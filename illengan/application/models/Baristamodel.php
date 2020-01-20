<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Baristamodel extends CI_Model{
        function checkIfLoggedIn(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
                return true;
            }
            return false;
        }

        // AUTOMATIC CONSUMPTION UPON PAYMENT
        // Get Orderlist by Orderslip ID
        function get_orderSlipItems($id){
            $query = "SELECT
                    olID AS item,
                    prID AS pref,
                    olQty AS qty
                FROM
                    orderlists
                WHERE
                    osID = ?;";
            return $this->db->query($query, array($id))->result_array();
        }
        // Get Preference's affiliated stocks
        function get_prefStockItems($id){
            $query = "SELECT
                    prID AS pref,
                    stID AS stock,
                    prstQty AS qty
                FROM
                    prefstock
                WHERE
                    prID = ?;";
            return $this->db->query($query, array($id))->result_array();
        }
        // Deduct from current stock qunatity
        // For automatic consumption $stQty value will be negative to deduct from quantity instead of adding
        function update_stockQty($stID, $stQty){
            $query = "UPDATE stockitems
            SET
                stQty = stQty + ?
            WHERE
                stID = ?";
            return $this->db->query($query, array($stQty, $stID));
        }

        // Add Consumption By Sales
        function add_consumptionFromSales($consumption, $consumedItems){
            $consumption_insert = $this->db->insert_string("consumptions", $consumption);
            $this->db->query($consumption_insert);
            $consumption_id = $this->db->insert_id();
            foreach($consumedItems as $key => $qty){
                $this->db->query("INSERT INTO consumed_items (ciID, cID) VALUES (NULL, ?)",array($consumption_id));
                $consumed_item_id = $this->db->insert_id();
                $this->update_stockQty($key, (-1 * $qty));
                $obj = array(
                    "tiType" => 'consumed',
                    "tiQty" => $qty,
                    "remainingQty" => $this->get_stockQtyConsumption($key),
                    "tiRemarks" => "Ordered",
                    "tiDate" => $consumption['cDate'],
                    "dateRecorded" => $consumption['cDateRecorded'],
                    "stID" => $key,
                    "ciID" => $consumed_item_id
                );
                $transitem_insert = $this->db->insert_string("transitems", $obj);
                $this->db->query($transitem_insert);
            }
        }

        
        function index()
        {
            if($this->checkIfLoggedIn()){
                $data['title'] = " ";
                $this->load->view('barista/head', $data);	
                $this->load->view('barista/barista');
            }else{
                redirect('login');
            } 
        }
    
        function get_oaddons(){
            $query = "SELECT * from orderaddons right join addons using (aoID)";
            return $this->db->query($query)->result_array();
        }
        
        function get_orderlist($osID){
            $query = "Select olID, olDesc, olQty, olSubTotal from orderlists inner join preferences using (prID) where osID = ?";
            return $this->db->query($query, array($osID))->result_array(); 
        }
        function orderlist(){
            $query = "SELECT * from orderslips join orderlists using (osID) join preferences using (prID)";
            return $this->db->query($query)->result_array();
        }
        function get_pendingOrders(){
            $status ="pending";
            $query = "SELECT * FROM orderslips left JOIN orderlists using (osID) where olStatus = ?;";
            return $this->db->query($query,array($status))->result_array();
        }
        function get_servedOrders(){
            $query = "SELECT * FROM orderslips inner JOIN orderlists on orderslips.osID= orderlists.osID where olStatus = 'served';";
            return $this->db->query($query)->result_array();
        }
        // function get_orderslips(){
        //     $this->load->database();
        //     $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) GROUP BY tableCode');
        //     return $query->result();
        // }

    //     function get_orderslips(){
    //         $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olDesc, olSubtotal, olStatus from orderslips inner join orderlists using (osID) GROUP BY osID, tableCode' );
    //         return $query->result();
    // }
        function get_orderitems($osID){
            $query = "SELECT osID, olDesc, olQty, olSubtotal, olPrice, osTotal, IFNULL(aoTotal, 0) as aoTotal from orderlists join orderslips USING (osID) left join orderaddons on orderlists.olID = orderaddons.olID WHERE osID = ?";
            return $this->db->query($query,array($osID))->result_array();
        }

        function get_availableTables(){
            $query = "SELECT tableCode FROM tables";
            return $this->db->query($query)->result_array();
        }

        function edit_tablenumber($osID, $tableCode){
             $query = "Update orderslips set tableCode = ? where osID=?";
             return $this->db->query($query,array($tableCode,$osID));
        }
       
        /*function search(){
            $query = $this->db
            ->select('*')
            ->from('orderslip')
            ->join('orderlist', 'orderslip.order_id=orderlist.order_id')
            ->join('menu', 'orderlist.menu_id=menu.menu_id')
            ->where('cust_name', $this->input->post('cust_name'))
            ->get();
         
         return $query->result_array();
      }*/

        function update_status($order_status, $olID) {
            $query = "UPDATE orderlists SET olStatus = ? WHERE olID = ?";
            return $this->db->query($query, array($order_status, $olID));
        }


        function get_bills(){
            $query = "select osID, tableCode, custName, osTotal, osDateTime,(CAST(osDateTime AS time)) as time, payStatus , osPayDateTime from orderslips where CAST(osDateTime AS date) = cast((now()) as date) ORDER BY payStatus desc, `orderslips`.`osDateTime` DESC";
            return $this->db->query($query)->result_array();
        }

        function get_orderslips(){
            $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olPrice, olDesc, olSubtotal, olStatus, IFNULL(aoTotal, 0) as aoTotal from orderslips inner join orderlists using (osID) left join orderaddons on orderlists.olID = orderaddons.olID GROUP BY osID, tableCode' );
            return $query->result();
        }

        function get_oslips(){
            $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olPrice, olDesc, olSubtotal, olStatus from orderslips inner join orderlists using (osID) where olStatus = "pending" and orderslips.osDateTime >= CURDATE() GROUP BY osID, tableCode' );
            return $query->result();

        }

        //JEANE NEEDED THIS FOR AUTO CONSUMPTION
        //May mali dito sa query kaya comment muna
        function get_olistsID($osID){
            $query = "SELECT prID,DATE_FORMAT(osDateTime,'%Y-%m-%d') osDate, olQty FROM orderlists NATURAL JOIN orderslips WHERE osID = ?";
            return $this->db->query($query,array($osID))->result();
        }
        function get_prefStocks(){
            $query = $this->db->query("SELECT * FROM prefstock");
            return $query->result();
        }
        function get_stockQtyConsumption($stID){
            $query = "SELECT stQty FROM stockitems WHERE stID = ?";
            return $this->db->query($query,array($stID))->row()->stQty;
        }
        function get_orderlists($osID){
            $query = "SELECT olID, olDesc, olQty, olSubtotal FROM orderlists INNER JOIN preferences USING (prID) INNER JOIN orderslips USING (osID) WHERE osID = ?";
            return $this->db->query($query, array($osID))->result_array(); 
        }
        function getLastNum2(){
            $this->db->select('MAX(tNum) AS lastnum');
            $this->db->from('transactions');
            $this->db->where('tType', 'consumption');
            return $this->db->get()->row()->lastnum;
        }
        function getLastConsumption(){
            $this->db->select('MAX(cID) lastnum');
            $this->db->from('consumptions');
            return $this->db->get()->row()->lastnum;
        }
        function getLastConItem(){
            $this->db->select('MAX(ciID) lastnum');
            $this->db->from('consumed_items');
            return $this->db->get()->row()->lastnum;
        }
        function getconsumptionItems(){
            $query="SELECT * FROM `prefstock` LEFT join stockitems using (stID)";
            return $this->db->query($query)->result_array();
        }

        function update_billstatus($osID, $payment_date_time = null, $date_recorded = null){
            $query = "update orderslips set osPayDate = ?, osDateRecorded = ? where osID=?";
            return $this->db->query($query, array($payment_date_time, $date_recorded, $osID));
        }

        // function restock($stocks){
        //     $query = "Update stockitems set stQty = ? + ? where stID = ?";
        //     if(count($stocks) > 0){
        //         for($in = 0; $in < count($stocks) ; $in++){
        //             $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'],  )); 
        //         }
        //     }
        // }
        
        # For Multiple Order Slips
        function update_payment($status,$osID,$payDate,$date_recorded){
            $query = "Update orderslips set payStatus = ?, osPayDateTime = ?, osDateRecorded = ? where osID = ?";
            for($in = 0; $in < count($osID) ; $in++){
                $this->db->query($query, array($status,$payDate, $date_recorded, $osID[$in]['osID']));
            }
        }

        # For One Order Slip
        function update_payment2($status,$osID,$payDate, $date_recorded){
            $query = "Update orderslips set payStatus = ?, osPayDateTime = ?, osDateRecorded = ? where osID = ?";
            $this->db->query($query, array($status,$payDate, $date_recorded, $osID));
        }

        function slipData(){
            $query = "SELECT osID, tableCode, custName, payStatus from orderslips";
            return $this->db->query($query)->result_array();
        } 

        function get_ordersData(){
            $query = "SELECT
            orderlists.olID,
            olQty,
            olDesc,
            olSubtotal,
            olRemarks,
            aoName,
            aoPrice
        FROM
            orderslips
        LEFT JOIN orderlists ON orderslips.osID = orderlists.osID
        LEFT JOIN orderaddons ON orderlists.olID = orderaddons.olID
        LEFT JOIN addons ON orderaddons.aoID = addons.aoID "; //where osID = ?
            return $this->db->query($query)->result_array();
        }
        //$query2 = "SELECT olID, aoName, aoPrice, olRemarks from orderlists inner join orderaddons using (olID) inner join addons using (aoID)";
        // function get_orderslips(){
        //     $query = "Select * from orderslips inner join (Select * from orderlists  where orderlists.olStatus = 'pending') as orderlists on orderslips.osID = orderlists.osID GROUP BY orderslips.osID, tableCode";
        //     return $this->db->query($query)->result_array();
        // }
        function get_pendingOlist(){
            $query = "Select * from  orderlists where olStatus = 'pending'";
            return $this->db->query($query)->result_array();
        }
        function get_servedorderslips(){
            $query = "SELECT * from orderslips inner join (Select * from orderlists  where orderlists.olStatus = 'served') as orderlists on orderslips.osID = orderlists.osID WHERE orderslips.osDateTime >= CURDATE() GROUP BY orderslips.osID, tableCode"; //WHERE CAST(osDateTime AS date) = cast((now()) as date)
            return $this->db->query($query)->result_array();
        }
        function get_servedOlist(){
            $query = "Select * from  orderlists where olStatus = 'served'";
            return $this->db->query($query)->result_array();
        }
        function get_olist(){
            $query = "Select * from orderlists inner join preferences on 
            orderlists.prID = preferences.prID inner join menu on preferences.mID = menu.mID; ";
            return $this->db->query($query)->result_array();
        }
        function updateStats($stats, $id){
            $query = "Update orderlists set olStatus = ? where olID = ?";
            return $this->db->query($query, array($stats, $id));
        }
       function cancelOrder($id){
            $list = "Select olPrice, osID from orderlists where olID='$id'";
            $ol= $this->db->query($list)->result_array();
            foreach($ol as $o){
                $price = $o['olPrice'];
                $osid = $o['osID'];
            }
            $slip = "Select osTotal from orderslips where osID = '$osid'";
            $sl = $this->db->query($slip)->result_array();
            foreach($sl as $s){
                $stotal = $s['osTotal'];
            }
            $total = $stotal - $price;
            $query= "Update orderslips set osTotal = ? where osID = ?";
            $this->db->query($query, array($total, $osid));

            $this->db->where('olID', $id);
            $this->db->delete('orderaddons');
            
            $this->db->where('olID', $id);
            $result=$this->db->delete('orderlists');
            return $result;
        }

        //MENU SPOILAGE ------------------------------------------------------------
        function getSlipNum(){
            $query="SELECT osID FROM  orderslips";
            return $this->db->query($query)->result_array();
        }
        function getCountRecMenuSpoil() {
            $query = "SELECT count(msID) as allcount FROM spoiledmenu";
            $result= $this->db->query($query)->result_array();      
            return $result[0]['allcount'];
        }
        function get_spoilagesmenu($rowno,$rowperpage){
            $query = "Select osID,menuspoil.msID as msID,prID, mName,msQty,DATE_FORMAT(menuspoil.msDate, '%b %d, %Y') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') 
            AS msDateRecorded,msRemarks, CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ',CONCAT(' ',mTemp))) as prName from menuspoil inner join spoiledmenu on menuspoil.msID=spoiledmenu.msID inner join preferences using (prID) 
            inner join menu using (mID) LIMIT $rowno, $rowperpage";
            return  $this->db->query($query)->result_array();
        }
        function get_menuPref(){
            $query = "SELECT prID, stID, prstQty, stQty, mName, CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ', 
            CONCAT(' ',mTemp))) as prName, prPrice, mAvailability FROM preferences INNER JOIN menu USING (mID) 
            LEFT JOIN prefstock USING (prID) LEFT JOIN stockitems USING (stID)";

            return $this->db->query($query)->result_array();
        }
        function edit_menuspoilage($msID,$prID,$msQty,$oldQty,$msDate,$msRemarks,$date_recorded,$osID,$account_id,$user){
            if($osID === ''){
                $osID = NULL;
            }else{
                $osID = $osID;
            }
            $query = "Update menuspoil set msDateRecorded = ?, msDate=? where msID=?";
            if($this->db->query($query,array($date_recorded,$msDate,$msID))){
                $query = "Update spoiledmenu set osID = ?, msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
                 $this->db->query($query,array($osID,$msQty,$msDate,$msRemarks,$msID,$prID));
                 $this->add_actlog($account_id,$date_recorded, "$user edited a spoiled menu.", "edited","");
                 $spoiled = "Select stID from spoiledmenu inner join prefstock on spoiledmenu.prID=prefstock.prID where msID = '$msID'";
                $stock = $this->db->query($spoiled)->result_array();
                foreach($stock as $stk){
                    if($stk['stID'] != null && $stk['stID'] != ''){
                        $this->update_stockItems($prID, $msQty, $oldQty);
                        $this->update_spoiledStock($msID,$msDate,$date_recorded,$msQty,$msRemarks,$prID);
                    }
                }
            }else{
                return false;
            }
        }
        //update
        function update_stockItems($prID, $msQty, $oldQty){
            $query3 = "Select stID from prefstock where prID = '$prID'";
            $stID = $this->db->query($query3)->result_array();
            foreach($stID as $s){
                $id = $s['stID'];
                $query4 = "Select stQty, prstQty from stockitems inner join prefstock on stockitems.stID=prefstock.stID
                where stockitems.stID = '$id' and prID='$prID'";
                $data = $this->db->query($query4)->result_array();
                foreach($data as $d){
                    $stQty = $d['stQty'];
                    $qty = $d['prstQty'];
                }
                if($msQty > $oldQty){
                    $diff = ($msQty * $qty) - ($oldQty * $qty);
                    $finQty = $stQty - $diff;
                    $updateQty = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($updateQty, array($finQty, $id));
                }else if($msQty < $oldQty){
                    $sum = ($oldQty * $qty) - ($msQty * $qty);
                    $finQty = $sum + $stQty;
                    $updateQty = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($updateQty, array($finQty, $id));
                }else{
                    $same = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($same, array($stQty, $id));
                }
            }
        }

        function update_spoiledStock($msID,$sDate,$dateRecorded,$qty,$remarks,$prID){
            $query = "Update stockspoil set  sDate=?, sDateRecorded = ? where msID=?";
            $this->db->query($query, array($sDate,$dateRecorded, $msID));
            $query1 = "SELECT sID from stockspoil where msID='$msID'";
            $rest = $this->db->query($query1)->result_array();
            foreach($rest as $r){
                $sID = $r['sID'];
                $query2 = "SELECT siID from spoiledstock where sID = '$sID'";
                $rest2 = $this->db->query($query2)->result_array();
                foreach($rest2 as $r2){
                    $siID = $r2['siID'];
                }
                $query3 = "SELECT  stID from prefstock where prID = '$prID'";
                $rest3 = $this->db->query($query3)->result_array();
                foreach($rest3 as $r3){
                    $stID = $r3['stID'];
                }
                $tiType = 'spoilage';
                $this->add_trans($prID,$stID,$qty,$remarks, $sDate, $siID, $tiType);
            }
        }
        function update_stockqnty($qty,$prID) {
            $query2 = "Select stID from prefstock where prID='$prID'";
            $result2= $this->db->query($query2)->result_array();
            foreach($result2 as $r2){
                $stID = $r2['stID'];
                $query1 = "SELECT stQty,prstQty FROM stockitems inner join prefstock on stockitems.stID=prefstock.stID where stockitems.stID = '$stID' AND prID='$prID'";
                $result= $this->db->query($query1)->result_array();
                foreach($result as $r){
                    $prstQty = $r['prstQty'];
                    $curQty = $r['stQty'];
                }
                $mul = $qty * $prstQty;
                $diff = $curQty - $mul;
         $query = "Update stockitems set stQty = ? where stID = ?";
         $this->db->query($query, array($diff, $stID));   
            } 
        }
        //add
        function add_trans($prID,$stID,$qty,$remarks, $date, $siID, $tiType){
            $query1 = "SELECT stQty, prstQty FROM stockitems inner join prefstock on stockitems.stID=prefstock.stID where stockitems.stID = '$stID' AND prID = '$prID'";
            $result= $this->db->query($query1)->result_array();
            foreach($result as $r){
                $prstQty = $r['prstQty'];
                $stQty = $r['stQty'];
            $query = "INSERT INTO transitems(tiID, tiType, tiQty, tiActual, remainingQty, tiRemarks, tiDate, stID, siID)
                VALUES (NULL, ?,?,?,?,?,?,?,?)";
             $this->db->query($query, array($tiType, $qty, $prstQty, $stQty, $remarks, $date, $stID, $siID));
            } 
            
        }
        function add_menuspoil($date,$date_recorded,$account_id,$menu, $tiType, $user){
            $query = "insert into menuspoil (msID,msDate,msDateRecorded) values (NULL,?,?)";
            if($this->db->query($query,array($date,$date_recorded))){ 
                $this->add_spoiledmenu($this->db->insert_id(),$account_id,$menu,$date,$date_recorded, $tiType);
                $this->add_actlog($account_id,$date_recorded, "$user added a spoiled menu.", "add","");
                return true;
            }
        }
        function add_spoiledmenu($msID,$account_id,$menus,$date,$date_recorded,$tiType){
            $query = "insert into spoiledmenu (msID,prID,osID,msQty,msDate,msRemarks) values (?,?,?,?,?,?)";
            if(count($menus) > 0){
                for($in = 0; $in < count($menus) ; $in++){
                    if($menus[$in]['slip'] === ''){
                        $osID = NULL;
                    }else{
                        $osID = $menus[$in]['slip'];
                    }
                $this->db->query($query, array($msID, $menus[$in]['prID'],$osID,$menus[$in]['qty'],$date,$menus[$in]['remarks']));
                    if($menus[$in]['stID'] !== null && $menus[$in]['stID'] !== '') {
                        $this->update_stockqnty($menus[$in]['qty'], $menus[$in]['prID']);
                        $this->add_stockSpoiled($menus[$in]['prID'],$msID,$menus[$in]['qty'],$menus[$in]['remarks'],$date,$date_recorded, $tiType);
                    }
                }
            }
        }
        function add_stockSpoiled($prID,$msID,$qty,$remarks,$date,$date_recorded,$tiType){
            $query1 = "SELECT stID FROM prefstock where prID = '$prID'";
            $return = $this->db->query($query1)->result_array();
            foreach($return as $ret){
                $query = "insert into stockspoil (sID, msID,sDate, sDateRecorded) values (NULL,?,?,?)";
                if($this->db->query($query, array($msID,$date,$date_recorded))){
                    $sID = $this->db->insert_id();
                    $query2 = "insert into spoiledstock (siID,sID) values (NULL,?)";
                    if($this->db->query($query2, array($sID))){
                        $this->add_trans($prID,$ret['stID'],$qty,$remarks,$date, $this->db->insert_id(), $tiType);
                    }
                }
            }
        }

        //ADDON SPOILAGES-------------------------------------------------------------------------------------------------
        function get_addspoil($s, $l){
            $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(addonspoil.aosDate, '%b %d, %Y') AS aosDate, 
            DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using 
            (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC Limit $s, $l";
            return  $this->db->query($query)->result_array();
        }
        function countRecAddsSpoil(){
            $query = "Select count(aoID) as allcount from addonspoil";
            $result = $this->db->query($query)->result_array();
            return $result[0]['allcount'];
        }
        function get_spoilagesaddons(){
            $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(addonspoil.aosDate, '%b %d, %Y') AS aosDate, DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC";
            return  $this->db->query($query)->result_array();
        }
        function get_addons(){
            $query = "Select * from addons left join orderaddons using (aoID)";
            return $this->db->query($query)->result_array();
        }
        function add_aospoil($date_recorded,$date,$addons,$account_id,$user){
            $query = "insert into aospoil (aosID,aosDateRecorded) values (NULL,?)";
            if($this->db->query($query,array($date_recorded))){ 
                $this->add_spoiledaddon($this->db->insert_id(),$addons,$date_recorded,$date,$account_id,$user);
                return true;
            }
        }
        function add_spoiledaddon($aosID,$addons,$date_recorded,$date,$account_id,$user){
            $query = "INSERT INTO `addonspoil`(`aoID`, `aosID`, `osID`, `aosQty`, `aosDate`, `aosRemarks`) VALUES (?,?,?,?,?,?)";
            if(count($addons) > 0){
                for($in = 0; $in < count($addons) ; $in++){
                    $this->db->query($query, array($addons[$in]['aoID'],$aosID, $addons[$in]['osID'], $addons[$in]['aosQty'],$date,$addons[$in]['tRemarks']));
                    $this->add_actlog($account_id,$date_recorded, "$user added an addon spoilage.", "add", $addons[$in]['tRemarks']);
                    
                }    
            }
        }
        function edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded){
            $query = "Update aospoil set aosDateRecorded = ? where aosID=?";
            if($this->db->query($query,array($date_recorded,$aosID))){
                $query = "Update addonspoil set aosQty = ?,aosDate = ?,aosRemarks = ? where aoID = ? and aosID = ?";
                return $this->db->query($query,array($aosQty,$aosDate,$aosRemarks,$aoID,$aosID));
            }else{
                return false;
            }
        }
        //ADDON SPOILAGES-------------------------------------------------------------------------------------------------
        function get_addspoil($s, $l){
            $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(addonspoil.aosDate, '%b %d, %Y') AS aosDate, 
            DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using 
            (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC Limit $s, $l";
            return  $this->db->query($query)->result_array();
        }
        function countRecAddsSpoil(){
            $query = "Select count(aoID) as allcount from addonspoil";
            $result = $this->db->query($query)->result_array();
            return $result[0]['allcount'];
        }
        function get_spoilagesaddons(){
            $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(addonspoil.aosDate, '%b %d, %Y') AS aosDate, DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC";
            return  $this->db->query($query)->result_array();
        }
        function get_addons(){
            $query = "Select * from addons left join orderaddons using (aoID)";
            return $this->db->query($query)->result_array();
        }
        function add_aospoil($date_recorded,$date,$addons,$account_id,$user){
            $query = "insert into aospoil (aosID,aosDateRecorded) values (NULL,?)";
            if($this->db->query($query,array($date_recorded))){ 
                $this->add_spoiledaddon($this->db->insert_id(),$addons,$date_recorded,$date,$account_id,$user);
                return true;
            }
        }
        function add_spoiledaddon($aosID,$addons,$date_recorded,$date,$account_id,$user){
            $query = "INSERT INTO `addonspoil`(`aoID`, `aosID`, `osID`, `aosQty`, `aosDate`, `aosRemarks`) VALUES (?,?,?,?,?,?)";
            if(count($addons) > 0){
                for($in = 0; $in < count($addons) ; $in++){
                    $this->db->query($query, array($addons[$in]['aoID'],$aosID, $addons[$in]['osID'], $addons[$in]['aosQty'],$date,$addons[$in]['tRemarks']));
                    $this->add_actlog($account_id,$date_recorded, "$user added an addon spoilage.", "add", $addons[$in]['tRemarks']);
                    
                }    
            }
        }
        function edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded){
            $query = "Update aospoil set aosDateRecorded = ? where aosID=?";
            if($this->db->query($query,array($date_recorded,$aosID))){
                $query = "Update addonspoil set aosQty = ?,aosDate = ?,aosRemarks = ? where aoID = ? and aosID = ?";
                return $this->db->query($query,array($aosQty,$aosDate,$aosRemarks,$aoID,$aosID));
            }else{
                return false;
            }
        }
        //Stock Spoilage---------------------------------------------------------------------------------------------------
        function get_spoilagesstock($s, $l){
            $query = "SELECT `tiID`,`tiType`,sum(`tiQty`) AS tiQty, sum(`tiActual`) AS tiActual,`remainingQty`,`tiRemarks`,`tiDate`,`stID`,`siID`,`stName`, `stQty` FROM `transitems` inner join stockitems using (stID) inner join uom USING (uomID) WHERE tiType = 'spoilage' GROUP BY `siID`,`stID` LIMIT $s, $l";
            return  $this->db->query($query)->result_array();
        }
        function countSpoiledStock(){
            $query = "SELECT count(stID) as allcount FROM `transitems` WHERE tiType = 'spoilage'";
            $result =  $this->db->query($query)->result_array();
            return $result[0]['allcount'];
        }
        // function get_stocks(){
        //     $query = "SELECT
        //     stockitems.stID,
        //     CONCAT(
        //         stName,
        //         IF(
        //             stSize IS NULL,
        //             '',
        //             CONCAT(' ', stSize)
        //         )
        //     ) AS stName,
        //     stMin,
        //     stQty,
        //     uomID,
        //     uomAbbreviation,
        //     uomStore,
        //     stBqty,
        //     UPPER(stStatus) AS stStatus,
        //     stType,
        //     UPPER(stLocation) AS stLocation,
        //     ctName,
        //     ctID
        // FROM
        //     (
        //         stockitems
        //     LEFT JOIN uom USING(uomID)
        //     )
        // LEFT JOIN categories USING(ctID)
        // GROUP BY
        //     stID order by ctName, stName asc";
        //     return $this->db->query($query)->result_array();
        // }

        function get_stocks(){
            $query = "SELECT
            stockitems.stID,
            CONCAT(
                stName,
                IF(
                    stSize IS NULL,
                    '',
                    CONCAT(' ', stSize)
                )
            ) AS stName,
            stMin,
            stQty,
            uomID,
            uomAbbreviation,
            uomStore,
            stBqty,
            UPPER(stStatus) AS stStatus,
            stType,
            UPPER(stLocation) AS stLocation,
            ctName,
            ctID
        FROM
            (
                stockitems
            LEFT JOIN uom USING(uomID)
            )
        LEFT JOIN categories USING(ctID)
        GROUP BY
            stID order by ctName, stName asc";
            return $this->db->query($query)->result_array();
        }
    
        function edit_stockspoilage($tDate,$date_recorded,$actualQtyUpdate,$tRemarks,$tID, $tiID){
            $query = "UPDATE `transactions` SET `tDate`= ?,`dateRecorded` = ?, `tRemarks`= ? where tID = ?";
            if($this->db->query($query,array($tDate,$date_recorded,$tRemarks,$tID))){
                $query = "UPDATE `trans_items` SET `actualQty`= ? where tID = ? AND tiID = ?";
                $this->db->query($query,array($actualQtyUpdate ,$tID, $tiID));
            }else{
                return false;
            }
        }
        function update_stock($stID, $stQty) {
            $query = "UPDATE `stockitems` SET `stQty` = ? WHERE `stID` = ?;";
            $this->db->query($query, array($stQty, $stID));
        }
        function add_stockspoil($date_recorded,$stocks,$account_id,$user,$date,$remarks){
            $query = "INSERT INTO `stockspoil`(`sID`, `sDate`, `sDateRecorded`) VALUES (NULL,?,?)";
            if($this->db->query($query,array($date,$date_recorded))){
                $this->add_spoileditems($this->db->insert_id(),$stocks,$remarks,$date,$account_id,$date_recorded,$user);
            }
        }
        function add_spoileditems($sID,$stocks,$remarks,$date,$account_id,$date_recorded,$user){
            $query = "INSERT INTO `spoiledstock`(`siID`, `sID`) VALUES (NULL,?)";
            if($this->db->query($query,array($sID))){
                $this->add_spoiltransitems($this->db->insert_id(),$stocks,$date,$date_recorded);
                $this->add_actlog($account_id,$date_recorded, "$user added a stock spoilage.", "add", $remarks);
            }
        }
        function add_spoiltransitems($siID,$stocks,$date,$date_recorded){
            $query = "INSERT INTO `transitems`(`tiID`, `tiType`,`tiQty`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`,`dateRecorded`) VALUES (NULL,?,?,?,?,?,?,?,?,?)";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query,array("spoilage",$stocks[$in]['tiQty'],$stocks[$in]['actualQty'],$stocks[$in]['curQty']-$stocks[$in]['actualQty'],$stocks[$in]['tRemarks'],$date,$stocks[$in]['stID'],$siID,$date_recorded));
                    $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                }
            }
        }
        //----------------------
        function getLastNum(){
            $this->db->select('MAX(tNum) AS lastnum');
            $this->db->from('transactions');
            $this->db->where('tType', 'spoilage');

            return $this->db->get()->row()->lastnum;
        }
        function add_stocktransitems($tiType,$actualQtyUpdate,$tiRemainingQty,$tiDate,$tiRemarks, $stID, $siID,$date_recorded){
            $query = "INSERT INTO `transitems`(`tiID`, `tiType`,`tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`,`dateRecorded`) VALUES (NULL,?,?,?,?,?,?,?,?)";
            return $this->db->query($query, array($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID,$date_recorded));
        }
        function destockvarItems($stID,$curQty,$actualQty){
            $query = "UPDATE stockitems SET stQty = ? - ? WHERE stID = ?;";
            return $this->db->query($query,array($curQty,$actualQty,$stID));
           
        }
        function deleteStockspoil($tID){
            $query ="Update transactions set isArchived = ? where tID = ?";
            return $this->db->query($query, array('1', $tID));
        }
        
        function add_stockLog($stID, $tID, $slType, $slDateTime, $dateRecorded, $actualQty, $slRemainingQty, $slRemarks){
            $query = "INSERT INTO `stocklog`(
                    `slID`,
                    `stID`,
                    `tID`,
                    `slType`,
                    `slDateTime`,
                    `dateRecorded`,
                    `slQty`,
                    `slRemainingQty`,
                    `slRemarks`
                )
                VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
            return $this->db->query($query, array($stID, $tID, $slType, $slDateTime, $dateRecorded, $actualQty, $slRemainingQty, $slRemarks));
        }
        function add_actlog($aID, $alDate, $alDesc, $defaultType, $additionalRemarks){
            $query = "INSERT INTO `activitylog`(
                `alID`,
                `aID`,
                `alDate`, 
                `alDesc`, 
                `alType`, 
                `additionalRemarks`
                ) 
                VALUES (NULL, ?, ?, ?, ?, ?)";
                return $this->db->query($query, array($aID, $alDate, $alDesc, $defaultType, $additionalRemarks));
        } 
        
        // function get_deliveryReceipts(){
        //     $query = "SELECT
        //             tID AS id,
        //             tNum AS num,
        //             receiptNo AS receipt,
        //             IF(
        //                 spID IS NULL,
        //                 supplierName,
        //                 spName
        //             ) AS supplier,
        //             tType AS type,
        //             tTotal AS total,
        //             tRemarks AS remarks,
        //             tDate AS date,
        //             dateRecorded AS daterecorded
        //         FROM
        //             transactions
        //         LEFT JOIN supplier USING(spID)
        //         WHERE
        //             isArchived = '0' and tType = 'delivery receipt'
        //     ORDER BY tID desc";
        //     return $this->db->query($query)->result_array();
        // }
        function get_deliveryReceipts(){
            $query = "SELECT dID, spName, dDate AS ddate, DATE_FORMAT(dDate, '%b %d, %Y') as pDate, pTotal, spID, receiptNo as receipt, spAltName 
            FROM deliveries LEFT JOIN supplier USING (spID) INNER JOIN (SELECT SUM(tiSubtotal) as pTotal, dID 
            from transitems INNER JOIN delivery_items USING (diID) LEFT JOIN deliveries USING (dID) GROUP BY dID) 
            as total USING (dID)";
            return $this->db->query($query)->result_array();
        }

        function get_deliveryItems(){
            $query = "SELECT spmID,tiID, d.dID, di.diID, ti.piID, receiptNo, ti.stID, stName, CONCAT(stName,' ',stSize) as stock, 
            CONCAT(spmName,' ',stSize) as merch, stSize, spmName, spmPrice, spmActual, tiQty as qty, uomName, tiActual as actual, 
            tiType, tiSubtotal, diStatus, piStatus FROM delivery_items di LEFT JOIN transitems ti USING (diID) LEFT JOIN deliveries d USING (dID) 
            LEFT JOIN purchase_items USING (piID) LEFT JOIN stockitems st ON (ti.stID = st.stID) LEFT JOIN suppliermerchandise spm 
            USING (spmID) LEFT JOIN uom ON (spm.uomID = uom.uomID) INNER JOIN (SELECT max(tiID) as tiID FROM transitems ti GROUP BY diID)
             AS maxNew USING (tiID) WHERE tiType = 'restock'";
            return $this->db->query($query)->result_array();
        }

        function get_deliveryReceiptItems(){
            $query = "SELECT
                tID AS transaction,
                tiID AS id,
                tiName AS name,
                tiQty AS qty,
                qtyPerItem AS equivalent,
                actualQty AS actualqty,
                tiPrice AS price,
                tiDiscount AS discount,
                drStatus AS deliverystatus,
                payStatus AS paymentstatus,
                rStatus AS returnstatus,
                tiSubtotal AS subtotal
            FROM
                (
                    transitems
                LEFT JOIN trans_items USING(tiID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID)
            WHERE
                tType = 'delivery receipt'";
            return $this->db->query($query)->result_array();
        }

        // function get_uomForStoring(){
        //     $query = "SELECT
        //         uomID,
        //         uomName,
        //         uomAbbreviation
        //     FROM
        //         uom
        //     WHERE
        //         uomStore IS NOT NULL;";
        //     return $this->db->query($query)->result_array();
        // }

        function get_uomForStoring(){
            $query = "SELECT
                uomID,
                uomName,
                uomAbbreviation
            FROM
                uom
            WHERE
                uomStore IS NOT NULL order by uomAbbreviation asc;";
            return $this->db->query($query)->result_array();
        }

        // function get_stockitems() {
        //     $query = "SELECT * FROM stockitems LEFT JOIN uom USING (uomID) LEFT JOIN suppliermerchandise USING (stID) ORDER BY 2;";
        //     return $this->db->query($query)->result_array();
        // }

        function get_stockitems() {
            $query = "SELECT * FROM suppliermerchandise INNER JOIN supplier USING (spID) INNER JOIN stockitems USING (stID) LEFT JOIN uom ON stockitems.uomID = uom.uomID order by 2";
            return $this->db->query($query)->result_array();
        }

        function add_purchase($spID, $receiptNo, $pType, $dDate, $dDateRecorded, $spAltName, $items, $addtype, $accountID){
            $query = "INSERT INTO `deliveries` (spID, receiptNo, dDate, dDateRecorded, spAltName ) VALUES(?,?,?,?,?);";
            if($this->db->query($query, array($spID, $receiptNo, $dDate, $dDateRecorded, $spAltName))) {
                $this->add_dItem($this->db->insert_id(), $items, $addtype, $dDateRecorded, $accountID);
            }
        }

        function get_supplier(){
            $query = "SELECT * from supplier where spStatus <> 'archived' order by spName";
            return $this->db->query($query)->result_array();
        }

        function get_retItems() {
            $query = "SELECT tiID, DATE_FORMAT(ret.rDate, '%b %d, %Y') as rDate, ret.rID, ri.riID, ri.returnReference, spmID, ri.riStatus, ret.spID, ti.stID, spmPrice, spmActual, spAltName, stName, u.uomAbbreviation,
            u.uomName, tiQty, tiActual,  CONCAT(ti.tiQty,' ',u.uomAbbreviation,'/s of ',st.stName) AS item 
            FROM `transitems` ti LEFT JOIN return_items ri USING (riID) LEFT JOIN returns ret USING (rID) LEFT JOIN stockitems st USING (stID) 
            LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom u ON (spm.uomID = u.uomID) INNER JOIN (SELECT max(tiID) as tiID 
            FROM transitems ti LEFT JOIN return_items ri USING (riID) WHERE ri.riStatus = 'pending' AND ti.tiType = 'return' 
            GROUP BY riID) AS maxNew USING (tiID) ";
            return $this->db->query($query)->result_array();
    
        }

        function get_unresolveReturns() {
            $query = "SELECT *,  DATE_FORMAT(rDate, '%b %d, %Y') as rDate FROM `returns` LEFT JOIN supplier USING (spID) LEFT
            JOIN return_items USING (rID) where riStatus = 'pending'";
            return $this->db->query($query)->result_array();
        }

        function get_supplierstocks(){
            $query = "Select * from suppliermerchandise supp LEFT JOIN stockitems USING (stID) LEFT JOIN uom ON (supp.uomID = uom.uomID);";
            return $this->db->query($query)->result_array();
        }
        function get_posForBrochure(){
            $query = "SELECT
                    tID as transactionID,
                    spID suppID,
                    spName suppName,
                    supplierName altName,
                    tNum as transNum,
                    receiptNo as receipt,
                    tDate as date,
                    tTotal as total,
                    tRemarks as remarks
                FROM
                    transactions
                LEFT JOIN supplier USING(spID)
                WHERE
                    tID IN(
                    SELECT
                        tID AS transactionID
                    FROM
                        (
                            transitems
                        LEFT JOIN trans_items USING(tiID)
                        )
                    LEFT JOIN transactions USING(tID)
                    WHERE
                        tType = 'purchase order' AND drStatus = 'pending'
                    GROUP BY
                        tID
                )";
            return $this->db->query($query)->result_array();
        }
        function get_poItemsForBrochure(){
            $query = "SELECT
                    tID AS transactionID,
                    tiID AS itemID,
                    tiName AS NAME,
                    tiPrice AS price,
                    tiDiscount AS discount,
                    uomID AS uom,
                    stID AS stock,
                    tiQty AS qty,
                    qtyPerItem AS equivalent,
                    tiSubtotal AS subtotal
                FROM
                    (
                        transitems
                    LEFT JOIN trans_items USING(tiID)
                    )
                LEFT JOIN transactions USING(tID)
                WHERE
                    tType = 'purchase order' AND drStatus = 'pending'";
            return $this->db->query($query)->result_array();
        }
        function get_officialReceipts(){
            $query = "SELECT
                    tID AS id,
                    tNum AS num,
                    receiptNo AS receipt,
                    IF(
                        spID IS NULL,
                        supplierName,
                        spName
                    ) AS supplier,
                    tType AS type,
                    tTotal AS total,
                    tRemarks AS remarks,
                    tDate AS date,
                    dateRecorded AS daterecorded
                FROM
                    transactions
                LEFT JOIN supplier USING(spID)
                WHERE
                    isArchived = '0' and tType = 'official receipt'
            ORDER BY tID desc";
            return $this->db->query($query)->result_array();
        }
        function get_officialReceiptItems(){
            $query = "SELECT
                tID AS transaction,
                tiID AS id,
                tiName AS name,
                tiQty AS qty,
                qtyPerItem AS equivalent,
                actualQty AS actualqty,
                tiPrice AS price,
                tiDiscount AS discount,
                drStatus AS deliverystatus,
                payStatus AS paymentstatus,
                rStatus AS returnstatus
            FROM
                (
                    transitems
                LEFT JOIN trans_items USING(tiID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID)
            WHERE
                tType = 'official receipt'";
            return $this->db->query($query)->result_array();
        }

        function get_purchases(){
            $query="SELECT *, DATE_FORMAT(pDate, '%b %d, %Y') as pDate FROM `purchases` INNER JOIN pur_items USING (`pID`) INNER JOIN purchase_items USING (`piID`) 
            INNER JOIN transitems USING (piID) INNER JOIN supplier USING (spID) WHERE purchase_items.piStatus != 'delivered' 
            GROUP BY pID";
            return $this->db->query($query)->result_array();
        }

        function get_purchItems($pID){
            $query="SELECT ti.stID, pu.piID, ti.spmID, spmActual, spmPrice, tiQty, spmName, uomAbbreviation FROM transitems ti 
            LEFT JOIN purchase_items pu USING (piID) LEFT JOIN pur_items pri USING (piID) LEFT JOIN purchases pur USING 
            (pID) INNER JOIN supplier USING (spID) LEFT JOIN suppliermerchandise sm ON (ti.spmID = sm.spmID) LEFT JOIN uom
            USING (uomID) WHERE piStatus != 'delivered' AND tiType = 'purchase order' AND pur.piD = ?";
            return $this->db->query($query,array($pID))->result_array();
        }

        function get_enumVals($table,$column){
            $query = "SELECT 
                column_type
            FROM
                COLUMNS
            WHERE
                TABLE_NAME = ?
                    AND COLUMN_NAME = ?;";
            return $this->infoDB->query($query,array($table,$column))->result_array();
        }

        function get_transaction($id){
            $query = "SELECT
                tID,
                tNum,
                tType,
                tDate,
                spID,
                spName,
                tRemarks
            FROM
                transactions
            LEFT JOIN supplier USING(spID)
            WHERE 
                tID = ?;";
            return $this->db->query($query, array($id))->result_array();
        }

        function get_transactionsBySupplier($spID, $tTypes){
            $query = "SELECT
                    spID,
                    tID,
                    tNum,
                    DATE_FORMAT(tDate, '%b %d, %Y %r') AS tDate,
                    DATE_FORMAT(dateRecorded, '%b %d, %Y %r') AS dateRecorded,
                    tType,
                    COUNT(tiID) as tCount
                FROM
                    (transactions
                LEFT JOIN supplier USING(spID)) LEFT JOIN trans_items using(tID)
                WHERE
                    spID = ? AND tType IN ?
                GROUP BY tID
                HAVING 
                    COUNT(tiID) > 0
                ORDER BY transaction.tDate ASC;";
            return $this->db->query($query, array($spID, $tTypes))->result_array();
        }

        function get_transitemsBySupplier($spID, $tTypes){
            $query = "SELECT
                spID, tID, tiID, tiName, tiPrice, tiDiscount, rStatus, tNum, tType,
                stID, CONCAT(stName, IF(stSize IS NULL,'',CONCAT(' ',stSize))) as stName, 
                ti.uomID AS uomID, uomAbbreviation, tiQty, actualQty, tiSubtotal
            FROM
                (
                    (
                        (
                            (
                                transitems AS ti
                            LEFT JOIN uom ON
                                (ti.uomID = uom.uomID)
                            )
                        LEFT JOIN trans_items USING(tiID)
                        )
                    LEFT JOIN transactions USING(tID)
                    )
                LEFT JOIN supplier USING(spID)
                )
            LEFT JOIN stockitems AS st USING(stID)
            WHERE
                spID = ? AND tType IN ?;";
            return $this->db->query($query, array($spID, $tTypes))->result_array();
        }

        function get_SPMs($spID){
            $query = "SELECT
                stID,
                CONCAT(
                    stName,
                    IF(stSize IS NULL, '', CONCAT(' ', stSize))
                ) AS stName,
                suppliermerchandise.uomID,
                uomAbbreviation,
                spmID,
                spmName,
                spmPrice,
                spmActual,
                spID,
                spName
            FROM
                (
                    stockitems
                RIGHT JOIN(
                        suppliermerchandise
                    LEFT JOIN supplier USING(spID)
                    ) USING(stID)
                )
            LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID) 
            WHERE spID = ?";
            return $this->db->query($query, array($spID))->result_array();
        }

        function get_supplierNames(){
            $query = "Select spID, spName from supplier order by spName";
            return $this->db->query($query)->result_array();
        }

        function get_stockItemNames(){
            $query = "SELECT
                stID,
                CONCAT(stName, if(stSize is NULL,'', concat(' ', stSize))) as stName,
                uomID,
                uomAbbreviation
            FROM
                stockitems
            LEFT JOIN uom USING(uomID);";
            return $this->db->query($query)->result_array();
        }

        // function get_SPMs($spID){
        //     $query = "SELECT
        //         stID,
        //         CONCAT(
        //             stName,
        //             IF(stSize IS NULL, '', CONCAT(' ', stSize))
        //         ) AS stName,
        //         suppliermerchandise.uomID,
        //         uomAbbreviation,
        //         spmID,
        //         spmName,
        //         spmPrice,
        //         spmActualQty,
        //         spID,
        //         spName
        //     FROM
        //         (
        //             stockitems
        //         RIGHT JOIN(
        //                 suppliermerchandise
        //             LEFT JOIN supplier USING(spID)
        //             ) USING(stID)
        //         )
        //     LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID) 
        //     WHERE spID = ?";
        //     return $this->db->query($query, array($spID))->result_array();
        // }
        function get_posBySupplier($id){
            $query = "SELECT
                    tID as transactionID,
                    spID suppID,
                    spName suppName,
                    supplierName altName,
                    tNum as transNum,
                    receiptNo as receipt,
                    tDate as date,
                    tTotal as total,
                    tRemarks as remarks
                FROM
                    transactions
                LEFT JOIN supplier USING(spID)
                WHERE
                    tID IN(
                    SELECT
                        tID AS transactionID
                    FROM
                        (
                            transitems
                        LEFT JOIN trans_items USING(tiID)
                        )
                    LEFT JOIN transactions USING(tID)
                    WHERE
                        tType = 'purchase order' AND drStatus = 'pending' AND spID = ?
                    GROUP BY
                        tID
                )";
            return $this->db->query($query, array($id))->result_array();
        }
        function get_poItemsBySupplier($id){
            $query = "SELECT
                    tID AS transactionID,
                    tiID AS itemID,
                    tiName AS NAME,
                    tiPrice AS price,
                    tiDiscount AS discount,
                    transitems.uomID AS uom,
                    uomAbbreviation as unit,
                    stID AS stock,
                    CONCAT(stName,
                        IF(stSize IS NULL, '', CONCAT(' ', stSize))
                    ) AS stockname,
                    tiQty AS qty,
                    qtyPerItem AS equivalent,
                    actualQty as actual,
                    tiSubtotal AS subtotal
                FROM
                    (
                        transitems
                    LEFT JOIN trans_items USING(tiID)
                    )
                left join stockitems using (stID)
                LEFT JOIN uom on (transitems.uomID = uom.uomID)
                LEFT JOIN transactions USING(tID)
                WHERE
                    tType = 'purchase order' AND drStatus = 'pending' AND spID = ?";
            return $this->db->query($query, array($id))->result_array();
        }
        function add_receiptTransaction($transaction){
            $query = "INSERT INTO transactions(
                    tID, spID, supplierName, tNum, receiptNo, tDate, dateRecorded, tType, tTotal, tRemarks
                )
                VALUES(
                    NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $lastNum = $this->db->query("SELECT MAX(tNum) AS lastnum
                FROM transactions
                WHERE tType = ?",array($transaction['type']))->result_array()[0]['lastnum'];
            $lastNum = $lastNum == NULL ? 1 : $lastNum+1;
            if($this->db->query($query, array($transaction['supplier'], $transaction['supplierName'], $lastNum, $transaction['receipt'],
                $transaction['date'], $transaction['dateRecorded'], $transaction['type'], $transaction['total'], $transaction['remarks']))){
                return $this->db->insert_id();
            }
            return 0;
        }
        function get_poItem($tiID){
            $query = "SELECT tiID, tiID, tType, tiQty, qtyPerItem, actualQty, drStatus
                FROM (transitems LEFT JOIN trans_items USING(tiID))
                LEFT JOIN transactions USING(tID)
                WHERE tType = 'purchase order' AND drStatus = 'pending' and tiID = ?;";
            return $this->db->query($query,array($tiID))->result_array();
        }
        function add_receiptTransactionItems($item){
            $query = "INSERT INTO transitems(tiID, uomID, stID, tiName, tiPrice, tiDiscount, drStatus, paystatus, rStatus)
                VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($query, array($item['uom'], $item['stock'], $item['name'], $item['price'], $item['discount'], $item['delivery']
                , $item['payment'], $item['return']))){
                return $this->db->insert_id();
            }
            return 0;
        }
        function add_receiptTransactionItemsQty($tID, $item){
            $query = "INSERT INTO trans_items(tID, tiID, tiQty, qtyPerItem, actualQty, tiSubtotal)
                VALUES(?, ?, ?, ?, ?, ?)";
            return $this->db->query($query, array($tID, $item['tiID'], $item['tiQty'], $item['perUnit'], $item['actual'], $item['subtotal']));
        }
        function add_restockLog($tID, $log){
            $query = "INSERT INTO stocklog(
                stID,
                tID,
                slType,
                slQty,
                slRemainingQty,
                actualQty,
                discrepancy,
                slDateTime,
                dateRecorded,
                slRemarks
            )
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $this->db->query($query ,array($log['stock'], $tID, 'restock', $log['qty'], $log['remain'], $log['actual'], $log['discrepancy']
            , $log['dateTime'], $log['dateRecorded'], $log['remarks']));
        }
        function edit_receiptTransactionItems($item){
            $query = "UPDATE
                    transitems
                SET
                    tiPrice = ?,
                    tiDiscount = ?,
                    drStatus = ?,
                    payStatus = ?,
                    rStatus = ?
                WHERE
                    tiID = ?;";
            return $this->db->query($query, array($item['price'], $item['discount'], $item['delivery']
            , $item['payment'], $item['return'], $item['tiID']));
        }
        function add_orReceiptItemsForPO($item){
            $query = "UPDATE
                    transitems
                SET
                    tiPrice = ?,
                    tiDiscount = ?,
                    drStatus = ?,
                    payStatus = ?,
                    rStatus = ?
                WHERE
                    tiID = ?;";
        }
    function edit_receiptTransactionTotal($tID, $total){
        $query = "UPDATE
                transactions
            SET
                tTotal = ?
            WHERE
                tID = ?;";
        return $this->db->query($query,array($total, $tID));
    }
    //--------------CONSUMPTIONS-------------------
    function get_consumpitems($s, $l){
        $query = "SELECT `tiID`,`tiType`,sum(`tiQty`) AS tiQty, sum(`tiActual`) AS tiActual,`remainingQty`,`tiRemarks`,`tiDate`,`stID`,`ciID`,`stName`, `stQty` 
        FROM `transitems` inner join stockitems using (stID) inner join uom USING (uomID) WHERE tiType = 'consumed' 
        GROUP BY `ciID`,`stID` LIMIT $s, $l";
        return  $this->db->query($query)->result_array();
    }
    function countConsump(){
        $query = "SELECT count(tiID) as allcount from transitems WHERE tiType = 'consumed'";
          $result = $this->db->query($query)->result_array();
           return $result[0]['allcount'];
    }
    function add_consumptiontransitems($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $ciID,$date_recorded){
        $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`ciID`,`dateRecorded`) VALUES (NULL,?,?,?,?,?,?,?,?)";
        return $this->db->query($query, array($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $ciID,$date_recorded));
    }
    function add_consumption($date_recorded,$stocks,$account_id,$user,$date,$remarks) {
        $query = "INSERT INTO consumptions (cID, cDate, cDateRecorded) VALUES (NULL,?,?)";
        if($this->db->query($query, array($date, $date_recorded))) {
            $this->consumed_item($this->db->insert_id(), $stocks,$remarks,$date,$account_id,$date_recorded,$user);
        }
    }
    function consumed_item($cID, $stocks,$remarks,$date,$account_id,$date_recorded,$user) {
        $query = "INSERT INTO consumed_items (ciID, cID) VALUES (NULL,?)";
        if($this->db->query($query, array($cID))) {
            $this->add_consumptransitems($this->db->insert_id(),$stocks,$date,$date_recorded);
            $this->add_actlog($account_id,$date_recorded, "$user added a consumption record.", "add", $remarks);
        }
    }
    function addAutoConsumption($consumption,$destockables){
        $this->db->insert('consumptions',$consumption);
        $conID = $this->db->insert_id();
        $this->addAutoTransItems($conID,$destockables);
    }
    function addAutoTransItems($conID,$destockables){
        $conitemID = $this->getLastConItem();
        $conitemIDs = array();
        $consumables = array();
        for($x = 0; $x < count($destockables); $x++){
            $destockables[$x]['ciID'] = $conitemID;
            array_push($conitemIDs,array(
                'cID'   => $conID,
                'ciID'  => $conitemID
            ));
            array_push($consumables,array(
                'stID'  => $destockables[$x]['stID'],
                'stQty' => $destockables[$x]['remainingQty']
            ));
            $conitemID++;
        }
        $this->updateAutoStockItems($consumables);
        $this->db->insert_batch('transitems',$destockables);
        $this->addAutoConItems($conitemIDs);
    }
    function updateAutoStockItems($consumables){
        $this->db->update_batch('stockitems',$consumables, 'stID');
    }
    function addAutoConItems($conitemIDs){
        $this->db->insert_batch('consumed_items',$conitemIDs);
    }
    
    function add_consumptransitems($ciID, $stocks,$date,$date_recorded) {
        $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiQty`,`tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`ciID`,`dateRecorded`) VALUES (NULL,?,?,?,?,?,?,?,?,?)";
        if(count($stocks) > 0){
            for($in = 0; $in < count($stocks) ; $in++){
                $this->db->query($query,array("consumed",$stocks[$in]['tiQty'],$stocks[$in]['actualQty'],$stocks[$in]['curQty']-$stocks[$in]['actualQty'],$stocks[$in]['tRemarks'],$date,$stocks[$in]['stID'],$ciID,$date_recorded));
                $this->deduct_stockQty($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
            }
        }
     } 
    function get_consumedQty($conID, $itemID){
        $query = "SELECT actualQty AS qty FROM trans_items WHERE tID = ? AND tiID = ?;";
        return $this->db->query($query, array($conID, $itemID))->result_array();
    }

    function add_consumptionLog($id, $log){
        $query = "INSERT INTO stocklog(
                stID,
                tID,
                slType,
                slQty,
                slRemainingQty,
                slDateTime,
                dateRecorded,
                slRemarks
            )
            VALUES(?,?,?,?,?,?,?,?);";
        $this->db->query($query,array($log['stock'],$id, $log['type'], $log['qty'], 
            $log['remain'], $log['date'], $log['dateRecorded'], $log['remarks']));
    }

    function deduct_stockQty($stID,$curQty, $actualQty){
        $query = "UPDATE stockitems SET stQty = ? - ? WHERE stID = ?;";
        $this->db->query($query,array($curQty, $actualQty, $stID));
    }
    }
    //--------------------------------------------------------------
