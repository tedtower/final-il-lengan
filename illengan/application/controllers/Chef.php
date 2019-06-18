<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chef extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->model('Chefmodel');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d H:i:s")
	}

	function checkIfLoggedIn(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'chef'){
            return true;
        }
        return false;
	}
	
	function index()
	{
		if($this->checkIfLoggedIn()){
			$data['title'] = " ";
			$this->load->view('chef/head', $data);	
			$this->load->view('chef/chef');
        }else{
            redirect('login');
        } 
	}

// --------------- M E N U  S P O I L A G E S ----------------- 
	function get_orderlist() {
		$data = array();
        $data['orders'] = $this->Chefmodel->get_orders();
        $data['addons'] = $this->Chefmodel->get_addons();
        
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
		
	}

// --------------- I N V E N T O R Y ----------------- 

	function viewinventory(){
		$data['title'] = " Inventory";
		$this->load->view('chef/head', $data);		
		$this->load->view('chef/navigation');
		$this->load->view('chef/chefInventory'); 
	}
	function inventoryJS(){
		echo json_encode($this->Chefmodel->get_inventory());
	}
	function restockitem(){
		$stocks = json_decode($this->input->post('stocks'), true);
		echo json_encode($stocks, true);
		$this->Chefmodel->restock($stocks);
	}
	function destockitem(){
		$stocks = json_decode($this->input->post('stocks'), true);
		echo json_encode($stocks, true);
		$this->Chefmodel->destock($stocks);
	}

// ------------  V I E W  S T O C K  A N D  M E N U  ------------- 
	function viewStockJS() {
		$data=$this->Chefmodel->get_stocks();
		header('Content-Type: application/json');
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	function viewMenuJS() {
		$data = $this->Chefmodel->get_menuPref();
		header('Content-Type: application/json');
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

// --------------- M E N U  S P O I L A G E S ----------------- 
	function viewSpoilagesMenu(){
		if($this->checkIfLoggedIn()){
			$data['title'] = " Menu Spoilages";
			$this->load->view('chef/head', $data);
			$this->load->view('chef/navigation');
			$this->load->view('chef/scripts');
			$this->load->view('chef/chefMenuSpoilages');
		}else{
			redirect('login');
		}
	}

    function viewSpoilagesMenuJs(){
        if($this->checkIfLoggedIn()){
            $data= $this->Chefmodel->get_spoilagesmenu();
            echo json_encode($data);
            
        }else{
            redirect('login');
        }
    }
   
	function editMenuSpoil(){
		if($this->checkIfLoggedIn()){
            $msID = $this->input->post('msID');
            $prID = $this->input->post('prID');
            $msQty = $this->input->post('msQty');
            $msDate = $this->input->post('msDate');
            $msRemarks = $this->input->post('msRemarks');
            $date_recorded = date("Y-m-d H:i:s");

            $this->chefmodel->edit_menuspoilage($msID,$prID,$msQty,$msDate,$msRemarks,$date_recorded);
        }else{
            redirect('login');
        } 
	}
	
	function addspoilagesmenu(){
		if($this->checkIfLoggedIn()){
            $date_recorded = date("Y-m-d H:i:s");
			$menus = json_decode($this->input->post('menus'), true);
			
            echo json_encode($menus, true);
            $this->Chefmodel->add_menuspoil($date_recorded,$menus);
           
        }else{
            redirect('login');
        }
	}

	
// --------------- S T O C K  S P O I L A G E S ----------------- 
	function viewSpoilagesStockJs(){
		if($this->checkIfLoggedIn()){
			$data= $this->Chefmodel->get_spoilagesstock();
			echo json_encode($data);
			
		}else{
			redirect('login');
		}
	}

	function viewSpoilagesStock(){
		if($this->checkIfLoggedIn()){
			$data['title'] = " Stock Spoilages";
			$this->load->view('chef/head', $data);
			$this->load->view('chef/navigation');
			$this->load->view('chef/chefStockSpoilages');
		}else{
			redirect('login');
		}
	}

	function addspoilagesstock(){
		if($this->checkIfLoggedIn()){
            $date_recorded = date("Y-m-d H:i:s");
            $slType = "spoilage";
            $stocks = json_decode($this->input->post('stocks'), true);
            echo json_encode($stocks, true);
            $this->Chefmodel->add_stockspoil($date_recorded,$stocks,$slType);
            
        }else{
            redirect('login');
        }
	}
	
	function editStockSpoil(){
        if($this->checkIfLoggedIn()){
            $stID = $this->input->post('stID');
            $ssID=$this->input->post('ssID');
            $ssDate=$this->input->post('ssDate');
            $ssRemarks=$this->input->post('ssRemarks');
            $stQty = $this->input->post('stQty');
            $ssQtyUpdate = $this->input->post('ssQtyUpdate');
            $curSsQty = $this->input->post('curSsQty');
            $updateQtyh = $ssQtyUpdate - $curSsQty; 
            $updateQtyl = $curSsQty - $ssQtyUpdate;
            $date_recorded=date("Y-m-d H:i:s");
            $slType = "spoilage";
            $slDateTime = date('Y-m-d', strtotime($ssDate));

            $this->Chefmodel->edit_stockspoilage($ssID,$stID,$ssDate,$ssRemarks,$updateQtyh,$updateQtyl,$curSsQty,$stQty,$ssQtyUpdate,$date_recorded);
            $this->Chefmodel->add_stockLog2($stID, $slType, $date_recorded, $slDateTime, $ssQty, $ssRemarks, $updateQtyh, $updateQtyl,$curSsQty,$ssQtyUpdate);
           
        }else{
            redirect('login');
        } 
	}


	
	

	
   
}
