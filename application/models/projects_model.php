<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model{
    
    function getUsers($companyId){
        if ( ! $this->db->simple_query("SELECT * from users where companyId=".$companyId."")){
            return 0;
        }
        $users = $this->db->query("SELECT * from users where companyId=".$companyId."");
        return $users->result_array();
    }
    function getUserId($head){
        $head = preg_split("/ /",htmlspecialchars($_POST["Head"]));
        $this->db->select("userID");
        $this->db->from("users");
        $this->db->where("name = '".$head[0]."' and serName ='".$head[1]."'");
        $userId =$this->db->get();
        $row = $userId->row();
        return $row->userID;
    }
    function getUsersProject($companyId,$id){
        if ( ! $this->db->simple_query("SELECT * from users where companyId=$companyId and userID in(SELECT userID from membersprojects where projectId=$id)")){
            return 0;
        }
        $users = $this->db->query("SELECT * from users where companyId=$companyId and userID in(SELECT userID from membersprojects where projectId=$id)");
        return $users->result_array();
    }

    function getcheckTasks($id){
        if(! $this->db->simple_query("SELECT * FROM `tasks` INNER JOIN users on tasks.userID=users.userID WHERE notefication=1 and projectId=$id")){
            return 0;
        }
        $this->db->select("taskId,tasks.name as nameTask,users.name,serName,fileTask");
        $this->db->from("tasks");
        $this->db->join("users","tasks.userID=users.userID");
        $this->db->where("notefication=1 and projectId=$id");
        $check = $this->db->get();
        return $check->result_array();
    }

    function getOverdueTasks($id){
        if ( ! $this->db->simple_query("SELECT * from users inner join tasks on users.userID=tasks.userID
                                         where actualEnd<CURRENT_DATE() and projectId=$id and statusTask NOT LIKE '%Выполнена%'")){
            return 0;
        }
        $this->db->select("*");
        $this->db->from("users");
        $this->db->join("tasks","users.userID=tasks.userID");
        $this->db->where("actualEnd<CURRENT_DATE() and projectId = $id and statusTask NOT LIKE '%Выполнена%'");
        $overdue = $this->db->get();
        return $overdue->result_array();
    }
    function getPU($projectId,$companyId){
            $projectUsers = $this->db->query("SELECT users.userID,users.name,serName,email,departments.name as nameDepart,phone FROM projects 
            INNER join membersprojects on membersprojects.projectId = projects.projectId 
            INNER join users on users.userID = membersprojects.userID INNER JOIN departments on users.departId=departments.departId where projects.projectId=$projectId and membersprojects.companyId =$companyId");
            return $projectUsers->result_array();
    }
    
    function getNoParticipants($projectId,$companyId){
        if( ! $this->db->simple_query("SELECT * FROM `users` WHERE 
        userID not in(SELECT userID FROM membersprojects where projectId=$projectId AND companyId=$companyId) and companyId=$companyId")){
            return 0;
        }
        $part = $this->db->query("SELECT * FROM `users` WHERE
         userID not in(SELECT userID FROM membersprojects where projectId=$projectId AND companyId=$companyId) and companyId=$companyId");
        return $part->result_array();
    }

    function getHeadProject($projectId){
            $projectHead = $this->db->query("SELECT * FROM users,projects where users.userID=projects.userID and projectId=$projectId");
            return $projectHead->row();
    }

    function getIdUserHead($id){
        $query = $this->db->query("SELECT userID from projects where projectId=$id");
        $row = $query->row();
        return $row->userID;
    }

    function getProjectName($projectId){
            $projectName =$this->db->query("SELECT nameProject from projects where projectId=$projectId");
            $row = $projectName->row();
            return $row->nameProject;
    }
    function setOverdue($id){
        $data = array(
            'statusTask' => 'Просрочена'
        );
       // $this->db->where("actualEnd<CURRENT_DATE() and projectId = $id");
        $this->db->update("tasks",$data,"actualEnd<CURRENT_DATE() and projectId = $id and statusTask!='Выполнена'");
    }
    function getTasks($projectId,$sort){
        if( ! $this->db->simple_query("SELECT tasks.name as nameTask,actualStart,actualEnd,
        users.name as nameEmployee,serName,statusTask,importance,descrip, fileTask from tasks,users where tasks.userID=users.userID && projectId=$projectId")){
            return 0;
        }
        $this->setOverdue($projectId);
        $this->db->select("tasks.name as nameTask,actualStart,actualEnd,
        users.name as nameEmployee,serName,statusTask,importance,descrip,fileTask",false);
        $this->db->from("tasks");
        $this->db->join("users",'users.userID=tasks.userID');
        $this->db->where("projectId=$projectId");
        if($sort==true){
            $this->db->order_by("statusTask like '%Просрочена%'","desc");
        }
        $tasks =$this->db->get();
        return $tasks->result_array();
    }
    function getTasksWithoutuser($projectId){
        $this->db->select("");
        $this->db->from("tasks");
        $this->db->where("userID is null and projectId=$projectId");
        $tasks =$this->db->get();
        return $tasks->result_array();
    }
    function getMyTasks($projectId,$sort,$userId){
        if( ! $this->db->simple_query("SELECT notefication, tasks.name as nameTask,actualStart,actualEnd,
        users.name as nameEmployee,serName,statusTask,importance,descrip, fileTask from tasks,users where tasks.userID=users.userID && projectId=$projectId && tasks.userID=$userId")){
            return 0;
        }
        $this->db->select("notefication,taskId,tasks.name as nameTask,actualStart,actualEnd,
        users.name as nameEmployee,serName,statusTask,importance,descrip, fileTask",false);
        $this->db->from("tasks");
        $this->db->join("users",'users.userID=tasks.userID');
        $this->db->where("projectId=$projectId and tasks.userID=$userId");
        if($sort==true){
            $this->db->order_by("statusTask like '%Просрочена%'","desc");
        }
        $tasks =$this->db->get();
        return $tasks->result_array();
    }


    function getInitials($userId){
        if ( ! $this->db->simple_query("SELECT * from users where userID=".$userId."")){
            return 0;
        }
        $user = $this->db->query("SELECT * from users where userID=".$userId."");
        return $user->result_array();
    }

    function getMyProjects($companyId){
        $userId = $_SESSION['userId'];
        if ( ! $this->db->simple_query("SELECT * FROM projects INNER join membersprojects on projects.projectId=membersprojects.projectId 
        WHERE membersprojects.userID=$userId and membersprojects.companyId=$companyId")){
            return 0;
        }
        $projects = $this->db->query("SELECT * FROM projects INNER join membersprojects on
         projects.projectId=membersprojects.projectId
          WHERE membersprojects.userID=$userId and membersprojects.companyId=$companyId");
        return $projects->result_array();
    }

    function getProjects($companyId){
        $projects = $this->db->query("SELECT * FROM projects where companyId=".$companyId."");
        return $projects->result_array();
    }

    function getDateProject($id){
        $this->db->select("startDate,endDate");
        $this->db->from("projects");
        $this->db->where("projectId=$id");
        $query = $this->db->get();
        return $query->row();
    }
    function addToArchive($id){
        //SELECT * FROM `users` INNER join membersprojects on users.userID=membersprojects.userID where membersprojects.projectId=36
        $this->db->update("projects",["statusProject"=>"archive"],"projectId=$id");
        $this->db->query("UPDATE users  SET users.countProjects = users.countProjects-1 WHERE users.userID IN (SELECT userID from (SELECT users.userID,projectId from users INNER join membersprojects on users.userID=membersprojects.userID and membersprojects.projectId=$id)as t1)");
    }
    function addToActive($id){
        //SELECT * FROM `users` INNER join membersprojects on users.userID=membersprojects.userID where membersprojects.projectId=36
        $this->db->update("projects",["statusProject"=>"active"],"projectId=$id");
        $this->db->query("UPDATE users  SET users.countProjects = users.countProjects+1 WHERE users.userID IN (SELECT userID from (SELECT users.userID,projectId from users INNER join membersprojects on users.userID=membersprojects.userID and membersprojects.projectId=$id)as t1)");
    }
    
    function createProject($data,$memberData){
        $this->db->insert('projects',$data);
        $this->db->select('projectId');
        $this->db->from('projects');
        $this->db->order_by('projectId','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $project = $query->row();
        $memberData['projectId'] = $project->projectId;
        $this->db->insert('membersprojects',$memberData);
        return $project->projectId;
    }
    function createTask($data){
        $this->db->insert('tasks',$data);
    }

    function getMyMessages(){
        $userId = $this->session->userdata('userId');
        if ( ! $this->db->simple_query("SELECT * from messages where userID=".$userId."")){
            return 0;
        }
        $this->db->select("*");
        $this->db->from("messages");
        $this->db->where("userID=$userId");
        $query = $this->db->get();
        return $query->result_array();
    }

    // function getPersentageCompleted($companyId){
    //     $persent = $this->db->query("SELECT round(sum(importance)/(SELECT sum(importance) FROM tasks as tsk
    //      INNER JOIN projects on projects.projectId=tsk.projectId WHERE projects.companyId=$companyId AND tsk.projectId=tasks.projectId
    //       GROUP BY projects.projectId)*100) as persent, projects.projectId FROM tasks INNER JOIN projects
    //        on projects.projectId=tasks.projectId WHERE projects.companyId=$companyId AND statusTask = 'Выполнена'
    //         AND notefication=0 GROUP BY projects.projectId");
    //     $temp = $persent->result_array();
    //     $result = [];
    //     foreach($temp as $t){
    //         $result[$t['projectId']] = $t['persent']; 
    //     }
    //     return $result;
    // }
    function getPersentageCompleted($companyId){
        $persent = $this->db->query("SELECT round(sum(persent)/
        (SELECT COUNT(*)*100 FROM `tasks` as tsk INNER JOIN projects on tsk.projectId=projects.projectId
         WHERE companyId = $companyId and tasks.projectId=tsk.projectId GROUP by tsk.projectId)*100) as persent, tasks.projectId 
         FROM `tasks` INNER JOIN projects on tasks.projectId=projects.projectId WHERE projects.companyId=$companyId GROUP BY tasks.projectId ");
         $temp = $persent->result_array();
             $result = [];
             foreach($temp as $t){
                 $result[$t['projectId']] = $t['persent']; 
             }
             return $result;
    }
    function addProjectPart($id,$projectId){
        $this->db->select("countProjects");
        $this->db->from("users");
        $this->db->where("userID=$id");
        $query = $this->db->get();
        $row = $query->row();
        $countProjects =$row->countProjects;
        if($countProjects>=3){
            return false;
        }
        $countProjects = (int)$countProjects+1;
        $data['companyId'] = $this->session->userdata('companyId');
        $data['userID'] = $id;
        $data['projectId'] =$projectId;
        $this->db->insert("membersprojects",$data);
        $data2 = array(
            'countProjects' => $countProjects
        );
        $this->db->update("users",$data2,"userID=$id");
        return true;
    }
    function checkDepart($name,$id){
        $query = $this->db->query("SELECT `name` from departments where `name` like '$name' and companyId=$id");
        $result = $query->row();
        if($result){
            return true;
        }
        return false;
    }
    function createDepart($name,$id,$create){
        if($create==1){
            $check = $this->checkDepart($name,$id);
            if($check==true) return false;
            $data = array(
                "name"=>$name,
                "companyId"=>$id
            );
            $this->db->insert("departments",$data);
            $this->db->select("departId");
            $this->db->from("departments");
            $this->db->where("name like '$name' and companyId=$id");
            $query = $this->db->get();
            $row = $query->row();
            return $row->departId;
        }
        $this->db->select("departId");
        $this->db->from("departments");
        $this->db->where("name like '$name' and companyId=$id");
        $query = $this->db->get();
        $row = $query->row();
        return $row->departId;

    }
    function getDepartments($companyId){
		$this->db->select("*");
		$this->db->from("departments");
		$this->db->where("companyId=$companyId");
		$query = $this->db->get();
		return $query->result_array();
    }
    
    function getDocuments($id){
        $this->db->select("*");
        $this->db->from("tasks");
        $this->db->where(("projectId=$id and fileTask IS NOT NULL"));
        $query = $this->db->get();
        return $query->result_array();
    }
}
