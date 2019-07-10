<?php
class Ajaxsearch_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("accounts");
  if($query != '')
  {
   $this->db->like('aID', $query);
   $this->db->or_like('aType', $query);
   $this->db->or_like('aUsername', $query);
   $this->db->or_like('aStatus', $query);
  }
  $this->db->order_by('aID', 'DESC');
  return $this->db->get();
 }
}
?>