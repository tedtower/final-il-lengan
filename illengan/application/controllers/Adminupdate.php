<?php
class Adminupdate extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }
    function editTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('prevTableCode', 'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]');
            $this->form_validation->set_rules('tableCode',   'Table Code', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tables.tableCode]');
            if($this->form_validation->run()){
                $prevTableCode = trim($this->input->post('prevTableCode'));
                $tableCode = trim($this->input->post('tableCode'));
                if($this->adminmodel->edit_table($tableCode,$prevTableCode)){
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

     function editSales() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $osID = $this->input->post('osID');
            $tableCodes = $this->input->post('tableCodes');
            $custName = $this->input->post('custName');
            $osTotal = $this->input->post('osTotal');
            $payStatus = $this->input->post('payStatus');
            $osDateTime = $this->input->post('osDateTime');
            $osDiscount = $this->input->post('osDiscount');
            $osPayDateTime = $this->input->post('osPayDateTime');
            $osDateRecorded = date("Y-m-d H:i:s");
            $orderlists = json_decode($this->input->post('orderlists'), true);
            $addons = json_decode($this->input->post('addons'), true);
            $accountID = $_SESSION["user_id"];
            $action = 'update';

            $this->adminmodel->edit_sales($osID, $tableCodes, $custName, $osTotal, $payStatus, 
            $osDateTime, $osPayDateTime, $osDateRecorded, $osDiscount, $orderlists, $addons, $accountID, $action);
        }else{
            redirect('login');
        }
    }

    function editReturns() {
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $rID = $this->input->post('rID'); 
            $spID = $this->input->post('spID'); 
            $spAltName = $this->input->post('spAltName'); 
            $rDate = $this->input->post('date'); 
            $rDateRecorded = date("Y-m-d H:i:s");
            $rTotal = $this->input->post('rTotal');
            $items = json_decode($this->input->post('items'), true);
            $accountID = $_SESSION["user_id"];
            $action = 'update';

            $this->adminmodel->edit_returns($rID, $rTotal, $rDate);
            $this->adminmodel->update_riStatus($items, $accountID, $action);
            }else{
                redirect('login');
            }
    }
    function editPurchaseOrder(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $pID = $this->input->post('id');
            $date = $this->input->post('date');
            $current = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $poitems = json_decode($this->input->post('poitems'),true);
            $this->adminmodel->edit_purchaseOrder($date, $current, $pID);
            $this->adminmodel->edit_pItem($poitems);
            $this->adminmodel->edit_potransitem($poitems);
            $this->adminmodel->add_actlog($account_id, $current, "$user updated a purchase order. .", "add", NULL);

        }else{
            redirect("login");
        }

    }
    function editMenuStock(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $prID = $this->input->post('prID');
            $stID = $this->input->post('stID');
            $qty = $this->input->post('qty');
            $account_id = $this->session->userdata('user_id');
            $date_recorded = date("Y-m-d H:i:s");
            $this->adminmodel->edit_menuStock($prID, $stID, $qty);
           $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin updated a prefstock.", "update", "");
        }else{
            redirect("login");
        }
    }
    
    function editStockSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){

            
            $tiActual = $this->input->post('tiActual');
            $actualQtyUpdate = $this->input->post('actualQtyUpdate');
            $updateTiQty = $this->input->post('updateTiQty');
            $tiQty = $this->input->post('tiQty');
            $stQty = $this->input->post('stQty');
            $tiRemarks = $this->input->post('tiRemarks');
            $tiDate = $this->input->post('tiDate');
            $stID= $this->input->post('stID');
            $siID = $this->input->post('siID');

            $tiType = "spoilage";
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $account_id= $_SESSION["user_id"];
            $updatedActual = $actualQtyUpdate - $tiActual;
            $updatedQty = $updateTiQty - $tiQty;

            if($tiActual > $actualQtyUpdate){
                $updateQtyl = ($tiActual - $actualQtyUpdate) + $stQty;
                $this->adminmodel->add_stocktransitems($tiType,$updatedQty,$updatedActual,$updateQtyl,$tiDate,$tiRemarks, $stID, $siID);
                $this->adminmodel->update_stock($stID, $updateQtyl);
                $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
                                
            }else if($tiActual < $actualQtyUpdate) {
                    $updateQtyh = $stQty - ($actualQtyUpdate - $tiActual); 
                    $this->adminmodel->add_stocktransitems($tiType,$updatedQty,$updatedActual,$updateQtyh,$tiDate,$tiRemarks,$stID, $siID);
                    $this->adminmodel->update_stock($stID, $updateQtyh);
                    $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);

            }else{
                if($tiQty == $updateTiQty){
                    $this->adminmodel->add_stocktransitems($tiType,0,0,$stQty,$tiDate,$tiRemarks, $stID, $siID);
                    $this->adminmodel->update_stock($stID, $stQty);
                    $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
                }else{
                    $this->adminmodel->add_stocktransitems($tiType,$updatedQty,0,$stQty,$tiDate,$tiRemarks, $stID, $siID);
                    $this->adminmodel->update_stock($stID, $stQty);
                    $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
                }
            }
           
        }else{
            redirect('login');
        } 
    }
     function editMenuSpoil(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $msID = $this->input->post('msID');
            $prID = $this->input->post('prID');
            $msQty = $this->input->post('msQty');
	    	$oldQty = $this->input->post('oldQty');
            $msDate = $this->input->post('msDate');
            $msRemarks = $this->input->post('msRemarks');
			$date_recorded = date("Y-m-d H:i:s");
            $osID = $this->input->post('osID');
            $account_id = $_SESSION["user_id"];
			
            $this->adminmodel->editmenuspoilage($msID,$prID,$msQty,$oldQty,$msDate,$msRemarks,$date_recorded,$osID);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin updated a menu spoilage.", "update", $msRemarks);
        }else{
            redirect('login');
        } 
	}
    function editAoSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoID = $this->input->post('aoID');
            $aosID = $this->input->post('aosID');
            $aosQty = $this->input->post('aosQty');
            $aosDate = $this->input->post('aosDate');
            $aosRemarks = $this->input->post('aosRemarks');
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];

            $this->adminmodel->edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin updated an addon spoilage.", "update", $aosRemarks);
        }else{
            redirect('login');
        } 
    }
    function editConsumption(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            
            $tiActual = $this->input->post('tiActual');
            $actualQtyUpdate = $this->input->post('actualQtyUpdate');
            $stQty = $this->input->post('stQty');
            $tiRemarks = $this->input->post('tiRemarks');
            $tiDate = $this->input->post('tiDate');
            $stID= $this->input->post('stID');
            $ciID = $this->input->post('ciID');
            $tiType = "consumed";
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $account_id= $_SESSION["user_id"];
            $updatedActual = $actualQtyUpdate - $tiActual;
            if($tiActual > $actualQtyUpdate){
                $updateQtyl = ($tiActual - $actualQtyUpdate) + $stQty;
                $this->adminmodel->add_consumptiontransitems($tiType,$updatedActual,$updateQtyl,$tiRemarks,$tiDate, $stID, $ciID);
                $this->adminmodel->update_stock($stID, $updateQtyl);
                $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
                                
            }else if($tiActual < $actualQtyUpdate) {
                    $updateQtyh = $stQty - ($actualQtyUpdate - $tiActual); 
                    $this->adminmodel->add_consumptiontransitems($tiType,$updatedActual,$updateQtyh,$tiRemarks,$tiDate, $stID, $ciID);
                    $this->adminmodel->update_stock($stID, $updateQtyh);
                    $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
            
            }else{
                    $this->adminmodel->add_consumptiontransitems($tiType,0,$stQty,$tiRemarks,$tiDate, $stID, $ciID);
                    $this->adminmodel->update_stock($stID, $stQty);
                    $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
                
            }
           
        }else{
            redirect('login');
        } 
    }
    function changeAccountPassword(){  
        $this->load->library('form_validation');
       
            $aID = $this->input->post('aID');
            $username = $this->input->post('aUsername');
            $new_password = password_hash($this->input->post("new_password"),PASSWORD_DEFAULT);
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];

            $this->adminmodel->change_aPassword($new_password,$aID);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin updated the account password of $username .", "update", NULL);
       
        redirect('admin/accounts');   
    }

    function editAccounts(){
        $this->form_validation->set_rules('new_aUsername','Username','trim|required|is_unique[accounts.aUsername]');
        $this->form_validation->set_rules('new_aType','Account Type','trim|required');
        $this->form_validation->set_rules('accountId','Account ID','required');

        if($this->form_validation->run()){
            $aID = $this->input->post('accountId');
            $aType = $this->input->post('new_aType');
            $aUsername = $this->input->post('new_aUsername');
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];

            $this->adminmodel->edit_accounts($aID,$aType,$aUsername);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "Admin updated the account information of $aUsername.", "update", NULL);
            redirect('admin/accounts');
            }else{
                echo "Form Validation is not Working.";
            }
            redirect('admin/accounts');
    }
    
    function editMenuCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctID = $this->input->post('ctID');
            $ctName = $this->input->post('new_name');
            $ctStatus = $this->input->post('new_status');
            $this->adminmodel->edit_category($ctName, $ctStatus, $ctID);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }

    function editStockCategory(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $ctID = $this->input->post('ctID');
            $ctName = $this->input->post('new_name');
            $ctStatus = $this->input->post('new_status');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->edit_category($ctName, $ctStatus, $ctID);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the stock category: $ctName.", "update", NULL);

            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }


    function editSupplierMerchandise(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $spID = $this->input->post('id');
            $spName = $this->input->post('name');
            $spContactNum = $this->input->post('contactNum');
            $spEmail= $this->input->post('email');
            $spStatus = $this->input->post('status');
            $spAddress = $this->input->post('address');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $spMerch = json_decode($this->input->post('merchandises'),true);
            if($this->adminmodel->edit_supplier($spName, $spContactNum, $spEmail, $spStatus, $spAddress, $spMerch, $spID)){
                echo json_encode(array(
                    'sources' => $this->adminmodel->get_supplier(),
                    'merchandises' => $this->adminmodel->get_suppliermerch(),
                    'stocks' => $this->adminmodel->get_stocks(),
                    'uom' => $this->adminmodel->get_uom()
                ));
            }
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the supplier details of $spName.", "update", NULL);

        }else{
            redirect('login');
        }
    }
    function editMenu(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $mID = $this->input->post('id');
            $mName = $this->input->post('name');
            $mDesc = $this->input->post('description');
            $mCat = $this->input->post('category');
            $mAvailability = $this->input->post('status');
            $preference = json_decode($this->input->post('preferences'),true);
            $addon = json_decode($this->input->post('addons'),true);
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            if($this->adminmodel->edit_menu($mName, $mDesc, $mCat, $mAvailability, $preference, $addon, $mID)){
                echo json_encode(array(
                    'menu' => $this->adminmodel->get_menu(),
                    'preferences' => $this->adminmodel->get_preferences(),
                    'addons' => $this->adminmodel->get_addons2(),
                    'categories' => $this->adminmodel->get_menucategories()
                ));
            }
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the menu details of $mName.", "update", NULL);

        }else{
            redirect('login');
        }
    }

    function editAddon(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $aoID = $this->input->post('aoID');
            $aoName = $this->input->post('aoName');
            $aoPrice = $this->input->post('aoPrice');
            $aoCategory = $this->input->post('aoCategory');
            $aoStatus= $this->input->post('aoStatus');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->edit_addon($aoName, $aoPrice, $aoCategory, $aoStatus, $aoID);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the addon details of $aoName.", "update", NULL);
            redirect('admin/menu/addons');

        }else{
            redirect('login');
        }
    }

    function editMeasurement(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $uomID = $this->input->post('uomID');
            $uomName = $this->input->post('uomName');
            $uomAbbreviation = $this->input->post('uomAbbreviation');
            $uomVariant = $this->input->post('uomVariant');
            $uomStore = $this->input->post('uomStore');
            $account_id = $_SESSION["user_id"];
            $date_recorded = date("Y-m-d H:i:s");
            $user= $_SESSION["user_name"];
            $this->adminmodel->edit_uom($uomName, $uomAbbreviation, $uomVariant, $uomStore, $uomID);
            $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the measurement details of $uomName.", "update", NULL);

            redirect('admin/measurements');
        }else{
            redirect('login');
        }
    }

    function editStockItem(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){   
            $this->form_validation->set_rules('id','Stock ID','trim|required|numeric');
            $this->form_validation->set_rules('name','Stock Name','trim|required|alpha_numeric_spaces');
            $this->form_validation->set_rules('type','Stock Type','trim|required|alpha');
            $this->form_validation->set_rules('category','Stock Category','trim|required|alpha_numeric');
            $this->form_validation->set_rules('status','Stock Status','trim|required|alpha');
            
            if($this->form_validation->run() == FALSE){
                redirect("admin/inventory");
            }else{
                $stockCategory = $this->input->post('category'); 
                $stockBqty = $this->input->post('bqty');
                $stockLocation = $this->input->post('location');
                $stockMin = $this->input->post('min');
                $stockName = $this->input->post('name');
                $stockQty = $this->input->post('qty');
                $stockStatus = $this->input->post('status');
                $stockType = $this->input->post('type');
                $stockUom = $this->input->post('uom');
                $stockID = $this->input->post('id');
                $stockSize = $this->input->post('size');
                $account_id = $_SESSION["user_id"];
                $date_recorded = date("Y-m-d H:i:s");
                $user= $_SESSION["user_name"];
                if($this->adminmodel->edit_stockItem($stockCategory, $stockBqty, $stockLocation, $stockMin, $stockName, $stockQty, $stockStatus, $stockType, $stockUom, $stockSize, $stockID)){
                    echo json_encode(array(
                        "stocks" => $this->adminmodel->get_stocks(),
                        "categories" => $this->adminmodel->get_stockSubCategories()
                    ));
                }
                $this->adminmodel->add_actlog($account_id,$date_recorded, "$user updated the stock item details of $stockName.", "update", NULL);

            }

        }else{
             redirect('login');
         }
    }	
}
?>
