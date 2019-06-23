<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barista extends CI_Controller{
    
    function __construct(){
        parent:: __construct();      
        date_default_timezone_set('Asia/Manila');        
        $this->load->model('baristamodel');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
    }
	function checkIfLoggedIn(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            return true;
        }
        return false;
	}
	
	function index()
	{
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
        if($this->checkIfLoggedIn()){
        $data =$this->baristamodel->get_orderslip();
        echo json_encode($data);
    }else{
        redirect('login');
        }
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
            $data=$this->baristamodel->getconsumptionItems();
            echo json_encode($data);
        }else{
            redirect('login');
            }
        }

        //barista functions for orderslips-cards

        function sample(){
            if($this->checkIfLoggedIn()){
            $this->load->view('barista/templates/head'); 
            $this->load->view('barista/templates/navigation'); 
                $data["slip"] = $this->baristamodel->slipData();
                $this->load->view("barista/orderCards", $data);
            }else{
                redirect('login');
                }
        }

        function get_slipData(){
            if($this->checkIfLoggedIn()){
            $this->load->helper->form();
            $data = array(
                $slip_id => $this->input->post('osID'),
                'table_code' => $this->input->post('tableCode'),
                'customerName' => $this->input->post('custName'),
                'paymentStatus' => $this->input->post('payStatus'),
            );
            $this->load->view('barista/orderCards', $data);
            //$this->load->view('barista/viewOrderslipJS', $data);
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
            $osID = json_decode($this->input->post('osArr'), true);
            echo json_encode($osID, true);
            $payDate = date("Y-m-d H:i:s");
            $date_recorded = date("Y-m-d H:i:s");
            $this->baristamodel->update_payment($status,$osID,$payDate, $date_recorded);
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
                'addons' => $this->baristamodel->get_addons()
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
                'orderslips' => $this->baristamodel->get_orderslips(),
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
    function destockitem(){
                
                if($this->checkIfLoggedIn()){
                    $lastNumget = intval($this->baristamodel->getLastNum2());
                    $stocks = json_decode($this->input->post('stocks'), true);
                    echo json_encode($stocks, true);
                    $date_recorded = date("Y-m-d H:i:s");
                    $account_id = $_SESSION["user_id"];
                    $lastNum = $lastNumget + 1;
                   
                    $this->baristamodel->add_consumption($date_recorded,$stocks,$account_id,$lastNum);
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
        function viewStockJS() {
            $data=$this->baristamodel->get_stocks();
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
        function editStockSpoil(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
    
                $stID = $this->input->post('stID');
                $tiID = $this->input->post('tiID');
                $tID = $this->input->post('tID');
                $stQty = $this->input->post('stQty');
                $actualQtyUpdate= $this->input->post('actualQtyUpdate');
                $tDate = $this->input->post('tDate');
                $tRemarks = $this->input->post('tRemarks');
                $slType = "spoilage";
                $actualQty = $this->input->post('actualQty');
                $date_recorded = date("Y-m-d H:i:s");
                $user= $_SESSION["user_name"];
                $account_id= $_SESSION["user_id"];
    
                if($actualQty > $actualQtyUpdate){
                    $updateQtyl = ($actualQty - $actualQtyUpdate) + $stQty;
                    $this->baristamodel->edit_stockspoilage($tDate,$date_recorded,$actualQtyUpdate,$tRemarks,$tID, $tiID, $stID, $updateQtyl);
                    $this->baristamodel->update_stock($stID, $updateQtyl);
                    $this->baristamodel->add_stockLog($stID,$tID, "spoilage", $tDate, $date_recorded, $actualQtyUpdate, $tRemarks);
                    $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tRemarks);
                                    
                }else if($actualQty < $actualQtyUpdate){
                        $updateQtyh = $stQty - ($actualQtyUpdate - $actualQty); 
                        $this->baristamodel->edit_stockspoilage($tDate,$date_recorded,$actualQtyUpdate,$tRemarks,$tID, $tiID, $stID, $updateQtyh);
                        $this->baristamodel->update_stock($stID, $updateQtyh);
                        $this->baristamodel->add_stockLog($stID,$tID, "spoilage", $tDate, $date_recorded, $actualQtyUpdate, $tRemarks);
                        $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tRemarks);
    
                }else{
                        $this->baristamodel->edit_stockspoilage($tDate,$date_recorded,$actualQtyUpdate,$tRemarks,$tID, $tiID, $stID, $stQty);
                        $this->baristamodel->update_stock($stID, $stQty);
                        $this->baristamodel->add_stockLog($stID,$tID, "spoilage", $tDate, $date_recorded, $actualQtyUpdate, $tRemarks);
                        $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tRemarks);
                }
               
            }else{
                redirect('login');
            } 
        }
        function addspoilagesstock(){
            if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
                $lastNumget = intval($this->baristamodel->getLastNum());
                $date_recorded = date("Y-m-d H:i:s");
                $stocks = json_decode($this->input->post('stocks'), true);
                $account_id = $_SESSION["user_id"];
                $user= $_SESSION["user_name"];
                $lastNum = $lastNumget + 1;
                print_r($lastNum);
                $this->baristamodel->add_stockspoil($date_recorded,$stocks,$account_id,$lastNum,$user);
                
            }else{
            redirect('login');
            }
        }
    function viewDeliveryReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $data['drs'] = $this->baristamodel->get_deliveryReceipts();
            $data['drItems'] = $this->baristamodel->get_deliveryReceiptItems();
            $this->load->view('barista/deliveryReceipt', $data);
        }else{
            redirect('login');
        }
    }
    
    function viewDRFormAdd(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $data['uom'] = $this->baristamodel->get_uomForStoring();
            $data['stock'] = $this->baristamodel->get_stockitems();
            $data['supplier'] = $this->baristamodel->get_supplier();
            $data['suppmerch'] = $this->baristamodel->get_supplierstocks();
            $data['pos'] = $this->baristamodel->get_posForBrochure();
            $data['poItems'] = $this->baristamodel->get_poItemsForBrochure();
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
            $this->load->view('barista/templates/head');
            $this->load->view('barista/templates/navigation');
            $data['ors'] = $this->baristamodel->get_officialReceipts();
            $data['orItems'] = $this->baristamodel->get_officialReceiptItems();
            $this->load->view('barista/officialReceipt', $data);
        }else{
            redirect('login');
        }
    }

}
?>
