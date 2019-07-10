<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajaxsearch extends CI_Controller
{

    function index()
    {
        $this->load->view('ajaxsearch');
    }

    function fetch()
    {
        $output = '';
        $query = '';
        $this->load->model('ajaxsearch_model');
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->ajaxsearch_model->fetch_data($query);
        $output .= '

  <table id="accountsTable" class="table table-bordered dt-responsive text-center nowrap" cellspacing="0" width="100%">
    <thead class="thead-dark">
        <th><b class="pull-left">Account No.</b></th>
        <th><b class="pull-left">Type</b></th>
        <th><b class="pull-left">Username</b></th>
        <th><b class="pull-left">Status</b></th>
        <th><b class="pull-left">Actions</b></th>
    </thead>
  ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
      <tr>
       <td>' . $row->aID . '</td>
       <td>' . $row->aType . '</td>
       <td>' . $row->aUsername . '</td>
       <td>' . $row->aStatus . '</td>
      </tr>
    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="5">No Data Found</td>
      </tr>';
        }
        $output .= '</table>';
        echo $output;
    }
}