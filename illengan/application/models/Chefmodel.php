<?php
    class Chefmodel extends CI_Model {
        function __construct(){
            parent:: __construct();
            date_default_timezone_set('Asia/Manila'); 
        }
        
        function get_orders($rowno,$rowperpage) {
            $this->load->database();
            $query = "SELECT os.osID, os.tableCode, os.custName, os.osDateTime, ol.olID, ol.olDesc, ol.olQty, ol.olRemarks
            FROM orderlists ol INNER JOIN orderslips os USING (osID) INNER JOIN preferences USING (prID) 
            INNER JOIN menu USING (mID) INNER JOIN categories cat USING (ctID) 
            WHERE cat.supcatID = '1' AND ol.olStatus='pending' LIMIT $rowno, $rowperpage";
            return $this->db->query($query)->result_array();
        }
        function getRecordCount() {
            $query = "SELECT count(ol.olID) as allcount
            FROM orderlists ol INNER JOIN orderslips os USING (osID) INNER JOIN preferences USING (prID) 
            INNER JOIN menu USING (mID) INNER JOIN categories cat USING (ctID) 
            WHERE supcatID = '1' AND olStatus='pending'";
            $result= $this->db->query($query)->result_array();      
              return $result[0]['allcount'];
        }
        function getSlipNum(){
            $query="SELECT osID FROM  orderslips";
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
     //consumption
     function get_consumption($rowno,$rowperpage){
        $query = "SELECT consumptions.cDate,consumptions.cID,tiID,stockitems.stID as stID,transitems.ciID as ciID,stName,tiQty,tiDate,cDateRecorded,tiRemarks FROM consumptions inner join consumed_items on  consumptions.cID=consumed_items.cID inner join
        transitems on consumed_items.ciID=transitems.ciID inner join stockitems on transitems.stID=stockitems.stID 
        WHERE tiType = 'consumed' LIMIT $rowno, $rowperpage";
        return $this->db->query($query)->result_array();
    }
    function getCountRecConsump() {
        $query = "SELECT count(transitems.ciID) as allcount
        FROM consumptions inner join consumed_items on  consumptions.cID=consumed_items.cID inner join
        transitems on consumed_items.ciID=transitems.ciID inner join stockitems on transitems.stID=stockitems.stID 
        WHERE tiType = 'consumed'";
        $result= $this->db->query($query)->result_array();      
        return $result[0]['allcount'];
    }
        function restock($stocks){
            $query = "Update stockitems set stQty = ? + ? where stID = ?";
            if(count($stocks) > 0){
                for($in = 0; $in < count($stocks) ; $in++){
                    $this->db->query($query, array($stocks[$in]['curQty'], $stocks[$in]['stQty'], $stocks[$in]['stID'],  )); 
                }
            }
        }
         function destock($items){
            if(count($items) > 0){
               for($in = 0; $in < count($items) ; $in++){
               $stID= $items[$in]['stID'];
               $query1 = "SELECT stQty FROM stockitems where stID = '$stID'";
               $result= $this->db->query($query1)->result_array();
               foreach($result as $r){
                   $curQty = $r['stQty'];
               }
               $query = "Update stockitems set stQty = ? - ? where stID = ?";
               $this->db->query($query, array($curQty, $items[$in]['qty'], $items[$in]['stID'])); 
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
       function get_spoilagesmenu($rowno,$rowperpage){
        $query = "Select osID,menuspoil.msID as msID,prID, mName,msQty,DATE_FORMAT(menuspoil.msDate, '%b %d, %Y') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') 
        AS msDateRecorded,msRemarks, CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ',CONCAT(' ',mTemp))) as prName from menuspoil inner join spoiledmenu on menuspoil.msID=spoiledmenu.msID inner join preferences using (prID) 
        inner join menu using (mID) LIMIT $rowno, $rowperpage";
        return  $this->db->query($query)->result_array();
    }
    function getCountRecMenuSpoil() {
        $query = "SELECT count(msID) as allcount FROM spoiledmenu";
        $result= $this->db->query($query)->result_array();      
        return $result[0]['allcount'];
    }
        function get_spoilagesstock(){
            $query = "SELECT * FROM transitems inner join stockitems using (stID) where siID != 'NULL'";
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
        function get_menuPref(){
            $query = "SELECT prID, stID, prstQty, stQty, mName, CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ', 
            CONCAT(' ',mTemp))) as prName, prPrice, mAvailability FROM preferences INNER JOIN menu USING (mID) 
            LEFT JOIN prefstock USING (prID) LEFT JOIN stockitems USING (stID)";

            return $this->db->query($query)->result_array();
        }

    // --------------- A D D I N G  S T O C K  S P O I L A G E S ---------------
    function add_stockspoil($date_recorded,$stocks,$account_id,$user,$date,$remarks){
        $query = "INSERT INTO `stockspoil`(`sID`, `sDate`, `sDateRecorded`) VALUES (NULL,?,?)";
        if($this->db->query($query,array($date,$date_recorded))){
            $this->add_spoileditems($this->db->insert_id(),$stocks,$remarks,$date,$account_id,$date_recorded,$user);
        }
    }
    function add_spoileditems($sID,$stocks,$remarks,$date,$account_id,$date_recorded,$user){
        $query = "INSERT INTO `spoiledstock`(`siID`, `sID`) VALUES (NULL,?)";
        if($this->db->query($query,array($sID))){
            $this->add_spoiltransitems($this->db->insert_id(),$stocks,$remarks,$date,$account_id,$date_recorded,$user);
        }
    }
    function add_spoiltransitems($siID,$stocks,$remarks,$date,$account_id,$date_recorded,$user){
        $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiQty`,`tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`) VALUES (NULL,?,?,?,?,?,?,?,?)";
        if(count($stocks) > 0){
            for($in = 0; $in < count($stocks) ; $in++){
                $this->db->query($query,array("spoilage",$stocks[$in]['actualQty'],'1',$stocks[$in]['curQty']-$stocks[$in]['actualQty'],$stocks[$in]['tRemarks'],$date,$stocks[$in]['stID'],$siID));
                $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                $this->add_actlog($account_id,$date_recorded, "$user added a stock spoilage.", "add", $remarks);
            }
        }
    }
//-------------------------------------- U P D A T I N G  S T O C K  S P O I L A G E S -----------------------------------------------------------------
function add_stocktransitems($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID){
    $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`) VALUES (NULL,?,?,?,?,?,?,?)";
    return $this->db->query($query, array($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID));
}
function update_stock($stID, $stQty) {
    $query = "UPDATE `stockitems` SET `stQty` = ? WHERE `stID` = ?;";
    $this->db->query($query, array($stQty, $stID));
}
function add_activlog($account_id, $alDate, $alDesc, $defaultType, $additionalRemarks){
    $query = "INSERT INTO `activitylog`(
        `alID`,
        `aID`,
        `alDate`, 
        `alDesc`, 
        `alType`, 
        `additionalRemarks`
        ) 
        VALUES (NULL, ?, ?, ?, ?, ?)";
        return $this->db->query($query, array($account_id, $alDate, $alDesc, $defaultType, $additionalRemarks));
} 
    //--------------------------------- A D D I N G  A N D  U P D A T I N G  M E N U  S P O I L A G E --------------------------------------------------
function add_menuspoil($date,$date_recorded,$account_id,$menu, $tiType){
    $query = "insert into menuspoil (msID,msDate,msDateRecorded) values (NULL,?,?)";
    if($this->db->query($query,array($date,$date_recorded))){ 
        $this->add_spoiledmenu($this->db->insert_id(),$account_id,$menu,$date,$date_recorded, $tiType);
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
                $this->update_stockqty($menus[$in]['qty'], $menus[$in]['prID']);
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

    function update_stockqty($qty,$prID) {
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
// ------------------------------------------- E D I T I N G  M E N U  S P O I L A G E S ------------------------------------------------
      function edit_menuspoilage($msID,$prID,$msQty,$oldQty,$msDate,$msRemarks,$date_recorded,$osID){
        if($osID === ''){
            $osID = NULL;
        }else{
            $osID = $osID;
        }
        $query = "Update menuspoil set msDateRecorded = ?, msDate=? where msID=?";
        if($this->db->query($query,array($date_recorded,$msDate,$msID))){
            $query = "Update spoiledmenu set osID = ?, msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
             $this->db->query($query,array($osID,$msQty,$msDate,$msRemarks,$msID,$prID));
            
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
        function add_consumptions($date, $items, $date_recorded, $account_id, $tiType){//Consumption
            $query2 = "INSERT INTO consumptions(cID, cDate, cDateRecorded) VALUES (NULL, ?,?)";
            $this->db->query($query2, array($date, $date_recorded));
            $cID = $this->db->insert_id();
            $this->add_cons($date,$items, $cID, $account_id, $tiType);
        }
        function add_cons($date,$items,$cID, $account_id, $tiType){
            if(count($items) > 0){
                for($in = 0; $in < count($items) ; $in++){
                $stID= $items[$in]['stID'];
                $tiQty = $items[$in]['qty'];
                $remarks = $items[$in]['remarks'];
                $this->cons_items($cID, $tiQty,$remarks, $date, $stID, $account_id, $tiType);
                }
            }
        }
        function cons_items($cID, $tiQty,$remarks, $date, $stID, $account_id, $tiType){
            $query3 = "INSERT INTO consumed_items (ciID, cID) VALUES (NULL,?)";
            $this->db->query($query3, array($cID));
            $ciID = $this->db->insert_id();
            $this->add_itrans($tiQty,'1',$remarks, $date, $stID, $ciID, $account_id, $tiType);
        }

        function add_itrans($tiQty,$actual,$remarks, $date, $stID, $ciID, $tiType){
            $query1 = "SELECT stQty FROM stockitems where stID = '$stID'";
            $result= $this->db->query($query1)->result_array();
            foreach($result as $r){
                $stQty = $r['stQty'];
            } 
            $query = "INSERT INTO transitems(tiID, tiType, tiQty, tiActual, remainingQty, tiRemarks, tiDate, stID, ciID)
                VALUES (NULL, ?,?,?,?,?,?,?,?)";
             return $this->db->query($query, array($tiType, $tiQty, $actual, $stQty, $remarks, $date, $stID, $ciID));
        }

        function add_consactlog($account_id, $date_recorded){
            $query = "INSERT INTO `activitylog`(
                `alID`,
                `aID`,
                `alDate`, 
                `alDesc`, 
                `alType`, 
                `additionalRemarks`
                ) 
                VALUES (NULL, ?, ?, ?, ?, ?)";
                return $this->db->query($query, array($account_id, $date_recorded, "Chef added consumption", "add", ""));
        } 
        function update_editCons($tiID,$stID,$ciID,$cQty,$coldQty,$cDate,$cRemarks,$drecorded){
            $query = "SELECT cID FROM consumed_items where ciID='$ciID'";
            $result = $this->db->query($query)->result_array();
            foreach($result as $r){
                $cID = $r['cID'];
            }
            $uquery = "UPDATE consumptions set cDate=?,cDateRecorded=? where cID = ?";
            $this->db->query($uquery,array($cDate,$drecorded,$cID));
            $this->add_itrans($cQty,'1',$cRemarks, $cDate, $stID, $ciID, 'consumed');
        }
        function update_iStocks($id, $cQty, $coldQty){
                $query4 = "Select stQty from stockitems where stID = '$id'";
                $data = $this->db->query($query4)->result_array();
                foreach($data as $d){
                    $stQty = $d['stQty'];
                }
                if($cQty > $coldQty){
                    $diff = $cQty - $coldQty;
                    $finQty = $stQty - $diff;
                    $updateQty = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($updateQty, array($finQty, $id));
                }else if($cQty < $coldQty){
                    $sum = $coldQty - $cQty;
                    $finQty = $sum + $stQty;
                    $updateQty = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($updateQty, array($finQty, $id));
                }else{
                    $same = "Update stockitems set stQty = ? where stID = ?";
                    $this->db->query($same, array($stQty, $id));
                }
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
    
    }
?>
