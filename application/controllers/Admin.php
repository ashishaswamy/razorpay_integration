<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('AdminModel','admin');
       $this->load->model('RegisterModel','reg');
       
        }
    public function index(){

        $this->load->view('admin_login',$data);
    }
    public function login(){
        $postData = $this->input->post();
       if ($this->input->is_ajax_request()) {
            if(!empty($postData['userName']) && !empty($postData['pwd'])){
                $admin_details = $this->admin->getAdminData($postData);
                if(!empty($admin_details)){
                    $session_data = [
                        'admin_id'  => $postData['admin_id'],
                        'admin_name'  => $postData['userName'],
                        'logged_in' => TRUE
                    ];
                    $this->session->set_userdata($session_data);
                    $data['success']    = true; 
    
                } else {
                    $data['success']    =   false;
                    $data['message']    =   'User not exist as per your details';
                }
    
           } else {
                $data['success']    =   false;
                $data['message']    =   'Username and Password are mandatory';
           }
        } else {
            redirect('admin/index');
        }


       echo json_encode($data);
    }

    public function dashboard(){
        if($this->session->userdata('logged_in')){
            $postData = $this->input->post();
            if(empty($postData)){
                $postData['status'] = 'all';
            }
           
            $data['user_list']  = $this->admin->getUserList($postData['status']);
            $data['status']     = $postData['status'];
            $this->load->view('dashboard',$data);
        }else{
            redirect('admin/index');
        }
    }
    public function edit($id){
        if($this->session->userdata('logged_in')){
            $data['user_data']  = $this->admin->getUserData($id);  
            $this->load->view('edit',$data);
        }else{
            redirect('admin/index');
        }
    }

    public function editUser(){
        if($this->session->userdata('logged_in')){

            $postData = $this->input->post();

            if(!empty($postData['firstName']) && !empty($postData['emailID']) && !empty($postData['phnNum'])){
            
                $userExist = $this->reg->checkUserExist($postData['emailID']);
                if(empty($userExist) || ($userExist['user_id'] == $postData['uid'])){
                    if(strlen($postData['phnNum']) == 10){
                        $this->admin->updateUser($postData);
                            $data['success'] = true;
                            $data['message'] = 'User updated successfully';
                    } else {
                        $data['success'] = false;
                        $data['message'] = 'Phone Number should be 10 digit';
                    }
                } else {

                    $data['success'] = false;
                    $data['message'] = 'User already exist with same email';
        
                }
            } else {
                $data['success'] = false;
                $data['message'] = 'First Name, Email ID, Phone Number are mandatory';

            }
        
        echo json_encode($data);
        }else{
            redirect('admin/index');
        }
    }

    public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('admin/index');
    }
}