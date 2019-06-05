<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function index($id)
	{
        $this->load->model("reports_model");
        $data['finished'] = $this->reports_model->getFinishedTasks($id);
        $data['work'] = $this->reports_model->getWorkTasks($id);
        $data['overdue'] = $this->reports_model->getOverdueTasks($id);
        $data['idProject']=$id;
		$companyId = $this->session->userdata('companyId');
		$userId = $this->session->userdata('userId');
		$data['userId'] = $userId;
		$this->load->model('projects_model');
        $this->load->model('users_model');
        $data['access'] = $this->users_model->getAccess();
        $data['currentUser'] = $this->users_model->getCurrentUser();
        $data['fullName'] = $this->users_model->getFullName();
        $user = $this->projects_model->getInitials($userId);
        $data['headProject'] = $this->projects_model->getHeadProject($id);
        $data['tasks'] = $this->reports_model->getTasksReport($id);
        $data['participants'] = $this->reports_model->getUsersReport($id);
        $data['overdue'] = $this->reports_model->getOverdue($id);
        $data['chartStatus'] = $this->reports_model->getStatusReport($id);
        $data['projectName'] = $this->reports_model->getProjectName($id);
        $data['persent'] = $this->reports_model->getPersentageCompleted($id);
        $this->load->view("reports",$data);
    }
}