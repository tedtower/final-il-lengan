<?php
    class Chefmodel extends CI_Model {
        
        
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

    // --------------- I N V E N T O R Y ---------------
        function get_inventory(){
            $query = "Select * from stockitems left join variance using (stID)";
            $query = "Select stID,stName,stStatus,stQty from stockitems";
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
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'],  )); 
                }
            }
        }

    // --------------- S P O I L A G E S ---------------
        function get_spoilagesmenu(){
            $query = "Select msID,prID, mName,msQty,DATE_FORMAT(msDate, '%b %d, %Y %r') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') 
            AS msDateRecorded,msRemarks from menuspoil inner join spoiledmenu using (msID) inner join preferences using (prID) 
            inner join menu using (mID)";
            return  $this->db->query($query)->result_array();
        }
        function get_spoilagesstock(){
            $query = "Select ssID,stID,stName,stLocation,ssQty,stQty,DATE_FORMAT(ssDate, '%b %d, %Y %r') 
            AS ssDate,DATE_FORMAT(ssDateRecorded, '%b %d, %Y %r') AS ssDateRecorded,ssRemarks from stockspoil 
            inner join spoiledstock using (ssID) inner join stockitems using (stID)";
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

    function add_stockspoil($date_recorded,$stocks,$slType){
        $query = "insert into stockspoil (ssID,ssDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_varspoilitems($this->db->insert_id(),$stocks,$date_recorded,$slType);
            return true;
        }
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
    function destockvarItems($stID,$tID,$curstQty,$ssQty,$slType,$date_recorded, $dateTime, $remarks){
        $query = "UPDATE stockitems 
        SET 
            stQty = ? - ?
        WHERE
            stID = ?;";
        return $this->db->query($query,array($curstQty,$ssQty,$stID));

        $this->add_stockLog($stID, $tID, $slType, $date_recorded, $dateTime, $slQty, $slRemarks);
       
    }

    // --------------- E D I T I N G  S P O I L A G E S ---------------
    function edit_menuspoilage($msID,$prID,$msQty,$msDate,$msRemarks,$date_recorded){
        $query = "Update menuspoil set msDateRecorded = ? where msID=?";
        if($this->db->query($query,array($date_recorded,$msID))){
            $query = "Update spoiledmenu set msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
            return $this->db->query($query,array($msQty,$msDate,$msRemarks,$msID,$prID));
        }else{
            return false;
        }
    }
    function edit_stockspoilage($ssID,$stID,$ssDate,$ssRemarks,$updateQtyh,$updateQtyl,$curSsQty,$stQty,$ssQtyUpdate,$date_recorded){
        $query = "Update stockspoil set ssDateRecorded = ? where ssID=?";
        
        if($this->db->query($query,array($date_recorded,$ssID))){
                $query = "Update spoiledstock set ssQty = ?,ssDate = ?, ssRemarks = ? where ssID = ? AND stID = ?";
                $this->db->query($query,array($ssQtyUpdate ,$ssDate, $ssRemarks, $ssID, $stID));
                $this->stockitemQty($updateQtyh,$updateQtyl,$stQty, $ssQtyUpdate, $curSsQty, $stID);  
        }else{
            return false;
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
        if($this->db->query($query, array($tNum, $msDate, $dateRecorded , "consumption", $msRemarks, 0))) {
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

        function add_actlog($aID, $alDate, $alDesc, $defaultType, $additinalRemarks){
            $query = "INSERT INTO `activitylog`(
                `alID`,
                `aID`,
                `alDate`, 
                `alDesc`, 
                `alType`, 
                `additionalRemarks`
                ) 
                VALUES (NULL, ?, ?, ?, ?, ?)";
                return $this->db->query($query, array($aID, $alDate, $alDesc, $defaultType, $additinalRemarks));
            }
    }
?>
