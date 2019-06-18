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
            $stockStatus = $this->input->post('status');
            $stockType = $this->input->post('type');
            $stockUom = $this->input->post('uom');
            $stockSize = $this->input->post('size');
            $stockID = $this->input->post('id');
            $dbErr = false;
            if($stockID == null){
                if(!$this->adminmodel->add_stockItem($stockCategory, $stockUom, $stockName, $stockQty, $stockMin, $stockType, $stockStatus, 0, $stockLocation, $stockSize)){
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
       
        $this->adminmodel->add_salesOrder($tableCode, $custName, $osTotal, $osDateTime,
        $osPayDateTime, $osDateRecorded, $osDiscount, $orderlists, $addons);

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
        $this->load->model('adminmodel');
        $date_recorded = date("Y-m-d H:i:s");
        $addons = json_decode($this->input->post('addons'), true);
        $account_id = $_SESSION["user_id"];

        echo json_encode($addons, true);
        $this->adminmodel->add_aospoil($date_recorded,$addons,$account_id);
       
    }else{
        redirect('login');
    }
}
function addspoilagesmenu(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $this->load->model('adminmodel');
        $date_recorded = date("Y-m-d H:i:s");
        $menus = json_decode($this->input->post('menus'), true);
        $account_id = $_SESSION["user_id"];

        echo json_encode($menus, true);
        $this->adminmodel->add_menuspoil($date_recorded,$menus,$account_id);
       
    }else{
        redirect('login');
    }
}
function addspoilagesstock(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
        $lastNumget = intval($this->adminmodel->getLastNum());
        $date_recorded = date("Y-m-d H:i:s");
        $stocks = json_decode($this->input->post('stocks'), true);
        $account_id = $_SESSION["user_id"];

        $lastNum = $lastNumget + 1;
        $this->adminmodel->add_stockspoil($date_recorded,$stocks,$account_id,$lastNumget);
    }else{
    redirect('login');
    }
}

    function addaccounts(){
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[50]');
        // $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[5]|max_length[50]|matches[password]');
        $this->form_validation->set_rules('aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('aType','Account Type','trim|required');

            $password = password_hash($this->input->post("password"),PASSWORD_DEFAULT);
            $username = $this->input->post("aUsername");
            $aType = $this->input->post("aType");
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];
            $data = array(
                'aPassword'=>$password,
                'aUsername'=>$username,
                'aType'=>$aType
            );
            $this->adminmodel->add_accounts($data);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin added account $username .", "add", NULL);

            redirect('admin/accounts');
    }
    function addMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $this->adminmodel->add_menucategory($ctName);
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
            $this->adminmodel->add_uom($uomName, $uomAbbreviation, $uomVariant, $uomStore);
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
            $data['currentInv'] = $this->adminmodel->get_invPeriodStart($stID)[0];
            $this->load->view('admin/reportInventory',$data);
            // redirect('admin/stocklog/report');
        }else{
            redirect('login');
        }
    }

    function addSubMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $supcatID = trim($this->input->post('subcatID'));
            $this->adminmodel->add_submenucategory($ctName, $supcatID);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function addStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = $this->input->post('ctName');
            $this->adminmodel->add_stockcategory($ctName);
            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }
    function addSubStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctName = trim($this->input->post('ctName'));
            $supcatID = trim($this->input->post('subcatID'));
            $this->adminmodel->add_SubStockCategory($ctName, $supcatID);
            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }


    function addAddon(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoName = $this->input->post('aoName');
            $aoPrice = $this->input->post('aoPrice');
            $aoCategory = $this->input->post('aoCategory');
            $aoStatus = $this->input->post('aoStatus');
            $this->adminmodel->add_addon($aoName, $aoPrice, $aoCategory, $aoStatus);
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
        }else{
            redirect("login");
        }
    }

    function addImage(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $config = array(
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
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
            $items = json_decode($this->input->post("items"),true);
            $inputErr = false;
            if($this->adminmodel->add_menuStock($items)){
                echo json_encode(array(
                    "inputErr" => $inputErr
                ));
            }else{
                echo json_encode(array(
                    "inputErr" => !$inputErr
                ));
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function addPurchaseOrder(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $poItems = json_encode($this->input->post(),true);
            $po = array(
                "supplier" => $this->input->post('supplier'),
                "supplierName" => NULL,
                "receipt" => NULL,
                "date" => $this->input->post('date'),
                "dateRecorded" => date("Y-m-d H:i:s"),
                "type" => $this->input->post('puchase order'),
                "total" => $this->input->post('total'),
                "remarks" => $this->input->post('remarks')
            );
            $poID = $this->adminmodel->add_receiptTransaction($po);
            if(count($poItems)>0){
                foreach($poItems as $poItem){
                    $po = array(
                        "uom" => $poItem['uomID'],
                        "stock" => $poItem['stID'],
                        "price" => $poItem['price'],
                        "discount" => $poItem['discount'],
                        "delivery" => 'pending',
                        "payment" => NULL,
                        "return" => NULL,
                        "tiQty" => $poItem['qty'],
                        "perUnit" => $poItem['actualQty'],
                        "actual" => $poItem['qty'] * $poItem['actualQty'],
                        "subtotal" => ($poItem['price'] - $poItem['discount']) * $poItem['qty'],
                        "tiID" => NULL
                    );
                    $poiID = $this->adminmodel->add_receiptTransactionItems($po);
                    $po['tiID'] = $poID;
                    $this->adminmodel->add_receiptTransactionItemsQty($poID, $po);
                }
            }
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    // function addDeliveryReceipt(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
    //         $drItems = json_decode($this->input->post(''),true);
    //         $dr = array(
    //             "supplier" => $this->input->post(''),
    //             "supplierName" => NULL,
    //             "receipt" => NULL,
    //             "date" => $this->input->post(''),
    //             "dateRecorded" => date("Y-m-d H:i:s"),
    //             "type" => $this->input->post(''),
    //             "total" => $this->input->post(''),
    //             "remarks" => $this->input->post('')
    //         );
    //         $drID = $this->adminmodel->add_receiptTransaction($po);
    //         if(count($drItems) > 0){
    //             foreach($drItems as $drItem){
    //                 $dr = array(
    //                     "uom" => $this->input->post(''),
    //                     "stock" => $this->input->post(''),
    //                     "price" => $this->input->post(''),
    //                     "discount" => $this->input->post(''),
    //                     "delivery" => 'pending',
    //                     "payment" => NULL,
    //                     "return" => $this->input->post(''),
    //                     "tiQty" => $this->input->post(''),
    //                     "perUnit" => $this->input->post(''),
    //                     "actual" => $this->input->post(''),
    //                     "subtotal" => $this->input->post(''),
    //                     "tiID" => $this->input->post('')
    //                 );
    //                 if(!isset(drID)){
    //                     $driID = $this->adminmodel->add_receiptTransactionItems($dr);
    //                     $dr['tiID'] = $drID;
    //                 }else{
    
    //                 }
    //                 if($this->adminmodel->checkIfExistingItemsQty($drID, $dr['tiID'] > 0)){
    
    //                 }else{
    //                     $this->adminmodel->add_receiptTransactionItemsQty($drID, $dr);
    //                 }
    //             }
    //         }
    //     }else{
    //         echo json_encode(array(
    //             "sessErr" => true
    //         ));
    //     }
    // }

    function addBeginningLogs(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $logs = json_decode($this->input->post('items'),true);
            if(count($logs)> 0){
                $dateTime = date("Y-m-d H:i:s");
                foreach($logs as $item){
                    $qty = $this->adminmodel->get_stockQty($item['stock'])[0]['stQty'];
                    $log = array(
                        "stock" => $item['stock'],
                        "qty" => 0,
                        "remain" => $qty,
                        "actual" => $item['qty'],
                        "discrepancy" => $item['qty'] - $qty,
                        "dateTime" => $dateTime,
                        "dateRecorded" => $dateTime,
                        "remarks" => $item['remarks']
                    );
                    $this->adminmodel->add_beginningLog($log);
                    $this->adminmodel->set_stockQty($log['stock'], $log['actual']);
                }
            }
            echo json_encode(array(
                "success" => true
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }
}
?>

