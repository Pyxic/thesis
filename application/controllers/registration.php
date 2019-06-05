<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('registration2');
	}
	function addUser(){
		$data['name'] = stripcslashes($_POST["name"]); 
		$data['email'] = stripcslashes($_POST["email"]); 
		$data['serName'] = stripcslashes($_POST["sername"]); 
		$data['status']=3;
		$data['departId']=0;
		$data['phone'] = $_POST['phone'];
		$data['password'] = md5(stripcslashes($_POST["pass"]));
		$dataCompany['nameCompany'] = stripcslashes($_POST["nameCompany"]); 
		$this->load->model('registration_model');
		$allUsers = $this->registration_model->allUsers();
		$allCompanies = $this->registration_model->getAllCompanies();
		$addUser = true;
		$error = "";
		foreach($allUsers as $user){
			if($user['serName']==$data['serName'] or $data['email']==$user['email']){
				$addUser = false;
				$error = "<div class='bg-danger'>Пользователь с таким email уже существует</div>";
			}
		}
		foreach($allCompanies as $Company){
			if($dataCompany['nameCompany']==$Company['NameCompany']){
				$addUser = false;
				$error = "<div class='bg-danger'>Компания с таким именем уже существует</div>";
			}
		}
		if($addUser == true){
			$Id = $this->registration_model->regUser($data,$dataCompany);
			$this->session->set_userdata('companyId',$Id['companyId']);
			$this->session->set_userdata('userId',$Id['userId']);
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
				'error' => $error
			);
			echo json_encode($answer);
		}
	}
	function addEmployee($email,$id,$depart=""){
		$data['email'] = $email;
		$data['companyId'] = $id;
		if($depart!=""){
			$data['depart']=$depart;
		}else{$data['depart']=0;}
		$this->load->view('registrationEmployee',$data);
	}
	function registerEmployee(){
		$data['name'] = htmlspecialchars($_POST["name"]); 
		$data['email'] = htmlspecialchars($_POST["email"]); 
		$data['serName'] = htmlspecialchars($_POST["sername"]); 
		$data['status']=2;
		if(isset($_POST['depart'])){
			$data['departId']=$_POST['depart'];
		}else{
			$data['departId']=0;
		}
		$data['password'] = md5(htmlspecialchars($_POST["pass"]));
		$data['companyId'] = htmlspecialchars($_POST['companyId']);
		$data['phone'] = htmlspecialchars($_POST['phone']);
		$this->load->model('registration_model');
		$userId = $this->registration_model->addEmployee($data);
		$this->session->set_userdata('companyId',$data['companyId']);
		$this->session->set_userdata('userId',$userId);
		if(isset($_SESSION['userId'])){
			$this->load->helper('url');
			redirect('/projects');
		}
	}
}
