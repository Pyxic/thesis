<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function index()
	{
		$this->load->view('autorization2');
    }
    function enterHead(){
        $email = stripcslashes($_POST["email"]); 
        $password = md5(stripcslashes($_POST["pass"]));
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email'=>$email,'password'=>$password));
        $query = $this->db->get();
        $user = $query->row();
        if(isset($user->email)){
            $this->session->set_userdata('companyId',$user->companyId);
            $this->session->set_userdata('userId',$user->userID); 
            if(isset($_SESSION['userId'])){
                $answer = array(
                    'command' => 1,
                    'location' => '/diplom/index.php/projects'
                );
			    echo json_encode($answer);
		    }   
        }else{
            $answer = array(
                'command' => 'error',
                'alert' => true,
                'error' => 'email или пароль введены неверно'
            );
            echo json_encode($answer);
        }
    }
}