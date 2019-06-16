<?php
class Admindelete extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model('adminmodel'); 
        date_default_timezone_set('Asia/Manila');  
        // code for getting current date : date("Y-m-d")
        // code for getting current date and time : date("Y-m-d 2H:i:s")
    }

    function deleteAccount(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('accountId', 'Account Id', 'trim|required');
            if($this->form_validation->run()){
                $accountId = trim($this->input->post("accountId"));
                $date_recorded=date("Y-m-d H:i:s");
                $this->adminmodel->delete_account($accountId);
               
            }else{
                 redirect('admin/accounts');
            } 

        }else{
            redirect('login');
        }  
    }

    function deleteAddon($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
                $this->adminmodel->delete_addon($id);
                redirect('admin/menu/addons');
            
        }else{
            redirect('login');
        }    
    }
    function deleteMeasurement($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
                $this->adminmodel->delete_uom($id);
                redirect('admin/measurements');
            
        }else{
            redirect('login');
        }    
    }
    function deleteMenu($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
                $this->adminmodel->delete_menu($id);
                redirect('admin/menu');
            
        }else{
            redirect('login');
        }    
    }
    function deleteMenuCategory($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->adminmodel->delete_category($id);
            redirect('admin/menucategories');
        }else{
            redirect('login');
        }
    }
    function deletestockspoilages(){
        
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('accountId', 'Account Id', 'trim|required');
            if($this->form_validation->run()){
                $ssID = trim($this->input->post("ssID"));
                $delRemarks = $this->input->post("delRemarks");
                $dateRecorded =  date("Y-m-d H:i:s");
                $type = "delete";
                $this->adminmodel->delete_account($ssID,$delRemarks,$dateRecorded,$type);
               
            }else{
                echo $accountID;
               redirect('admin/stock/spoilages');
            } 

        }else{
            redirect('login');
        }  
    }
    function deletemenuspoilages($sid){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            
            $this->adminmodel->delete_spoilages($sid); 
            redirect('admin/menu/spoilages');
        }else{
            redirect('login');
        }
    }
    function deleteaddonsspoilages($sid){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            
            $this->adminmodel->delete_spoilages($sid); 
            redirect('admin/addons/spoilages');
        }else{
            redirect('login');
        }
    }
    function deleteStockCategory($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->adminmodel->delete_category($id);
            redirect('admin/stockcategories');
        }else{
            redirect('login');
        }
    }
    function deleteStockItem($stock_id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_stockitem($stock_id)){
                redirect('admin/inventory');
            }else{           
                $this->viewInventory("");
            }
        }else{
            redirect('login');
        }
    }    
    function deleteTable(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            $this->form_validation->set_rules('tableCode', 'Table Code', 'trim|required|alpha_numeric_spaces');
            if($this->form_validation->run()){
                $tableCode = trim($this->input->post("tableCode"));
                if($this->adminmodel->delete_table($tableCode)){
                    $this->output->set_output(json_encode($this->adminmodel->get_tables()));
                }else{
                    redirect('admin/tables');
                }
            }else{
                redirect('admin/tables');
            }
        }else{
            redirect('login');
        }
    }    
    function deleteSource($id){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type') === 'admin'){
            if($this->adminmodel->delete_supplier($id)){
                redirect('admin/supplier');
            }else{
                echo "There was an error";
            }
        }else{
            redirect('login');
        }
    }    
    function delete_menu(){
        $id = $this->uri->segment(3);
        $this->adminmodel->delete_menu($id);
        $this->viewMenu();
    }
}
?>
