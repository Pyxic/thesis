<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {
    function index($id){
        $data['idProject']=$id;
		$companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$data['userId'] = $userId;
		$this->load->model('projects_model');
        $this->load->model('users_model');
        $data['access'] = $this->users_model->getAccess();
        $data['currentUser'] = $this->users_model->getCurrentUser();
        $data['idUserHead'] = $this->projects_model->getIdUserHead($id);
        $data['fullName'] = $this->users_model->getFullName();
        $user = $this->projects_model->getInitials($userId);
        $data['headProject'] = $this->projects_model->getHeadProject($id);
        $data['documents'] = $this->projects_model->getDocuments($id);
        $this->load->view("documents",$data);
    }
    function downloadFile($taskId){
        $query = $this->db->query("SELECT fileTask from tasks where taskId=$taskId");
        $row = $query->row();
        $fileName = $row->fileTask;
        $this->load->helper('download');
		$data['path'] = './uploads/';
		error_reporting(E_NOTICE & ~E_WARNING);
		$data1 = file_get_contents($data['path']."/$fileName");
		if(empty($data1))
                    {
                        //редирект обратно на страницу, если запрашиваемого файла нет
                        echo "ничего";
                    }
                    else
                        {
                            force_download($fileName, $data1);  
                        }
    }
    function deleteFile(){
        $path = './uploads/'.'/'.$_POST['file'];
        $taskId = $_POST['taskId'];
        $this->load->helper('file');
        unlink($path);
        $data['fileTask']=null;
        $this->db->update("tasks",$data,"taskId=$taskId");
        echo 1;
    }
    function changeAccessFile(){
        $taskId = $_POST['taskId'];
        $data['fileAccess'] = $_POST['access'];
        $this->db->update("tasks",$data,"taskId=$taskId");
        echo "1";
    }
}