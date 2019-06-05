<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gant extends CI_Controller {
    public function index($id)
	{
        $companyId = $this->session->userdata('companyId');
        $userId = $this->session->userdata('userId');
        $this->load->model('gant_model');
        $this->load->model('users_model');
        $this->load->model('projects_model');
        $data['dateProject'] = $this->projects_model->getDateProject($id);
        $data['access'] = $this->users_model->getAccess();
        $data['jsonTasks'] = $this->gant_model->tasksToJson($id);
        $data['departments'] = $this->projects_model->getDepartments($companyId);
        //$data['jsonWithoutUser'] = $this->gant_model->getTasksWithoutuser($id);
        $data['idProject'] = $id;
        $data['userId'] = $userId;
        $data['currentUser'] = $this->users_model->getFullName();
        $data['idUserHead'] = $this->projects_model->getIdUserHead($id);
        $data['users'] = $this->projects_model->getUsersProject($companyId,$id);
        $this->load->view('gant',$data);
    }
    public function updateGant($id,$projectId){
        $this->load->model('gant_model');
        $this->gant_model->deleteTask($id);
        $this->load->helper('url');
        redirect("/gant/index/$projectId");
    }
}