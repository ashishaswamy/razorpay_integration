<?php
//Below Controller work on this base path only http://localhost/Codeignitor_3/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model{


    public function __construct() {
        parent::__construct();
        $this->load->config('config');
    }
    public function saveUserData($postData){

        $data = [
            'user_first_name' => $postData['firstName'],
            'user_last_name'  => $postData['lastName'],
            'user_email'      => $postData['emailID'],
            'user_phone_number'      => $postData['phone'],
            'user_payment_status'     => 'pending'
        ];


        $insert_id = $this->db->insert('user_details', $data);
        return $this->db->insert_id();;

    }

    public function checkUserExist($email){

        $this->db->select('user_id');
        $this->db->from('user_details');
        $this->db->where('user_email',$email);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function updateUserData($id){

        $data['user_payment_status'] = 'success';

        return $this->db->where('user_id',$id)->update('user_details',$data);
    }

}