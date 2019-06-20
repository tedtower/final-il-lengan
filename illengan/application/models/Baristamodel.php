<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Baristamodel extends CI_Model{
        
        function get_orderlist($osID){
            $query = "Select olID, olDesc, olQty, olSubTotal from orderlists inner join preferences using (prID) where osID = ?";
            return $this->db->query($query, array($order_id))->result_array(); 
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
        // function get_orderslip(){
        //     $this->load->database();
        //     $query = $this->db->query('SELECT * from orderslips join orderlists using (osID) join preferences using (prID) GROUP BY tableCode');
        //     return $query->result();
        // }

        function get_orderslip(){
            $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olDesc, olSubtotal, olStatus from orderslips inner join orderlists using (osID) GROUP BY osID, tableCode' );
            return $query->result();
    }
        function get_orderitems($osID){
            $query = "SELECT olDesc, olSubtotal,olQty,osTotal from orderlists join orderslips USING (osID) WHERE osID = ?";
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
            $query = "select osID, tableCode, custName, osTotal, osDateTime,(CAST(osDateTime AS time)) as time, payStatus , osPayDateTime from orderslips where CAST(osDateTime AS date) = cast((now()) as date) ORDER BY `orderslips`.`osDateTime` DESC ";
            return $this->db->query($query)->result_array();
        }

        function get_orderslipsi($osID){
            $query = "select osID, tableCode, custName, osTotal, osDate, if(osPayDate is null, 'Unpaid', 'Paid') as payStatus , osPayDate from orderslips where osID = ?";
            return $this->db->query($query, array($order_id))->result_array();
        }

        function get_orderlists($osID){
            $query = "Select olID, olDesc, olQty, olSubtotal from orderlists inner join preferences using (prID) inner join orderslips using (osID) where osID = ?";
            return $this->db->query($query, array($order_id))->result_array(); 
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

        function update_payment($status,$osID,$payDate,$date_recorded){
            $query = "Update orderslips set payStatus = ?, osPayDateTime = ?, osDateRecorded = ? where osID = ?";
            for($in = 0; $in < count($osID) ; $in++){
            $this->db->query($query, array($status,$payDate, $date_recorded, $osID[$in]['osID']));
            }
        }
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
        function get_orderslips(){
            $query = "Select * from orderslips inner join (Select * from orderlists  where orderlists.olStatus = 'pending') as orderlists on orderslips.osID = orderlists.osID GROUP BY orderslips.osID, tableCode";
            return $this->db->query($query)->result_array();
        }
        function get_pendingOlist(){
            $query = "Select * from  orderlists where olStatus = 'pending'";
            return $this->db->query($query)->result_array();
        }
        function get_servedorderslips(){
            $query = "Select * from orderslips inner join (Select * from orderlists  where orderlists.olStatus = 'served') as orderlists on orderslips.osID = orderlists.osID GROUP BY orderslips.osID, tableCode";
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
        function get_addons(){
            $query = "select * from orderaddons inner join addons on orderaddons.aoID=addons.aoID";
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
        //---------------------------------CONSUMPTION------------------------------------
        function get_inventory(){
            $query = "SELECT * FROM `transactions` LEFT JOIN trans_items USING (tID) left JOIN transitems using (tiID) WHERE tType = 'consumption'";
            return $this->db->query($query)->result_array();
        }
        
        function getconsumptionItems(){
            $query="SELECT * FROM `prefstock` LEFT join stockitems using (stID)";
            return $this->db->query($query)->result_array();
        }

        function add_consumption($date_recorded,$stocks,$account_id,$lastNum){
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->destock($stocks);  
                    $this->add_contransaction(NULL, $stocks[$in]['tDate'], "consumption", $date_recorded, NULL, $lastNum, $stocks[$in]['stID'], $stocks[$in]['uomID'],$stocks[$in]['stName'],$stocks[$in]['consQty'],$account_id,$stocks);
                }
            }
        }
        function add_contransaction($id, $date, $type, $dateRecorded, $remarks,$lastNum,$stID,$uomID,$stName,$consQty,$account_id,$stocks){
            $query = "INSERT INTO transactions(tID,tNum,tDate,dateRecorded,tType,tRemarks) VALUES(NULL, ?, ?, ?, ?, ?)";
           
            if($this->db->query($query,array($lastNum, $date, $dateRecorded, $type, $remarks))){
                $this->add_contransitems($this->db->insert_id(), $stID, $uomID,$stName,$consQty,$date,$dateRecorded,$remarks,$account_id,$stocks);
                return true;
             }
        }
        function add_contransitems($tID,$stID,$uomID,$stName,$consQty,$date,$dateRecorded,$remarks,$account_id,$stocks){
            $query = "INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`) VALUES (null,?,?,?)";
             if($this->db->query($query,array($uomID, $stID, $stName))){
                $this->add_contrans_items($this->db->insert_id(), $stID, $tID, $consQty);
                for($in = 0; $in < count($stocks)-1 ; $in++){
                $this->add_stocklog($stocks[$in]['stID'], $tID, "consumed",$stocks[$in]['tDate'], $dateRecorded, $stocks[$in]['consQty'], NULL);
                $this->add_actlog($account_id, $dateRecorded, "Barista added a consumption.", "add", NULL);
            }
             }
        }
        function add_contrans_items($tiID, $stID, $tID, $consQty){
            $query = "INSERT INTO `trans_items`(`tID`, `tiID`, `actualQty`) VALUES (?,?,?)";
            return  $this->db->query($query,array($tID, $tiID, $consQty));
        }
        function destock($stocks){
            $query = "Update stockitems set stQty = ? - ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['consQty'], $stocks[$in]['stID'],  )); 
                }
            }
        }
        //Stock Spoilage---------------------------------------------------------------------------------------------------
        function get_spoilagesstock(){
            $query = "SELECT * FROM `transactions` left JOIN trans_items USING (tID) inner JOIN transitems using (tiID)";
            return  $this->db->query($query)->result_array();
        }
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
            spmActualQty,
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
            LEFT JOIN suppliermerchandise USING(uomID)
            )
        LEFT JOIN categories USING(ctID)
        GROUP BY
            stID";
            return $this->db->query($query)->result_array();
        }
        //-----------------------------------------STOCK TRANSACTIONS------------------------------------
        function getLastNum(){
            $query = "SELECT MAX(tNum) AS lastnum FROM transactions WHERE tType = 'spoilage'";
            return $result = $this->db->query($query)->result();
            
        }
        function add_stockspoil($date_recorded,$stocks,$account_id,$lastNum){
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                    $this->add_spoiltransaction(NULL, "spoilage", $date_recorded, $lastNum,$account_id,$stocks);
                    $this->add_spoiltransaction(NULL,$lastNum,$stocks[$in]['tDate'],$dateRecorded,"spoilage",$stocks[$in]['tRemarks'])
                }
            }
        }
        function add_spoiltransaction($id, $type, $dateRecorded,$lastNum,$account_id,$stocks){
            $query = "INSERT INTO transactions(tID,tNum,tDate,dateRecorded,tType,tRemarks) VALUES(NULL, ?, ?, ?, ?, ?)";
            for($in = 0; $in < count($stocks) ; $in++){
                if($this->db->query($query,array($lastNum, $stocks[$in]['tDate'], $dateRecorded, $type, $stocks[$in]['tRemarks']))){
                    $this->add_spoiltransitems($this->db->insert_id(),$dateRecorded,$account_id,$stocks);  
                    return true;
                }
            }
        }
        function add_spoiltransitems($tID,$dateRecorded,$account_id,$stocks){
            $query = "INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`) VALUES (null,?,?,?)";
            for($in = 0; $in < count($stocks)-1 ; $in++){
                if($this->db->query($query,array($stocks[$in]['uomID'], $stocks[$in]['stID'], $stocks[$in]['stName']))){
                    $this->add_spoiltrans_items($this->db->insert_id(), $tID, $stocks);
                    $this->add_stocklog($stocks[$in]['stID'], $tID, "spoilage",$stocks[$in]['tDate'], $dateRecorded, $stocks[$in]['actualQty'], $stocks[$in]['tRemarks']);
                    $this->add_actlog($account_id, $dateRecorded, "Barista added a stockitem spoilage.", "add", $stocks[$in]['tRemarks']);
                
                }
             }
        }
        function add_spoiltrans_items($tiID, $tID, $stocks){
            $query = "INSERT INTO `trans_items`(`tID`, `tiID`, `actualQty`) VALUES (?,?,?)";
            for($in = 0; $in < count($stocks)-1 ; $in++){
                return  $this->db->query($query,array($tID, $tiID, $stocks[$in]['actualQty']));
            }
        }
        function destockvarItems($stID,$curQty,$tNum){
            $query = "UPDATE stockitems 
            SET 
                stQty = ? - ?
            WHERE
                stID = ?;";
            return $this->db->query($query,array($curQty,$tNum,$stID));
           
        }
        function add_stockLog($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks){
            $query = "INSERT INTO `stocklog`(
                    `slID`,
                    `stID`,
                    `tID`,
                    `slType`,
                    `slDateTime`,
                    `dateRecorded`,
                    `slQty`,
                    `slRemarks`
                )
                VALUES(NULL, ?, ?, ?, ?, ?, ?, ?);";
            return $this->db->query($query, array($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks));
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
    }
?>
