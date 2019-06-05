<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gant_model extends CI_Model{
    
    function getTasks($projectId){
        if ( ! $this->db->simple_query("SELECT * from tasks where projectId=".$projectId."")){
            return 0;
        }
        $tasks = $this->db->query("SELECT persent/100 as progressValue,descrip,taskId,tasks.name,actualStart,actualEnd,statusTask,users.name as nameHead,importance,serName
          from tasks inner join users
         on tasks.userID=users.userID where projectId=$projectId order by actualStart");
        return $tasks->result_array();
    }
    function tasksToJson($projectId){
        $tasks = $this->getTasks($projectId);
        $noUser = $this->getTasksWithoutuser($projectId);
        $result = array_merge($tasks,$noUser);
        return json_encode($result);
    }
    function deleteTask($id){
        $this->db->delete('tasks', array('taskId' => $id));
    }
    function getTasksWithoutuser($projectId){
        $tasks = $this->db->query("SELECT persent/100 as progressValue,descrip,taskId,tasks.name,actualStart,actualEnd,statusTask,importance
        from tasks where userID is null and projectId=$projectId order by actualStart");
        $arr = $tasks->result_array();
        $result = [];
        $name=["nameHead"=>"","serName"=>""];
        foreach($arr as $task){
            $result = array_merge($task,$name);
        }
        return $result;
    }

}