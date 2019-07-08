<?php
class Customermodel extends CI_Model {
    
    function __construct(){
        parent:: __construct();
        date_default_timezone_set('Asia/Manila'); 
    }
    //ADD  CONSUMPTION TRANSACTION
    function add_consumption($consumption){
        $query = "INSERT INTO transactions(tID, tNum, tDate, dateRecorded, tType, tRemarks)
            VALUES(NULL, ?, ?, ?, 'consumption', ?)";
        $lastNum = $this->db->query("SELECT MAX(tNum) AS lastnum
            FROM transactions
            WHERE tType = 'consumption'")->result_array()[0]['lastnum'];
        $lastNum = $lastNum == NULL ? 1 : $lastNum++;
        if($this->db->query($query, array($lastNum,$consumption['date'],$consumption['dateRecorded'],$consumption['remarks']))){
            return $this->db->insert_id();
        }
        return 0;
    }
    function add_consumedItems($stID){
        $query = "INSERT INTO transitems(tiID, stID)
            VALUES(NULL, ?)";
        if($this->db->query($query, array($stID))){
            return $this->db->insert_id();
        }
        return 0;
    }
    function add_consumedItemsQty($tID, $tiID, $qty){
        $query= "INSERT INTO trans_items(tID, tiID, actualQty)
            VALUES(?, ?, ?)";
        return $this->db->query($query,array($tID, $tiID, $qty));
    }
    function add_consumedLog($log){
        $query = "INSERT INTO stocklog(
            slID, stID, tID, slType, slQty, slRemainingQty, actualQty,
            discrepancy, slDateTime, dateRecorded, slRemarks
        )
        VALUES(
            NULL, ?, ?, 'consumed', ?, ?, NULL, NULL, ?, ?, ?
        )";
        return $this->db->query($query, array($log['stID'], $log['tID'], 
        $log['slQty'], $log['slRemain'], $log['slDateTime'], $log['dateRecorded'], $log['slRemarks']));
    }
    function update_stQty($stID, $stQty){
        $query = "UPDATE stockitems
            SET stQty = stQty - ?
            WHERE stID = ?";
        return $this->db->query($query, array($stQty, $stID));
    }
    //END ADD  CONSUMPTION TRANSACTION
	function get_tables(){ 
	    $query = $this->db->query('SELECT tableCode FROM tables');
	    return $query->result();
    }
    function fetch_promos(){
        $query = $this->db->query('SELECT * FROM menu left join preferences using (mID)
        left join promo_cons using (prID)
        left join promo using (pmID)
        left join discounts AS d using (pmID) 
        left join freebie AS f using (pmID) 
        left join menu_discount AS md USING (pmID)
        left join menu_freebie AS mf USING (pmID)');
        return $query->result();
    }

    function fetch_freebies($pref_id){
        $query = $this->db->query("SELECT *, mn.mName AS fb_menuname FROM ((((((menu 
        INNER JOIN preferences pref USING (mID)) 
        INNER JOIN promo_cons USING (prID)) 
        INNER JOIN promo USING (pmID)) 
        INNER JOIN freebie USING (pmID)) 
        inner join menu_freebie AS mf USING (pmID)) 
        inner join preferences fb_pref ON mf.prID = fb_pref.prID)
        inner join menu mn ON fb_pref.mID = mn.mID
        WHERE pref.prID = ".$pref_id.";");
         return $query->result();
    }

    function fetch_discounts($pref_id){
        $query = $this->db->query('SELECT *, mn.mName AS dc_menuname FROM ((((((menu 
        INNER JOIN preferences pref USING (mID)) 
        INNER JOIN promo_cons USING (prID)) 
        INNER JOIN promo USING (pmID)) 
        INNER JOIN discounts USING (pmID)) 
        inner join menu_discount AS mf USING (pmID)) 
        inner join preferences fb_pref ON mf.prID = fb_pref.prID)
        inner join menu mn ON fb_pref.mID = mn.mID
        WHERE pref.prID = '.$pref_id.';');
         return $query->result();
    }


        function fetch_category(){
            $query = $this->db->query('SELECT ctID, ctName FROM categories WHERE supcatID IS NULL AND ctType = "menu" GROUP BY ctName ASC');
            return $query->result();
        }
        function fetch_availableSubcategory() {
            $query = $this->db->query("SELECT ctID, supcatID, ctName, ctType FROM preferences NATURAL JOIN menu NATURAL JOIN categories WHERE supcatID IS NOT NULL AND ctType = 'menu' GROUP BY ctName ORDER BY ctID, supcatID ASC");
            return $query->result();
        }
	function fetch_availableSubcategory1($id) {
            $query = $this->db->query("SELECT ctID, supcatID, ctName, ctType FROM preferences NATURAL JOIN menu NATURAL JOIN categories WHERE supcatID IS NOT NULL AND supcatID = '$id' GROUP BY ctName ORDER BY ctID, supcatID ASC");
            return $query->result();
        }
        function fetch_menu(){
            $query = $this->db->query('SELECT menu.mID, categories.ctName, menu.mName, menu.mDesc, menu.mAvailability,
            menu.mImage, categories.ctType, MIN(preferences.prPrice) AS prPrice, preferences.mTemp FROM menu LEFT JOIN categories USING (ctID) NATURAL JOIN preferences WHERE ctType = "menu" GROUP BY mName');
            return $query->result();
        }
        function fetch_allsubcats(){
            $query = $this->db->query('SELECT * FROM categories WHERE supcatID IS NOT NULL ORDER BY ctID, supcatID ASC');
            return $query->result();
        }
        function fetch_catswithmenu(){
            $query = $this->db->query('SELECT ctName FROM categories NATURAL JOIN menu GROUP BY ctID ORDER BY ctID ASC');
            return $query->result();
        }
        function fetch_menupref(){
            $query = $this->db->query('SELECT prID,prName,mID,prPrice,mTemp,IF(mTemp IS NOT NULL, CONCAT(prName," (",IF(mTemp="h","Hot",IF(mTemp="c","Cold",NULL)),") - ",prPrice), CONCAT(prName," - ",prPrice)) AS preference FROM preferences ORDER BY prPrice ASC');
            return $query->result();
        }
        function fetch_addon(){
            $query = $this->db->query('SELECT * FROM menuaddons NATURAL JOIN addons WHERE aoStatus = "available" ORDER BY aoPrice ASC');
            return $query->result();
        }

        function get_all(){
            $query =$this->db->get('menu');
            return $query->result();
        }
        function return_drinks() {
            $query = $this->db->get_where('menu', array('ctID' => '10'));
            return $query->result();
        }
        function return_meals() {
            $query = $this->db->get_where('menu', array('ctID' => '11'));
            return $query->result();
        }
        function return_menu($menu_id){
            $query =$this->db->get_where('menu', array('mID'=>$menu_id));
            return $query->result();
        }
        function return_snacks() {
            $query = $this->db->get_where('menu', array('ctID' => '12'));
            return $query->result();
        }
       function orderInsert($total, $tableCode, $orderlist, $customer, $dateTime){//insert in table orderslip
            $query1 = "Insert into orderslips(tableCode, custName, osTotal, payStatus, osDateTime, osPayDateTime, osDateRecorded) values (?,?,?,?,?,?,?)";
			$this->db->query($query1, array( $tableCode, $customer, $total, 'unpaid', $dateTime,'', $dateTime)); 
			$order_id= $this->db->insert_id();
			$bool = false;
	foreach($orderlist as $items){
        $prID = $items['id'];
        $sql="SELECT CONCAT(mName, ' ', '(',prName,')', IF(mTemp IS NULL,' ',CONCAT(' ',mTemp))) as prName 
        from preferences INNER JOIN menu USING (mID) where prID = '$prID'";
        $rest = $this->db->query($sql)->result_array();
        foreach($rest as $r){
		$query2 = "Insert into orderlists (olID, osID, prID, olDesc, olQty, olSubtotal, olStatus, olRemarks, olPrice, olDiscount) values (?,?,?,?,?,?,?,?,?,?)";
                 $this->db->query($query2, array(NULL,$order_id, $items['id'],$r['prName'],$items['qty'], $total, 'pending', $items['remarks'], $items['subtotal'], ''));
                $olID = $this->db->insert_id(); 

                $addOns = $items['addons'];
                if(!empty($addOns)){
                $bool3= false;
                foreach($addOns as $key => $value){
                   if($key == 'addonIds'){
                    $addonIds = $value;
                    }else if($key == 'addonQtys'){
                        $addonQtys = $value;
                    }else if($key == 'addonSubtotals'){
                        $addonSubtotals = $value;
                    }
                }
                for($i = 0, $q=0, $s=0; $i < count($addonIds), $q <  count($addonQtys),$s <  count($addonSubtotals)
                     ; $i++, $q++, $s++){
                $query3 ="Insert into orderaddons(aoID, olID, aoQty, aoTotal)values(?,?,?,?)";
                $bool3 = $this->db->query($query3, array($addonIds[$i], $olID, $addonQtys[$q], $addonSubtotals[$s]));
               }
              }
            }
        }
            return true;
        }
        // function add_consumedItems($pref, $olID) {
        //     $query = "SELECT * FROM orderlists left join prefstock using (prID) left join stockitems using (stID) where prefstock.prID = ? and olID = ?";
        //     $array = $this->db->query($query, array($pref, $olID));
        //     $this->automatic_deduction($array);
        // }

        function automatic_deduction($array){
            $stID = $array['stID'];
            $newQty = $array['stQty'] - ($array['prstQty'] * $array['olQty']);
            $query = "UPDATE `stockitems` SET `stQty` = ? WHERE `stockitems`.`stID` = ?;";
            $this->db->query($query, array(5, 5));
        }

        function get_menudetails($menu_id){
            $query = "select * from menu where mID = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }

        function get_sizes($menu_id){
            $query = "Select mID, prName, size_price from sizes where mID = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }

        function get_addons($menu_id){
            $query = "Select aoID, aoName, aoPrice, aoStatus from menuaddons inner join addons using where mID = ?";
            return $this->db->query($query, array($menu_id))->result_array();
        }
        function get_preference($prefID){
            $query = "SELECT 
                        prID,
                        mID,
                        prPrice,
                        CONCAT(mName,
                                IF(prName = 'Normal',
                                    '',
                                    CONCAT(' - ', prName)),
                                IF(mTemp IS NULL,
                                    '',
                                    IF(mTemp = 'h', ' Hot', ' Cold'))) AS 'order'
                    FROM
                        preferences
                            INNER JOIN
                        menu USING (mID)
                    WHERE
                        prID = ?;";
            return $this->db->query($query, array($prefID))->result_array();
        }
        
        function get_addonPrices($addonIds){
            $query = "SELECT 
                            aoID, aoPrice
                        FROM
                            addons
                        WHERE
                            aoID IN ?;";
            return $this->db->query($query,array($addonIds))->result_array();
        }
        function get_prefStocks($prID){
            $query="SELECT
                    prID,
                    stID,
                    prstQty
                FROM
                    prefstock
                LEFT JOIN(
                        preferences
                    LEFT JOIN menu USING(MID)
                    ) USING(prID)
                LEFT JOIN stockitems USING(stID) where prID = ?";
            return $this->db->query($query, array($prID))->result_array();
        }

        function get_priceAndName($prID){
            $query = "SELECT
                    prPrice AS price,
                    CONCAT(
                        mName,
                        IF(
                            prName IS NULL,
                            '',
                            CONCAT(' ', prName)
                        ),
                        IF(
                            mTemp IS NULL,
                            '',
                            CONCAT(
                                ' ',
                                IF(
                                    mTemp = 'hc',
                                    '',
                                    IF(mTemp = 'h', 'Hot', 'Cold')
                                )
                            )
                        )
                    ) AS 'name'
                FROM
                    preferences left join menu using (mID)
                WHERE
                    prID = ?;";
            return $this->db->query($query,array($prID))->result_array()[0];
        }
        function get_stockQty($stID){
            $query = "SELECT
                stQty
            FROM
                stockitems
            WHERE
                stID = ?";
            return $this->db->query($query,array($stID))->result_array();
        }
    }
?>
