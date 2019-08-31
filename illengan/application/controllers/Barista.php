<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barista extends CI_Controller{
    
    function __construct(){
        parent:: __construct();      
        date_default_timezone_set('Asia/Manila');        
        $this->load->model('baristamodel');  
        $this->load->helper('url');
        $this->load->library('pagination');
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }
	function checkIfLoggedIn(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            return true;
        }
        return false;
	}
	
	function index(){
		if($this->checkIfLoggedIn()){
			$data['title'] = " ";
			$this->load->view('barista/head', $data);	
			$this->load->view('barista/barista');
        }else{
            redirect('login');
        } 
	}

    //BARISTA ORDER FUNCTIONS
    function pendingOrders(){
        if($this->checkIfLoggedIn()){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/pendingOrders'); 
    }else{
        redirect('login');
        }
    }
    function pendingOrdersJS(){
        if($this->checkIfLoggedIn()){
        echo json_encode($this->baristamodel->get_pendingOrders());
    }else{
        redirect('login');
        }
    }
    function servedOrders(){
        if($this->checkIfLoggedIn()){
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/servedOrders');  
    }else{
        redirect('login');
        }
    }
    function servedOrdersJS(){
        if($this->checkIfLoggedIn()){
       $data= $this->baristamodel->get_servedOrders();
       echo json_encode($data);
    }else{
        redirect('login');
        }
    }
    
    function viewOrderslipJS(){
        $data =$this->baristamodel->get_orderslips();
        echo json_encode($data);
    }
    function getTables(){
        if($this->checkIfLoggedIn()){
        $data =$this->baristamodel->get_availableTables();
        echo json_encode($data);
    }else{
        redirect('login');
        }
    }
    function editTableNumber(){
        if($this->checkIfLoggedIn()){
        $osID = $this->input->post('osID');
        $tableCode =$this->input->post('tableCode');
        $this->baristamodel->edit_tablenumber($osID, $tableCode);
    }else{
        redirect('login');
        }
    }
    
    //BARISTA BILLINGS FUNCTIONS
    function getOrders(){
       if($this->checkIfLoggedIn()){
            //Code Here
        }else{
            redirect('login');
        }
    }

    function getOrderBills(){
        if($this->checkIfLoggedIn()){
        $this->load->view('barista/templates/head');
        $this->load->view('barista/templates/navigation');
        $this->load->view('barista/orderBills');
    }else{
        redirect('login');
        }
    }
    
    function orderBillsJS(){
        if($this->checkIfLoggedIn()){
        $data= $this->baristamodel->get_bills();
        echo json_encode($data);
    }else{
        redirect('login');
        }
    }
    function getOrderItems(){
        if($this->checkIfLoggedIn()){
        $osID = $this->input->post('osID');
        $data = $this->baristamodel->get_orderitems($osID);
        echo json_encode($data);
    }else{
        redirect('login');
        }
    }

    function getBillDetails(){
       if($this->checkIfLoggedIn()){
            $osID = $this->input->post("osID"); 
            $orderdetails = array(
            'orderslips' => $this->baristamodel->get_orderslips($osID)[0],
            'orderlists' => $this->baristamodel->get_orderlists($osID)
            );
                $this->output->set_output(json_encode($orderdetails));
            }else{
            redirect('login');
        }
    }

    function getDate(){
        if($this->checkIfLoggedIn()){
        $this->load->helper('date');
        date_default_timezone_set('Asia/Manila'); 
        $format = "%Y-%m-%d %h:%i %A";
        echo mdate($format);
    }else{
        redirect('login');
        }
    }

    function change_status() {
        if($this->checkIfLoggedIn()){
        $olID = $this->input->post('olID');
		$order_status = $this->input->post('olStatus');
		$this->baristamodel->update_status( $order_status, $olID);
    }else{
        redirect('login');
        }
    }
    function cancel(){
        if($this->checkIfLoggedIn()){
        $data=$this->baristamodel->cancelOrder();
        echo json_encode($data);
    }else{
        redirect('login');
        }
    }
    function cancelslip(){
        if($this->checkIfLoggedIn()){
        $data=$this->baristamodel->cancel_slip();
        echo json_encode($data);
    }else{
        redirect('login');
        }
    }
    function setBillStatus(){        
       if($this->checkIfLoggedIn()){
            $payment_date_time = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d");
            $osID = $this->input->post("osID");
            $status = $this->input->post("payStatus");
            
            switch($status){
                case "p": 
                    if($this->baristamodel->update_billstatus($osID)){
                        $this->output->set_output(json_encode($this->baristamodel->get_bills()));
                    }else{
                        //error
                    }
                    break;
                case "u" : 
                    if($this->baristamodel->update_billstatus($osID, $payment_date_time, $date_recorded)){
                        $this->output->set_output(json_encode($this->baristamodel->get_bills()));
                    }else{
                        //error
                    }
                    break;
        
                }
            }else{
                redirect('login');
            }
        }

        //BARISTA INVENTORY FUNCTIONS
        function viewinventory(){
            if($this->checkIfLoggedIn()){
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $this->load->view('barista/baristaConsumptions'); 
        }else{
            redirect('login');
            }
        }

        function inventoryJS(){
            if($this->checkIfLoggedIn()){
            echo json_encode($this->baristamodel->get_inventory_consumption());
        }else{
            redirect('login');
            }
        }
        function getConsumptionItems(){
            if($this->checkIfLoggedIn()){
            $data=$this->baristamodel->get_stocks();
            echo json_encode($data);
        }else{
            redirect('login');
            }
        }

        function orderData(){
            if($this->checkIfLoggedIn()){
            $data= $this->baristamodel->get_ordersData();
            echo json_encode($data);
        }else{
            redirect('login');
            }
        }

        function updatePayment(){
            if($this->checkIfLoggedIn()){
            $status = "paid";
            $osID = json_decode($this->input->post('osIDarr'), true);
            $payDate = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d H:i:s");
            $this->baristamodel->update_payment($status,$osID,$payDate, $date_recorded);
            foreach ($osID as $o) {
                $this->destockPrefStock($o);
            }
        }else{
            redirect('login');
            }
        }
        function updatePayment2(){
            if($this->checkIfLoggedIn()){
            $status = "paid";
            $osID = $this->input->post('osID');
            $payDate = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d H:i:s");
            $this->baristamodel->update_payment2($status,$osID,$payDate, $date_recorded);
            $this->destockPrefStock($osID);
        }else{
            redirect('login');
            }
        }
        function destockPrefStock($osID){
            $prefStocks = $this->baristamodel->get_prefStocks();
            $olists = $this->baristamodel->get_olistsID($osID);
            $destockables = array();
            $cDate = '';
            if(count($prefStocks) > 0){
                foreach($prefStocks as $ps){
                    foreach($olists as $ol){
                        if($ps->prID == $ol->prID){
                            $tiActual = intval($ps->prstQty) * intval($ol->olQty);
                            $curQty = intval($this->baristamodel->get_stockQty($ps->stID));
                            $remainingQty = $curQty - $tiActual;
                            $tiDate = $ol->osDate;
                            if($cDate == '') $cDate = $ol->osDate;
                            array_push($destockables,array(
                                'tiActual'      => $tiActual,
                                'remainingQty'  => $remainingQty,
                                'stID'          => $ps->stID,
                                'tiType'        => 'consumed',
                                'tiRemarks'     => 'Ordered'
                            ));
                        }
                    }
                }
                if(count($destockables > 0)){
                    $this->baristamodel->addAutoConsumption(array('cDate' => $cDate, 'cDateRecorded' => date("Y-m-d H:i:s")),$destockables);
                }
            }
        }
        function destockitem(){            
            if($this->checkIfLoggedIn()){
                $lastNumget = intval($this->baristamodel->getLastNum2());
                $stocks = json_decode($this->input->post('stocks'), true);
                echo json_encode($stocks, true);
                $date_recorded = date("Y-m-d H:i:s");
                $account_id = $_SESSION["user_id"];
                $user = $_SESSION["user_name"];
                $lastNum = $lastNumget + 1;
                $this->baristamodel->add_consumption($date_recorded,$stocks,$account_id,$lastNum,$user);
            }else{
                redirect('login');
            }    
        }
        function updateStatus(){
            if($this->checkIfLoggedIn()){
            $stats = $this->input->post('status');
            $id = $this->input->post('id');
            $this->baristamodel->updateStats($stats, $id);
        }else{
            redirect('login');
            }
        }
        function deleteOrderItem(){
            if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            $this->baristamodel->cancelOrder($id);
        }else{
            redirect('login');
            }
        }
        function vieworderslip(){
            if($this->checkIfLoggedIn()){
            $data['orderlists'] = $this->baristamodel->get_olist();
            $data['orderslips'] = $this->baristamodel->get_orderslips();
            $this->load->view('barista/orderslip', $data);
        }else{
            redirect('login');
            }
        }
        function getServed(){
            if($this->checkIfLoggedIn()){
            $data = array(
                'slips' => $this->baristamodel->get_servedorderslips(),
                'lists' => $this->baristamodel->get_servedOlist(),
                'addons' => $this->baristamodel->get_addons(),
		'orderaddons' => $this->baristamodel->get_oaddons()
            );
            header('Content-Type: application/json');
                echo json_encode($data, JSON_PRETTY_PRINT);
            }else{
                redirect('login');
                }
        }
        function getOrderslip(){
            if($this->checkIfLoggedIn()){
            $data = array(
                'orderslips' => $this->baristamodel->get_oslips(),
                'orderlists' => $this->baristamodel->get_pendingOlist(),
                'addons' => $this->baristamodel->get_addons(),
		 'tables' => $this->baristamodel->get_availableTables()
            );
            header('Content-Type: application/json');
                echo json_encode($data, JSON_PRETTY_PRINT);
            }else{
                redirect('login');
                }
        }
        
    // function restockitem(){
    //             $stocks = json_decode($this->input->post('stocks'), true);
    //             echo json_encode($stocks, true);
    //             $date_recorded = date("Y-m-d H:i:s");
    //             $account_id = $_SESSION["user_id"];
    //             $this->baristamodel->restock($stocks,$date_recorded,$account_id);
    //         }

    
    //ADDON SPOILAGE------------------------------------------------
    function viewSpoilagesAddons(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Spoilages - Addons";
            $this->load->view('barista/templates/head', $data);
            $this->load->view('barista/templates/navigation');
            $this->load->view('barista/baristaspoilagesaddons');
            // $this->load->view('barista/templates/scripts');
        }else{
            redirect('login');
        }
    }
    function viewAddonJS(){
        if($this->checkIfLoggedIn()){
            $data=$this->baristamodel->get_spoilagesaddons();
            echo json_encode($data);
        }
    }
    function viewSpoilagesAddonAdd(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Spoilages - Addons";
            $this->load->view('barista/templates/head', $data);
            $this->load->view('barista/templates/navigation');
            $data['addons'] = $this->baristamodel->get_addons();
            $this->load->view('barista/baristaspoilagesaddonsAdd', $data);
        }else{
            redirect('login');
        }
    }
    function viewSpoilagesAddonsJs(){
        if($this->checkIfLoggedIn()){
            $data= $this->baristamodel->get_spoilagesaddons();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
    function editAoSpoil(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $aoID = $this->input->post('aoID');
            $aosID = $this->input->post('aosID');
            $aosQty = $this->input->post('aosQty');
            $aosDate = $this->input->post('aosDate');
            $aosRemarks = $this->input->post('aosRemarks');
            $date_recorded = date("Y-m-d H:i:s");
            $account_id = $_SESSION["user_id"];

            $this->baristamodel->edit_aospoilage($aoID,$aosID,$aosQty,$aosDate,$aosRemarks,$date_recorded);
            $this->baristamodel->add_actlog($account_id,$date_recorded, "Admin updated an addon spoilage.", "update", $aosRemarks);
        }else{
            redirect('login');
        } 
    }
    function addspoilagesaddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $date_recorded = date("Y-m-d H:i:s");
            $date = $this->input->post('date');
            $addons = json_decode($this->input->post('items'), true);
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $this->baristamodel->add_aospoil($date_recorded,$date,$addons,$account_id,$user);
           
        }else{
            redirect('login');
        }
    }
    //STOCK SPOILAGES------------------------------------------------
    function viewSpoilagesStockJs(){
        if($this->checkIfLoggedIn()){
            $data= $this->baristamodel->get_spoilagesstock();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
        }
        function loadDataSpoilagesStock($record=0) {
            $recordPerPage = 10;
            if($record != 0){
                $record = ($record-1) * $recordPerPage;
            }      	
            $recordCount = $this->baristamodel->countSpoiledStock();
            $ssRecord = $this->baristamodel->get_spoilagesstock($record,$recordPerPage);
            $config['base_url'] = base_url().'barista/loadDataSpoilagesStock';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['last_tag_open'] = '<li class="page-link">';
            $config['last_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="page-link">';
            $config['first_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-link">&nbsp;';
            $config['num_tag_close'] = '&nbsp;</li>';
            $config['cur_tag_open'] = '<li class="page-link" style="background-color:#EBEEEE;width:30px;padding:7px 10px 7px 10px;font-weight:700">';
            $config['cur_tag_close'] = '</li>';
            $config['use_page_numbers'] = TRUE;
            $config['next_link'] = '<li class="page-link">Next <i class="fa fa-long-arrow-right"></i></li>';
            $config['prev_link'] = '<li class="page-link"><i class="fa fa-long-arrow-left"></i> Previous</li>';
            $config['total_rows'] = $recordCount;
            $config['per_page'] = $recordPerPage;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['stckspoiled'] = $ssRecord;
            echo json_encode($data);		
        }
        function loadDataAddsSpoil($record=0) {
            $recordPerPage = 10;
            if($record != 0){
                $record = ($record-1) * $recordPerPage;
            }      	
            $recordCount = $this->baristamodel->countRecAddsSpoil();
            $aoRecord = $this->baristamodel->get_addspoil($record,$recordPerPage);
            $config['base_url'] = base_url().'barista/addonspoilage/loadDataAddsSpoil';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['last_tag_open'] = '<li class="page-link">';
            $config['last_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="page-link">';
            $config['first_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-link" style="padding:7px 10px 7px 10px;">&nbsp;';
            $config['num_tag_close'] = '&nbsp;<li>';
            $config['cur_tag_open'] = '<li  class="page-link" style="background-color:#EBEEEE;width:30px;padding:7px 10px 7px 10px;font-weight:700">';
            $config['cur_tag_close'] = '</li>';
            $config['use_page_numbers'] = TRUE;
            $config['next_link'] = '<li class="page-link">Next <i class="fa fa-long-arrow-right"></i></li>';
            $config['prev_link'] = '<li class="page-link"><i class="fa fa-long-arrow-left"></i> Previous</li>';
            $config['total_rows'] = $recordCount;
            $config['per_page'] = $recordPerPage;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['addspoiled'] = $aoRecord;
            echo json_encode($data);		
               
        }
    function viewSpoilagesStock(){
            if($this->checkIfLoggedIn()){
                $data['title'] = "Spoilages - Stock";
                $this->load->view('barista/templates/head', $data);
                $this->load->view('barista/templates/navigation');
                $this->load->view('barista/baristastockspoilages');
            }else{
                redirect('login');
        }
    }
        function viewSpoilagesStockAdd(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Spoilages - Stock";
            $this->load->view('barista/templates/head', $data);
            $this->load->view('barista/templates/navigation');
            $data['stocks'] = $this->baristamodel->get_stocks();
            $this->load->view('barista/baristaspoilagesstockAdd', $data);
        }else{
            redirect('login');
        }
        }
        function editStockSpoil(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
    
                
                $tiActual = $this->input->post('tiActual');
                $actualQtyUpdate = $this->input->post('actualQtyUpdate');
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
    
                if($tiActual > $actualQtyUpdate){
                    $updateQtyl = ($tiActual - $actualQtyUpdate) + $stQty;
                    $this->baristamodel->add_stocktransitems($tiType,$updatedActual,$updateQtyl,$tiDate,$tiRemarks, $stID, $siID,$date_recorded);
                    $this->baristamodel->update_stock($stID, $updateQtyl);
                    $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
                                    
                }else if($tiActual < $actualQtyUpdate) {
                        $updateQtyh = $stQty - ($actualQtyUpdate - $tiActual); 
                        $this->baristamodel->add_stocktransitems($tiType,$updatedActual,$updateQtyh,$tiDate,$tiRemarks,$stID, $siID,$date_recorded);
                        $this->baristamodel->update_stock($stID, $updateQtyh);
                        $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
    
                }else{
                    
                        $this->baristamodel->add_stocktransitems($tiType,0,$stQty,$tiDate,$tiRemarks, $stID, $siID,$date_recorded);
                        $this->baristamodel->update_stock($stID, $stQty);
                        $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a spoilage.", "update", $tiRemarks);
                }
               
            }else{
                redirect('login');
            } 
        }
            function addspoilagesstock(){
                if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
                    $date_recorded = date("Y-m-d H:i:s");
                    $stocks = json_decode($this->input->post('items'), true);
                    $date = $this->input->post('date');
                    $remarks = $this->input->post('remarks');
                    $account_id = $_SESSION["user_id"];
                    $user= $_SESSION["user_name"];
            
                    $this->baristamodel->add_stockspoil($date_recorded,$stocks,$account_id,$user,$date,$remarks);
                }else{
                redirect('login');
                }
            }
        function deleteStockSpoil(){
            $tID = $this->input->post('tID');
            $delRemarks = $this->input->post('delRemarks');
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $date_recorded = date("Y-m-d H:i:s");

            $this->baristamodel->deleteStockspoil($tID);
                                // add_stocklog($stocks[$in]['stID'], $tID, "spoilage",$stocks[$in]['tDate'], $dateRecorded, $stocks[$in]['actualQty'], $stocks[$in]['tRemarks'])
            // $this->baristamodel->add_stocklog($stID, $tID, "spoilage", $slDateTime, $dateRecorded, $actualQty, $slRemarks);
            $this->baristamodel->add_actlog($account_id,$date_recorded,"$user deleted a stockitem consumption.","archived", $delRemarks);
        }
        
    function viewDeliveryReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $data['drs'] = $this->baristamodel->get_deliveryReceipts();
            $data['drItems'] = $this->baristamodel->get_deliveryItems();
            $this->load->view('barista/deliveryReceipt', $data);
        }else{
            redirect('login');
        }
    }
    
    // function viewDRFormAdd(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
    //         $this->load->view('barista/templates/head');
    //         $this->load->view('barista/templates/navigation');
    //         $data['uom'] = $this->baristamodel->get_uomForStoring();
    //         $data['stocks'] = $this->baristamodel->get_stockitems();
    //         $data['supplier'] = $this->baristamodel->get_supplier();
    //         $data['suppmerch'] = $this->baristamodel->get_supplierstocks();
    //         $data['pos'] = $this->baristamodel->get_posForBrochure();
    //         $data['poItems'] = $this->baristamodel->get_poItemsForBrochure();
    //         $this->load->view('barista/deliveryReceiptAdd', $data);
    //     }else{
    //         redirect('login');
    //     }
    // }

    function viewDRFormAdd(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $head['title'] = "Inventory - Add Delivery";
            $this->load->view('barista/templates/head', $head);
            $this->load->view('barista/templates/navigation');
            $data['stocks'] = $this->baristamodel->get_stockitems();
            $data['supplier'] = $this->baristamodel->get_supplier();
            $data['returns'] = $this->baristamodel->get_retItems();
            $data['retTrans'] = $this->baristamodel->get_unresolveReturns();
            $this->load->view('barista/deliveryReceiptAdd', $data);
        }else{
            redirect('login');
        }
    }

    function viewORFormAdd(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $data['supplier'] = $this->baristamodel->get_supplier();
            $data['stocks'] = $this->baristamodel->get_stockItemNames();
            $this->load->view('barista/officialReceiptAdd',$data);
        }else{
            redirect('login');
        }
    }

    function viewOfficialReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            //$this->load->view('barista/templates/head');
            //$this->load->view('barista/templates/navigation');
            $data['ors'] = $this->baristamodel->get_officialReceipts();
            $data['orItems'] = $this->baristamodel->get_officialReceiptItems();
            $this->load->view('barista/officialReceipt', $data);
        }else{
            redirect('login');
        }
    }

    function viewDeliveryReceiptJS(){
        if($this->checkIfLoggedIn()){
        $data['dr']= $this->baristamodel->get_deliveryReceipts();
        $data['drItems']= $this->baristamodel->get_deliveryItems();
            echo json_encode($data);
        }else{
            redirect('login');
        }
    }

    function getSuppMerchForBrochure(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "merchandise" => $this->baristamodel->get_SPMs($id),
                    "uom" => $this->baristamodel->get_uomForStoring()
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
    // function getUOMs(){
    //     if($this->checkIfLoggedIn()){
    //         echo json_encode(array(
    //             'uom' => $this->baristamodel->get_uomForStoring()
    //         ));
    //     }else{
    //         echo json_encode(array(
    //             "sessErr" => true
    //         ));
    //     }
    // }
    function getUOMs(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                'uom' => $this->baristamodel->get_uomForStoring(),
                'stocks' => $this->baristamodel->get_stocks()
            ));
        }else{
            echo json_encode(array(
                "sessErr" => true
            ));
        }
    }

    function getpurchases(){
        $data =$this->baristamodel->get_purchases();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function viewPurchItems(){
        $pID = $this->input->post('pID');
        // $pID = $this->input->post('pID');
        $data =$this->baristamodel->get_purchItems($pID);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function viewStockitems(){
        $data =$this->baristamodel->get_stockitems();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getEnumValsForTransaction(){
        if($this->checkIfLoggedIn()){
            preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->baristamodel->get_enumVals('transactions','tType')[0]['column_type'], $tTypes);
            preg_match_all("/\w+(\s+)?(\w+)?(\'\w+)?(?=')/",$this->baristamodel->get_enumVals('transitems','tiStatus')[0]['column_type'], $tiStatuses);
            echo json_encode(array(
                "tTypes" => $tTypes[0],
                "tiStatuses" => $tiStatuses[0],
                "suppliers" => $this->baristamodel->get_supplierNames(),
                "uoms" => $this->baristamodel->get_uomForStoring(),
                "stocks" => $this->baristamodel->get_stockItemNames()
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
                    "transaction" => $this->baristamodel->get_transaction($id),
                    "transitems" => $this->baristamodel->get_transitems($id)
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
                    "transactions" => $this->baristamodel->get_transactionsBySupplier($spID, array("purchase order")),
                    "transitems" =>  $this->baristamodel->get_transitemsBySupplier($spID, array("purchase order"))
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
                    "transactions" => $this->baristamodel->get_transactionsBySupplier($spID, array("delivery receipt")),
                    "transitems" =>  $this->baristamodel->get_transitemsBySupplier($spID, array("delivery receipt"))
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
                    "merchandise" => $this->baristamodel->get_SPMs($spID)
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

    function getPOItemsBySupplier(){
        if($this->checkIfLoggedIn()){
            $id = $this->input->post('id');
            if(is_numeric($id)){
                echo json_encode(array(
                    "inputErr" => false,
                    'uom' => $this->baristamodel->get_uomForStoring(),
                    "pos" => $this->baristamodel->get_posBySupplier($id),
                    "poItems" => $this->baristamodel->get_poItemsBySupplier($id)
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

    // function addDeliveryReceipt(){
    //     if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
    //         $total = 0;
    //         $dateTime = date("Y-m-d H:i:s");
    //         $dateOfTrans = $this->input->post('date');
    //         $drItems = json_decode($this->input->post('transitems'),true);
    //         $dr = array(
    //             "supplier" => $this->input->post('supplier'),
    //             "supplierName" => NULL,
    //             "receipt" => $this->input->post('receipt'),
    //             "date" => $dateOfTrans,
    //             "dateRecorded" => $dateTime,
    //             "type" => "delivery receipt",
    //             "total" => $this->input->post('total'),
    //             "remarks" => $this->input->post('remarks')
    //         );
    //         $drID = $this->baristamodel->add_receiptTransaction($dr);
    //         if(count($drItems) > 0){
    //             foreach($drItems as $drItem){
    //                 $tiID = isset($drItem['tiID']) ? $drItem['tiID'] : NULL;
    //                 $qty = $drItem['qty'];
    //                 $status = "complete";
    //                 $item = $this->baristamodel->get_poItem($tiID);
    //                 if(!isset($item[0])){
    //                     $tiID = NULL;
    //                 }else if($item[0]['tiQty'] > $drItem['qty']){
    //                     $status = "partial";
    //                 }
    //                 $dr = array(
    //                     "uom" => $drItem['uomID'],
    //                     "stock" => $drItem['stID'],
    //                     "name" => $drItem['name'],
    //                     "price" => $drItem['price'],
    //                     "discount" => $drItem['discount'],
    //                     "delivery" => $status,
    //                     "payment" => NULL,
    //                     "return" => NULL,
    //                     "tiQty" => $drItem['qty'],
    //                     "perUnit" => $drItem['actualQty'],
    //                     "actual" => $drItem['qty'] * $drItem['actualQty'],
    //                     "subtotal" => ($drItem['price'] - $drItem['discount']) * $drItem['qty'],
    //                     "tiID" => $tiID
    //                 );
    //                 if($dr['tiID'] == NULL){
    //                     $dr['tiID'] = $this->baristamodel->add_receiptTransactionItems($dr);
    //                     $total += $dr['subtotal'];
    //                     $this->baristamodel->add_receiptTransactionItemsQty($drID, $dr);
    //                     $log = array(
    //                         "stock" => $dr['stock'],
    //                         "qty" => $dr['actual'],
    //                         "remain" => $this->baristamodel->get_stockQty($dr['stock'])[0]['stQty'] + $dr['actual'],
    //                         "actual" => NULL,
    //                         "discrepancy" => NULL,
    //                         "dateTime" => $dateOfTrans,
    //                         "dateRecorded" => $dateTime,
    //                         "remarks" => "delivery"
    //                     );
    //                     $this->baristamodel->add_restockLog($drID, $log);
    //                     $this->baristamodel->update_stockQty($dr['stock'], $dr['actual']);
    //                 }else{
    //                     $this->baristamodel->edit_receiptTransactionItems($dr);
    //                     $total += $dr['subtotal'];
    //                     $this->baristamodel->add_receiptTransactionItemsQty($drID, $dr);
    //                     $log = array(
    //                         "stock" => $dr['stock'],
    //                         "qty" => $dr['actual'],
    //                         "remain" => $this->baristamodel->get_stockQty($dr['stock'])[0]['stQty'] + $dr['actual'],
    //                         "actual" => NULL,
    //                         "discrepancy" => NULL,
    //                         "dateTime" => $dateOfTrans,
    //                         "dateRecorded" => $dateTime,
    //                         "remarks" => "delivery"
    //                     );
    //                     $this->baristamodel->add_restockLog($drID, $log);
    //                     $this->baristamodel->update_stockQty($dr['stock'], $dr['actual']);
    //                 }
    //             }
    //             $this->baristamodel->edit_receiptTransactionTotal($drID, $total);
    //         }
    //         echo json_encode(array(
    //             "success" => true
    //         ));
    //     }else{
    //         echo json_encode(array(
    //             "sessErr" => true
    //         ));
    //     }
    // }

    function addDeliveryReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
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
                $this->baristamodel->add_purchase(NULL, $receipt, "delivery", $date, $dateTime, $source, $drItems, $addtype, $account_id);
                break;
                case "merchandise":
                $this->baristamodel->add_purchase($supplier, $receipt, "delivery",$date, $dateTime, NULL, $drItems, $addtype, $account_id);
                break;
                case "po":
                $this->baristamodel->add_purchase($supplier, $receipt, "delivery",$date, $dateTime, NULL, $drItems, $addtype, $account_id);
                break;
                case "return":
                $this->baristamodel->add_purchase($supplier, $receipt, "delivery", $date, $dateTime, NULL, $drItems, $addtype, $account_id);
                break;
            }
        }
    }
    //-----------------------------CONSUMPTION---------------------
    function loadConsumptionData($record=0) {
        $recordPerPage = 10;
        if($record != 0){
            $record = ($record-1) * $recordPerPage;
        }      	
        $recordCount = $this->baristamodel->countConsump();
        $conRecord = $this->baristamodel->get_consumpitems($record,$recordPerPage);
        $config['base_url'] = base_url().'barista/loadConsumptionData';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['last_tag_open'] = '<li class="page-link">';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-link">';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-link">&nbsp;';
        $config['num_tag_close'] = '&nbsp;</li>';
        $config['cur_tag_open'] = '<li class="page-link" style="background-color:#EBEEEE;width:30px;padding:7px 10px 7px 10px;font-weight:700">';
        $config['cur_tag_close'] = '</li>';
        $config['use_page_numbers'] = TRUE;
        $config['next_link'] = '<li class="page-link">Next <i class="fa fa-long-arrow-right"></i></li>';
        $config['prev_link'] = '<li class="page-link"><i class="fa fa-long-arrow-left"></i> Previous</li>';
        $config['total_rows'] = $recordCount;
        $config['per_page'] = $recordPerPage;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['consumption'] = $conRecord;
        echo json_encode($data);		
    }
    function jsonConsumptions() {
        if($this->checkIfLoggedIn()){
            $data=$this->baristamodel->get_consumpitems();
            echo json_encode($data);
        }else{
            redirect('login');
        }
    }
    function viewConsumptions(){
        if($this->checkIfLoggedIn()){
            $data['title'] = "Consumption";
            $this->load->view('barista/templates/head', $data);
            $this->load->view('barista/templates/navigation');
            $this->load->view('barista/baristaConsumptions');
        }else{
            redirect('login');
        }
    }
    function viewConsumptionFormAdd(){
        if($this->checkIfLoggedIn()){
            $head['title'] = "Inventory - Add Consumption";
            $this->load->view('barista/templates/head', $head);
            $this->load->view('barista/templates/navigation');
            $data['stocks'] = $this->baristamodel->get_stocks();
            $this->load->view('barista/consumptionAdd', $data);
        }else{
            redirect('login');
        }
    }
    
function addConsumption(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
       
        $date_recorded = date("Y-m-d H:i:s");
        $stocks = json_decode($this->input->post('items'), true);
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $account_id = $_SESSION["user_id"];
        $user= $_SESSION["user_name"];
        
        $this->baristamodel->add_consumption($date_recorded,$stocks,$account_id,$user,$date,$remarks);
    }else{
    redirect('login');
    }
}
function editConsumption(){
    if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
        
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
            $this->baristamodel->add_consumptiontransitems($tiType,$updatedActual,$updateQtyl,$tiRemarks,$tiDate, $stID, $ciID,$date_recorded);
            $this->baristamodel->update_stock($stID, $updateQtyl);
            $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
                            
        }else if($tiActual < $actualQtyUpdate) {
                $updateQtyh = $stQty - ($actualQtyUpdate - $tiActual); 
                $this->baristamodel->add_consumptiontransitems($tiType,$updatedActual,$updateQtyh,$tiRemarks,$tiDate, $stID, $ciID,$date_recorded);
                $this->baristamodel->update_stock($stID, $updateQtyh);
                $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
        
        }else{
                $this->baristamodel->add_consumptiontransitems($tiType,0,$stQty,$tiRemarks,$tiDate, $stID, $ciID,$date_recorded);
                $this->baristamodel->update_stock($stID, $stQty);
                $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a consumption.", "update", $tiRemarks);
            
        }
       
    }else{
        redirect('login');
    } 
}
//---------------------------------------------------------------------------------------

}
?>
