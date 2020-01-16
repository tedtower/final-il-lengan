<?php
class LoginModel extends CI_Model {
    
    private $err = array('Username or Password is incorrect!', 'Username or Password is incorrect!');

    function validate($username, $password){
        $query = "select * from accounts where aUsername = ?";
        $qresult = $this->db->query($query, array($username));
        if($qresult->num_rows() === 1){
            $details = $qresult->row(1);
            if(password_verify($password,$details->aPassword)){
                return $qresult->result_array();
            } else {
                $this->sendAuthError($this->err[1]);    
            }
        } else {
            $this->sendAuthError($this->err[0]);
        }
    }

    function sendAuthError($err){
        echo '<div style="background:white;width:25%;margin:auto;padding:10px;border-radius:5px;margin-top:1%;box-shadow:0px 0px 20px 10px rgba(0,0,0,0.3)"><div style="font-size:15px">Warning Message</div><hr style="margin:0;margin-top:1%"><div style="margin-top:3%;margin-bottom:2%;color:grey;font-size:14px;">'.$err.'</div></div>';
    }

    function set_isOnline($id, $stat){
        $query = "UPDATE accounts SET aIsOnline = ? WHERE aID = ?";
        return $this->db->query($query, array($stat, $id));
    }

}

?>