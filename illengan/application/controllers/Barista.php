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
            $osID = json_decode($this->input->post('osIDarr'), true);
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
                    $user = $_SESSION["user_name"];
                    $lastNum = $lastNumget + 1;
                   
                    $this->baristamodel->add_consumption($date_recorded,$stocks,$account_id,$lastNum,$user);
                }else{
                redirect('login');
                }
                
    }
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
            $this->baristamodel->add_actlog($account_id,$date_recorded, "Barista updated an addon spoilage.", "update", $aosRemarks);
        }else{
            redirect('login');
        } 
    }
    function addspoilagesaddons(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $date_recorded = date("Y-m-d H:i:s");
            $date = $this->input->post('date');
            $remarks = $this->input->post('remarks');
            $addons = json_decode($this->input->post('items'), true);
            $account_id = $_SESSION["user_id"];
            $user= $_SESSION["user_name"];
            $this->baristamodel->add_aospoil($date_recorded,$date,$remarks,$addons,$account_id,$user);
           
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
            function editStockSpoil(){
                if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
        
                    
                    $tiActual = $this->input->post('tiActual');
                    $stQty = $this->input->post('stQty');
                    $tiRemarks = $this->input->post('tiRemarks');
                    $tiDate = $this->input->post('tiDate');
                    $stID= $this->input->post('stID');
                    $siID = $this->input->post('siID');
                    $actualQtyUpdate = $this->input->post('actualQtyUpdate');
        
                    $tiType = "spoilage";
                    $date_recorded = date("Y-m-d H:i:s");
                    $user= $_SESSION["user_name"];
                    $account_id= $_SESSION["user_id"];
                    $tiRemainingQty = $stQty - $actualQtyUpdate;
                    $updatedActual = $actualQtyUpdate - $tiActual;
        
                    if($tiActual > $actualQtyUpdate){
                        $updateQtyl = ($tiActual - $actualQtyUpdate) + $stQty;
                        $this->baristamodel->add_stocktransitems($tiType,$updatedActual,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID);
                        $this->baristamodel->update_stock($stID, $updateQtyl);
                        $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tiRemarks);
                                        
                    }else if($tiActual < $actualQtyUpdate){
                            $updateQtyh = $stQty - ($actualQtyUpdate - $tiActual); 
                            $this->baristamodel->add_stocktransitems($tiType,$updatedActual,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID);
                            $this->baristamodel->update_stock($stID, $updateQtyh);
                            $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tiRemarks);
        
                    }else{
                            $this->baristamodel->add_stocktransitems($tiType,$updatedActual,$tiRemainingQty,$tiRemarks,$tiDate, $stID, $siID);
                            $this->baristamodel->update_stock($stID, $stQty);
                            $this->baristamodel->add_actlog($account_id,$date_recorded, "$user updated a stockitem spoilage.", "update", $tiRemarks);
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
            $data['stocks'] = $this->baristamodel->get_stockitems();
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
    function getUOMs(){
        if($this->checkIfLoggedIn()){
            echo json_encode(array(
                'uom' => $this->baristamodel->get_uomForStoring()
            ));
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

    function addDeliveryReceipt(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $total = 0;
            $dateTime = date("Y-m-d H:i:s");
            $dateOfTrans = $this->input->post('date');
            $drItems = json_decode($this->input->post('transitems'),true);
            $dr = array(
                "supplier" => $this->input->post('supplier'),
                "supplierName" => NULL,
                "receipt" => $this->input->post('receipt'),
                "date" => $dateOfTrans,
                "dateRecorded" => $dateTime,
                "type" => "delivery receipt",
                "total" => $this->input->post('total'),
                "remarks" => $this->input->post('remarks')
            );
            $drID = $this->baristamodel->add_receiptTransaction($dr);
            if(count($drItems) > 0){
                foreach($drItems as $drItem){
                    $tiID = isset($drItem['tiID']) ? $drItem['tiID'] : NULL;
                    $qty = $drItem['qty'];
                    $status = "complete";
                    $item = $this->baristamodel->get_poItem($tiID);
                    if(!isset($item[0])){
                        $tiID = NULL;
                    }else if($item[0]['tiQty'] > $drItem['qty']){
                        $status = "partial";
                    }
                    $dr = array(
                        "uom" => $drItem['uomID'],
                        "stock" => $drItem['stID'],
                        "name" => $drItem['name'],
                        "price" => $drItem['price'],
                        "discount" => $drItem['discount'],
                        "delivery" => $status,
                        "payment" => NULL,
                        "return" => NULL,
                        "tiQty" => $drItem['qty'],
                        "perUnit" => $drItem['actualQty'],
                        "actual" => $drItem['qty'] * $drItem['actualQty'],
                        "subtotal" => ($drItem['price'] - $drItem['discount']) * $drItem['qty'],
                        "tiID" => $tiID
                    );
                    if($dr['tiID'] == NULL){
                        $dr['tiID'] = $this->baristamodel->add_receiptTransactionItems($dr);
                        $total += $dr['subtotal'];
                        $this->baristamodel->add_receiptTransactionItemsQty($drID, $dr);
                        $log = array(
                            "stock" => $dr['stock'],
                            "qty" => $dr['actual'],
                            "remain" => $this->baristamodel->get_stockQty($dr['stock'])[0]['stQty'] + $dr['actual'],
                            "actual" => NULL,
                            "discrepancy" => NULL,
                            "dateTime" => $dateOfTrans,
                            "dateRecorded" => $dateTime,
                            "remarks" => "delivery"
                        );
                        $this->baristamodel->add_restockLog($drID, $log);
                        $this->baristamodel->update_stockQty($dr['stock'], $dr['actual']);
                    }else{
                        $this->baristamodel->edit_receiptTransactionItems($dr);
                        $total += $dr['subtotal'];
                        $this->baristamodel->add_receiptTransactionItemsQty($drID, $dr);
                        $log = array(
                            "stock" => $dr['stock'],
                            "qty" => $dr['actual'],
                            "remain" => $this->baristamodel->get_stockQty($dr['stock'])[0]['stQty'] + $dr['actual'],
                            "actual" => NULL,
                            "discrepancy" => NULL,
                            "dateTime" => $dateOfTrans,
                            "dateRecorded" => $dateTime,
                            "remarks" => "delivery"
                        );
                        $this->baristamodel->add_restockLog($drID, $log);
                        $this->baristamodel->update_stockQty($dr['stock'], $dr['actual']);
                    }
                }
                $this->baristamodel->edit_receiptTransactionTotal($drID, $total);
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
    //-------------------------------CONSUMPTION
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
            $items = json_decode($this->input->post('items'),true);
            echo json_encode($items);
            if(count($items)> 0){
                $currentDate = date("Y-m-d H:i:s");
                $transDate = $this->input->post('date');
                $con = array(
                    "date" => $transDate,
                    "dateRecorded" => $currentDate,
                    "type" => "consumption",
                    "remarks" => $this->input->post('remarks')
                );
                $conID = $this->baristamodel->add_consumption($con);
                foreach($items as $item){
                    $qty = $this->baristamodel->get_stockQty($item['stock'])[0]['stQty'];
                    $itemID = $this->baristamodel->add_consumedItem($item['stock']);
                    $conItem = array(
                        "id" => $itemID,
                        "qty" => $item['qty'],
                        "remarks" => $item['remarks'],
                        "type" => "consumed",
                        "date" => $transDate,
                        "dateRecorded" => $currentDate,
                        "remain" => $qty - $item['qty'],
                        "stock" => $item['stock']
                    );
                    $this->baristamodel->add_consumptionQty($conID, $conItem);
                    $this->baristamodel->add_consumptionLog($conID, $conItem);
                    $this->baristamodel->deduct_stockQty($conItem['qty'], $conItem['stock']);
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
    function editConsumption(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'barista'){
            $items = json_decode($this->input->post('items'),true);
            if(count($items)> 0){
                $currentDate = date("Y-m-d H:i:s");
                $transDate = $this->input->post('date');
                $con = array(
                    "date" => $transDate,
                    "dateRecorded" => $currentDate,
                    "remarks" => $this->input->post('remarks')
                );
                $conID = $this->baristamodel->edit_consumption($con);
                foreach($items as $item){
                    $qty = $this->baristamodel->get_stockQty($item['stock'])[0]['stQty'];
                    $itemID = $this->baristamodel->add_consumedItem($item['stock']);
                    $conItem = array(
                        "id" => $itemID,
                        "qty" => $item['qty'],
                        "remarks" => $item['remarks'],
                        "type" => "consumption",
                        "date" => $transDate,
                        "dateRecorded" => $currentDate,
                        "remain" => $qty - $item['qty'],
                        "stock" => $item['stock']
                    );
                    $this->baristamodel->add_consumptionQty($conID, $conItem);
                    $this->baristamodel->add_consumptionLog($conID, $conItem);
                    $this->baristamodel->deduct_stockQty($conItem['qty'], $conItem['stock']);
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
