<?php
class Adminmodel extends CI_Model{
    
    private $err = array('Username does not exist!', 'Incorrect password');

    function __construct(){
        parent:: __construct();
        $this->infoDB = $this->load->database('information',true);
        date_default_timezone_set('Asia/Manila'); 
    }

//GET FUNCTIONS-------------------------------------------------------------------
//REPORT GENERATION GETTERS
 function getInventoryList(){
     $query = "SELECT ctID, ctName, stID, UPPER(stLocation) AS stLocation, stMin, CONCAT(stName, IF(stSize IS NULL, '', CONCAT(' ', stSize))) AS stockitemname, stQty, UPPER(stStatus) AS stStatus, UPPER(stType) AS stType, uomID, uomName, uomAbbreviation, stBqty FROM(stockitems LEFT JOIN categories USING(ctID)) LEFT JOIN uom USING(uomID) order by ctName, stName asc";
     return $this->db->query($query)->result_array();
 }
 function get_inventoryReport($stID, $sDate, $eDate){
    $query = "SELECT
                slID, stID, uomAbbreviation, slType,
                DATE_FORMAT(slDateTime, '%b %d, %Y %r') AS slDateTime, 
                stocklog.dateRecorded, slQty, slRemarks, tNum
            FROM
                (
                    stocklog
                LEFT JOIN stockitems USING(stID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID) WHERE stID = ? and slDateTime BETWEEN ? and ?";
    return $this->db->query($query, array($stID, $sDate, $eDate))->result_array();
}

//DASHBOARD GETTERSdate_format
function get_salesReport($sDate, $eDate){
    $query = "SELECT * FROM orderslips LEFT JOIN orderlists USING(osID) WHERE osPayDateTime BETWEEN ? and ? order by olDesc ASC";
    return $this->db->query($query, array($sDate, $eDate))->result_array();
}
//DASHBOARD GETTERS

function getOSMonthByYear($year){
    $query = "SELECT DATE_FORMAT(osDateTime,'%m') osMonth, DATE_FORMAT(osDateTime,'%M') osLongMonth, SUM(olQty) salesCount, SUM(osTotal) revenue FROM orderlists NATURAL JOIN orderslips WHERE payStatus = 'paid' AND DATE_FORMAT(osDateTime,'%Y') = ? GROUP BY osMonth ORDER BY osMonth";
    return $this->db->query($query,array($year))->result_array();
}
function getUnavailableKitchen(){
    $query = "SELECT stID, stLocation, COALESCE(CONCAT(stName,' (',stSize,')'),stName) stock, stQty, stMin FROM stockitems WHERE stLocation = 'kitchen' AND stQty <= stMin";
    return $this->db->query($query)->result();
}
function getUnavailableStockRoom(){
    $query = "SELECT stID, stLocation, COALESCE(CONCAT(stName,' (',stSize,')'),stName) stock, stQty, stMin FROM stockitems WHERE stLocation = 'stockroom' AND stQty <= stMin";
    return $this->db->query($query)->result();
}
function getTopTenMenu(){
    $query = "SELECT mName, COUNT(prID) salesCount FROM preferences NATURAL JOIN menu NATURAL JOIN orderlists NATURAL JOIN orderslips WHERE payStatus = 'paid' AND DATE_FORMAT(osDateTime,'%Y') = ? GROUP BY mName ORDER BY salesCount DESC LIMIT 10";
    return $this->db->query($query,array(date('Y')))->result();
}
function getTodaySales(){
    $query = "SELECT DATE_FORMAT(osDateTime,'%d') osDay, SUM(olQty) salesCount, SUM(osTotal) sales FROM orderlists NATURAL JOIN orderslips WHERE payStatus = 'paid' AND DATE_FORMAT(osDateTime,'%d-%m-%Y') = ? GROUP BY osDay ORDER BY osDay";
    return $this->db->query($query,array(date('d-m-Y')))->result();
}
function getTotalSales(){
    $query = "SELECT COUNT(olQty) total FROM orderslips NATURAL JOIN orderlists WHERE payStatus = 'paid'";
    return $this->db->query($query)->result();
}
function getMonthConsumption(){
    $query = "SELECT COUNT(tiQty) total FROM consumed_items NATURAL JOIN consumptions NATURAL JOIN transitems WHERE DATE_FORMAT(cDate,'%Y-%m') = ?";
    return $this->db->query($query,array(date('Y-m')))->result();
}

function get_transactions(){
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
                isArchived = '0' and tType = 'purchase order'
                order by tID desc";
    return $this->db->query($query)->result_array();
}

function get_transitems(){
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
                tType = 'purchase order'";
    return $this->db->query($query)->result_array();
}
    function get_receiptTransaction($id){
        $query = "SELECT
                tID AS id,
                spID AS sp,
                spName,
                tNum AS num,
                receiptNo AS receipt,
                tDate AS date,
                tTotal AS total,
                tRemarks AS remarks
            FROM transactions
            LEFT JOIN supplier USING(spID)
            WHERE tID = ?";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_receiptTransactionItems($id){
        $query = "SELECT
                tiID AS id,
                uomID AS uom,
                stID AS stock,
                tiPrice AS price,
                tiQty AS qty,
                qtyPerItem AS perItem
            FROM transitems LEFT JOIN trans_items USING(tiID)
            WHERE tID = ?";
        return $this->db->query($query,array($id))->result_array();
    }

    function get_prefStocks(){
        $query="SELECT
                prID,
                CONCAT(mName, 
                    IF(prName IS NULL, '', CONCAT(' ', prName)),
                    IF(mTemp IS NULL, '', CONCAT(' ',
                            IF(mTemp = 'hc', '',
                                IF(mTemp = 'h', 'Hot', 'Cold')
                            )
                        )
                    )
                ) AS prefname,
                stID AS stockitem,
                CONCAT(stName,
                    IF(stSize IS NULL, '', CONCAT(' ', stSize))
                ) AS stockitemname,
                prstQty AS qty
            FROM
                prefstock
            LEFT JOIN(
                    preferences
                LEFT JOIN menu USING(MID)
                ) USING(prID)
            LEFT JOIN stockitems USING(stID)";
        return $this->db->query($query)->result_array();
    }
    function get_prefNames(){
        $query = "SELECT 
            CONCAT(mName,
                    IF(prName IS NULL,
                        '',
                        CONCAT(' ', prName)),
                    IF(mTemp IS NULL,
                        '',
                        CONCAT(' ',
                                IF(mTemp IS NULL,
                                    '',
                                    IF(mTemp = 'h', 'Hot', 'Cold'))))) AS prefname,
                prID AS id
            FROM
                preferences
                    LEFT JOIN
                menu USING (mID)
            WHERE
                NOT mAvailability = 'archived'
            ORDER BY prefname;";
        return $this->db->query($query)->result_array();
    }
    function get_stockQty($stID){
        $query = "SELECT stQty from stockitems where stID = ?";
        return $this->db->query($query,array($stID))->result_array();
    }
    function get_stockCategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockMainCategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(stID) as stockCount from categories left join stockitems using (ctID) where ctType = 'inventory' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_menuprices(){
        $query = "select mID, prName, prPrice from sizes";
        return $this->db->query($query)->result_array();
    }

    function get_menucategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_menumaincategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_menusubcategories(){
        $query = "Select ctID, ctName, ctType, ctStatus, COUNT(mID) as menu_no from categories left join menu using (ctID) where ctType = 'menu' and supcatID is not null group by ctID order by ctName asc";
        return $this->db->query($query)->result_array();
    }

    function get_maincat(){
        $query = "SELECT * from categories where supcatID is null AND ctType = 'menu' group by ctName order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_uom(){
        $query = "SELECT * from uom";
        return $this->db->query($query)->result_array();
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
    function get_uomForSizes(){
        $query = "SELECT
            uomName,
            uomAbbreviation,
            UPPER(uomVariant) as uomVariant
        FROM
            uom
        WHERE
            uomVariant IS NOT NULL;";
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
    function get_stockItem($id){
        $query = "SELECT
            ctID, ctName, stID, UPPER(stLocation) AS stLocation, stMin,
            stName, stQty, stSize, UPPER(stStatus) AS stStatus, UPPER(stType) AS stType,
            uomID, uomAbbreviation, stBqty
        FROM
            (
                stockitems
            LEFT JOIN categories USING(ctID)
            )
        LEFT JOIN uom USING(uomID)
        WHERE
            stID = ?;";
        return $this->db->query($query, array($id))->result_array();
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
    function get_stockLog($stID){
        $query = "SELECT
                slID,
                stID,
                uomAbbreviation,
                slType,
                DATE_FORMAT(slDateTime, '%b %d, %Y %r') AS slDateTime,
                stocklog.dateRecorded,
                slQty,
                slRemainingQty,
                actualQty,
                discrepancy,
                slRemarks,
                if(tID is NULL, 'N/A' ,concat(if(tType='delivery receipt','DR#',if(tType='official receipt','OR#',if(tType='consumption','C#',if(tType='spoilage','S#','R#')))),tNum)) as tNum
            FROM
                (
                    stocklog
                LEFT JOIN stockitems USING(stID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID)
            WHERE
                stID = ? AND slID >= (
                SELECT
                    MAX(slID)
                FROM
                    stocklog
                WHERE
                    slType = 'beginning' AND stID = ?
            )
            order by dateRecorded;";
        return $this->db->query($query,array($stID,$stID))->result_array();
    }

    function get_stockLogBetween($stID){
        $query = "SELECT
                slID,
                stID,
                uomAbbreviation,
                slType,
                DATE_FORMAT(slDateTime, '%b %d, %Y %r') AS slDateTime,
                stocklog.dateRecorded,
                slQty,
                slRemainingQty,
                actualQty,
                discrepancy,
                slRemarks,
                if(tID is NULL, 'N/A' ,concat(if(tType='delivery receipt','DR#',if(tType='official receipt','OR#',if(tType='consumption','C#',if(tType='spoilage','S#','R#')))),tNum)) as tNum
            FROM
                (
                    stocklog
                LEFT JOIN stockitems USING(stID)
                )
            LEFT JOIN transactions USING(tID)
            LEFT JOIN uom USING(uomID)
            WHERE
                stID = ? AND slID between (
                SELECT
                    slID
                FROM
                    stocklog
                WHERE
                    slType = 'beginning' AND stID = ?
                limit 2;
            )
            order by slDateTime;";
        return $this->db->query($query,array($stID,$stID))->result_array();
    }
    function get_stocksForBeginningBrochure(){
        $query ="SELECT
            CONCAT(
                stName,
                IF(
                    stSize IS NULL,
                    '',
                    CONCAT(' ', stSize)
                )
            ) AS stName,
            stID,
            ctName,
            stQty,
            uomAbbreviation
        FROM
            stockitems
        LEFT JOIN categories USING(ctID)
        LEFT JOIN uom USING(uomID)
        ORDER BY
            stName;";
        return $this->db->query($query)->result_array();
    }

    function get_invPeriodStart($stID){
        return $this->db->query("SELECT
                    DATE_FORMAT(MAX(slDateTime), '%b %d, %Y %r') AS maxDate, actualQty
                FROM
                    stocklog
                WHERE
                    slType = 'beginning' AND stID = ?
            ;",array($stID))->result_array();
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

    function get_tables(){
        $query = "Select * from tables";
        return $this->db->query($query)->result_array();
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

    function get_stockDetails($id){
        $query = "SELECT 
            stID, stName, stStatus, stType, ctID
        FROM
            stockitems
        WHERE
            stID = ?;";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_discounts() {
        $query = "SELECT *, CONCAT(mn.mName,' ',pref.prName) AS menu_item  FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID) 
        INNER JOIN discounts USING (pmID) 
        INNER JOIN menudiscount USING (pmID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_freebies() {
        $query = "SELECT *, CONCAT(mn.mName,' ',pref.prName) AS menu_item, CONCAT(me.mName,' ',pr.prName) AS menu_freebie 
        FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID) 
        INNER JOIN freebies USING (pmID) 
        INNER JOIN menufreebie mf USING (pmID) 
        INNER JOIN preferences pr ON mf.prID = pr.prID 
        INNER JOIN menu me ON pr.mID = me.mID";
        return $this->db->query($query)->result_array(); 
    }
    function get_menu_items(){
        $query = "SELECT CONCAT(mn.mName,' ',pref.prName) 
        AS pref_menu, pref.mTemp, pref.prID 
        FROM menu mn INNER JOIN preferences pref USING (mID)";
        return $this->db->query($query)->result_array();
    }
    function get_menuItems() {
        $query = "SELECT pr.prID, CONCAT(mn.mName,' ',pr.prName) AS menu_item 
        FROM preferences pr INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_menudiscounts() {
        $query = "SELECT * FROM menudiscount INNER JOIN discounts USING (pmID)";
        return $this->db->query($query)->result_array();
    }
    function get_promos() {
        $query = "SELECT * FROM promos";
        return $this->db->query($query)->result_array(); 
    }
    function get_promoconst() {
        $query = "SELECT pc.pmID, pc.pc_type, pc.pcQty, pref.prID, mn.mName, pref.prName,
        CONCAT(mn.mName,' ',pref.prName) AS menu_item
        FROM promoconstraint pc INNER JOIN preferences pref USING (prID) INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_promoconstraint() {
        $query = "SELECT pmID, pc.prID, pc.pcQty, 
        CONCAT(mn.mName,' ',pref.prName) AS menu_item
        FROM promoconstraint pc 
        INNER JOIN preferences pref USING (prID) 
        INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_fb() {
        $query = "SELECT * FROM freebies";
        return $this->db->query($query)->result_array(); 
    }
    function get_menudc() {
        $query = "SELECT pmID, CONCAT(mn.mName,' ',pref.prName) AS menu_item, md.dcAmount FROM 
        menudiscount md INNER JOIN preferences pref 
        USING (prID) INNER JOIN menu mn USING (mID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_dc() {
        $query = "SELECT * FROM discounts";
        return $this->db->query($query)->result_array(); 
    }
    function get_menu(){
        $query = "Select * from menu inner join categories using (ctID) order by ctName asc, mName asc";
        return $this->db->query($query)->result_array();
    }
    function get_addons2(){
        $query = "SELECT * from menuaddons inner join addons using (aoID)";
        return $this->db->query($query)->result_array();
    }
    function get_preferences(){
        $query = "SELECT * from preferences";
        return $this->db->query($query)->result_array();
    }
    function get_prefDetails($prID){
        $query = "SELECT * from preferences pr INNER JOIN menu USING (mID) 
        LEFT JOIN prefstock USING (prID) 
        LEFT JOIN stockitems USING (stID) 
        WHERE pr.prID = ?";
        return $this->db->query($query,array($prID))->result_array();
    }
    function get_orderAddon() {
        $query = "SELECT * FROM `orderaddons` INNER JOIN addons USING (aoID)";
        return $this->db->query($query)->result_array(); 
    }
    function get_osSales(){
        $query = "Select * from orderslips where payStatus = 'paid';";
        return $this->db->query($query)->result_array();
    }
    function get_olSales(){
        $query = "Select * from orderlists inner join preferences using (prID) inner join menu using (mID) 
        LEFT JOIN prefstock USING (prID) LEFT JOIN stockitems USING (stID)";
        return $this->db->query($query)->result_array();
    }
    function get_menuPref(){
        $query = "SELECT 
        prID, 
        mName,
        CONCAT(mName,
                   ' ',
                '(',prName,')',
                IF(mTemp IS NULL,' ', CONCAT(' ',mTemp))) as prName,
        prPrice,
        mAvailability 
    FROM 
        preferences 
                INNER JOIN 
        menu USING (mID)";
        return $this->db->query($query)->result_array();
    }
    function get_addons(){
        $query = "Select * from addons";
        return $this->db->query($query)->result_array();
    }
    function get_mnAddons() {
        $query = "SELECT * FROM addons INNER JOIN menuaddons USING (aoID);";
        return $this->db->query($query)->result_array();
    }
    function get_menuaddons($mID) {
        $query = "SELECT * FROM menu mn INNER JOIN menuaddons ma USING (mid) INNER JOIN addons ao USING (aoID) 
        WHERE mn.mID = ? AND ao.aoStatus = 'available'";
         return $this->db->query($query, array($mID))->result_array();
    }
    function get_supplierstocks(){
        $query = "Select * from suppliermerchandise supp LEFT JOIN stockitems USING (stID) LEFT JOIN uom ON (supp.uomID = uom.uomID);";
        return $this->db->query($query)->result_array();
    }
    function get_supplier(){
        $query = "Select * from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_supplierNames(){
        $query = "Select spID, spName from supplier order by spName";
        return $this->db->query($query)->result_array();
    }
    function get_suppliermerch(){
        $query = "SELECT stID, CONCAT( stName, IF( stSize IS NULL, '', CONCAT(' ', stSize) ) ) AS stName, suppliermerchandise.uomID, uomAbbreviation,uomName, spmID, spmName, spmPrice, spmActualQty, spID, spName FROM ( stockitems RIGHT JOIN( suppliermerchandise LEFT JOIN supplier USING(spID) ) USING(stID) ) LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID)
        ";
        return $this->db->query($query)->result_array();
    }
    function get_suppliermerchBySupplier($id){
        $query = "SELECT stID, CONCAT( stName, IF( stSize IS NULL, '', CONCAT(' ', stSize) ) ) AS stName, suppliermerchandise.uomID, uomAbbreviation,uomName, spmID, spmName, spmPrice, spmActualQty, spID, spName FROM ( stockitems RIGHT JOIN( suppliermerchandise LEFT JOIN supplier USING(spID) ) USING(stID) ) LEFT JOIN uom on (suppliermerchandise.uomID = uom.uomID)
        where spID = ?";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_stockSubcategories(){
        $query = "SELECT 
            ctID, ctName, ctType, ctStatus, COUNT(stID) AS stockCount
        FROM
            categories
                LEFT JOIN
            stockitems USING (ctID)
        WHERE
            ctType = 'inventory'
                AND supcatID IS NOT NULL
        GROUP BY ctID
        ORDER BY ctName ASC;";
        return $this->db->query($query)->result_array();
    }
    function get_maincatStock(){
        $query = "SELECT * from categories where supcatID is null AND ctType = 'inventory' group by ctName order by ctName asc";
        return $this->db->query($query)->result_array();
    }
    function get_stockitems() {
        $query = "SELECT * FROM stockitems LEFT JOIN uom USING (uomID) LEFT JOIN suppliermerchandise USING (stID) ORDER BY 2;";
        return $this->db->query($query)->result_array();
    }
    function get_stocktransitems() {
        $query = "SELECT ti.stID, ti.tiID, tri.tiQty, trans.tDate, ti.rRemarks,trans.supplierName,trans.receiptNo, pf.prstQty, sp.spID, sp.spmID, sp.spmName, uom.uomID, uom.uomName, st.stQty, sp.spmActualQty, sp.spmPrice, tr.tID
        FROM `transitems` ti INNER JOIN trans_items tri USING (tiID) INNER JOIN transactions trans USING (tID) 
        INNER JOIN uom USING (uomID) INNER JOIN suppliermerchandise sp USING (stID) INNER JOIN stockitems st USING (stID) 
        LEFT JOIN prefstock pf USING (stID) LEFT JOIN transactions tr USING (tID) WHERE trans.tType = 'delivery receipt' ORDER BY 4";
        return $this->db->query($query)->result_array();
    }
//--------------CONSUMPTIONS--------------------
    function get_consumpitems() {
        $query = "SELECT * FROM consumed_items LEFT JOIN transitems ti USING (ciID) LEFT JOIN consumptions USING (cID) 
        LEFT JOIN stockitems st ON (ti.stID = st.stID) INNER JOIN (SELECT max(tiID) as tiID FROM transitems 
        LEFT JOIN consumed_items USING (ciID) GROUP BY ciID) AS maxNew USING (tiID)";
        return $this->db->query($query)->result_array();
    }
    //--------------------------------
    function get_returns() {
        $query = "SELECT * FROM `returns`";
        return $this->db->query($query)->result_array();
    }
    function get_returnItems() {
        $query = "SELECT * FROM return_items LEFT JOIN transitems ti USING (riID) INNER JOIN suppliermerchandise USING (spmID) 
        INNER JOIN uom USING (uomID) LEFT JOIN stockitems st ON (ti.stID = st.stID) INNER JOIN (SELECT max(tiID) as tiID 
        FROM transitems LEFT JOIN return_items USING (riID) GROUP BY riID) AS maxNew USING (tiID)";
        return $this->db->query($query)->result_array();
    }
    function get_deliveries() {
        $query = "SELECT tiID, spmID, pur.spID, ti.stID, spmPrice, spmActual, receiptNo, spAltName, stName, u.uomName, tiQty, tiActual, 
        CONCAT(receiptNo,' - ', DATE_FORMAT(pDate, '%b %d, %Y')) AS trans, CONCAT(ti.tiQty,' ',u.uomName,'/s of ',st.stName) AS item 
        FROM `transitems` ti LEFT JOIN purchase_items USING (piID) LEFT JOIN pur_items USING (piID) LEFT JOIN purchases pur USING (pID) LEFT JOIN stockitems st USING (stID) 
        LEFT JOIN suppliermerchandise spm USING (spmID) LEFT JOIN uom u ON (spm.uomID = u.uomID) WHERE pur.ptype = 'delivery' AND ti.tiType = 'restock'";
        return $this->db->query($query)->result_array();

    }

//INSERT FUNCTIONS----------------------------------------------------------------
    function add_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch){
        $query = "insert into supplier (spName, spContactNum, spEmail, spStatus, spAddress) values (?,?,?,?,?);";
        if($this->db->query($query,array($spName, $spContactNum, $spEmail, $spStatus, $spAddress))){
            $spID = $this->db->insert_id();
            if(count($spMerch) > 0){
                foreach($spMerch as $merch) {
                    $this->add_supplierMerchandise($merch, $spID);
                }
            }
            return true;          
        }
        return false;
    }

    function add_supplierMerchandise($merch, $spID) {
        $query = "insert into suppliermerchandise (stID, spID, uomID, spmName, spmActualQty, spmPrice) values (?,?,?,?,?,?);";
        $this->db->query($query,array($merch['stID'],$spID,$merch['merchUnit'],$merch['merchName'],$merch['merchActualQty'],$merch['merchPrice']));
    }

    function add_menu($mName, $mDesc, $category, $status,$preference,$addon){
        $query = "INSERT into menu (mName, mDesc, ctID, mAvailability) values (?,?,?,?);";
        if($this->db->query($query,array($mName, $mDesc, $category, $status))){
            $mID = $this->db->insert_id();
            if(count($preference) > 0){
                foreach($preference as $pref) {
                    $this->add_preference($mID, $pref);
                }
            }
            if(count($addon) > 0){
                foreach($addon as $ao) {
                    $this->add_menuaddon($mID, $ao);
                }
            }
            return true;
        }
        return false;
    }

    function add_image($image, $mID){
        $query = "UPDATE menu set mImage = ? where mID = ?";
        return $this->db->query($query,array($image, $mID));
    }

    function add_preference($mID, $pref){
       $query = "INSERT into preferences (mID, prName, mTemp, prPrice, prStatus) values (?,?,?,?,?)";
       $this->db->query($query, array($mID, $pref['prName'], $pref['mTemp'], $pref['prPrice'], $pref['prStatus']));
    }
    function set_tNum() {
        $this->db->select('MAX(tNum) AS lastnum');
        $this->db->from('transactions');
        $this->db->where('tType', 'return');

        return $this->db->get()->row()->lastnum;
    }
    
    function add_returns($spID, $spAltName, $rDate, $rDateRecorded, $rTotal, $items, $accountID, $action) {
        $query = "INSERT INTO `returns` (rID, rDate, rDateRecorded, spID, spAltName, rTotal) values (NULL, ?,?,?,?,?)";
        if($this->db->query($query, array($rDate, $rDateRecorded, $spID, $spAltName, $rTotal))) {
            if(count($items) > 0) {
                $this->add_return_items($this->db->insert_id(),$items, $accountID, $action);
            }
        }
        
    }
    function update_riStatus($ti, $accountID, $action) {
        $query = "UPDATE return_items SET riStatus = ? WHERE riID = ?";
        for($in = 0; $in < count($ti) ; $in++){
            $this->db->query($query, array($ti[$in]['riStatus'], $ti[$in]['riID']));
            if(intval($ti[$in]['new']) === 1 ) {
                $this->add_transitems($ti[$in]['riID'], $ti[$in]['tiQty'], $ti[$in]['tiActualQty'], $ti[$in]['tiActual'], $ti[$in]['tiSubtotal'], 
                $ti[$in]['tiRemarks'], $ti[$in]['tiDate'], $ti[$in]['stID'], $ti[$in]['spmID'], $accountID, $action);
                $this->update_transitems($ti[$in]['tiID'], $ti[$in]['tiRemarks']);
            } else {
                $this->update_transitems($ti[$in]['tiID'], $ti[$in]['tiRemarks']);
            }  
        }
    }

    function update_transitems($tiID, $tiRemarks) {
        $query = "UPDATE transitems SET tiRemarks = ? WHERE tiID = ?";
        $this->db->query($query, array($tiRemarks, $tiID));
    }

    function add_return_items($rID, $ti, $accountID, $action) {
        $query = "INSERT INTO return_items (riID, rID, riStatus, returnReference) values (NULL, ?,?,?)";
        for($in = 0; $in < count($ti) ; $in++){
                $this->db->query($query, array($rID, $ti[$in]['riStatus'], $ti[$in]['receipt']));
                $this->add_transitems($this->db->insert_id(), $ti[$in]['tiQty'], $ti[$in]['tiActualQty'], $ti[$in]['tiActual'],
                $ti[$in]['tiSubtotal'], $ti[$in]['tiRemarks'], $ti[$in]['tiDate'], $ti[$in]['stID'], $ti[$in]['spmID'], 
                $accountID, $action);
            }
        } 

    function add_transitems($riID, $tiQty, $tiActualQty, $tiActual, $tiSubtotal, $tiRemarks, $tiDate, $stID, $spmID, $accountID, $action) {
        $qty = "SELECT stQty FROM stockitems WHERE stID = ?";
        $remainingQty = intval($this->db->query($qty, $stID)->row()->stQty) - intval($tiActual); 

        $query = "INSERT INTO transitems (tiID, tiType, tiQty, tiActual, tiSubtotal, remainingQty, tiRemarks, 
        tiDate, stID, spmID, riID) VALUES (NULL, ?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($query, array('return', $tiQty, $tiActualQty, $tiSubtotal, $remainingQty, $tiRemarks,
        $tiDate, $stID, $spmID, $riID));

        $this->update_stock($stID, $remainingQty);
        $this->add_actlog($accountID, date("Y-m-d H:i:s"), "Admin ".$action."ed a stockitem return.", $action, $tiRemarks);

        } 

        function deleteStockspoil($tID){
            $query ="Update transactions set isArchived = ? where tID = ?";
            return $this->db->query($query, array('1', $tID));
        }

    function add_menuaddon($mID, $ao){
        $query = "INSERT into menuaddons (mID, aoID) values (?,?)";
        $this->db->query($query, array($mID, $ao['aoID']));
    }

    function update_stockitemqty($stID, $updateQty) {
        $this->db->select('stQty');
        $this->db->from('stockitems');
        $this->db->where('stID', $stID);
        $stQty = $this->db->get()->row()->stQty;

        $query = "UPDATE stockitems SET stQty = (? + ?) WHERE stID = ?";
        $this->db->query($query, array(intval($stQty), intval($updateQty), $stID));
   
        echo $stQty;
        echo $updateQty;
    }

    function add_menucategory($ctName){
        $query = "Insert into categories (ctName, ctType) values (?,'menu')";
        return $this->db->query($query,array($ctName));
    }
    function add_submenucategory($ctName, $supcatID){
        $query = "Insert into categories (ctName, supcatID, ctType) values (?,?,'menu')";
        return $this->db->query($query,array($ctName,$supcatID));
    }
    function add_stockcategory($ctName){
        $query = "Insert into categories (ctName,ctType) values (?,'inventory')";
        return $this->db->query($query,array($ctName));
    }
    function add_substockcategory($ctName, $supcatID){
        $query = "Insert into categories (ctName, supcatID, ctType) values (?,?,'inventory')";
        return $this->db->query($query,array($ctName,$supcatID));
    }
    function add_addon($aoName, $aoPrice, $aoCategory, $aoStatus){
        $query = "INSERT into addons (aoName, aoPrice, aoCategory, aoStatus) values (?,?,?,?)";
        return $this->db->query($query,array($aoName, $aoPrice, $aoCategory, $aoStatus));
    }
    function add_menuStock($items){
        $query = "INSERT INTO prefstock(prID, stID, prstQty)
        VALUES(?, ?, ?)";
        foreach($items as $item){
            $this->db->query($query, array($item['prID'],$item['stID'],$item['prstQty']));
        }
        return true;
    }
    function add_uom($uomName, $uomAbbreviation, $uomVariant, $uomStore){
        $query = "INSERT into uom (uomName, uomAbbreviation, uomVariant, uomStore) values (?,?,?,?)";
        return $this->db->query($query,array($uomName, $uomAbbreviation, $uomVariant, $uomStore));
    }
    function getTransItems($stID){
        $query = "SELECT * FROM `transactions` left JOIN trans_items USING (tID) inner JOIN transitems using (tiID) where $stID = ?";
        return $this->db->query($query,array($stID))->result_array();
    }
    function getLastNum(){
        $query = "SELECT MAX(tNum) AS lastnum FROM transactions WHERE tType = 'spoilage'";
        return $result = $this->db->query($query)->result();
        
    }
    function addEdit_transactionItem($item, $id, $type){
    if(!isset($item['tiID'])){
        $query = "INSERT INTO `transitems`(
                tiID,
                uomID,
                stID,
                tiName,
                tiPrice,
                tiDiscount,
                rStatus
            )
            VALUES(NULL, ?, ?, ?, ?, ?, ?);";
        $this->db->query($query, array($item['uomID'],$item['stID'],$item['tiName'],$item['tiPrice'], 0, $item['rStatus']));
        return $this->db->insert_id();
    }else{
        $query = "UPDATE transitems 
            SET 
                uomID = ?,
                stID = ?,
                tiName = ?,
                tiPrice = ?,
                tiDiscount = ?,
                rStatus = ?
            WHERE
                tiID = ?;";
        return $this->db->query($query,array($item['uomID'],$item['stID'],$item['tiName'],$item['tiPrice'], 0,$item['rStatus'],$item['tiID']));
    }
}
function addEdit_trans_item($tiID, $tID, $tiQty, $qtyPerItem, $actualQty){
    $result = $this->db->query('SELECT
                tiID,
                tID,
                tiQty,
                qtyPerItem,
                actualQty,
                tiID
            FROM
                trans_items
            LEFT JOIN transitems USING(tiID)
            WHERE
                tiID = ? AND tID = ?;', array($tiID, $tID));
    echo json_encode($result->result_array());
    if($result->num_rows() === 1){
        $result = $result->result_array();
        return $this->db->query('UPDATE trans_items
            SET tiQty = ?, tiSubtotal = ?, actualQty = ?
            WHERE tiID = ? and tID = ?', array($tiQty, $tiSubtotal, $actualQty, $tiID, $tID));
    }else{
        return $this->db->query("INSERT INTO trans_items (
            tiID,
            tID,
            tiQty,
            tiSubtotal,
            actualQty
        )
        VALUES(?, ?, ?, ?, ?);", array($tiID, $tID, $tiQty, $tiSubtotal, $actualQty));
    }
}
function add_stockItem($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBqty, $stockLocation,$stockSize){
    $query = "INSERT INTO `stockitems`(
            `stID`,
            `ctID`,
            `uomID`,
            `stName`,
            `stQty`,
            `stMin`,
            `stType`,
            `stStatus`,
            `stBqty`,
            `stLocation`,
            `stSize`
        )
        VALUES(
            NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        );";
    if($this->db->query($query,array($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBqty, $stockLocation,$stockSize))){
        if($this->add_stockLog($this->db->insert_id(), NULL, 'beginning', date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $stockQty, $stockQty, "New item")){
            return true;
        }
    }
    return false;
}
function add_table($tableCode){
    $query = "INSERT INTO TABLES(tableCode)
    VALUES(?);";
    return $this->db->query($query, array($tableCode));
}

//UPDATE FUNCTIONS----------------------------------------------------------------
function add_stocktransitems($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID){
    $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`) VALUES (NULL,?,?,?,?,?,?,?)";
    return $this->db->query($query, array($tiType,$actualQtyUpdate,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID));
}
function edit_table($newTableCode, $previousTableCode){
    $query = "Update tables set tableCode = ? where tableCode = ?;";
    return $this->db->query($query, array($newTableCode, $previousTableCode));
}
function update_stockQty($stID, $stQty){
    $query = "UPDATE stockitems
    SET
        stQty = stQty + ?
    WHERE
        stID = ?";
    return $this->db->query($query, array($stQty, $stID));
}
function set_stockQty($stID, $stQty){
    $query = "UPDATE stockitems
    SET
        stQty = ?
    WHERE
        stID = ?";
    return $this->db->query($query, array($stQty, $stID));
}
function edit_stockItem($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID){
    $query = "UPDATE
        stockitems
    SET
        ctID = ?,
        stLocation = ?,
        stMin = ?,
        stName = ?,
        stStatus = ?,
        stType = ?,
        uomID = ?,
        stSize = ?
    WHERE
        stID = ?;";
    if($this->db->query($query,array($stockCategory, $stockLocation, $stockMin, $stockName, $stockStatus, $stockType, $stockUom, $stockSize, $stockID))){
        return true;
    }
    return false;
}
    function edit_uom($uomName, $uomAbbreviation, $uomVariant, $uomStore, $uomID){
        $query = "UPDATE uom SET uomName = ?, uomAbbreviation = ?, uomVariant = ?, uomStore = ? WHERE uomID = ?";
        return $this->db->query($query,array($uomName, $uomAbbreviation, $uomVariant, $uomStore, $uomID));
    }
    function edit_menu($mName, $mDesc, $mCat, $mAvailability, $preference, $addon, $mID){
        $query = "UPDATE menu SET mName = ?, mDesc = ?, ctID = ?, mAvailability = ? WHERE mID = ? ";
        if($this->db->query($query, array($mName, $mDesc, $mCat, $mAvailability, $mID))){
            if(count($preference) > 0){
                foreach($preference as $pref){
                    if($pref['del'] === 0) {
                        $this->delete_preference($pref);
                    }
                    else if($pref['prID'] == NULL){
                        $this->add_preference($mID, $pref);
                    }else{
                        $this->edit_preference($pref);
                    }
                }
            }

            if(count($addon) > 0){
                foreach($addon as $ao){
                    if($ao['del'] === 0) {
                        $this->delete_menuaddon($mID, $ao);
                    }
                    else if($ao['oldaoID'] === 0){
                        $this->add_menuaddon($mID, $ao);
                    }else{
                        $this->edit_menuaddon($ao, $mID);
                    }
                }
            }
            return true;
        }
        return false;
    }
    function edit_preference($pref){
        $query = "UPDATE preferences SET prName = ?, mTemp = ?,	prPrice = ?, prStatus = ? where prID = ?";
        $this->db->query($query,array($pref['prName'],$pref['mTemp'],$pref['prPrice'],$pref['prStatus'], $pref['prID']));
    }

    function edit_menuaddon($ao, $mID){
        $query = "UPDATE menuaddons SET aoID = ? WHERE menuaddons.mID = ? AND menuaddons.aoID = ?";
        $this->db->query($query,array($ao['aoID'],$mID, $ao['oldaoID']));
    }
    function edit_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch, $spID){
        $query = "UPDATE supplier 
            SET 
                spName = ?,
                spContactNum = ?,
                spEmail = ?,
                spStatus = ?,
                spAddress = ?
            WHERE
                spID = ?;";
        if($this->db->query($query, array($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spID))){
            if(count($spMerch) > 0){
                foreach($spMerch as $merch){
                if($merch['del'] === 0){
                    $this->delete_supplierMerchandise($merch);
                }else if($merch['spmID'] == NULL){
                        $this->add_supplierMerchandise($merch, $spID);
                    }else{
                        $this->edit_supplierMerchandise($merch);
                    }
                }
            }
            return true;
        }
        return false;
    }
    function edit_supplierMerchandise($merch){
        $query = "UPDATE suppliermerchandise 
            SET 
                stID = ?,
                uomID = ?,
                spmName = ?,
                spmActualQty = ?,
                spmPrice = ?
            WHERE
                spmID = ?;";
        $this->db->query($query,array($merch['stID'],$merch['merchUnit'],$merch['merchName'],$merch['merchActualQty'],$merch['merchPrice'], $merch['spmID']));
    }
    function edit_addon($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID){
        $query = "UPDATE addons set aoName = ?, aoPrice = ?, aoCategory = ?, aoStatus = ? where aoID = ?";
        return $this->db->query($query,array($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID));
    }
    function edit_category($ctName, $ctStatus, $ctID){
        $query = "UPDATE categories SET ctName = ?, ctStatus = ? where ctID = ?";
        return $this->db->query($query,array($ctName, $ctStatus, $ctID));
    }
//DELETE FUNCTIONS----------------------------------------------------------------
     function delete_salesOrderitem($olID, $stID, $stQty) {
        $query = "DELETE FROM orderlists WHERE orderlists.olID = ?";
        if($stID !== null) {
            $this->update_stock($stID, $stQty);
        }
        return $this->db->query($query, array($olID));
    }
    function delete_salesAddons($aoID, $olID) {
        $query = "DELETE FROM orderaddons WHERE orderaddons.aoID = ? AND orderaddons.olID = ?";
        return $this->db->query($query, array($aoID, $olID));
    }
    function delete_preference($pref){
        $query = "DELETE FROM preferences WHERE prID = ?";
        return $this->db->query($query, array($pref['prID']));
    }
    function delete_menuaddon($mID, $ao){
        $query = "DELETE FROM menuaddons WHERE menuaddons.mID = ? AND menuaddons.aoID = ?";
        return $this->db->query($query, array($mID, $ao['oldaoID']));
    }
    function delete_supplierMerchandise($merch){
        $query = "DELETE FROM suppliermerchandise WHERE spmID = ?";
        return $this->db->query($query, array($merch['spmID']));
    }
    function delete_supplier($id){
        $query = "UPDATE supplier SET spStatus = 'archived' WHERE spID = ?";
        return $this->db->query($query, array($id));
    }
    function delete_account($accountId){
        $query = "Delete from accounts where aID = ?";
        return $this->db->query($query, array($accountId));
    }
    function delete_category($id){
        $query = "UPDATE categories set ctStatus = 'archived' where ctID = ?";
        return $this->db->query($query, array($id));
    }
    function delete_addon($id){
        $query = "UPDATE addons set aoStatus = 'archived' where aoID = ?"; 
        return $this->db->query($query, array($id));
    }
    function delete_uom($id){
        $query = "DELETE FROM uom where uomID = ?"; 
        return $this->db->query($query, array($id));
    }
    function delete_menu($id){
        $query = "UPDATE menu set mAvailability = 'archived' where mID = ?"; 
        return $this->db->query($query, array($id));
    }
    function delete_spoilages($ssID, $delRemarks){
        $query ="Delete from stockspoil where ssID = ?";
        return $this->db->query(query, array($ssID));
    }
    function delete_stockitem($stID){
        $query = "Delete from stockitems where stID=?;";
        return $this->db->query($query, array($stID));
    }
    function add_accounts($data){
        $this->db->insert('accounts',$data);
    }
    //----ADD STOCK SPOIL-----------------
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
        $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`siID`) VALUES (NULL,?,?,?,?,?,?,?)";
        if(count($stocks) > 0){
            for($in = 0; $in < count($stocks) ; $in++){
                $this->db->query($query,array("spoilage",$stocks[$in]['actualQty'],$stocks[$in]['curQty']-$stocks[$in]['actualQty'],$stocks[$in]['tRemarks'],$date,$stocks[$in]['stID'],$siID));
                $this->destockvarItems($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
                $this->add_actlog($account_id,$date_recorded, "$user added a stock spoilage.", "add", $stocks[$in]['remarks']);
            }
        }
    }
    //---END ADD STOCK SPOIL-----------------
    //---add ADDONS SPOIL-----------------
    function add_aospoil($date_recorded,$date,$remarks,$addons,$account_id,$user){
        $query = "insert into aospoil (aosID,aosDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledaddon($this->db->insert_id(),$addons,$date_recorded,$date,$account_id,$user,$remarks);
            return true;
        }
    }
    function add_spoiledaddon($aosID,$addons,$date_recorded,$date,$account_id,$user,$remarks){
        $query = "INSERT INTO `addonspoil`(`aoID`, `aosID`, `osID`, `aosQty`, `aosDate`, `aosRemarks`) VALUES (?,?,?,?,?,?)";
        if(count($addons) > 0){
            for($in = 0; $in < count($addons) ; $in++){
                $this->db->query($query, array($addons[$in]['aoID'],$aosID, $addons[$in]['osID'], $addons[$in]['aosQty'],$date,$addons[$in]['tRemarks']));
                $this->add_actlog($account_id,$date_recorded, "$user added an addon spoilage.", "add", $remarks);
                
            }    
        }
    }
    
    //end ADD ADDONS SPOIL-----------------
    function add_menuspoil($date_recorded,$menu,$account_id){
        $query = "insert into menuspoil (msID,msDateRecorded) values (NULL,?)";
        if($this->db->query($query,array($date_recorded))){ 
            $this->add_spoiledmenu($this->db->insert_id(),$menu,$date_recorded,$account_id);
            return true;
        }
    }
    function add_spoiledmenu($msID,$menus,$date_recorded,$account_id){
        $query = "insert into spoiledmenu (msID,prID,msQty,msDate,msRemarks) values (?,?,?,?,?)";
        if(count($menus) > 0){
            for($in = 0; $in < count($menus)-1 ; $in++){
                $this->db->query($query, array($msID, $menus[$in]['prID'], $menus[$in]['msQty'],$menus[$in]['msDate'],$menus[$in]['msRemarks']));
                $this->add_actlog($account_id,$date_recorded, "Admin added a menu spoilage.", "add", $menus[$in]['msRemarks']);
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
    function get_inventory_consumption(){
        $query = "SELECT * FROM `transactions` LEFT JOIN trans_items USING (tID) left JOIN transitems using (tiID) WHERE tType = 'consumption'";
        return $this->db->query($query)->result_array();
    }
    
    function change_aPassword($new_password, $aID){
        $query = "Update accounts set aPassword = ?  where aID = ? ";
        return $this->db->query($query,array($new_password, $aID));  
           
    }
    function edit_accounts($aID,$aType,$aUsername){
        $query = "update accounts set aUsername = ?, aType = ? where aID = ?";
        return $this->db->query($query,array($aUsername, $aType, $aID));
    }
    function edit_menuspoilage($msID,$prID,$msQty,$msDate,$msRemarks,$date_recorded){
        $query = "Update menuspoil set msDateRecorded = ? where msID=?";
        if($this->db->query($query,array($date_recorded,$msID))){
            $query = "Update spoiledmenu set msQty = ?, msDate = ?,msRemarks = ? where msID = ? AND prID = ?";
            return $this->db->query($query,array($msQty,$msDate,$msRemarks,$msID,$prID));
        }else{
            return false;
        }
    }
    function update_stock($stID, $stQty) {
        $query = "UPDATE `stockitems` SET `stQty` = ? WHERE `stID` = ?;";
        $this->db->query($query, array($stQty, $stID));
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
    function get_accounts(){
        $query = "Select * from accounts";
        return $this->db->query($query)->result_array();
    }
    function get_spoilagesmenu(){
        $query = "Select msID,prID, mName,msQty,DATE_FORMAT(msDate, '%b %d, %Y') AS msDate,DATE_FORMAT(msDateRecorded, '%b %d, %Y %r') AS msDateRecorded,msRemarks from menuspoil inner join spoiledmenu using (msID) inner join preferences using (prID) inner join menu using (mID) order by msDateRecorded DESC";
        return  $this->db->query($query)->result_array();
    }
    // MODIFIED--------------------------------
    function get_spoilagesstock(){
        $query = "SELECT `tiID`,`tiType`,sum(`tiActual`) AS tiActual,`remainingQty`,`tiRemarks`,`tiDate`,`stID`,`siID`,`stName`, `stQty` FROM `transitems` inner join stockitems using (stID) inner join uom USING (uomID) WHERE tiType = 'spoilage' GROUP BY `siID`";
        return  $this->db->query($query)->result_array();
    }
    function get_spoilagesaddons(){
        $query = "Select aoID,aosID, aoName,aosQty, aoCategory,DATE_FORMAT(addonspoil.aosDate, '%b %d, %Y') AS aosDate, DATE_FORMAT(aosDateRecorded, '%b %d, %Y %r') AS aosDateRecorded, aosRemarks from addonspoil INNER JOIN aospoil using (aosID)INNER JOIN addons using (aoID) order by aosDateRecorded DESC";
        return  $this->db->query($query)->result_array();
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
    function add_beginningLog($log){
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
        VALUES(?, NULL, 'beginning', ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($query, array($log['stock'], $log['qty'], $log['remain'], $log['actual'], $log['discrepancy']
        , $log['dateTime'], $log['dateRecorded'], $log['remarks']));
    }
    function add_actlog($account_id, $alDate, $alDesc, $defaultType, $additionalRemarks){
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

    // function add_consumptionQty($conID,$con){
    //     $query = "INSERT INTO trans_items(tID, tiID, actualQty) VALUES(?, ?, ?)";
    //     return $this->db->query($query,array($conID, $con['id'], $con['qty']));
    // }
    // function edit_consumptionQty($conID, $con){
    //     $query = "UPDATE trans_items SET actualQty = ? WHERE tiID = ? AND tID = ?";
    //     return $this->db->query($query,array($con['qty'], $con['id'], $conID));
    // }
    
    // function get_consumedQty($conID, $itemID){
    //     $query = "SELECT actualQty AS qty FROM trans_items WHERE tID = ? AND tiID = ?;";
    //     return $this->db->query($query, array($conID, $itemID))->result_array();
    // }

    // function add_consumptionLog($id, $log){
    //     $query = "INSERT INTO stocklog(
    //             stID,
    //             tID,
    //             slType,
    //             slQty,
    //             slRemainingQty,
    //             slDateTime,
    //             dateRecorded,
    //             slRemarks
    //         )
    //         VALUES(?,?,?,?,?,?,?,?);";
    //     $this->db->query($query,array($log['stock'],$id, $log['type'], $log['qty'], 
    //         $log['remain'], $log['date'], $log['dateRecorded'], $log['remarks']));
    // }



    // ------ Sales Functions ------
   // ------ Sales Functions ------
   function add_salesOrder($tableCode, $custName, $osTotal, $osDateTime, $osPayDateTime, $osDateRecorded, $osDiscount, 
   $orderlists, $addons,  $account_id, $action) {
       $query = "insert into orderslips (osID, tableCode, custName, osTotal, payStatus, 
       osDateTime, osPayDateTime, osDateRecorded, osDiscount) values (NULL,?,?,?,?,?,?,?,?);";
       if($this->db->query($query,array($tableCode, $custName, $osTotal, 'paid', $osDateTime, $osPayDateTime, $osDateRecorded, $osDiscount))) {
           $this->add_salesList($this->db->insert_id(), $orderlists, $addons, $osDateTime, $account_id, $action);
           }
       }

   function add_salesList($osID, $orderlists, $addons, $osDateTime, $account_id, $action) {
       $query = "insert into orderlists (olID, prID, osID, olDesc, olQty, 
       olSubtotal, olStatus, olRemarks, olPrice, olDiscount) values (NULL,?,?,?,?,?,?,?,?,?);";
       if(count($orderlists) > 0){
            for($in = 0; $in < count($orderlists) ; $in++){
             if($this->db->query($query, array($orderlists[$in]['prID'], $osID, $orderlists[$in]['olDesc'], 
             $orderlists[$in]['olQty'], $orderlists[$in]['olSubtotal'],'served', ' ', $orderlists[$in]['olPrice'], 
             $orderlists[$in]['olDiscount']))) {
               $olID = $this->db->insert_id();
               if(count($addons) > 0) {
                   $this->update_salesaddons($olID, $orderlists[$in]['prID'], $addons);
               }
               if($orderlists[$in]['stID'] !== null) {
                   $this->update_stock($orderlists[$in]['stID'], $orderlists[$in]['stQty']);
                   $this->add_constsales($orderlists[$in]['stID'], $orderlists[$in]['deductQty'], $osDateTime,
                   $account_id, $action);
                   
               }
             }
       }
   }else {
       return false;
   }
   }

   function add_salesAddons($olID, $olprID, $addons) {
       $query = "INSERT INTO orderaddons (aoID, olID, aoQty, aoTotal) VALUES (?, ?, ?, ?);";
         for($in = 0; $in < count($addons); $in++){
           if($olprID == $addons[$in]['prID']) {
           $this->db->query($query, array($addons[$in]['aoID'], $olID, $addons[$in]['aoQty'], 
           $addons[$in]['aoTotal']));
           }
   }
}
function add_constsales($stID, $dQty, $cDate, $account_id, $action) {
   $cDateRecorded = date("Y-m-d H:i:s");
   $query = "INSERT INTO consumptions (cID, cDate, cDateRecorded) VALUES (NULL,?,?)";
   if($this->db->query($query, array($cDate, $cDateRecorded))) {
        $this->add_constransitems($this->db->insert_id(), $stID, $dQty, $cDate, $cDateRecorded,$account_id, $action);
   }
}

function add_constransitems($cID, $stID, $dQty, $cDate, $cDateRecorded, $account_id, $action) {
   $query = "INSERT INTO consumed_items (ciID, cID) VALUES (NULL,?)";
   if($this->db->query($query, array($cID))) {
       $this->add_constrans_items($this->db->insert_id(), $stID, $dQty, $cDateRecorded, $cDate, 
       $account_id, $action);
   }
}

function add_constrans_items($ciID, $stID, $dQty, $cDateRecorded, $cDate, $account_id, $action) {
   $qty = "SELECT stQty FROM stockitems WHERE stID = ?";
   $remainingQty = intval($this->db->query($qty, $stID)->row()->stQty);

   $query = "INSERT INTO transitems (tiID, tiType, tiQty, tiActual, remainingQty, tiDate, stID, ciID) VALUES (NULL,?,?,?,?,?,?,?)";
   if($this->db->query($query, array('consumed', $dQty, $dQty, $remainingQty, $cDate, $stID, $ciID))) {
       $this->add_actlog($account_id, $cDateRecorded, "Admin ".$action."ed a stockitem consumption.", $action, "Sales");
   }

   } 

//------------CONSUMPTIONS---------------------------
function add_consumption($date_recorded,$stocks,$account_id,$user,$date,$remarks) {
    $query = "INSERT INTO consumptions (cID, cDate, cDateRecorded) VALUES (NULL,?,?)";
    if($this->db->query($query, array($date, $date_recorded))) {
         $this->consumed_item($this->db->insert_id(), $stocks,$remarks,$date,$account_id,$date_recorded,$user);
    }
}

function consumed_item($cID, $stocks,$remarks,$date,$account_id,$date_recorded,$user) {
    $query = "INSERT INTO consumed_items (ciID, cID) VALUES (NULL,?)";
    if($this->db->query($query, array($cID))) {
        $this->add_constransitems($this->db->insert_id(),$stocks,$remarks,$date,$account_id,$date_recorded,$user);
    }
}

// function add_constransitems($ciID, $stocks,$remarks,$date,$account_id,$date_recorded,$user) {
//     $query = "INSERT INTO `transitems`(`tiID`, `tiType`, `tiActual`, `remainingQty`, `tiRemarks`, `tiDate`, `stID`,`ciID`) VALUES (NULL,?,?,?,?,?,?,?)";
//     if(count($stocks) > 0){
//         for($in = 0; $in < count($stocks) ; $in++){
//             $this->db->query($query,array("spoilage",$stocks[$in]['actualQty'],$stocks[$in]['curQty']-$stocks[$in]['actualQty'],$stocks[$in]['tRemarks'],$date,$stocks[$in]['stID'],$ciID));
//             $this->deduct_stockQty($stocks[$in]['stID'],$stocks[$in]['curQty'],$stocks[$in]['actualQty']);  
//             $this->add_actlog($account_id,$date_recorded, "$user added a consumption.", "add", $stocks[$in]['remarks']);
//         }
//     }
    

//  } 

    function deduct_stockQty($stID,$curQty, $actualQty){
        $query = "UPDATE stockitems SET stQty = ? - ? WHERE stID = ?;";
        $this->db->query($query,array($curQty, $actualQty, $stID));
    }
//--------------------------------------------------------------------
    function get_prefstock() {
        $query = "SELECT ol.osID, ol.olID, pr.prID, ps.stID, ps.prstQty, st.stQty FROM orderlists ol 
        INNER JOIN preferences pr USING (prID) LEFT JOIN prefstock ps USING (prID) 
        LEFT JOIN stockitems st USING (stID)";
        return $this->db->query($query)->result_array();
    }

    function edit_sales($osID, $tableCodes, $custName, $osTotal, $payStatus, $osDateTime, $osPayDateTime, 
    $osDateRecorded, $osDiscount, $orderlists, $addons, $account_id, $action) {
        $query = "UPDATE orderslips SET tableCode = ?, custName = ?, osTotal = ?, 
        osDateTime = ?, osPayDateTime = ?, osDiscount = ? WHERE orderslips.osID = ?;";
        if($this->db->query($query, array($tableCodes, $custName, $osTotal, $osDateTime, $osPayDateTime, $osDiscount, $osID))) {
            for($i = 0; $i < count($orderlists); $i++) {
                $orlist = array(
                    'olID' => $orderlists[$i]['olID'],
                    'prID' => $orderlists[$i]['prID'],
                    'stID' => $orderlists[$i]['stID'],
                    'stQty' => $orderlists[$i]['stQty'],
                    'osID' => $orderlists[$i]['osID'],
                    'olDesc' => $orderlists[$i]['olDesc'],
                    'olQty' => $orderlists[$i]['olQty'],
                    'olSubtotal' => $orderlists[$i]['olSubtotal'],
                    'olStatus' => $orderlists[$i]['olStatus'],
                    'olRemarks' => $orderlists[$i]['olRemarks'],
                    'olPrice' => $orderlists[$i]['olPrice'],
                    'olDiscount' => $orderlists[$i]['olDiscount'],
                    'tiActual' => $orderlists[$i]['tiActual'],
                    'update' => $orderlists[$i]['update']
                );

                if($orderlists[$i]['del'] === 0) {
                    $this->delete_salesOrderitem($orderlists[$i]['olID'], $orderlists[$i]['stID'],
                    $orderlists[$i]['stQty']);
                }
                else if($orderlists[$i]['olID'] != null) {
                    $this->edit_salesorders($orlist, $addons, $osDateTime,$account_id, $action);
                } else{
                    $orderlist = array();
                    array_push($orderlist, $orlist);
                    $this->add_salesList($osID, $orderlist, $addons);
                } 
            }   
        }
    }

    function edit_salesorders($orlist, $addons, $osDateTime, $account_id, $action) {
        $query = "UPDATE orderlists SET prID = ?, osID = ?, olDesc = ?, 
        olQty = ?, olSubtotal = ?, olPrice = ?, olDiscount = ? WHERE orderlists.olID = ?;";
        if($this->db->query($query, array($orlist['prID'], $orlist['osID'], $orlist['olDesc'], 
        $orlist['olQty'], $orlist['olSubtotal'],  $orlist['olPrice'],  $orlist['olDiscount'],  
        $orlist['olID'])))  {
            if($orlist['stID'] !== null) {
                $this->update_stock($orlist['stID'], $orlist['stQty']);
                $this->add_constsales($orlist['stID'], $orlist['tiActual'], $osDateTime,
                $account_id, $action);
            }
            if(count($addons) > 0) {
              $this->update_salesaddons($orlist['olID'], $orlist['prID'], $addons);
            }
        }
        
    }

    function update_salesaddons($olID, $prID, $addons) {
        for($i = 0; $i < count($addons); $i++) {
            if($addons[$i]['del'] === 0 ) {
                $this->delete_salesAddons($addons[$i]['aoID'], $addons[$i]['olID']);
            } else if($addons[$i]['olID'] === null){
                $addonsArr = array();
                $aolist = array(
                    'prID' => $addons[$i]['prID'],
                    'aoID' => $addons[$i]['aoID'],
                    'aoQty' => $addons[$i]['aoQty'],
                    'aoTotal' => $addons[$i]['aoTotal']
                );
                array_push($addonsArr, $aolist);
                $this->add_salesAddons($olID, $prID, $addonsArr);
            } else if(intval($addons[$i]['oldaoID']) != intval($addons[$i]['aoID'])) {
                $this->update_changedAddon($addons[$i]['aoID'], $addons[$i]['oldaoID'], $addons[$i]['olID']);
            } else if($addons[$i]['prID'] == $prID && $addons[$i]['olID'] != null) {
                $aolist = array(
                    'aoID' => $addons[$i]['aoID'],
                    'olID' => $addons[$i]['olID'],
                    'aoQty' => $addons[$i]['aoQty'],
                    'aoTotal' => $addons[$i]['aoTotal']
                );
                $this->edit_salesaddons($aolist);
            } 
        }
}

    function edit_salesaddons($addon) {
        $query = "UPDATE orderaddons SET aoQty = ?, aoTotal = ? WHERE orderaddons.aoID = ?
        AND orderaddons.olID = ?;";
        $this->db->query($query, array($addon['aoQty'], $addon['aoTotal'], $addon['aoID'], $addon['olID']));
    }

    function update_changedAddon($aoID, $oldaoID, $olID) {
        $query = "UPDATE orderaddons SET aoID = ? WHERE orderaddons.aoID = ? AND orderaddons.olID = ?;";
        $this->db->query($query, array($aoID, $oldaoID, $olID));
    }


    function edit_returns($rID, $rTotal, $rDate) {
        $query = "UPDATE returns SET rTotal = ?, rDate = ? WHERE rID = ?";
        $this->db->query($query, array($rTotal, $rDate, $rID));
    }

    function update_transitem($trans, $ti, $tID) {
        $query = "UPDATE transitems SET rStatus = ?, rRemarks = ? WHERE tiID = ?";
        if(count($trans) > 0) {
            for($in = 0; $in < count($trans) ; $in++){
               if( $this->db->query($query, array($trans[$in]['rStatus'], $ti[$in]['rRemark'], $trans[$in]['tiID'])))
               {
                   $this->update_trans_items($ti, $trans[$in]['tiID'], $tID, $trans[$in]['stID']);
               }
           }
        }
    }

    function update_trans_items($ti, $tiID, $tID, $stID) {
        $query = "UPDATE trans_items SET tiQty = ?, actualQty = ?, tiSubtotal = ? WHERE tiID = ? AND tID = ?";
        if(count($ti) > 0) {
            for($in = 0; $in < count($ti) ; $in++){
            if($ti[$in]['tiID'] === $tiID) {
                $this->db->query($query, array($ti[$in]['tiQty'], $ti[$in]['actualQty'], $ti[$in]['tiSubtotal'],
                $ti[$in]['tiID'], $tID));
                
                $this->update_stockitemqty($stID, $ti[$in]['updateQty']);
            }
           }
        }
    }
    function update_paymentStatus($tiID, $status){
        $this->db->query("UPDATE transitems SET payStatus = ? WHERE tiID = ?;",array($status, $tiID));
    }
    
    // Get Transactions (PO, DR, OR)
    // INSERT FUNCTIONS FOR PO, DR, OR, RETURN (NEW)
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
    function edit_receiptItemPayStatus($item){
        $query = "UPDATE
                transitems
            SET
                tiPrice = ?,
                tiDiscount = ?,
                drStatus = ?,
                payStatus = ?
            WHERE
                tiID = ?;";
        return $this->db->query($query, array($item['price'], $item['discount'], $item['delivery']
        , $item['payment'], $item['tiID']));
    }

    function add_receiptTransactionItemsQty($tID, $item){
        $query = "INSERT INTO trans_items(tID, tiID, tiQty, qtyPerItem, actualQty, tiSubtotal)
            VALUES(?, ?, ?, ?, ?, ?)";
        return $this->db->query($query, array($tID, $item['tiID'], $item['tiQty'], $item['perUnit'], $item['actual'], $item['subtotal']));
    }

    function checkIfExistingItemsQty($tID, $tiID){
        $query="SELECT tiID, tID
        FROM transactions
        WHERE tiID = ? AND tID = ?;";
        return $this->db->query($query, array($tiID, $tID))->num_rows();
    }
    function add_purchaseOrder($supplier, $date, $current, $type, $poitems){
        $query = "INSERT INTO purchases(spID, receiptNo, pType, pDate, pDateRecorded, spAltName) VALUES(?,NULL,?,?,?,NULL)";
        if($this->db->query($query,array($supplier, $type, $date, $current))){
            $pID = $this->db->insert_id();
            if(count($poitems) > 0){
                $this->add_pItem($pID, $poitems);
            }
        }
    }
    function edit_purchaseorder($date, $current, $pID){
        $query = "UPDATE purchases SET pDate = ?, pDateRecorded = ? where pID = ?";
        return $this->db->query($query,array($date, $current, $pID));
    }
    
    function edit_pItem($poitems){
        $query = "UPDATE purchase_items SET piStatus = ? WHERE piID = ?";
        for($in = 0; $in < count($poitems) ; $in++){
            $this->db->query($query, array($poitems[$in]['piStatus'], $poitems[$in]['piID']));
        }
    }

    function edit_potransitem($poitems){
        $query = "UPDATE transitems SET tiQty = ?, tiDate = ?, tiActual = ?, tiSubtotal = ? where tiID = ?";
        for($in = 0; $in < count($poitems); $in++){
            $this->db->query($query, array($poitems[$in]['tiQty'], $poitems[$in]['date'], $poitems[$in]['tiActual'], $poitems[$in]['tiSubtotal'], $poitems[$in]['tiID']));
        }
    }

    function add_reconciliation($re){
        $query = "INSERT INTO reconciliation (reDate, reDateRecorded) VALUES (?, ?)";
        return $this->db->query($query, array($re["date"], $re["current"]));
    }
    function add_reItems($rei){
        $query = "INSERT INTO st_recon (reID, stID, reQty, reRemain, reDiscrepancy, reRemarks) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->query($query,array($rei["reID"], $rei["stock"], $rei["qty"], $rei["remain"], $rei["discrepancy"], $rei["remarks"]));
    }
    function add_purchase($p){
        $query = "INSERT INTO `purchases`(
                spID,
                receiptNo
                pType,
                pDate,
                pDateRecorded,
                spAltName
            )
            VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            );";
        return $this->db->query($query, array($p["supplier"], $p["receipt"], 
        $p["type"], $p["date"], $p["current"], $p["alt"]));
    }

    function edit_purchase($p){
        $query = "UPDATE purchases SET receiptNo = ?, pDate = ?, pDateRecorded = ?, spAltName = ? WHERE pID = ?";
        return $this->db->query($query, array($p["receipt"], $p["date"], $p["current"], $p["alt"], $p["pID"]));
    }
    function add_pItem($pID, $poitems){
        $query = "INSERT INTO purchase_items (piStatus) VALUES(?)";
        for($in = 0; $in < count($poitems) ; $in++){
            $this->db->query($query, array($poitems[$in]['piStatus']));
            $piID = $this->db->insert_id();
            $this->add_purItem($pID, $piID);
            $this->add_potransitem($poitems[$in]["piType"], $poitems[$in]["tiQty"], $poitems[$in]["tiActual"], $poitems[$in]["tiSubtotal"], $poitems[$in]["date"], $poitems[$in]["stID"] ,$poitems[$in]["spmID"], $piID);
        }
    }

    function add_purItem($pID, $piID){
        $query = "INSERT INTO pur_items(pID, piID) VALUES(?,?)";
        return $this->db->query($query, array($pID, $piID));
    }
    
    function add_transitem($item){ 
        $query = "INSERT INTO `transitems`(
                tiID,
                tiType,
                tiQty,
                tiActual,
                tiSubtotal,
                remainingQty,
                tiRemarks,
                tiDate,
                stID,
                spmID,
                riID,
                piID,
                ciID,
                siID
            )
            VALUES(
                NULL,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            );";
        return $this->db->query($query,array($item["type"], $item["qty"], $item["actual"], $item["subtotal"], $item["remaining"], 
        $item["remarks"], $item["date"], $item["stock"] ,$item["merch"], $item["return"], $item["purchase"], $item["consume"], $item["spoil"]));
    }
    function add_potransitem($type, $qty, $actualQty, $subtotal, $date, $stID, $spmID, $piID){
        $query = "INSERT INTO transitems (tiType, tiQty, tiActual, tiSubtotal, remainingQty, tiRemarks, tiDate, stID, spmID, riID, piID, ciID, siID) 
                 VALUES(?, ?, ?, ?, NULL, NULL, ?, ?, ?, NULL, ?, NULL, NULL)";
        return $this->db->query($query,array($type, $qty, $actualQty, $subtotal, $date, $stID, $spmID, $piID));
    }

    // function add_consumption($c){
    //     $query = "INSERT INTO consumptions (cDate, cDateRecorded) VALUES (?,?)";
    //     return $this->db->query($query,array($c["date"], $c["current"]));
    // }
    // function add_consumptionItem($cID){
    //     $query = "INSERT INTO consumed_items (cID) VALUES (?)";
    //     return $this->db->query($query, array($cID));
    // }
    function get_purchaseOrders(){
        $query = "SELECT
            pID AS id,
            spID AS supplier,
            spName AS supplierName,
            pDate AS transDate,
            DATE_FORMAT(pDateRecorded, '%b %d, %Y %r') AS dateRecorded,
            SUM(tiSubtotal) AS total
        FROM
            (
                (
                    purchases
                LEFT JOIN pur_items USING(pID)
                )
            LEFT JOIN purchase_items USING(piID)
            )
        LEFT JOIN transitems USING(piID)
        LEFT JOIN supplier USING(spID)
        WHERE pType = 'purchase order'
        GROUP BY pID ORDER BY transDate DESC, pID DESC";
        return $this->db->query($query)->result_array();
    }
    
    function get_purchaseOrderItems(){
        $query = "SELECT
                tiID,
                tiType as type,
                SUM(tiQty) AS qty,
                SUM(tiActual) AS actual,
                SUM(tiSubtotal) AS subtotal,
                remainingQty,
                tiRemarks,
                tiDate,
                CONCAT(
                    stName,
                    IFNULL(CONCAT(' ', stSize),
                    '')
                ) AS stockname,
                spmName,
                spmPrice,
                spmActual,
                suppliermerchandise.uomID,
                uomAbbreviation,
                piID,
                pID,
                piStatus
            FROM
                (transitems
            LEFT JOIN purchase_items USING(piID))
            LEFT JOIN pur_items using (piID)
            LEFT JOIN stockitems USING(stID)
            LEFT JOIN suppliermerchandise USING(spmID)
            LEFT JOIN uom ON (suppliermerchandise.uomID = uom.uomID) GROUP BY piID";
        return $this->db->query($query)->result_array();
    }
    function get_deliveryReceipts(){
        $query = "SELECT
            pID AS id,
            receiptNo as receipt,
            spID AS supplier,
            spName AS supplierName,
            spAltName as altSupplier,
            DATE_FORMAT(pDate, '%b %d, %Y %r') AS transDate,
            DATE_FORMAT(pDateRecorded, '%b %d, %Y %r') AS dateRecorded,
            SUM(tiSubtotal) AS total
        FROM
            (
                purchases
            LEFT JOIN purchase_items USING(pID)
            )
        LEFT JOIN transitems USING(piID)
        LEFT JOIN supplier USING(spID)
        WHERE pType = 'delivery'
        ORDER BY transDate DESC ,pID DESC";
        return $this->db->query($query)->result_array();
    }
    function get_deliveryReceiptItems(){
        $query = "SELECT
                tiID,
                tiType as type,
                SUM(tiQty) AS qty,
                SUM(tiActual) AS actual,
                SUM(tiSubtotal) AS subtotal,
                remainingQty,
                tiRemarks,
                tiDate,
                CONCAT(
                    stName,
                    IFNULL(CONCAT(' ', stSize),
                    '')
                ) AS stockname,
                spmName,
                piID,
                piStatus
            FROM
                transitems
            LEFT JOIN purchase_items USING(piID)
            LEFT JOIN stockitems USING(stID)
            LEFT JOIN suppliermerchandise USING(spmID)
            WHERE piStatus in ('partially delivered','delivered')";
        return $this->db->query($query)->result_array();
    }

    function get_poItem($tiID){
        $query = "SELECT tiID, tiID, tType, tiQty, qtyPerItem, actualQty, drStatus
            FROM (transitems LEFT JOIN trans_items USING(tiID))
            LEFT JOIN transactions USING(tID)
            WHERE tType = 'purchase order' AND drStatus = 'pending' and tiID = ?;";
        return $this->db->query($query,array($tiID))->result_array();
    }
    function get_drItem($tiID){
        $query = "SELECT tiID, tiID, tType, tiQty, qtyPerItem, actualQty, drStatus
            FROM (transitems LEFT JOIN trans_items USING(tiID))
            LEFT JOIN transactions USING(tID)
            WHERE tType = 'delivery receipt' AND drStatus in ('complete','resolved') and tiID = ?;";
        return $this->db->query($query,array($tiID))->result_array();
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
    function get_drsBySupplier($id){
        $query = "SELECT
                tID AS transactionID,
                spID suppID,
                spName suppName,
                supplierName altName,
                tNum AS transNum,
                receiptNo AS receipt,
                tDate AS date,
                tTotal AS total,
                tRemarks AS remarks
            FROM
                (transactions
            LEFT JOIN supplier USING(spID)) right join (
                SELECT tID
                FROM ( transitems LEFT JOIN trans_items USING(tiID) )
                LEFT JOIN transactions USING(tID)
                WHERE tType = 'delivery receipt'
                GROUP BY tID
                HAVING count(if(drStatus ='PARTIAL', 1, NULL)) = 0)  as deliveries using (tID)
            where spID = ?";
        return $this->db->query($query, array($id))->result_array();
    }
    function get_drItemsBySupplier($id){
        $query = "SELECT 
            tID AS transactionID,
            tiID AS itemID,
            tiName AS NAME,
            tiPrice AS price,
            tiDiscount AS discount,
            transitems.uomID AS uom,
            uomAbbreviation AS unit,
            stID AS stock,
            CONCAT(stName,
                    IF(stSize IS NULL,
                        '',
                        CONCAT(' ', stSize))) AS stockname,
            tiQty AS qty,
            qtyPerItem AS equivalent,
            actualQty AS actual,
            tiSubtotal AS subtotal
        FROM
            ((transitems
            LEFT JOIN trans_items USING (tiID))
            RIGHT JOIN (SELECT 
                tID, spID
            FROM
                (transitems
            LEFT JOIN trans_items USING (tiID))
            LEFT JOIN transactions USING (tID)
            WHERE
                tType = 'delivery receipt'
            GROUP BY tID
            HAVING COUNT(IF(drStatus = 'PARTIAL', 1, NULL)) = 0) AS deliveries USING (tID))
                LEFT JOIN
            stockitems USING (stID)
                LEFT JOIN
            uom ON (transitems.uomID = uom.uomID)
        WHERE spID = 1";
        return $this->db->query($query, array($id))->result_array();
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

    function delete_transaction($tID) {
        $query ="UPDATE transactions SET isArchived = ? WHERE tID = ?";
        $this->db->query($query,array('1', $tID));
    }
    //getPosFor Brochure
    //     SELECT
    //     tID as transactionID,
    //     spID suppID,
    //     spName suppName,
    //     supplierName altName,
    //     tNum as transNum,
    //     receiptNo as receipt,
    //     tDate as date,
    //     tTotal as total,
    //     tRemarks as remarks
    // FROM
    //     transactions
    // LEFT JOIN supplier USING(spID)
    // WHERE
    //     tID IN(
    //     SELECT
    //         tID AS transactionID
    //     FROM
    //         (
    //             transitems
    //         LEFT JOIN trans_items USING(tiID)
    //         )
    //     LEFT JOIN transactions USING(tID)
    //     WHERE
    //         tType = "purchase order" AND drStatus = "pending"
    //     GROUP BY
    //         tID
    // )

    // getPoItemsForBrochure
    //     SELECT
    //     tID AS transactionID,
    //     tiID AS itemID,
    //     tiName AS NAME,
    //     tiPrice AS price,
    //     tiDiscount AS discount,
    //     uomID AS uom,
    //     stID AS stock,
    //     tiQty AS qty,
    //     qtyPerItem AS equivalent,
    //     tiSubtotal AS subtotal
    // FROM
    //     (
    //         transitems
    //     LEFT JOIN trans_items USING(tiID)
    //     )
    // LEFT JOIN transactions USING(tID)
    // WHERE
    //     tType = "purchase order" AND drStatus = "pending"

    //  Get Transactions (PO, DR, OR)
    // SELECT
    //     tID AS id,
    //     tNum AS num,
    //     receiptNo AS receipt,
    //     IF(
    //         spID IS NULL,
    //         supplierName,
    //         spName
    //     ) AS supplier,
    //     tType AS type,
    //     tTotal AS total,
    //     tRemarks AS remarks,
    //     tDate AS date,
    //     dateRecorded AS daterecorded
    // FROM
    //     transactions
    // LEFT JOIN supplier USING(spID)
    // WHERE
    //     isArchived = '0' and tType = 'purchase order';

    // get transaction (CONSUMED, SPOILAGE)
    //     SELECT
    //     tID AS id,
    //     tNum AS num,
    //     tType AS TYPE,
    //     tRemarks AS remarks,
    //     tDate AS DATE,
    //     dateRecorded AS daterecorded
    // FROM
    //     transactions
    // LEFT JOIN supplier USING(spID)
    // WHERE
    //     isArchived = '0' AND tType = 'consumed';

    // get transaction (RETURN)
    // SELECT
    //     tID AS id,
    //     tNum AS num,
    //     IF(
    //         spID IS NULL,
    //         supplierName,
    //         spName
    //     ) AS supplier,
    //     tType AS TYPE,
    //     tTotal AS total,
    //     tRemarks AS remarks,
    //     tDate AS DATE,
    //     dateRecorded AS daterecorded
    // FROM
    //     transactions
    // LEFT JOIN supplier USING(spID)
    // WHERE
    //     isArchived = '0' AND tType = 'return';

    //get transitems (PO, DR, OR, RETURN)
    // SELECT
    //     tID AS transaction,
    //     tiID AS id,
    //     tiName AS name,
    //     tiQty AS qty,
    //     qtyPerItem AS equivalent,
    //     actualQty AS actualqty,
    //     tiPrice AS price,
    //     tiDiscount AS discount,
    //     drStatus AS deliverystatus,
    //     payStatus AS paymentstatus,
    //     rStatus AS returnstatus
    // FROM
    //     (
    //         transitems
    //     LEFT JOIN trans_items USING(tiID)
    //     )
    // LEFT JOIN transactions USING(tID)
    // LEFT JOIN uom USING(uomID)
    // WHERE
    //     tType = 'purchase order'


    // get transitems (CONSUMED, SPOILAGE)
    // SELECT
    //     tID AS transaction,
    //     tiID AS id,
    //     actualQty AS actualqty
    // FROM
    //     (
    //         transitems
    //     LEFT JOIN trans_items USING(tiID)
    //     )
    // LEFT JOIN transactions USING(tID)
    // LEFT JOIN uom USING(uomID)
    // WHERE
    //     tType = 'consumed';

    //get last number or last transaction of type (Plus 1 to the value returned -> ilalagay as tNum sa transactions table)
    // SELECT
    //     MAX(tNum) AS lastnum
    // FROM
    //     transactions
    // WHERE
    //     tType = 'purchase order'

    // Add transaction (PO, DR, OR)
    // INSERT INTO transactions(
    //     tID, spID, supplierName, tNum, receiptNo, tDate, dateRecorded, tTYpe, tTotal, tRemarks, isArchived
    // )
    // VALUES(
    //     NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    // )

    // insert transitem (PO, DR, OR, RETURN)
    // INSERT INTO transitems(
    //     tiID,
    //     uomID,
    //     stID,
    //     tiName,
    //     tiPrice,
    //     tiDiscount,
    //     drStatus,
    //     paystatus,
    //     rStatus
    // )
    // VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)

    // insert trans_item (PO, DR, OR, RETURN)
    // INSERT INTO trans_items(
    //     tID,
    //     tiID,
    //     tiQty,
    //     qtyPerItem,
    //     actualQty,
    //     tiSubtotal
    // )
    // VALUES(?, ?, ?, ?, ?, ?)

    // Update transaction (PO, DR, OR)
    // UPDATE transactions
    // SET supplierName = ?, receiptNo = ?, tDate = ?, dateRecorded = ?, tTotal = ?, tRemarks = ?
    // WHERE tID = ?

    //Update transaitem
    //     UPDATE
    //     transitems
    // SET
    //     tiPrice = ?,
    //     tiDiscount = ?,
    //     drStatus = ?,
    //     payStatus = ?,
    //     rStatus = ?
    // WHERE
    //     tiID = ?;

    //update trans_item
    //     UPDATE
    //     trans_items
    // SET
    //     tiQty = ?,
    //     tiSubtotal = ?,
    //     actualQty = ?
    // WHERE
    //     tiID = ? AND tID = ?;

    // Insert transaction (RETURN)
    // INSERT INTO transactions(
    //     tID, tNum, tDate, dateRecorded, tType, tRemarks, tTotal
    // )
    // VALUES(NULL, ?, ?, ?, ?, ?, ?)

    // insert transaction (CONSUMED, SPOILAGE)
    // INSERT INTO transactions(
    //     tID, tNum, tDate, dateRecorded, tType, tRemarks
    // )
    // VALUES(NULL, ?, ?, ?, ?, ?)

    // insert transitem (CONSUMED, SPOILAGE)
    // INSERT INTO transitems(
    //     tiID,
    //     stID
    // )
    // VALUES(NULL, ?)

    // insert trans_item (CONSUMED, SPOILAGE)
    // INSERT INTO trans_items(
    //     tID,
    //     tiID,
    //     actualQty
    // )
    // VALUES(?, ?, ?)

    // Update Transaction (CONSUMPTION, SPOILAGE)
    // UPDATE transactions
    // SET tDate = ?, dateRecorded = ?, tRemarks = ?
    // WHERE tID = ?;

    // Update Transaction (RETURN)
    // UPDATE transactions
    // SET tDate = ?, dateRecorded = ?, tRemarks = ?, tTotal = ?
    // WHERE tID = ?;
    
    // get prefstock
    // SELECT
    //     prID AS menuitem,
    //     CONCAT(mName, 
    //         IF(prName IS NULL, '', CONCAT(' ', prName,)),
    //         IF(mTemp IS NULL, '', CONCAT(' ',
    //                 IF(mTemp = 'hc', '',
    //                     IF(mTemp = 'h', 'Hot', 'Cold')
    //                 )
    //             )
    //         )
    //     ) AS prefname,
    //     stID AS stockitem,
        // CONCAT(stName,
        //     IF(stSize IS NULL, '', CONCAT(' ', stSize))
        // ) AS stockitemname,
    //     prstQty AS qty
    // FROM
    //     prefstock
    // LEFT JOIN(
    //         preferences
    //     LEFT JOIN menu USING(MID)
    //     ) USING(prID)
    // LEFT JOIN stockitems USING(stID)

    // Insert prefstock
    // INSERT INTO prefstock(prID, stID, prstQty)
    // VALUES(?, ?, ?)

    // Update prefstock
    // UPDATE prefstock set prstQty = ?
    // WHERE prID = ? AND stID = ?

    //Delete prefStock
    // DELETE FROM prefstock
    // WHERE prID = ? AND stID = ?

// SELECT
//     tiID,
//     tiType,
//     SUM(tiQty) AS qty,
//     SUM(tiActual) AS actual,
//     SUM(tiSubtotal) AS subtotal,
//     remainingQty,
//     tiRemarks,
//     tiDate,
//     CONCAT(
//         stName,
//         IFNULL(CONCAT(' ', stSize),
//         '')
//     ) AS stockname,
//     spmName,
//     piID,
//     piStatus
// FROM
//     transitems
// LEFT JOIN purchase_items USING(piID)
// LEFT JOIN stockitems USING(stID)
// LEFT JOIN suppliermerchandise USING(spmID)

// INSERT INTO `purchases`(
//     spID,
//     pType,
//     pDate,
//     pDateRecorded
// )
// VALUES(
//     ?,
//     ?,
//     ?,
//     ?
// );
 }
?>