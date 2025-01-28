<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
    parent::__construct();
   $this->load->model('RegisterModel','reg');
   
    }

    public function index(){

        //SSSSS$this->load->config('config'); 

        $keyId = $this->config->item('keyId');
        $keySecret = $this->config->item('keySecret');
        $data['keyId'] = $keyId;
        $data['keySecret'] = $keySecret;
        $this->load->view('register',$data);
    }

    public function saveUserData(){

        $postData = $this->input->post();

        if(!empty($postData['firstName']) && !empty($postData['emailID']) && !empty($postData['phone'])){

            $userExist = $this->reg->checkUserExist($postData['emailID']);

            if(empty($userExist)){
                if(strlen($postData['phone']) == 10){
                    $user_id = $this->reg->saveUserData($postData);
                    if(!empty($user_id)){
                        $data['user_id'] = $user_id;
                        $data['success'] = true;
                    }else {
                        $data['success'] = false;
                        $data['message'] = 'Failed';
                    }
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
    }

    public function updatePaymentStatus(){
        $postData = $this->input->post();
        if(!empty($postData['payment_id']) && !empty($postData['user_id'])){

            $this->reg->updateUserData($postData['user_id']);
            $data['success'] = true;
        }else{
            $data['success'] = false;
        }

        echo json_encode($data);

    }
    

}
