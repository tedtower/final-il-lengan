<?php
class Adminadd extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }


function addTable(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.tableCode]');
        if($this->form_validation->run()){
            $tableCode = trim($this->input->post('tableCode'));
            if($this->adminmodel->add_table($tableCode)){
                $this->output->set_output(json_encode($this->adminmodel->get_tables()));
            }else{
                redirect('admin/tables');
            }
        }else{
            redirect("admin/tables");
        }
    }else{
        redirect('login');
    }        
}

function addStockItem(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $this->form_validation->set_rules('name','Stock Name','trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('type','Stock Type','trim|required|alpha');
        $this->form_validation->set_rules('category','Stock Category','trim|required|alpha_numeric');
        $this->form_validation->set_rules('status','Stock Status','trim|required|alpha');
        
        if($this->form_validation->run() == FALSE){
            redirect("admin/dashboard");
        }else{
            $stockCategory = $this->input->post('category');
            $stockLocation = $this->input->post('storage');
            $stockMin = $this->input->post('min');
            $stockName = $this->input->post('name');
            $stockQty = $this->input->post('qty');
            $stockBty = $this->input->post('qty');
            $stockStatus = $this->input->post('status');
            $stockType = $this->input->post('type');
            $stockUom = $this->input->post('uom');
            $stockSize = $this->input->post('size');
            $stockID = $this->input->post('id');
            $dbErr = false;
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            if($stockID == null){
                if(!$this->adminmodel->add_stockItem($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, $stockBty, $stockLocation, $stockSize)){
                    $dbErr = true;
                }
            }else{                 
                if(!$this->adminmodel->edit_stockItem($stockCategory, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID)){
                    $dbErr = true;
                }
            }
            if($dbErr){
                echo json_encode(array(
                    "dbErr" => true 
                ));
            }else{
                echo json_encode(array(
                    "stocks" => $this->adminmodel->get_stocks(),
                    "categories" => $this->adminmodel->get_stockSubCategories()
                ));
            }
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a new stock item: $stockName .", "add", NULL);

        }
    }else{
        echo json_encode(array(
            "sessErr" => true
        ));
    }
}

function addSales() {
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $tableCode = trim($this->input->post('tableCode'));
        $custName = trim($this->input->post('custName'));
        $osTotal = trim($this->input->post('osTotal'));
        $osDateTime = trim($this->input->post('osDateTime'));
        $osPayDateTime = trim($this->input->post('osPayDateTime'));
        $osDate = trim($this->input->post('osDate'));
        $osPayDate = trim($this->input->post('osPayDate'));
        $osDiscount = trim($this->input->post('osDiscount'));
        $orderlists = json_decode($this->input->post('orderlists'), true);
        $osDateRecorded = date("Y-m-d H:i:s");
        $addons = json_decode($this->input->post('addons'), true);
        $account_id = $_SESSION["user_id"];
        $action = 'add';

        header('Content-Type: application/json');
        echo json_encode($addons, JSON_PRETTY_PRINT);
        $this->adminmodel->add_salesOrder($tableCode, $custName, $osTotal, $osDateTime,
        $osPayDateTime, $osDateRecorded, $osDiscount, $orderlists, $addons, $account_id, $action);

    }else{
        redirect('login');
    }
}

function addPromo() {
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $pmName = $this->input->post('pmName');
        $pmStartDate = $this->input->post('pmStartDate');
        $pmEndDate = $this->input->post('pmEndDate');
        $freebie = $this->input->post('freebie');
        $discount = $this->input->post('discount');
        $status = $this->input->post('status');
        $pc = json_decode($this->input->post('pc'), true);
        $fb = json_decode($this->input->post('fb'), true);
        $dc = json_decode($this->input->post('dc'), true);
        $mfb = json_decode($this->input->post('mfb'), true);
        $mdc = json_decode($this->input->post('mdc'), true);

        $this->adminmodel->add_promo($pmName, $pmStartDate, $pmEndDate, $freebie,
        $discount, $status, $pc, $fb, $dc, $mfb, $mdc);
    } else {
        redirect('login');
    }

}

function addspoilagesaddons(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $date_recorded = date("Y-m-d H:i:s");
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $addons = json_decode($this->input->post('items'), true);
        $account_id = $_SESSION["user_id"];
        $user= $_SESSION["user_name"];
        $this->adminmodel->add_aospoil($date_recorded,$date,$remarks,$addons,$account_id,$user);
       
    }else{
        redirect('login');
    }
}
function addMenuSpoilage(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $date_recorded = date("Y-m-d H:i:s");
        $date = $this->input->post('date');
        $menus = json_decode($this->input->post('menus'), true);
        $account_id = $_SESSION["user_id"];
        $tiType = "spoilage";

        echo json_encode($menus, true);
        $this->adminmodel->add_menuspoil($date, $date_recorded,$account_id, $menus, $tiType);
    }else{
        redirect('login');
    }
}
function addspoilagesstock(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $date_recorded = date("Y-m-d H:i:s");
        $stocks = json_decode($this->input->post('items'), true);
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $account_id = $_SESSION["user_id"];
        $user= $_SESSION["user_name"];

        $this->adminmodel->add_stockspoil($date_recorded,$stocks,$account_id,$user,$date,$remarks);
    }else{
    redirect('login');
    }
}
function addaccounts(){
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[50]');
        // $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[5]|max_length[50]|matches[password]');
        $this->form_validation->set_rules('aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('aType','Account Type','trim|required');

            //$password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
            $password = $this->input->post("password");
            $username = $this->input->post("aUsername");
            $aType = $this->input->post("aType");
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $data = array(
                'aPassword'=>$password,
                'aUsername'=>$username,
                'aType'=>$aType
            );
            $this->adminmodel->add_accounts($data);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user added a new account: $username .", "add", NULL);

            redirect('admin/accounts');
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_menucategory($ctName);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a menu main category: $ctName .", "add", NULL);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addUOM(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $uomName = trim($this->input->post('uomName'));
            $uomAbbreviation = trim($this->input->post('uomAbbreviation'));
            $uomVariant = trim($this->input->post('uomVariant'));
            $uomStore = trim($this->input->post('uomStore'));
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_uom($uomName, $uomAbbreviation, $uomVariant, $uomStore);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a unit of measurement: $uomName .", "add", NULL);
            redirect('admin/measurements');
        }else{
            redirect('login');
        }
    }

    function addInventoryReport(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $stID = $this->input->post('stID');
            $id = $this->input->post('stID');
            $sDate = $this->input->post('sDate');
            $eDate = $this->input->post('eDate');
            $this->adminmodel->get_inventoryReport($stID, $sDate, $eDate);
            $this->adminmodel->get_stockItem($id);
            $data['report'] = $this->adminmodel->get_inventoryReport($stID, $sDate, $eDate);
            $data['stock'] = $this->adminmodel->get_stockItem($id)[0];
            $this->load->view('admin/reportInventory', $data);
            // redirect('admin/stocklog/report');
        }else{
            redirect('login');
        }
    }
    function addSalesReport(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $sDate = $this->input->post('sDate');
            $eDate = $this->input->post('eDate');
            $this->adminmodel->get_salesReport($sDate, $eDate);
            $this->adminmodel->get_totalSales($sDate, $eDate);
            $data['total'] = $this->adminmodel->get_totalSales($sDate, $eDate);
            $data['report'] = $this->adminmodel->get_salesReport($sDate, $eDate);
            $data['addons'] = $this->adminmodel->get_orderAddon();
            $this->load->view('admin/reportSales', $data);
            // redirect('admin/stocklog/report');
        }else{
            redirect('login');
        }
    }

    function addSubMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $supcatID = trim($this->input->post('subcatID'));
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_submenucategory($ctName, $supcatID);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a menu subcategory: $ctName .", "add", NULL);
            
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = $this->input->post('ctName');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_stockcategory($ctName);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a stock category: $ctName .", "add", NULL);

            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }
    // function addSubStockCategory(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
    //         $ctName = trim($this->input->post('ctName'));
    //         $supcatID = trim($this->input->post('subcatID'));
    //         $this->adminmodel->add_SubStockCategory($ctName, $supcatID);
    //         redirect('admin/stockcategories');
    //     }else{
    //         redirect('login');
    //     }
    // }


    function addAddon(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoName = $this->input->post('aoName');
            $aoPrice = $this->input->post('aoPrice');
            $aoCategory = $this->input->post('aoCategory');
            $aoStatus = $this->input->post('aoStatus');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_addon($aoName, $aoPrice, $aoCategory, $aoStatus);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a new addon: $aoName .", "add", NULL);

            redirect('admin/menu/addons');
        }else{
            redirect('login');
        }
    }
    
    function addSupplierMerchandise(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spName = $this->input->post('name');
            $spContactNum = $this->input->post('contactNum');
            $spEmail= $this->input->post('email');
            $spStatus = $this->input->post('status');
            $spAddress = $this->input->post('address');
            $spMerch = json_decode($this->input->post('merchandises'),true);
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            if($this->adminmodel->add_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch)){
                echo json_encode(array(
                    'sources' => $this->adminmodel->get_supplier(),
                    'merchandises' => $this->adminmodel->get_suppliermerch(),
                    'stocks' => $this->adminmodel->get_stocks(),
                    'uom' => $this->adminmodel->get_uom()
                ));
            }else{
                redirect("admin/dashboard");
                // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
            }
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a new supplier: $spName .", "add", NULL);

        }else{
            redirect('login');
        }
        // redirect("login");
        // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
    }
    function addMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
                $mName = $this->input->post('name');
                $mDesc = $this->input->post('description');
                $category = $this->input->post('category');
                $status = $this->input->post('status');
                $preference = json_decode($this->input->post('preferences'),true);
                $addon = json_decode($this->input->post('addons'),true);
                $account_id = $_SESSION["user_id"];
                $date_recorded = date("Y-m-d H:i:s");
                $user= $_SESSION["user_name"];
                if($this->adminmodel->add_menu($mName, $mDesc, $category, $status, $preference, $addon)){
                    echo json_encode(array(
                            'menu' => $this->adminmodel->get_menu(),
                            'preferences' => $this->adminmodel->get_preferences(),
                            'addons' => $this->adminmodel->get_addons2()
                        ));
                }else{
                    redirect("admin/menu");
                    // echo json_encode(array("stock" => $stockName, "stock" => $stockCategory, "stock" => $stockStatus, "stock" => $stockType, "stock" => $stockVariance));
                }
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a new menu: $mName .", "add", NULL);

        }else{
            redirect("login");
        }
    }

    function addImage(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $config = array(
                'upload_path' => "./assets/media/customer/menu",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE
                );
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('mImage')){
                echo 'error';
            }
            else{
                $data = $this->upload->data();
                $image = $data['file_name'];
                $mID = $this->input->post('menuId');
                $this->adminmodel->add_image($image, $mID);
                redirect("admin/menu");
            }
        }else{
            redirect("login");
        }
    }

   function addMenuStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $items = json_decode($this->input->post('items'), true);
            $account_id = $this->session->userdata('user_id');
            $date =date("Y-m-d H:i:s");
            $this->adminmodel->add_menuStock($items, $account_id, $date);
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function addReturns() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spID = $this->input->post('spID'); 
            $spAltName = $this->input->post('spAltName'); 
            $rDate = $this->input->post('date'); 
            $rDateRecorded = date("Y-m-d H:i:s");
            $rTotal = $this->input->post('rTotal');
            $items = json_decode($this->input->post('items'), true);
            $accountID = $_SESSION["user_id"];
            $action = 'add';
            $this->adminmodel->add_returns($spID, $spAltName, $rDate, $rDateRecorded, $rTotal, $items, $accountID, $action);
        }else{
            redirect("login");
        }
    }

    function addPurchaseOrder(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $supplier = $this->input->post('supplier');
            $date = $this->input->post('date');
            $current = date("Y-m-d H:i:s");
            $type = "purchase order";
            $poitems = json_decode($this->input->post('poitems'),true);
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->add_purchaseOrder($supplier, $date, $current, $type, $poitems);
            $this->adminmodel->add_actlog($account_id, $date_recorded, "$user added a purchase order to $supplier .", "add", NULL);

        }else{
            redirect("login");
        }
    }

    function addDeliveryReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $supplier = $this->input->post("spID");
            $remarks = $this->input->post("remarks");
            $receipt = $this->input->post("receipt");
            $date = $this->input->post("date");
            $source = $this->input->post("spAltName");
            $addtype = $this->input->post("addtype");
            $dateTime = date("Y-m-d H:i:s");
            $drItems = json_decode($this->input->post('items'),true);
            $account_id = $_SESSION["user_id"];
           
            switch($addtype) {
                case "new":
                $this->adminmodel->add_purchase(NULL, $receipt, "delivery", $date, $dateTime, $source, $drItems, $addtype, $account_id);
                break;
                case "merchandise":
                $this->adminmodel->add_purchase($supplier, $receipt, "delivery",$date, $dateTime, $source, $drItems, $addType, $account_id);
                break;
                case "po":
                $this->adminmodel->add_purchase($supplier, $receipt, "delivery",$date, $dateTime, $source, $drItems, $addType, $account_id);
                break;
                case "return":
                $this->adminmodel->add_purchase($supplier, $receipt, "delivery", $date, $dateTime, NULL, $drItems, $addtype, $account_id);
                break;
            }
            echo 'HHAHAHAA';
    }
}
 
//-----------------------------CONSUMPTION---------------------
function addConsumption(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $date_recorded = date("Y-m-d H:i:s");
        $stocks = json_decode($this->input->post('items'), true);
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $account_id = $_SESSION["user_id"];
        $user= $_SESSION["user_name"];

        $this->adminmodel->add_consumption($date_recorded,$stocks,$account_id,$user,$date,$remarks);
    }else{
    redirect('login');
    }
}

//---------------------------------------------------------------------------------------
    function addBeginningLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $dateTime = date("Y-m-d H:i:s");
            $date = $this->input->post('date');
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $logs = json_decode($this->input->post('items'),true);
            $this->adminmodel->add_beginning($date, $dateTime, $logs, $user, $accountID);
        }
    }
}

?>

