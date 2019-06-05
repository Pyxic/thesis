<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model{

    function getFinishedTasks($id){
        $this->db->select("serName,COUNT(*) as count");
        $this->db->from("users");
        $this->db->join("tasks",'users.userID=tasks.userID');
        $this->db->where("statusTask LIKE '%Выполнена%' and projectId = $id");
        $this->db->group_by("serName");
        $finished = $this->db->get();
        $finished = $finished->result_array();
        $companyId = $this->session->userdata('companyId');
        $users = $this->getProjectUsers($id,$companyId);
        $return = [];
        $bool = false;
        foreach($users as $user){
            foreach($finished as $fin){
                if($fin['serName']==$user['serName']){
                    array_push($return,(int)$fin['count']);
                    $bool=true;
                }
            }
            if($bool==false){
                array_push($return,0);  
            }else{
                $bool=false;
            }
        }
        return json_encode($return);
    }

    function getWorkTasks($id){
        $this->db->select("serName,COUNT(*) as count");
        $this->db->from("users");
        $this->db->join("tasks",'users.userID=tasks.userID');
        $this->db->where("statusTask LIKE '%В_работе%' and projectId = $id");
        $this->db->group_by("serName");
        $work = $this->db->get();
        $work = $work->result_array();
        $companyId = $this->session->userdata('companyId');
        $users = $this->getProjectUsers($id,$companyId);
        $return = [];
        $bool = false;
        foreach($users as $user){
            foreach($work as $w){
                if($w['serName']==$user['serName']){
                     array_push($return,(int)$w['count']);
                     $bool=true;
                }
            }
            if($bool==false){
                array_push($return,0);  
            }else{
                $bool=false;
            }
        }
        return json_encode($return);
    }

    function getOverdueTasks($id){
        $this->db->select("serName,COUNT(*) as count");
        $this->db->from("users");
        $this->db->join("tasks","users.userID=tasks.userID");
        $this->db->where("actualEnd<CURRENT_DATE() and projectId = $id and statusTask NOT LIKE '%Выполнена%'");
        $this->db->group_by("serName");
        $overdue = $this->db->get();
        $overdue = $overdue->result_array();
        $companyId = $this->session->userdata('companyId');
        $users = $this->getProjectUsers($id,$companyId);
        $return = [];
        $bool = false;
        foreach($users as $user){
            foreach($overdue as $over){
                if($over['serName']==$user['serName']){
                    array_push($return,(int)$over['count']);
                    $bool =true;
                }
            }
            if($bool==false){
                array_push($return,0);  
            }else{
                $bool=false;
            }
        }
        // $return = array_map("self::arr",$overdue,$users);
        return json_encode($return);
    }

    private function getProjectUsers($projectId,$companyId){
        $projectUsers = $this->db->query("SELECT users.name,serName,email,departId,phone FROM projects 
        INNER join membersprojects on membersprojects.projectId = projects.projectId 
        INNER join users on users.userID = membersprojects.userID where projects.projectId=$projectId and membersprojects.companyId =$companyId");
        return $projectUsers->result_array();
    }

    static function arr($overdue,$users){
        if($overdue['serName']==$users['serName']){
            return $overdue['count'];
        }else{
            return 0;
        }
    }
    function getTasksReport($id){
        $tasks = $this->db->query("SELECT tasks.name as nameTask,users.name as `name`,users.serName as sername,persent 
        FROM `tasks` INNER JOIN users on users.userID=tasks.userID WHERE projectId=$id");
        $answer = $tasks->result_array();
        $return =[];
        foreach($answer as $a){
            $temp['name'] = $a['nameTask'];
            $temp['fullname'] = $a['name'].' '.$a['sername'];
            $temp['persent'] = $a['persent'];
            array_push($return,$temp);
        }
        return $return;
    }
    function getProjectName($id){
        $this->db->select('nameProject');
        $this->db->from('projects');
        $this->db->where("projectId=$id");
        $query=$this->db->get();
        $row=$query->row();
        return $row->nameProject;
    }
    function getPersentageCompleted($id){
        $persent = $this->db->query("SELECT round(sum(persent)/
        (SELECT COUNT(*)*100 FROM `tasks` as tsk INNER JOIN projects on tsk.projectId=projects.projectId
         WHERE projects.projectId = $id and tasks.projectId=tsk.projectId GROUP by tsk.projectId)*100) as persent, tasks.projectId 
         FROM `tasks` INNER JOIN projects on tasks.projectId=projects.projectId WHERE projects.projectId=$id GROUP BY projects.projectId");
         $temp = $persent->row();
         return $temp->persent;
    }
    function getUsersReport($id){
        $query = $this->db->query("select users.userID as usID,name,sername,
        (select COUNT(*) from tasks where users.userID=tasks.userID and projectId=$id) as countTasks,
        round((SELECT sum(persent) from tasks where projectId=$id and usID=tasks.userID)/
        (select COUNT(*)*100 from tasks where projectId=$id and usID=tasks.userID)*100) as persent
         from users INNER JOIN membersprojects on users.userID=membersprojects.userID where projectId=$id");
         $answer = $query->result_array();
         $return = [];
         foreach($answer as $a){
            $temp['fullname'] = $a['name'].' '.$a['sername'];
            $temp['countTasks'] = $a['countTasks'];
            $temp['persent'] = $a['persent'];
            if($a['countTasks']==0) { $temp['persent'] = '0';}
            array_push($return,$temp);
        }
        return $return;
    }
    function getOverdue($id){
        $query = $this->db->query("SELECT users.userID as usID,users.name as `name`,sername,tasks.name as nameTask,
        datediff(CURRENT_DATE(),tasks.actualEnd) as countDays FROM `users` 
        INNER JOIN tasks on users.userID=tasks.userID WHERE tasks.statusTask='Просрочена' and projectId=$id");
        $answer = $query->result_array();
        $return = [];
        foreach($answer as $a){
            $temp['fullname'] = $a['name'].' '.$a['sername'];
            $temp['nameTask'] = $a['nameTask'];
            $temp['countDays'] = $a['countDays'];
            array_push($return,$temp); 
        }
        return $return;
    }
    function getStatusReport($id){
        $query = $this->db->query("SELECT statusTask, count(*) as countStatus FROM `tasks` where projectId = $id group by statusTask");
        $answer = $query->result_array();
        $return = [];
        foreach($answer as $a){
            $temp['x'] = $a['statusTask'];
            $temp['value'] =$a['countStatus'];
            array_push($return,$temp);
        }
        return $return;
    }
}