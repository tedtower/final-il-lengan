<?php
class Adminview extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }
    function checkIfLoggedIn(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            return true;
        }
        return false;
    }
//VIEW FUNCTIONS--------------------------------------------------------------------------------

function viewDashboard(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Dashboard";
        $data['sales'] = $this->adminmodel->getOSMonthByYear(date('Y'));
        $data['todaySales'] = $this->adminmodel->getTodaySales();
        $data['kitchen'] = $this->adminmodel->getUnavailableKitchen();
        $data['stockroom'] = $this->adminmodel->getUnavailableStockRoom();
        $data['topmenu'] = $this->adminmodel->getTopTenMenu();
        $data['monthConsumption'] = $this->adminmodel->getMonthConsumption();
        $this->load->view('admin/templates/head',$data);
        $this->load->view('admin/templates/sideNav');            
        $this->load->view('admin/adminDashboard');
        $this->load->view('admin/templates/scripts');
        $this->load->view('admin/templates/charts');
    }else{
        redirect('login');
    }
}
function viewInventory($error = null){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Admin Stock Items";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $data['inventory'] = array(
            "stocks" => $this->adminmodel->get_stocks(),
            "categories" => $this->adminmodel->get_stockSubCategories()
        );
        $data['category'] = $this->adminmodel->get_stockcategories();
        $this->load->view('admin/adminInventory',$data);
    }else{
        redirect('login');
    }
}

function performPhysicalCount($error = null){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Admin Physical Count";
        $this->load->view('admin/templates/head2', $data);
        $this->load->view('admin/templates/sideNav');
        $data['stocks'] = $this->adminmodel->get_stocks();
        $this->load->view('admin/physicalCount',$data);
    }else{
        redirect('login');
    }
}

//---functions for viewing the different ADD and EDIT pages in the transaction
function viewPOFormAdd(){
    if($this->checkIfLoggedIn()){
        $head['title'] = "Inventory - Add PO";
        $this->load->view('admin/templates/head2', $head);
        $this->load->view('admin/templates/sideNav');
        $data['uom'] = $this->adminmodel->get_uomForStoring();
        $data['stock'] = $this->adminmodel->get_stockitems();
        $data['supplier'] = $this->adminmodel->get_supplier();
        $data['suppmerch'] = $this->adminmodel->get_supplierstocks();
        $this->load->view('admin/purchaseOrderAdd', $data);
    }else{
        redirect('login');
    }
}
function viewReturn(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Returns";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminReturns');
    }else{
        redirect('login');
    }
}

function viewReturnFormAdd(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Inventory - Add Return";
        $this->load->view('admin/templates/head2', $head);
        $this->load->view('admin/templates/sideNav');
        $data['deliveries'] = $this->adminmodel->get_deliveries();
        $data['supplier'] = $this->adminmodel->get_supplier();
        $this->load->view('admin/returnsAdd', $data);
    }else{
        redirect('login');
    }
}
function viewReturnFormEdit($id){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Inventory - Edit Return";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $data = array(
            'id' => $id,
            'returns' => $this->adminmodel->get_returns(),
            'returnitems' => $this->adminmodel->get_returnItems(),
            'supplier' => $this->adminmodel->get_supplier()
            // 'suppmerch' => $this->adminmodel->get_stocktransitems()
        );
        $this->load->view('admin/returnsEdit', $data);
    }else{
        redirect('login');
    }
}
function viewPOFormEdit(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Inventory - Edit PO";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/purchaseOrderEdit');
    }else{
        redirect('login');
    }
}
function viewDRFormAdd(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Inventory - Add Delivery";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $data['stocks'] = $this->adminmodel->get_stockitems();
        $data['supplier'] = $this->adminmodel->get_supplier();
        $this->load->view('admin/deliveryReceiptAdd', $data);
    }else{
        redirect('login');
    }
}

function viewDRFormEdit($id){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        if(is_numeric($id)){
            $head['title'] = "Inventory - Edit Delivery";
            $this->load->view('admin/templates/head', $head);
            $this->load->view('admin/templates/sideNav');
            $data['dr'] = $this->adminmodel->get_receiptTransaction($id);
            $data['stocks'] = $this->adminmodel->get_stocks();
            $this->load->view('admin/deliveryReceiptEdit',$data);
        }else{
            redirect('admin/deliveryreceipt');
        }
    }else{
        redirect('login');
    }
}
function getCardValuesForDR(){
    if($this->checkIfLoggedIn()){
        $id = $this->input->post('id');
        $supplier = $this->input->post('supplier');
        if(is_numeric($id) && is_numeric($supplier)){
            echo json_encode(array(
                "merchandise" => $this->adminmodel->get_SPMs($supplier),
                "pos" => $this->adminmodel->get_posBySupplier($supplier),
                "poItems" => $this->adminmodel->get_poItemsBySupplier($supplier),
                "drItems" => $this->adminmodel->get_receiptTransactionItems($id),
                'uom' => $this->adminmodel->get_uomForStoring()
            ));
        }else{
            echo json_encode(array(
                "inputErr" => true
            ));
        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}
// function viewORFormAdd(){
//     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
//         $head['title'] = "Inventory - Add OR";
//         $this->load->view('admin/templates/head', $head);
//         $this->load->view('admin/templates/sideNav');
//         $data['supplier'] = $this->adminmodel->get_supplier();
//         $data['stocks'] = $this->adminmodel->get_stockItemNames();
//         $this->load->view('admin/officialReceiptAdd',$data);
//     }else{
//         redirect('login');
//     }
// }

// function viewORFormEdit(){
//     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
//         $head['title'] = "Inventory - Edit OR";
//         $this->load->view('admin/templates/head', $head);
//         $this->load->view('admin/templates/sideNav');
//         $data['supplier'] = $this->adminmodel->get_supplier();
//         $data['stocks'] = $this->adminmodel->get_stockItemNames();
//         $this->load->view('admin/officialReceiptEdit');
//     }else{
//         redirect('login');
//     }
// }
function viewConsumptionFormAdd(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Inventory - Add Consumption";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $data['stocks'] = $this->adminmodel->get_stocks();
        $this->load->view('admin/consumptionAdd', $data);
    }else{
        redirect('login');
    }
}
//-------------end-----------------------
function viewStockCard($stID){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Admin - Stock Card";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $data['logs'] = $this->adminmodel->get_stockLog($stID);
        $data['stock'] = $this->adminmodel->get_stockItem($stID)[0];
        $data['currentInv'] = $this->adminmodel->get_invPeriodStart($stID)[0];
        $this->load->view('admin/stockcard', $data);
    }else{
        redirect('login');
    }
}
function viewStockCardHistory(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $head['title'] = "Admin - Stock Card";
        $this->load->view('admin/templates/head', $head);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/stockcardHistory');
    }else{
        redirect('login');
    }
}
function viewTables(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Tables";
        // $data['table'] = $this->adminmodel->get_tables();
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminTables');
    }else{
        redirect('login');
    }
}

function getEnumValsForStock(){
    if($this->checkIfLoggedIn()){
        preg_match_all("/\w+\'?\w+?(?=')/",$this->adminmodel->get_enumVals('stockitems','stType')[0]['column_type'], $stTypes);
        preg_match_all("/\w+\'?\w+?(?=')/",$this->adminmodel->get_enumVals('stockitems','stLocation')[0]['column_type'],$stLocations);
        preg_match_all("/\w+\'?\w+?(?=')/",$this->adminmodel->get_enumVals('stockitems','stStatus')[0]['column_type'],$stStatuses);
        // preg_match_all("/\w+\'?\w+?(?=')/",$this->adminmodel->get_enumVals('uom','uomVariant')[0]['column_type'],$uomVariants);
        // preg_match_all("/\w+\'?\w+?(?=')/",$this->adminmodel->get_enumVals('uom','uomStore')[0]['column_type'],$uomStores);
        echo json_encode(array(
            "stTypes" => $stTypes[0],
            "stLocations" => $stLocations[0],
            "stStatuses" => $stStatuses[0],
            "uomVariants" => $this->adminmodel->get_uomForSizes(),
            "uomStores" => $this->adminmodel->get_uomForStoring(),
            "categories" => $this->adminmodel->get_stockSubCategories()
        ));
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}


function viewTransactions(){
    if($this->checkIfLoggedIn()){
        $head['title'] = "Admin Transactions";
        $this->load->view('admin/templates/head',$head);
        $this->load->view('admin/templates/sideNav');
        $data['transactions'] = $this->adminmodel->get_transactions();
        $data['transitems'] = $this->adminmodel->get_transitems();
        $this->load->view('admin/adminTransactionsAll',$data);
    }else{
        redirect('login');
    }
}

function getEnumValsForTransaction(){
    if($this->checkIfLoggedIn()){
        preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->adminmodel->get_enumVals('transactions','tType')[0]['column_type'], $tTypes);
        preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->adminmodel->get_enumVals('transitems','tiStatus')[0]['column_type'], $tiStatuses);
        echo json_encode(array(
            "tTypes" => $tTypes[0],
            "tiStatuses" => $tiStatuses[0],
            "suppliers" => $this->adminmodel->get_supplierNames(),
            "uoms" => $this->adminmodel->get_uomForStoring(),
            "stocks" => $this->adminmodel->get_stockItemNames()
        ));
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}
function getTransaction(){
    if($this->checkIfLoggedIn()){
        $id = $this->input->post('id');
        if(is_numeric($id)){
            echo json_encode(array(
                "transaction" => $this->adminmodel->get_transaction($id),
                "transitems" => $this->adminmodel->get_transitems($id)
            ));
        }else{
            echo json_encode(array(
                "inputErr" => true
            ));
        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}

function getDRs(){
    if($this->checkIfLoggedIn()){
        $spID = $this->input->post('supplier');
        if(is_numeric($spID)){
            echo json_encode(array(
                "transactions" => $this->adminmodel->get_transactionsBySupplier($spID, array("delivery receipt")),
                "transitems" =>  $this->adminmodel->get_transitemsBySupplier($spID, array("delivery receipt"))
            ));
        }else{
            echo json_encode(array(
                "inputErr" => true
            ));
        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}

function getPOs(){
    if($this->checkIfLoggedIn()){
        $spID = $this->input->post('supplier');
        if(is_numeric($spID)){
            echo json_encode(array(
                "transactions" => $this->adminmodel->get_transactionsBySupplier($spID, array("purchase order")),
                "transitems" =>  $this->adminmodel->get_transitemsBySupplier($spID, array("purchase order"))
            ));
        }else{
            echo json_encode(array(
                "inputErr" => true
            ));
        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}

function getSPMs(){
    if($this->checkIfLoggedIn()){
        $spID = $this->input->post('supplier');
        if(is_numeric($spID)){
            echo json_encode(array(
                "merchandise" => $this->adminmodel->get_SPMs($spID)
            ));
        }else{
            echo json_encode(array(
                "inputErr" => true
            ));
        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}
//end of Tatum's Code

function viewSales(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Sales";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $data['mnaddons'] = $this->adminmodel->get_mnAddons();
        $data['discounts'] = $this->adminmodel->get_menudiscounts();
        // $data['sales'] = $this->adminmodel->get_sales();
        $this->load->view('admin/adminSales', $data);
    }else{
        redirect('login');
    }
}

function getTables(){
    if($this->checkIfLoggedIn()){
        echo json_encode($this->adminmodel->get_tables());
    }else{
        redirect('login');
    }
}

function viewPromos() {
    if($this->checkIfLoggedIn()){
        $data['title'] = "Promos";
        $this->load->view('admin/templates/head',$data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/templates/scripts');
        $this->load->view('admin/templates/footer');
        $this->load->view('admin/adminPromo');
    }else{
        redirect('login');
    }
}

function jsonPromos() {
    $promo = array(
        "promos" => $this->adminmodel->get_promos(),
        "discounts" => $this->adminmodel->get_discounts(),
        "freebies" => $this->adminmodel->get_freebies()
    );

    header('Content-Type: application/json');
    echo json_encode($promo, JSON_PRETTY_PRINT);
    
}

function jsonMenu() {
    $data = $this->adminmodel->get_menu_items();
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function jsonSales() {
    $data = array();
    $data['orderslips'] = $this->adminmodel->get_osSales();
    $data['orderlists'] = $this->adminmodel->get_olSales();
    $data['stocks'] = $this->adminmodel->get_prefstock();
    $data['menuitems'] = $this->adminmodel->get_menuPref();
    $data['addons'] = $this->adminmodel->get_orderAddon();
    $data['tables'] = $this->adminmodel->get_tables();
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function jsonPrefDetails() {
    $prID = $this->input->post('prID');
    $data = $this->adminmodel->get_prefDetails($prID);

    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function jsonSuppliers() {
    $data =  $this->adminmodel->get_supplier();
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function jsonMenuAddons() {
    $mID = $this->input->post('mID');
    $data = $this->adminmodel->get_menuaddons($mID);

    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
//end of Jessa's Code

function viewAccountsJs(){
    if($this->checkIfLoggedIn()){
        echo json_encode($this->adminmodel->get_accounts());
    }else{
        redirect('login');
    }
}
function viewAccounts(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Admin Accounts";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/viewaccounts', $data);
    }else{
        redirect('login');
    }   
}
function viewStockJS() {
    $data=$this->adminmodel->get_stocks();
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
function viewMenuJS() {
    $data=$this->adminmodel->get_menuPref();
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
function viewAddonJS(){
    if($this->checkIfLoggedIn()){
        $data=$this->adminmodel->get_spoilagesaddons();
        echo json_encode($data);
    }
}
function viewSpoilagesAddonAdd(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Spoilages - Addons";
        $this->load->view('admin/templates/head2', $data);
        $this->load->view('admin/templates/sideNav');
        $data['addons'] = $this->adminmodel->get_addons();
        $this->load->view('admin/adminspoilagesaddonsAdd', $data);
    }else{
        redirect('login');
    }
}
function viewSpoilagesStockJs(){
if($this->checkIfLoggedIn()){
    $data= $this->adminmodel->get_spoilagesstock();
    echo json_encode($data);
    
}else{
    redirect('login');
}
}
function viewSpoilagesStockAdd(){
if($this->checkIfLoggedIn()){
    $data['title'] = "Spoilages - Stock";
    $this->load->view('admin/templates/head2', $data);
    $this->load->view('admin/templates/sideNav');
    $data['stocks'] = $this->adminmodel->get_stocks();
    $this->load->view('admin/adminspoilagesstockAdd', $data);
}else{
    redirect('login');
}
}
function viewSpoilagesStock(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Spoilages - Stock";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminspoilagesstock');
    }else{
        redirect('login');
    }
    }

function viewSpoilagesMenuJs(){
    if($this->checkIfLoggedIn()){
        $data= $this->adminmodel->get_spoilagesmenu();
        echo json_encode($data);
        
    }else{
        redirect('login');
    }
}
function viewSpoilagesMenu(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Spoilages - Menu";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminspoilagesmenu');
        $this->load->view('admin/templates/footer');
        // $this->load->view('admin/templates/scripts');
    }else{
        redirect('login');
    }
}
function viewSpoilagesAddonsJs(){
    if($this->checkIfLoggedIn()){
        $data= $this->adminmodel->get_spoilagesaddons();
        echo json_encode($data);
        
    }else{
        redirect('login');
    }
}
function viewSpoilagesAddons(){
    if($this->checkIfLoggedIn()){
        $data['title'] = "Spoilages - Addons";
        $this->load->view('admin/templates/head', $data);
        $this->load->view('admin/templates/sideNav');
        $this->load->view('admin/adminspoilagesaddons');
        $this->load->view('admin/templates/footer');
        // $this->load->view('admin/templates/scripts');
    }else{
        redirect('login');
    }
}
function getStockItem(){
    if($this->checkIfLoggedIn()){
        echo json_encode(array(
            "stock" => $this->adminmodel->get_stockItem($this->input->post('id'))[0],
            "uomVariants" => $this->adminmodel->get_uomForSizes()
        ));
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}
//end of rox's code


//     function viewAccountsJs(){
//         if($this->checkIfLoggedIn()){
//             echo json_encode($this->adminmodel->get_accounts());
//         }else{
//             redirect('login');
//         }
//     }
//     function viewAccounts(){
//         if($this->checkIfLoggedIn()){
//             $data['title'] = "Admin Accounts";
//             $this->load->view('admin/templates/head', $data);
//             $this->load->view('admin/templates/sideNav');
//             $this->load->view('admin/viewaccounts', $data);
//         }else{
//             redirect('login');
//         }   
//     }



    function getInventoryList(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $head['title'] = "Admin - Inventory List";
            $this->load->view('admin/templates/head', $head);
            $data['stockitems'] = $this->adminmodel->getInventoryList();
            $data['categories'] = $this->adminmodel->get_stockCategories();
            $this->load->view('admin/reportInventoryList',$data);
        }else{
            redirect('login');
        }
    }
    function viewSupplier(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data['title'] = "Sources";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');

            $data['supplier'] = array(
                'sources' => $this->adminmodel->get_supplier(),
                'merchandises' => $this->adminmodel->get_suppliermerch(),
                'stocks' => $this->adminmodel->get_stocks(),
                'uom' => $this->adminmodel->get_uom()
            );
            $this->load->view('admin/adminSources', $data);
            // $this->load->view('admin/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewLogs(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Admin Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['log'] = $this->adminmodel->get_logs();
            $this->load->view('admin/adminLogs',$data);
            $this->load->view('admin/templates/scripts');            
            $this->load->view('admin/templates/footer');
        }else{
            redirect('login');
        }
    }
    function viewMenu(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['addons'] = $this->adminmodel->get_addons();
            $data['category'] = $this->adminmodel->get_menucategories();
            // $data['menuitem'] = array(
            //     'menus' => $this->adminmodel->get_menu(),
            //     'preferences' => $this->adminmodel->get_peferences(),
            //     'addons' => $this->adminmodel->get_addons2()
            // );
            $this->load->view('admin/menuitems',$data);
        }else{
            redirect('login');
        }
    }
    function menuStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $head['title'] = "Menu - Stock";
            $this->load->view('admin/templates/head',$head);
            $this->load->view('admin/templates/sideNav');
            $data['menuStock'] = $this->adminmodel->get_prefStocks();
            $this->load->view('admin/menu-stock', $data);
        }else{
            redirect('login');
        }
    }
    function getMenuStockModalData(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            echo json_encode(array(
                "preferences" => $this->adminmodel->get_prefNames(),
                "stocks" => $this->adminmodel->get_stockItemNames()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function menuGetDetails(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $data = array(
                'menu' => $this->adminmodel->get_menu(),
                'preferences' => $this->adminmodel->get_preferences(),
                'addons' => $this->adminmodel->get_addons2(),
                'categories' => $this->adminmodel->get_menucategories()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    function menuAddons(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Addons";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['addon'] = $this->adminmodel->get_addons();
            $this->load->view('admin/addons', $data);
        }else{
            redirect('login');
        }
    }
    function menuPromos(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Promos";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminPromo');
        }else{
            redirect('login');
        }
    }
    function viewMenuCategories(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Menu - Categories";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['category'] = $this->adminmodel->get_menucategories();
            $data['maincategory'] = $this->adminmodel->get_maincat();
            $this->load->view('admin/menucategories',$data);
        }else{
            redirect('login');
        }
    }

    function viewUOM(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Inventory - Measurements";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['measurement'] = $this->adminmodel->get_uom();
            $this->load->view('admin/UOM',$data);
        }else{
            redirect('login');
        }
    }
    
    function viewPurchaseOrder(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Purchase Order";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['pos'] = $this->adminmodel->get_purchaseOrders();
            $data['poitems'] = $this->adminmodel->get_purchaseOrderItems();
            $this->load->view('admin/adminPurchaseOrder', $data);
        }else{
            redirect('login');
        }
    }
    function viewDeliveryReceipt(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Delivery Receipt";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['drs'] = $this->adminmodel->get_deliveryReceipts();
            $data['drItems'] = $this->adminmodel->get_deliveryReceiptItems();
            $this->load->view('admin/adminDeliveryReceipt', $data);
        }else{
            redirect('login');
        }
    }

    function viewOfficialReceipt(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Official Receipt";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $data['ors'] = $this->adminmodel->get_officialReceipts();
            $data['orItems'] = $this->adminmodel->get_officialReceiptItems();
            $this->load->view('admin/adminOfficialReceipt', $data);
        }else{
            redirect('login');
        }
    }

    function jsonPO() {
        if($this->checkIfLoggedIn()){
            $data = array(
                'stock' => $this->adminmodel->get_stockitems(),
                'supplier' => $this->adminmodel->get_supplier(),
                'suppmerch' => $this->adminmodel->get_supplierstocks(),
                'uom' => $this->adminmodel->get_uomForStoring()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    
    function jsonReturns() {
        if($this->checkIfLoggedIn()){
            $data = array(
                'returns' => $this->adminmodel->get_returns(),
                'returnitems' => $this->adminmodel->get_returnItems(),
                'supplier' => $this->adminmodel->get_supplier()
                // 'suppmerch' => $this->adminmodel->get_stocktransitems()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    function jsonConsumptions() {
        if($this->checkIfLoggedIn()){
            $data = array(
                'consumption' => $this->adminmodel->get_consumptions(),
                'consitems' => $this->adminmodel->get_consumpitems()
            );
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }else{
            redirect('login');
        }
    }
    function viewConsumptions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Consumption";
            $this->load->view('admin/templates/head', $data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/adminConsumption');
        }else{
            redirect('login');
        }
    }
    function viewActivityLog() {
        if($this->checkIfLoggedIn()){
            $data['title'] = "Activity Logs";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $this->load->view('admin/activityLogs');
		    
        }else {
            redirect('login');
        }
    }

    function viewStockCategories(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Inventory - Categories";
            $this->load->view('admin/templates/head',$data);
            $this->load->view('admin/templates/sideNav');
            $data['category'] = $this->adminmodel->get_stockcategories();
            $data['maincategory'] = $this->adminmodel->get_maincatStock();
            $this->load->view('admin/inventorycategories',$data);
        }else{
            redirect('login');
        }
    }
    function getStocksForBeginningBrochure(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                "stocks" => $this->adminmodel->get_stocksForBeginningBrochure()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getPOItemsForBrochure(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                'stock' => $this->adminmodel->get_stockitems(),
                'supplier' => $this->adminmodel->get_supplier(),
                'suppmerch' => $this->adminmodel->get_supplierstocks(),
                'uom' => $this->adminmodel->get_uomForStoring(),
                "pos" => $this->adminmodel->get_posForBrochure(),
                "poItems" => $this->adminmodel->get_poItemsForBrochure()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getPOItemsBySupplier(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->get_post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "inputErr" => false,
                    'uom' => $this->adminmodel->get_uomForStoring(),
                    "pos" => $this->adminmodel->get_posBySupplier($id),
                    "poItems" => $this->adminmodel->get_poItemsBySupplier($id)
                ));
            }else{
                echo json_encode(array(
                    "inputErr" => true
                ));
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getDRItemsBySupplier(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "inputErr" => false,
                    'uom' => $this->adminmodel->get_uomForStoring(),
                    "drs" => $this->adminmodel->get_drsBySupplier($id),
                    "drItems" => $this->adminmodel->get_drItemsBySupplier($id)
                ));
            }else{
                echo json_encode(array(
                    "inputErr" => true
                ));
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getUOMs(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                'uom' => $this->adminmodel->get_uomForStoring()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getTransitemsFormValues(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                'stock' => $this->adminmodel->get_stockitems(),
                'suppmerch' => $this->adminmodel->get_supplierstocks(),
                "uom" => $this->adminmodel->get_uomForStoring()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
    function getSuppMerchForBrochure(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "merchandise" => $this->adminmodel->get_SPMs($id),
                    "uom" => $this->adminmodel->get_uomForStoring()
                ));
            }else{
                echo json_encode(array(
                    "inputErr" => true
                ));
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function getReceiptTransactionItems($id){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "items" => $this->adminmodel->get_receiptTransactionItems($id)
                ));
            }else{
                echo json_encode(array(
                    "inputErr" => true
                ));
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }



//     // function viewTransactions(){
//     //     if($this->checkIfLoggedIn()){
//     //         $data['title'] = "Transactions";
//     //         // $this->load->view('admin/templates/head');
//     //         // $this->load->view('admin/templates/sideNav');
//     //         $data['transactions'] = array(
//     //             "transaction" => $this->adminmodel->get_transactions(),
//     //             "transitem" => $this->adminmodel->get_transitems(),
//     //             "sources" => $this->adminmodel->get_sources()
//     //         );
//     //         $this->load->view('admin/adminAllTransactions',$data);
//     //         // $this->load->view('admin/templates/scripts');
//     //     }else{
//     //         redirect('login');
//     //     }
//     // }
//     function viewDeliveryTransactions(){
//         if($this->checkIfLoggedIn()){
//             $data['title'] = "Transactios - Deliveries";
//             $this->load->view('admin/templates/head', $data);
//             $this->load->view('admin/templates/sideNav');
//             $data['deliveries'] = $this->adminmodel->get_deliveryTransactions();
//             $data['items'] = $this->adminmodel->get_deliveryTransactionsItems();
//             $this->load->view('admin/adminTransactionsDeliveries',$data);
//         }else{
//             redirect('login');
//         }
//     }
//     function viewPurchaseTransactions(){
//         if($this->checkIfLoggedIn()){
//             $data['title'] = "Transactions - Purchases";
//             $this->load->view('admin/templates/head', $data);
//             $this->load->view('admin/templates/sideNav');
//             $data['purchases'] = $this->adminmodel->get_purchaseTransactions();
//             $data['items'] = $this->adminmodel->get_purchaseTransactionsItems();
//             $this->load->view('admin/adminTransactionsPurchases',$data);
            
//         }else{
//             redirect('login');
//         }
//     }
//     function viewReturnTransactions(){
//         if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
//             $data['title'] = "Transactions - Returns";
//             $this->load->view('admin/templates/head', $data);
//             $this->load->view('admin/templates/sideNav');
//             $data = array(
//                 'invRet' => $this->adminmodel->get_invRetVar(),
//                 'retItems' => $this->adminmodel->get_returns(),

//             );
//             $this->load->view('admin/adminTransactionsReturns',$data);
//         }else{
//             redirect('login');
//         }
//     }
//     function getReturns(){
//         if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
//             $item = $this->input->post('id');
//             $data = array(
//                 'invoice' => $this->adminmodel->get_invoiceReturns(),
//                 'returns' => $this->adminmodel->get_returns(),
//                 'invoiceitems' => $this->adminmodel->get_poD(),
//                 'invoSup' => $this->adminmodel->get_allInvoice(),
//                 'selected' => $this->adminmodel->get_item($item)
//             );
//             header('Content-Type: application/json');
//             echo json_encode($data, JSON_PRETTY_PRINT);

//         }else{
//             redirect('login');
//         }
//     }





//     function jsonLogStock() {
//         if($this->checkIfLoggedIn()){
//             $data = $this->adminmodel->get_logs();

//             header('Content-Type: application/json');
// 		    echo json_encode($data, JSON_PRETTY_PRINT);
//         }else {
//             redirect('login');
//         }  

//     }
//     function jsonStock() {
//         if($this->checkIfLoggedIn()){
//             $data = array();
//             $data['restock'] = $this->adminmodel->get_restock();
//             $data['destock'] = $this->adminmodel->get_transactions();
//             header('Content-Type: application/json');
// 		    echo json_encode($data, JSON_PRETTY_PRINT);
//         }else {
//             redirect('login');
//         }  


//     }

//     function viewLogStock() {
//         if($this->checkIfLoggedIn()){
//             $data['title'] = "Stock Logs";
//             $this->load->view('admin/templates/head',$data);
//             $this->load->view('admin/templates/sideNav');
//             $this->load->view('admin/stocklog');
		    
//         }else {
//             redirect('login');
//         }

//     }

//     // function jsonActivityLogs() {
//     //     if($this->checkIfLoggedIn()){
//     //         $data = $this->adminmodel->get_actlogs();
//     //         header('Content-Type: application/json');
// 	// 	    echo json_encode($data, JSON_PRETTY_PRINT);
//     //     }else {
//     //         redirect('login');
//     //     }  

//     // }


//     function viewConsumptions(){
//         if($this->checkIfLoggedIn()){
//             $data['title'] = "Stock Consumption";
//             $data['consumptions'] = $this->adminmodel->get_consumption();
//             $data['conitems'] = $this->adminmodel->get_consumptionItems();
//             $data['variance'] = $this->adminmodel->get_poItemVariance();
//             $this->load->view('admin/templates/head',$data);
//             $this->load->view('admin/templates/sideNav');
//             $this->load->view('admin/adminDestock');
//         }else{
//             redirect('login');
//         }
//     }



//     function jsonPurchaseOrders() {
//         $data = array();
//         $data['purOrders'] = $this->adminmodel->get_purchOrders();
//         $data['poItems'] = $this->adminmodel->get_poItemVariance();
//         $data['suppliers'] = $this->adminmodel->get_supplier();
//         $data['supplierMerch'] = $this->adminmodel->get_suppliermerch();

//         header('Content-Type: application/json');
//         echo json_encode($data, JSON_PRETTY_PRINT);
//     }
    

//     function getPurchaseOrders(){
//         if($this->checkIfLoggedIn()){
//             $id = $this->input->post('id');
//             $data = array(
//                 "po" => $this->adminmodel->get_purchaseOrders($id),
//                 "poItems" => $this->adminmodel->get_poItems($id)
//             );
//             echo json_encode($data);
//         }else{
//             redirect('login');
//         }
//     }

//     function jsonSuppMerchandise() {
//         $spmID = $this->input->post('spmID');
//         $data = $this->adminmodel->get_suppMerchandise($spmID);
//         header('Content-Type: application/json');
//         echo json_encode($data, JSON_PRETTY_PRINT);
//     }




//     function getStockItem(){
//         if($this->checkIfLoggedIn()){
//             echo json_encode(array(
//                 "stock" => $this->adminmodel->get_stockItem($this->input->post('id'))[0],
//                 "uomVariants" => $this->adminmodel->get_uomForSizes()
//             ));
//         }else{
//             echo json_encode(array(
//                 "sessErr" => true
//             ));
//         }
//     }

//     function viewTransactions(){
//         if($this->checkIfLoggedIn()){
//             $head['title'] = "Admin Transactions";
//             $this->load->view('admin/templates/head',$head);
//             $this->load->view('admin/templates/sideNav');
//             $data['transactions'] = $this->adminmodel->get_transactions();
//             $data['transitems'] = $this->adminmodel->get_transitems();
//             $this->load->view('admin/adminTransactionsAll',$data);
//         }else{
//             redirect('login');
//         }
//     }

//     function getEnumValsForTransaction(){
//         if($this->checkIfLoggedIn()){
//             preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->adminmodel->get_enumVals('transactions','tType')[0]['column_type'], $tTypes);
//             preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->adminmodel->get_enumVals('transitems','tiStatus')[0]['column_type'], $tiStatuses);
//             echo json_encode(array(
//                 "tTypes" => $tTypes[0],
//                 "tiStatuses" => $tiStatuses[0],
//                 "suppliers" => $this->adminmodel->get_supplierNames(),
//                 "uoms" => $this->adminmodel->get_uomForStoring(),
//                 "stocks" => $this->adminmodel->get_stockItemNames()
//             ));
//         }else{
//             echo json_encode(array(
//                 "sessErr" => true
//             ));
//         }
//     }


}
?>