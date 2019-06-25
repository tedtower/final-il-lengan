<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Baristamodel extends CI_Model{
        function checkIfLoggedIn(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
                return true;
            }
            return false;
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

        function get_orderslips(){
            $query = $this->db->query('SELECT osID, tableCode, custName, osTotal, payStatus, olQty, olDesc, olSubtotal, olStatus from orderslips inner join orderlists using (osID) GROUP BY osID, tableCode' );
            return $query->result();
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
        // function get_orderslips(){
        //     $query = "Select * from orderslips inner join (Select * from orderlists  where orderlists.olStatus = 'pending') as orderlists on orderslips.osID = orderlists.osID GROUP BY orderslips.osID, tableCode";
        //     return $this->db->query($query)->result_array();
        // }
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
        function getLastNum2(){
            $this->db->select('MAX(tNum) AS lastnum');
            $this->db->from('transactions');
            $this->db->where('tType', 'consumption');

            return $this->db->get()->row()->lastnum;
            
        }
        function get_inventory_consumption(){
            $query = "SELECT * FROM `transactions` LEFT JOIN trans_items USING (tID) left JOIN transitems using (tiID) WHERE tType = 'consumption'";
            return $this->db->query($query)->result_array();
        }
        
        function getconsumptionItems(){
            $query="SELECT * FROM `prefstock` LEFT join stockitems using (stID)";
            return $this->db->query($query)->result_array();
        }

        // function add_consumption($date_recorded,$stocks,$account_id,$lastNum,$user){
        //     if(count($stocks) > 0){
        //         for($in = 0; $in < count($stocks) ; $in++){
        //             $this->destock($stocks);  
        //             $this->add_contransaction(NULL, $stocks[$in]['tDate'], "consumption", $date_recorded, NULL, $lastNum, $stocks[$in]['stID'], $stocks[$in]['uomID'],$stocks[$in]['stName'],$stocks[$in]['consQty'],$account_id,$stocks,$user);
        //         }
        //     }
        // }
        function add_contransaction($id, $date, $type, $dateRecorded, $remarks,$lastNum,$stID,$uomID,$stName,$consQty,$account_id,$stocks,$user){
            $query = "INSERT INTO transactions(tID,tNum,tDate,dateRecorded,tType,tRemarks) VALUES(NULL, ?, ?, ?, ?, ?)";
           
            if($this->db->query($query,array($lastNum, $date, $dateRecorded, $type, $remarks))){
                $this->add_contransitems($this->db->insert_id(), $stID, $uomID,$stName,$consQty,$date,$dateRecorded,$remarks,$account_id,$stocks,$user);
                return true;
             }
        }
        function add_contransitems($tID,$stID,$uomID,$stName,$consQty,$date,$dateRecorded,$remarks,$account_id,$stocks,$user){
            $query = "INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`) VALUES (null,?,?,?)";
             if($this->db->query($query,array($uomID, $stID, $stName))){
                $this->add_contrans_items($this->db->insert_id(), $stID, $tID, $consQty);
               
                $this->add_stocklog($stID, $tID, "consumed",$date, $dateRecorded, $consQty, $remarks);
                $this->add_actlog($account_id, $dateRecorded, "$user added a consumption.", "add", $remarks);
                      
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
            $query = "SELECT * FROM `transactions` left JOIN trans_items USING (tID) inner JOIN transitems using (tiID) inner join stockitems using (stID) WHERE tType = 'spoilage' and isArchived = '0'";
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
        function getLastNum(){
            $this->db->select('MAX(tNum) AS lastnum');
            $this->db->from('transactions');
            $this->db->where('tType', 'spoilage');

            return $this->db->get()->row()->lastnum;
        }
        function add_stockspoil($date_recorded,$stocks,$account_id,$lastNum,$user){
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                    $this->add_spoiltransaction(NULL, $stocks[$in]['tDate'], "spoilage", $date_recorded, $stocks[$in]['tRemarks'],$lastNum,$stocks[$in]['stID'],$stocks[$in]['uomID'],$stocks[$in]['stName'],$stocks[$in]['actualQty'],$account_id,$stocks,$user);
                }
            }
        }
        function add_spoiltransaction($id, $date, $type, $dateRecorded, $remarks,$lastNum,$stID,$uomID,$stName,$actualQty,$account_id,$stocks,$user){
            $query = "INSERT INTO transactions(tID,tNum,tDate,dateRecorded,tType,tRemarks) VALUES(NULL, ?, ?, ?, ?, ?)";
           
            if($this->db->query($query,array($lastNum, $date, $dateRecorded, $type, $remarks))){
                $this->add_spoiltransitems($this->db->insert_id(), $stID, $uomID,$stName,$actualQty,$date,$dateRecorded,$remarks,$account_id,$stocks,$user);
                return true;
             }
        }
        function add_spoiltransitems($tID,$stID,$uomID,$stName,$actualQty,$date,$dateRecorded,$remarks,$account_id,$stocks,$user){
            $query = "INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`) VALUES (null,?,?,?)";
             if($this->db->query($query,array($uomID, $stID, $stName))){
                $this->add_spoiltrans_items($this->db->insert_id(), $stID, $tID, $actualQty);
                
                $this->add_stocklog($stID, $tID, "spoilage",$date, $dateRecorded, $actualQty, $remarks);
                $this->add_actlog($account_id, $dateRecorded, "$user added a stockitem spoilage.", "add", $remarks);
            
             }
        }
        function add_spoiltrans_items($tiID, $stID, $tID, $actualQty){
            $query = "INSERT INTO `trans_items`(`tID`, `tiID`, `actualQty`) VALUES (?,?,?)";
            return  $this->db->query($query,array($tID, $tiID, $actualQty));
        }
        function destockvarItems($stID,$curQty,$actualQty){
            $query = "UPDATE stockitems 
            SET 
                stQty = ? - ?
            WHERE
                stID = ?;";
            return $this->db->query($query,array($curQty,$actualQty,$stID));
           
        }
        function deleteStockspoil($tID){
            $query ="Update transactions set isArchived = ? where tID = ?";
            return $this->db->query($query, array('1', $tID));
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
        
        function get_deliveryReceipts(){
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
                    isArchived = '0' and tType = 'delivery receipt'
            ORDER BY tID desc";
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

        function get_uomForStoring(){
            $query = "SELECT
                uomID,
                uomName,
                uomAbbreviation
            FROM
                uom
            WHERE
                uomStore IS NOT NULL;";
            return $this->db->query($query)->result_array();
        }
        function get_stockitems() {
            $query = "SELECT * FROM stockitems LEFT JOIN uom USING (uomID) LEFT JOIN suppliermerchandise USING (stID) ORDER BY 2;";
            return $this->db->query($query)->result_array();
        }
        function get_supplier(){
            $query = "Select * from supplier order by spName";
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
                spmActualQty,
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
        function get_stockQty($stID){
            $query = "SELECT stQty from stockitems where stID = ?";
            return $this->db->query($query,array($stID))->result_array();
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
        function update_stockQty($stID, $stQty){
            $query = "UPDATE stockitems
            SET
                stQty = stQty + ?
            WHERE
                stID = ?";
            return $this->db->query($query, array($stQty, $stID));
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
    //--------------consumption
    function add_consumption($con) {
        $query = "INSERT INTO transactions(tID, tNum, tDate, dateRecorded, tType, tRemarks)
            VALUES(NULL, ?, ?, ?, ?, ?)";
        $lastNum = $this->db->query("SELECT MAX(tNum) AS lastnum FROM transactions
            WHERE tType = ?",array($con['type']))->result_array()[0]['lastnum'];
        $lastNum = $lastNum == NULL ? 1 : $lastNum+1;
        if($this->db->query($query, array($lastNum, $con['date'],$con['dateRecorded'],$con['type'],$con['remarks']))){
            return $this->db->insert_id();
        }
        return 0;
    }
    function edit_consumption($con){
        $query = "UPDATE transactions SET tDate = ?, dateRecorded = ?, tRemarks = ? WHERE tID = ?";
        return $this->db->query($query, array($con['date'], $con['dateRecorded'], $con['remarks'], $con['id']));
    }
    function add_consumedItem($st){
        $query="INSERT INTO transitems(tiID, stID) VALUES(NULL, ?)";
        if($this->db->query($query,array($st))){
            return $this->db->insert_id();
        }
        return 0;
    }
    function add_consumptionQty($conID,$con){
        $query = "INSERT INTO trans_items(tID, tiID, actualQty) VALUES(?, ?, ?)";
        return $this->db->query($query,array($conID, $con['id'], $con['qty']));
    }
    function edit_consumptionQty($conID, $con){
        $query = "UPDATE trans_items SET actualQty = ? WHERE tiID = ? AND tID = ?";
        return $this->db->query($query,array($con['qty'], $con['id'], $conID));
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

    function deduct_stockQty($qty, $st){
        $query = "UPDATE stockitems SET stQty = stQty - ? WHERE stID = ?;";
        $this->db->query($query,array($qty, $st));
    }
    }
?>
