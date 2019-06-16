<?php
class Loginmodel extends CI_Model{

    private $err = array('Username or Password is incorrect!', 'Username or Password is incorrect!');

    function validate($username, $password){
        $query = "select * from accounts where BINARY aUsername = ?";
        $qresult = $this->db->query($query, array($username));
        if($qresult->num_rows() === 1){
            $query = "select * from accounts where BINARY aUsername = ? and aPassword = ?;";
            $qresult = $this->db->query($query, array($username,$password));
            if($qresult->num_rows() === 1){
                return $qresult->result_array();
            }else{
                echo '<div style="background:white;width:25%;margin:auto;padding:10px;border-radius:5px;margin-top:1%;box-shadow:0px 0px 20px 10px rgba(0,0,0,0.3)">
                            <div style="font-size:15px">Warning Message</div><hr style="margin:0;margin-top:1%"><div style="margin-top:3%;margin-bottom:2%;color:grey;font-size:14px;">'.$this->err[1].'</div></div>';
            }
        }else{
            echo '<div style="background:white;width:25%;margin:auto;padding:10px;border-radius:5px;margin-top:1%;box-shadow:0px 0px 20px 10px rgba(0,0,0,0.3)">
                            <div style="font-size:15px">Warning Message</div><hr style="margin:0;margin-top:1%"><div style="margin-top:3%;margin-bottom:2%;color:grey;font-size:14px;">'.$this->err[0].'</div></div>';
        }
    }
}
?>
