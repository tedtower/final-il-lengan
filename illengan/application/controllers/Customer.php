<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once($_SERVER["DOCUMENT_ROOT"]."/application/helpers/utility_helper.php");
class Customer extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model("customermodel");
        date_default_timezone_set('Asia/Manila');  
	}

	//Checks if the user is logged in. *DON'T CHANGE*
	function isLoggedIn(){
		if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'customer' || 'barista'){
			return true;			
		}else{
			return false;
		}
	}

	//Checks if the customer has a table *DON'T CHANGE*
	function isCheckedIn(){
		if($this->session->userdata('table_no')!= NULL){
			return true;
		}else{
			return false;
		}
	}

	//Checking in of customers *CONSULT BEFORE MODIFYING*
	function checkIn(){
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				redirect('customer/menu');
			}else{
				$data['number'] = $this->customermodel->get_tables();
				$this->load->view('customer/checkin', $data);
			}
		}else{
			redirect('login');
		}
	}

	//Unsets session variables and redirects to checkin
	function checkout(){
		$this->session->unset_userdata('cust_name');
		$this->session->unset_userdata('table_no');
		$this->session->unset_userdata('orders');
		redirect('customer/checkin');
	}
	
	//Sets the customer's name and table as session variable
	public function processCheckin(){
		if($this->isLoggedIn()){
			$cust_name = $this->input->post('cust_name');
			$table_no['table_code'] = $this->input->post('table_no');
				if ($cust_name != NULL || $table_no != NULL) {
					$data= array(
						'cust_name' => $cust_name,
						'table_no' => $table_no
					);
					$this->session->set_userdata($data);
					redirect('customer/menu');
				} else {
					redirect('customer/checkin');
				}
		}else{
			redirect('login');
		}
	}

	//View Pages *CONSULT BEFORE ADDING THINGS*
	function view($page = 'menu'){
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$data = array ();
				$data['categories'] = $this->customermodel->fetch_category();
				$data['menu'] = $this->customermodel->fetch_menu();
				$data['subcats'] = $this->customermodel->fetch_availableSubcategory();
				sort($data['subcats']);
				$data['pref_menu'] = $this->customermodel->fetch_menupref();
				$data['addons'] = $this->customermodel->fetch_addon();
				$data['orders'] = $this->session->userdata('orders');
				$this->load->view('customer/template/head',$data);
				$this->load->view('customer/menu');
				$this->load->view('customer/template/foot');
				$this->load->view('customer/template/modal_func');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}
	function category($id){
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$data = array(
					'categories' => $this->customermodel->fetch_category(),
					'subcats' => $this->customermodel->fetch_availableSubcategory1($id),
					'menu' => $this->customermodel->fetch_menu(),
					'pref_menu'=> $this->customermodel->fetch_menupref(),
					'addons' => $this->customermodel->fetch_addon(),
					'orders' => $this->session->userdata('orders')
				);
				$this->load->view('customer/template/head',$data);
				$this->load->view('customer/menu');
				$this->load->view('customer/template/foot');
				$this->load->view('customer/template/modal_func');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}
	//Adds selected menu item in the cart
	function addOrder() {
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$preference = $this->customermodel->get_preference($this->input->post('preference'))[0];
				$rawAddons = json_decode($this->input->post('addons'),true);
				if(empty($rawAddons['addonIds'])){
					$rawAddons = "";
				}else{
					$addonsPrices = $this->customermodel->get_addonPrices($rawAddons['addonIds']);					
					for($index = 0 ; $index < count($rawAddons['addonIds']) ; $index++){
						foreach($addonsPrices as $addon){
							if($addon['aoID'] == $rawAddons['addonIds'][$index]){
								$rawAddons['addonIds'][$index] = intval($rawAddons['addonIds'][$index]);
								$rawAddons['addonQtys'][$index] = intval($rawAddons['addonQtys'][$index]);
								array_push($rawAddons['addonSubtotals'], intval($this->input->post('quantity')) * (floatval($addon['aoPrice'])*intval($rawAddons['addonQtys'][$index])));
							}
						}
					}
				}
				$data = array(
					'id' => intval($this->input->post('preference')),
					'menu_id' => intval($preference['mID']),
					'name' => $preference['order'],
					'qty' => intval($this->input->post('quantity')),
					'orderDesc' => $preference['order'],
					'subtotal' => (floatval($preference["prPrice"]) * intval($this->input->post('quantity'))) + get_sum($rawAddons["addonSubtotals"]) ,
					'remarks' => $this->input->post('remarks'),
					'addons' => $rawAddons
				);
				if(!$this->session->has_userdata('orders')){
					$this->session->set_userdata('orders',array());
				}
				$order = $this->session->userdata('orders');
				array_push($order, $data);
				$this->session->set_userdata('orders', $order);
				echo json_encode($this->session->userdata('orders'));
				//term for adding as a temporary order
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function viewOrders(){
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$this->load->view('customer/modals/order_modal');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	
	function completeOrder(){		
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$dateTime = date('Y-m-d H:i:s');
				$tableCode = $this->input->post('table_no');
				$customer = $this->input->post('cust_name');
				$orderlist = $this->session->userdata('orders');
				$total = $this->input->post('total');
				$this->customermodel->orderInsert($total, $tableCode, $orderlist, $customer, $dateTime);
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}
	
	
	function clearOrder(){
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$this->session->unset_userdata('orders');
				redirect('customer/menu');
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function editOrder() {
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$id = $this->input->post('rowID');
				$preference = $this->customermodel->get_preference($this->input->post('preference'))[0];
				$rawAddons = json_decode($this->input->post('addons'),true);
				for($index = 0; $index < count($rawAddons['addonIds']); $index++){
					$rawAddons['addonIds'][$index] = intval($rawAddons['addonIds'][$index]);
					$rawAddons['addonQtys'][$index] = intval($rawAddons['addonQtys'][$index]);
					$rawAddons['addonSubtotals'][$index] = floatval($rawAddons['addonSubtotals'][$index]);
				}
				$data = array(
					'id' => intval($this->input->post('preference')),
					'menu_id' => intval($preference['mID']),
					'name' => $preference['order'],
					'qty' => intval($this->input->post('quantity')),
					'orderDesc' => $preference['order'],
					'unit_price' => intval($preference['prPrice']),
					'subtotal' => floatval($this->input->post('subtotal')),
					'remarks' => $this->input->post('remarks'),
					'addons' => $rawAddons
				);
				unset($_SESSION['orders'][$id]);
				array_push($_SESSION['orders'], $data);
				rsort($_SESSION['orders']);
				echo json_encode($_SESSION['orders']);
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function removeOrder() {	
		if($this->isLoggedIn()){			
			if($this->isCheckedIn()){
				$id = $this->input->post('id');
				unset($_SESSION['orders'][$id]);
				rsort($_SESSION['orders']);
				echo json_encode($_SESSION['orders']);
			}else{
				redirect('customer/checkin');
			}
		}else{
			redirect('login');
		}
	}

	function promos() {
		if($this->isLoggedIn()){
			if($this->isCheckedIn()){
				$data = $this->customermodel->fetch_promos();
				echo json_encode($data);
			}else{
				redirect('customer/checkin');
			}	
		}else{
			redirect('login');
		}
	}

	function freebies_discounts() {
			$pref_id = $this->input->post('pref_id');
			$data = array();
			$data['freebies'] = $this->customermodel->fetch_freebies($pref_id);
			$data['discounts'] = $this->customermodel->fetch_discounts($pref_id);
	
			echo json_encode($data);
	}
 }
?>
