<?php
//Below Controller work on this base path only http://localhost/Codeignitor_3/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->config('config');
    }

    public function getAdminData($data){

        $this->db->select('admin_id');
        $this->db->from('admin_data');
        $this->db->where('admin_email',$data['userName']);
        $this->db->where('admin_password',md5($data['pwd']));
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function getUserList($status=''){
        
        $this->db->select('*');
        $this->db->from('user_details');
        if($status != 'all'){
            $this->db->where('user_payment_status',$status);
        }  
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getUserData($id){
        
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('user_id',$id); 
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function updateUser($postData){

        $data = [
            'user_first_name' => $postData['firstName'],
            'user_last_name'  => $postData['lastName'],
            'user_email'      => $postData['emailID'],
            'user_phone_number'      => $postData['phnNum']
        ];
        return $this->db->where('user_id',$postData['uid'])->update('user_details',$data);

    }


}