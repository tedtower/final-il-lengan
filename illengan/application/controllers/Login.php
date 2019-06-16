<?php
class Login extends CI_Controller{
   function __construct(){
        parent:: __construct();
        $this->load->model('loginmodel');  
    }
	
    function viewlogin(){
        if($this->session->userdata('user_id') && $this->session->userdata('user_type')){
            $this->homeRedirect();
        }else{
            $this->load->view('login');
        }
    }

    function check_cred(){
        $uname = $this->input->post('username');
        $pword = $this->input->post('password');
        $loginAttempt = $this->loginmodel->validate($uname,$pword);
        if(is_array($loginAttempt)){
            $user_data = array(
                'user_id' => $loginAttempt[0]['aID'],
                'user_name' => ucfirst($loginAttempt[0]['aUsername']),
                'user_type' => $loginAttempt[0]['aType']
            );
            $this->session->set_userdata($user_data);
            $this->homeRedirect();
        }else{
            $data['err'] = $loginAttempt;
            $this->load->view('login',$data);
        }
    }

    function homeRedirect(){        
        switch ($this->session->userdata('user_type')){
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'barista':
                redirect('barista/orders');
                break;
            case 'chef':
                redirect('chef');
                break;
            case 'customer':
                redirect('customer/menu');
                break;
        }
    }

    function logout() {
		if($this->session->userdata('user_id') && $this->session->userdata('user_type')){
			$this->session->sess_destroy();
		}
		redirect('login');		
    }

}
?>
