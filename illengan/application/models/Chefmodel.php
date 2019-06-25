<?php
    class Chefmodel extends CI_Model {
        function __construct(){
            parent:: __construct();
            date_default_timezone_set('Asia/Manila'); 
        }
        
        function get_orders() {
            $this->load->database();
            $query = "SELECT os.osID, os.tableCode, os.custName, os.osDateTime, ol.olID, ol.olDesc, ol.olQty, ol.olRemarks
            FROM orderlists ol INNER JOIN orderslips os USING (osID) INNER JOIN preferences USING (prID) 
            INNER JOIN menu USING (mID) INNER JOIN categories cat USING (ctID) 
            WHERE cat.supcatID = '1' AND ol.olStatus='pending'";
            return $this->db->query($query)->result_array();
        }
    
        function get_addons() {
            $query = "SELECT * FROM orderaddons INNER JOIN addons USING (aoID)";
            return $this->db->query($query)->result_array();

        }
             
        function getconsumptionItems(){
            $query="SELECT * FROM `prefstock` LEFT join stockitems using (stID)";
            return $this->db->query($query)->result_array();
        }


    // --------------- I N V E N T O R Y ---------------
    function get_inventory(){
        $query = "SELECT * FROM `transactions` LEFT JOIN trans_items USING (tID) left JOIN transitems using (tiID) WHERE tType = 'consumption'";
        return $this->db->query($query)->result_array();
    }
        function restock($stocks){
            $query = "Update stockitems set stQty = ? + ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'],  )); 
                }
            }
        }
         function destock($stocks){
            $query = "Update stockitems set stQty = ? - ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['consQty'], $stocks[$in]['stID'],  )); 
                }
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

    // --------------- S P O I L A G E S ---------------
        function get_spoilagesmenu(){
            $query = "Select msID,prID, mName,msQty,DATE_FORMAT(msDate, '%b %d, %Y %r') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') 
            AS msDateRecorded,msRemarks from menuspoil inner join spoiledmenu using (msID) inner join preferences using (prID) 
            inner join menu using (mID)";
            return  $this->db->query($query)->result_array();
        }
        function get_spoilagesstock(){
            $query = "SELECT * FROM `transactions` left JOIN trans_items USING (tID) inner JOIN transitems using (tiID)";
            return  $this->db->query($query)->result_array();
        }
        function get_stocks(){
            $query = "SELECT
                stID,
                CONCAT(stName, if(stSize IS Null,'', concat(' ',stSize))) as stName,
                stMin,
                stQty,
                uomID,
                uomAbbreviation,
                stBqty,
                UPPER(stStatus) as stStatus,
                stType,
                UPPER(stLocation) as stLocation,
                ctName,
                ctID
            FROM
                (
                    stockitems
                LEFT JOIN uom USING(uomID)
                )
            LEFT JOIN categories USING(ctID)
            GROUP BY
                stID;";
            return $this->db->query($query)->result_array();
        }
        function get_menuPref(){
            $query = "SELECT prID, stID, prstQty, stQty, mName, CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ', 
            CONCAT(' ',mTemp))) as prName, prPrice, mAvailability FROM preferences INNER JOIN menu USING (mID) 
            LEFT JOIN prefstock USING (prID) LEFT JOIN stockitems USING (stID)";

            return $this->db->query($query)->result_array();
        }

    // --------------- A D D I N G  S P O I L A G E S ---------------
    function getLastNum(){
        $query = "SELECT MAX(tNum) AS lastnum FROM transactions WHERE tType = 'spoilage'";
        return $result = $this->db->query($query)->result();
        
    }
    function add_stockspoil($date_recorded,$stocks,$account_id,$lastNum){
        if(count($stocks) > 0){
            for($in = 0; $in < count($stocks) ; $in++){
                $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                $this->add_spoiltransaction(NULL, $stocks[$in]['tDate'], "spoilage", $date_recorded, $stocks[$in]['tRemarks'],$lastNum,$stocks[$in]['stID'],$stocks[$in]['uomID'],$stocks[$in]['stName'],$stocks[$in]['actualQty'],$account_id,$stocks);
            }
        }
    }
    function add_spoiltransaction($id, $date, $type, $dateRecorded, $remarks,$lastNum,$stID,$uomID,$stName,$actualQty,$account_id,$stocks){
        $query = "INSERT INTO transactions(tID,tNum,tDate,dateRecorded,tType,tRemarks) VALUES(NULL, ?, ?, ?, ?, ?)";
       
        if($this->db->query($query,array($lastNum, $date, $dateRecorded, $type, $remarks))){
            $this->add_spoiltransitems($this->db->insert_id(), $stID, $uomID,$stName,$actualQty,$date,$dateRecorded,$remarks,$account_id,$stocks);
            return true;
         }
    }
    function add_spoiltransitems($tID,$stID,$uomID,$stName,$actualQty,$date,$dateRecorded,$remarks,$account_id,$stocks){
        $query = "INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`) VALUES (null,?,?,?)";
         if($this->db->query($query,array($uomID, $stID, $stName))){
            $this->add_spoiltrans_items($this->db->insert_id(), $stID, $tID, $actualQty);
            for($in = 0; $in < count($stocks)-1 ; $in++){
            $this->add_stocklog($stocks[$in]['stID'], $tID, "spoilage",$stocks[$in]['tDate'], $dateRecorded, $stocks[$in]['actualQty'], $stocks[$in]['tRemarks']);
            $this->add_actlog($account_id, $dateRecorded, "Chef added a stockitem spoilage.", "add", $stocks[$in]['tRemarks']);
        }
         }
    }

    function add_spoiltrans_items($tiID, $stID, $tID, $actualQty){
        $query = "INSERT INTO `trans_items`(`tID`, `tiID`, `actualQty`) VALUES (?,?,?)";
        return  $this->db->query($query,array($tID, $tiID, $actualQty));
    }
    function add_spoiledaddon($aosID,$addons){
        $query = "insert into addonspoil (aosID,aoID,aosQty,aosDate,aosRemarks) values (?,?,?,?,?)";
        if(count($addons) > 0){
            for($in = 0; $in < count($addons) ; $in++){
                $this->db->query($query, array($aosID, $addons[$in]['aoID'], $addons[$in]['aosQty'],
                $addons[$in]['aosDate'],$addons[$in]['aosRemarks']));
            }    
        }
    }
    function add_menuspoil($date_recorded,$account_id,$menu){
        $query = "insert into menuspoil (msID,msDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledmenu($this->db->insert_id(),$account_id,$menu);
            return true;
        }
    }
    function add_spoiledmenu($msID,$account_id,$menus){
        $query = "insert into spoiledmenu (msID,prID,msQty,msDate,msRemarks) values (?,?,?,?,?)";
        if(count($menus) > 0){
            for($in = 0; $in < count($menus) ; $in++){
            $this->db->query($query, array($msID, $menus[$in]['prID'], $menus[$in]['msQty'],$menus[$in]['msDate'],$menus[$in]['msRemarks']));
            if($menus[$in]['stID'] !== null) {
                $this->update_stockqty($menus[$in]['newQty'], $menus[$in]['stID']);
                $this->add_consumption($menus[$in]['stID'], $menus[$in]['deductQty'],$menus[$in]['msDate'],$menus[$in]['msRemarks'], $account_id);
                }
            }
            
        }
    }
    function update_stockqty($newQty, $stID) {
        $query = "UPDATE stockitems SET stQty = ? WHERE stID = ?";
        $this->db->query($query, array($newQty, $stID));
    }


    function add_varspoilitems($ssID,$stocks,$date_recorded,$slType){ 
        $tID = NULL;
        $query = "insert into spoiledstock (ssID,stID,ssQty,ssDate,ssRemarks) values (?,?,?,?,?)";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                   $this->db->query($query, array($ssID, $stocks[$in]['stID'], $stocks[$in]['ssQty'], $stocks[$in]['ssDate'],$stocks[$in]['ssRemarks']));  
                   $this->destockvarItems($stocks[$in]['stID'],$tID,$stocks[$in]['curstQty'],$stocks[$in]['ssQty'], $slType, $date_recorded, $stocks[$in]['ssDate'], $stocks[$in]['ssRemarks'] );   
                }    
            }
    }

    // --------------- E D I T I N G  S P O I L A G E S ---------------
      function edit_menuspoilage($msID,$prID,$msQty,$oldQty,$msDate,$msRemarks,$date_recorded, $account_id){
        $query = "Update menuspoil set msDateRecorded = ? where msID=?";
        if($this->db->query($query,array($date_recorded,$msID))){
            $query = "Update spoiledmenu set msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
             $this->db->query($query,array($msQty,$msDate,$msRemarks,$msID,$prID));
             $query2 = "INSERT INTO `activitylog` (alID, aID, alDate, alDesc, alType, additionalRemarks)
             Values (NULL, ?, ?, ?, ?, ?)";
            $this->db->query($query2, array($account_id, $date_recorded, "Chef updated a menu spoiled item.", "update", $msRemarks));
            
            $spoiled = "Select stID from spoiledmenu inner join prefstock on spoiledmenu.prID=prefstock.prID where msID = '$msID'";
            $stock = $this->db->query($spoiled)->result_array();
            foreach($stock as $stk){
                if($stk['stID'] != null){
                    $this->edit_stockItems($prID, $msQty, $oldQty);
                    $this->edit_msTransactions($msID, $msDate, $msRemarks, $date_recorded);
                }
            }
        }else{
            return false;
        }
    }
    function edit_msTransactions($msID, $msDate, $msRemarks, $date_recorded){
        $query = "SELECT transactions.tID as tID, transitems.stID as stID  FROM spoiledmenu inner join prefstock on spoiledmenu.prID = prefstock.prID inner join transitems on prefstock.stID=transitems.stID
        inner join trans_items on transitems.tiID=trans_items.tiID inner join transactions on trans_items.tID=transactions.tID where msID='$msID'";
        $mspoiled = $this->db->query($query)->result_array();
        foreach($mspoiled as $ms){
            $tID = $ms['tID'];
            $stID = $ms['stID'];
        }
        $query2 = "Update transactions set tDate=?, dateRecorded = ?, tRemarks=? where tID = ?";
        $this->db->query($query2, array($msDate, $date_recorded, $msRemarks, $tID));
        $this->edit_msStocklog($stID, $tID, $msDate, $msRemarks, $date_recorded);
    }
     function edit_msStocklog($stID, $tID, $msDate, $msRemarks, $date_recorded){
        $query = "Update stocklog set slDateTime = ?, dateRecorded = ?, slRemarks =? where stID = ? and tID = ?";
        return $this->db->query($query, array($msDate, $date_recorded, $msRemarks, $stID, $tID));
     }
    function edit_stockItems($prID, $msQty, $oldQty){
        $query3 = "Select stID from prefstock where prID = '$prID'";
        $stID = $this->db->query($query3)->result_array();
        foreach($stID as $s){
            $id = $s['stID'];
        }
        $query4 = "Select stQty, prstQty from stockitems inner join prefstock on stockitems.stID=prefstock.stID
        where stockitems.stID = '$id'";
        $data = $this->db->query($query4)->result_array();
        foreach($data as $d){
            $stQty = $d['stQty'];
            $qty = $d['prstQty'];
            //$stMin = $d['stMin'];
        }
        if($msQty > $oldQty){
            $diff = ($msQty * $qty) - ($oldQty * $qty);
            $finQty = $stQty - $diff;
            $updateQty = "Update stockitems set stQty = ? where stID = ?";
            return $this->db->query($updateQty, array($finQty, $id));
        }else if($msQty < $oldQty){
            $sum = ($oldQty * $qty) - ($msQty * $qty);
            $finQty = $sum + $stQty;
            $updateQty = "Update stockitems set stQty = ? where stID = ?";
            return $this->db->query($updateQty, array($finQty, $id));
        }else{
            $same = "Update stockitems set stQty = ? where stID = ?";
            return $this->db->query($same, array($stQty, $id));
        }
    }
    // --------------- A D D I N G  T O  S T O C K L O G ---------------
    function add_stockLog2($stID, $slType, $date_recorded, $slDateTime, $ssQty, $ssRemarks, $updateQtyh, $updateQtyl,$curSsQty,$ssQtyUpdate){
        if ($curSsQty > $ssQtyUpdate){
        $query = "INSERT INTO `stocklog`(
                `slID`,
                `stID`,
                `slType`,
                `slDateTime`,
                `dateRecorded`,
                `slQty`,
                `slRemarks`
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            return $this->db->query($query, array($stID, $slType, $date_recorded, $slDateTime, $updateQtyl, $ssRemarks));
        }
        if ($curSsQty < $ssQtyUpdate){
            $query = "INSERT INTO `stocklog`(
                `slID`,
                `stID`,
                `slType`,
                `slDateTime`,
                `dateRecorded`,
                `slQty`,
                `slRemarks`
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            return $this->db->query($query, array($stID, $slType, $date_recorded, $slDateTime, $updateQtyh, $ssRemarks));
            
        }else{
            $query = "INSERT INTO `stocklog`(
                `slID`,
                `stID`,
                `slType`,
                `slDateTime`,
                `dateRecorded`,
                `slQty`,
                `slRemarks`
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?);";
            return $this->db->query($query, array($stID, $slType, $date_recorded, $slDateTime, $ssQty, $ssRemarks));
        }
    }


    // -------------- A D D I N G  T R A N S A C T I O N S  A N G  L O G S ----------------
    function set_tNum() {
        $this->db->select('MAX(tNum) AS lastnum');
        $this->db->from('transactions');
        $this->db->where('tType', 'return');

        return $this->db->get()->row()->lastnum;
    }
    
    function add_consumption($stID, $dQty, $msDate, $msRemarks, $account_id) {
        $maxtNum = intval($this->set_tNum());
        $tNum = $maxtNum + 1;
        $dateRecorded = date("Y-m-d H:i:s");
        $query = "INSERT INTO transactions (tID, tNum, tDate, dateRecorded, tType, tRemarks, isArchived) 
        values (NULL, ?,?,?,?,?,?)";
        if($this->db->query($query, array($tNum, $msDate, $dateRecorded , "spoilage", $msRemarks, 0))) {
             $this->add_transitems($this->db->insert_id(), $stID, $dQty, $msDate, $msRemarks, $dateRecorded,$account_id);
        }
    }
    
    function add_transitems($tID, $stID, $dQty, $msDate, $msRemarks, $dateRecorded, $account_id) {
        $query = "INSERT INTO transitems (tiID, stID) VALUES (NULL,?)";
        if($this->db->query($query, array($stID))) {
            $this->add_trans_items($tID, $this->db->insert_id(), $stID, $dQty, $dateRecorded, $msDate, 
            $msRemarks, $account_id);
        }
    }

    function add_trans_items($tID, $tiID, $stID, $dQty, $dateRecorded, $tDate, $tRemarks, $account_id) {
        $query = "INSERT INTO trans_items (tID, tiID, actualQty) VALUES (?,?,?)";
        if($this->db->query($query, array($tID, $tiID, $dQty))) {
            $this->add_stocklog($stID, $tID, "consumption", $tDate, $dateRecorded, $dQty, $tRemarks);
            $this->add_actlog($account_id, $dateRecorded, "Chef added a stockitem consumption.", "add", $tRemarks);
        }

       
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

        //------------------------------ C O N S U M P T I O N ------------------------------------------------------------------------------
        function add_consumptions($date_recorded,$stocks,$account_id,$lastNum){//Consumption
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->destock($stocks);  
                    $this->add_contransaction(NULL, $stocks[$in]['tDate'], "consumption", $date_recorded, NULL, $lastNum, $stocks[$in]['stID'], $stocks[$in]['uomID'],$stocks[$in]['stName'],$stocks[$in]['consQty'],$account_id,$stocks);
                }
            }
        }
//consumption
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
                for($in = 0; $in < count($stocks) ; $in++){
                $this->add_consstocklog($stocks[$in]['stID'], $tID, "consumed",$stocks[$in]['tDate'], $dateRecorded, $stocks[$in]['consQty'], $remarks);
                $this->add_consactlog($account_id, $dateRecorded, "Chef added a consumption.", "add", $remarks);
            }
             }
        }
        function add_contrans_items($tiID, $stID, $tID, $consQty){
            $query = "INSERT INTO `trans_items`(`tID`, `tiID`, `actualQty`) VALUES (?,?,?)";
            $this->db->query($query,array($tID, $tiID, $consQty));
        }
        function add_consactlog($aID, $alDate, $alDesc, $defaultType, $additionalRemarks){
            $query = "INSERT INTO `activitylog`(
                `alID`,
                `aID`,
                `alDate`, 
                `alDesc`, 
                `alType`, 
                `additionalRemarks`
                ) 
                VALUES (NULL, ?, ?, ?, ?, ?)";
                 $this->db->query($query, array($aID, $alDate, $alDesc, $defaultType, $additionalRemarks));
        } 
        function add_consstockLog($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks){
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
             $this->db->query($query, array($stID, $tID, $slType, $slDateTime, $dateRecorded, $slQty, $slRemarks));
        }

        // ---------  D E L I V E R Y  R E C E I P T S ---------
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

        // For viewing delivery receipts
        
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
    }
?>
