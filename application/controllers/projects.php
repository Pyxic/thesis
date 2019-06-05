<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

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
		$companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$this->load->model('projects_model');
		$this->load->model('users_model');
		$data['departments'] = $this->projects_model->getDepartments($companyId);
		$user= $this->projects_model->getInitials($userId);
		$data['access'] = $this->users_model->getAccess();
		$data['head'] = $user;
		$data['users'] = $this->projects_model->getUsers($companyId);
		$data['completed'] = $this->projects_model->getPersentageCompleted($companyId);
		if($data['access']==2){
			$data['projects'] = $this->projects_model->getProjects($companyId);
		}else{
			$data['projects'] = $this->projects_model->getMyProjects($companyId);	
		}
		$this->load->view('projects',$data);
	}
	function createProject(){
		$companyId = $this->session->userdata('companyId');
		$data['nameProject'] = stripslashes($_POST["nameProject"]); 
		$date =preg_split("/\//",stripslashes($_POST["stDate"]));
		$data['startDate'] = $date[2]."/".$date[0]."/".$date[1];
		$date =preg_split("/\//",stripslashes($_POST["endDate"]));
		$data['endDate'] =  $date[2]."/".$date[0]."/".$date[1];
		$date1 = date($data['startDate']);
		$date2 =date($data['endDate']);
		if($date1<=$date2){
			$this->load->model('projects_model');
			$id =$this->projects_model->getUserId($_POST['Head']);
			$this->db->select("countProjects");
        	$this->db->from("users");
        	$this->db->where("userID=$id");
        	$query = $this->db->get();
        	$row = $query->row();
        	$countProjects =$row->countProjects;
        	if($countProjects>=3){
            	$answer = array(
					'command' => 'error',
					'alert' => true,
					'error' => 'Пользователь уже участвует в трёх проектах'
				);
				echo json_encode($answer);
				return;
        	}
			$data['userID'] = $this->projects_model->getUserId($_POST['Head']);
			$data['companyId'] = $companyId;
			$memberData['userID'] = $data['userID'];
			$memberData['companyId']= $companyId;
			$projectId = $this->projects_model->createProject($data,$memberData);
			$countProjects = (int)$countProjects+1;
			$this->db->update("users",["countProjects"=>$countProjects],'userID='.$data['userID']);
			$answer = array(
				'command' => 'reload'
			);
			echo json_encode($answer);
		}else{
			$answer = array(
				'command' => 'error',
				'alert' => true,
				'error' => 'Дата окончания должна быть больше даты начала'
			);
			echo json_encode($answer);
		}
	}
	function createTask($id,$bool=1){
		$data['name'] = htmlspecialchars($_POST["nameTask"]);
		$date =preg_split("/\//",htmlspecialchars($_POST["stDate"]));
		$data['actualStart'] = $date[2]."/".$date[0]."/".$date[1];
		$date =preg_split("/\//",htmlspecialchars($_POST["endDate"]));
		$data['actualEnd'] =  $date[2]."/".$date[0]."/".$date[1];
		$head = htmlspecialchars($_POST["Head"]);
		$date1 = date($data['actualStart']);
		$date2 =date($data['actualEnd']);
		if($date1<=$date2){
			$this->load->model('projects_model');
			$data['userID'] = $this->projects_model->getUserId($head);
			$data['projectId'] = $id;
			if($_POST['importance']!=""){$data['importance'] = htmlspecialchars($_POST['importance']);}else{
				$data['importance']= null;
			}
			$data['statusTask'] = htmlspecialchars($_POST['statusTask']);
				if(isset($_POST['gantt']) and $_POST['gantt']=="изменить"){
					$taskId = htmlspecialchars($_POST['taskIdUp']);
					$this->load->model("tasks_model");
					$this->tasks_model->updateTask($data,$taskId,$bool);
				}else{
				$data['descrip'] = $_POST['description'];
				$this->projects_model->createTask($data);	
				}
			if(isset($_POST['gantt'])){
				$answer = array(
					'command' => 1,
					'location' => "/diplom/index.php/gant/index/$id"
				);
				echo json_encode($answer);
			}else {
				$answer = array(
					'command' => 1,
					'location' => "/diplom/index.php/projects/structure/$id"
				);
				echo json_encode($answer);
			}
		}else{
			$answer = array(
				'command' => 'error',
				'alert' => true,
				'error' => "Дата окончания должна быть больше даты начала"
			);
			echo json_encode($answer);
		}
	}

	function settings($id){

		$this->load->view('settings');
	}
	function structure($id){
		$data['idProject']=$id;
		$companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$data['userId'] = $userId;
		$this->load->model('projects_model');
		$this->load->model('users_model');
		$data['dateProject'] = $this->projects_model->getDateProject($id);
		$data['departments'] = $this->projects_model->getDepartments($companyId);
		$data['access'] = $this->users_model->getAccess();
		$data['currentUser'] = $this->users_model->getCurrentUser();
		$data['fullName'] = $this->users_model->getFullName();
		$user = $this->projects_model->getInitials($userId);
		$data['usersProject'] = $this->projects_model->getPU($id,$companyId);
		$data['addPart'] = $this->projects_model->getNoParticipants($id,$companyId);
		$data['headProject'] = $this->projects_model->getHeadProject($id);
		$data['nameProject'] =$this->projects_model->getProjectName($id);
		$data['users'] = $this->projects_model->getUsersProject($companyId,$id);
		$data['tasks'] = $this->projects_model->getTasks($id,true);
		$data['withoutUser'] = $this->projects_model->getTasksWithoutuser($id);
		$data['overdues'] = $this->projects_model->getOverdueTasks($id);
		$data['checkTasks'] = $this->projects_model->getcheckTasks($id);
		$this->load->view('tasks',$data);
	}
	function myTasks($id){
		$data['idProject']=$id;
		$companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$this->load->model('projects_model');
		$this->load->model('users_model');
		$data['access'] = $this->users_model->getAccess();
		$data['userId'] = $userId;
		$data['headProject'] = $this->projects_model->getHeadProject($id);
		$data['currentUser'] = $this->users_model->getFullName();
		$data['idUserHead'] = $this->projects_model->getIdUserHead($id);
		$data['tasks'] = $this->projects_model->getmyTasks($id,true,$userId);
		$data['messages'] =$this->projects_model->getmyMessages();
		$user = $this->projects_model->getInitials($userId);
		$this->load->view('myTasks',$data);
    }

	function updateActualEnd($id,$projectId){
		$this->load->model('tasks_model');
		$this->tasks_model->updateEnd($id);
		$this->load->helper('url');
		redirect("/projects/structure/$projectId");
	}
	function upload($id){
				$this->load->helper('url');
		if(isset($_FILES["doc_file"]["name"]))  
           {  
                $config['upload_path'] = './uploads/';  
                $config['allowed_types'] = 'doc|docx|png|jpg|jpeg|pptx|ppt';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('doc_file'))  
                {  
                     echo $this->upload->display_errors();  
                }  
                else  
                {  
										$this->load->model('tasks_model');
                    					 $data = $this->upload->data();  
										 $taskId = $id;
										 $this->tasks_model->attachFile($taskId,$data['file_name']);
										 echo "1";
				} 
           } else echo "error";
	}
	function downloadFile(){
		$fileName = $_POST['fileName'];
		$this->load->helper('download');
		$data['path'] = './uploads/';
		error_reporting(E_NOTICE & ~E_WARNING);
		$data1 = file_get_contents($data['path']."/$fileName");
		if(empty($data1))
                    {
                        //редирект обратно на страницу, если запрашиваемого файла нет
                        echo "<script>alert('Извините данный файл не удалось скачать. :(');</script>";
                    }
                    else
                        {
                            force_download($fileName, $data1);  
                        }
		
	}
	function changeStatus($id,$status,$idProject,$access){
		echo var_dump(($status));
		$this->load->model('tasks_model');
		if($status=='done'){
			$this->tasks_model->changeStatusTask($id,$access);
		}
		if($status=='inWork'){
			$this->tasks_model->inWork($id);
		}
		$this->load->helper('url');
		redirect("/projects/myTasks/$idProject");
	}
	function reject(){
			$reason = $_POST['reason'];
			$id = $_POST['taskId'];
			$persent = $_POST['persent'];
			$this->load->model('tasks_model');
			$this->tasks_model->mesReject($id,$reason,$persent);
			$this->tasks_model->inWork($id);
			echo 1;
	}
	function read($id,$idProject){
		$this->load->model('tasks_model');
		if(isset($_POST['good']) and $_POST['good']!='good'){
			$this->tasks_model->readMes($id);
		}else{
			$this->tasks_model->done($id);
		}
		$this->load->helper('url');
		redirect("/projects/myTasks/$idProject");
	}

	function addProjectPart(){
		$this->load->model('projects_model');
		$checkCount =  $this->projects_model->addProjectPart($_POST['Id'],$_POST['projectId']);
		if($checkCount==false){
			$answer = array(
				'command' => "error",
				'error' => "Пользователь уже учавствует в трёх проектах"
			);
			echo json_encode($answer);
		}else{
			$answer = array(
				'command' => 1
			);
			echo json_encode($answer);
		}
	}
	function changeEndProjectDate(){
		$date['endDate'] = date($_POST['date']);
		$id = $_POST['id'];
		$this->db->update("projects",$date,"projectId=$id");
		echo "1";
	}
	function addToArchive($id){
		$this->load->model("projects_model");
		$this->projects_model->addToArchive($id);
		$this->load->helper('url');
		redirect("/projects");
	}
	function addToActive($id){
		$this->load->model("projects_model");
		$this->projects_model->addToActive($id);
		$this->load->helper('url');
		redirect("/projects");
	}
	function deleteMember(){
		$userID = $_POST['userID'];
		$this->load->model("users_model");
		$this->users_model->deleteMember($userID,$_POST['projectId']);
		echo "1";
	}
	function searchUser(){
		$query = $_POST['query'];
		$this->load->model('users_model');
		$users = $this->users_model->search($query);
		$output = "<li class='flex'><a href=''>
		<span class='fa fa-folder-o'>Найденные</span></a><ul>";
		foreach($users as $user){
			$name= "".$user['name']." ".$user['serName'].",".$user['userID']."";
			$output .="<li class='employ search'>
			<a href='' style='pointer-events: none;'>
				<span class='fa fa-tasks nameEmploy' data-userId ='".$user['userID']."'>".$user['name']." ".$user['serName']."
				</span>
			</a>
			</li>";
		}
		$output .="</ul></li></div>";
		echo $output;
	}
}