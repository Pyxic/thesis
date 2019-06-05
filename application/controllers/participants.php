<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;

class Participants extends CI_Controller {
    public function index()
	{
        $companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$this->load->model('projects_model');
		$this->load->model('users_model');
		$data['access'] = $this->users_model->getAccess();
		$user= $this->projects_model->getInitials($userId);
		$data['head'] = $user;
		$data['departments'] = $this->projects_model->getDepartments($companyId);
		$data['users'] = $this->projects_model->getUsers($companyId);
		$this->load->view('participants',$data);
	}
	public function inviteUser(){
		$email = htmlspecialchars($_POST['email']);
		$name = htmlspecialchars($_POST['name']);
		$create = $_POST['createBool'];
		$depart=false;
		if($_POST['createDepart']!="no"){
			$this->load->model("projects_model");
			$check = $this->projects_model->createDepart($_POST['createDepart'],$this->session->userdata('companyId'),$create);
			if($check == false&&$create==1){
				$answer = array(
					"command" => "error",
					"alert" => true,
					"error" => "Такой отдел уже существует"
				);
				echo json_encode($answer);
				return;
			}else{
				$depart=$check;
			}
		}
		$this->load->model("users_model");
		$fullName = $this->users_model->getFullName();
		$emailHead = $this->users_model->getEmail();
		$nameCompany = $this->users_model->getCompanyName();
		if($this->users_model->checkUser($email)==true){
			require './vendor/autoload.php';
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '465';
			$mail->isHTML();
			$mail->Username = 'your username';
			$mail->Password = 'Password';
			$mail->SetFrom('email');
			$mail->Subject = "Приглашение в систему";
			$mail->AddCustomHeader ('Content-Type: text/html; charset="utf-8"');
			$mail->CharSet = "utf-8";
			$companyId = $this->session->userdata('companyId');
			$comapanyName = $this->users_model->getCompanyName();
			if($depart==false){
					$mail->Body = "Здраствуйте, $name! Вас приветствует система управления проектами MIPROJECT. Пользователь $fullName->name $fullName->serName $emailHead приглашает вас в компанию $nameCompany.  Чтобы принять приглашение перейдите по ссылке http://localhost/diplom/index.php/registration/addEmployee/$email/$companyId";
			}else{
				$mail->Body = "Здраствуйте, $name! Вас приветствует система управления проектами MIPROJECT. Пользователь $fullName->name $fullName->serName $emailHead приглашает вас в компанию $nameCompany. Чтобы принять приглашение перейдите по ссылке http://localhost/diplom/index.php/registration/addEmployee/$email/$companyId/$depart";
			}
			$mail->AddAddress($email);
			$mail->Send();
			$this->load->helper('url');
			$answer = array(
				"command" => 1,
				"location" => "/diplom/index.php/participants"
			);
			echo json_encode($answer);
		}else{
			$answer = array(
				"command" => "error",
				"alert" => true,
				"error" => "Пользователь уже есть в системе"
			);
			echo json_encode($answer);
		}
	}
	function createDepart(){
		//$name = mb_convert_encoding($name, "UTF-8",mb_detect_encoding($name));
		$name = $_POST['name'];
		$this->load->model("projects_model");
			$check = $this->projects_model->createDepart($name,$this->session->userdata('companyId'),1);
			if($check == false){
				$answer = array(
					"command" => "error",
					"alert" => true,
					"error" => "Такой отдел уже существует"
				);
				echo json_encode($answer);
			}else{
				$answer = array(
					"command" => 1
				);
				echo json_encode($answer);
			}
	}
	function addToDepart(){
		$departId = $_POST['departId'];
		$this->load->model("users_model");
		$answer=[];
		$users = $this->users_model->getNoDepart($departId);
		echo json_encode($users);
	}
	function addInDepart(){
		$id = $_POST['id'];
		$departId = $_POST['departId'];
		$this->load->model("users_model");
		$depart =  $this->users_model->setDepart($id,$departId);
		if($depart==false){
			$answer = array(
				"command" =>"error",
				"confirm" =>true,
				"error" => "Пользователь уже состоит в другом отделе! Хотите его перевести в этот отдел?"
			);
			echo json_encode($answer);
		}else{
			$answer = array(
				"command" => 1
			);
			echo json_encode($answer);
		}
	}
	function changeDepart($id,$departId){
		$data['departId'] = $departId;
		$this->db->update("users",$data,"userID=$id");
		$this->load->helper("url");
		redirect("/participants");
	}
}
