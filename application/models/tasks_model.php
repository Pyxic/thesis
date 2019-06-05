<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model{
    function updateEnd($id){
        $date = array(
            'actualEnd' =>date('Y-m-d',mktime(0,0,0,date("m"),date("d")+3,date("Y"))),
            'statusTask' => "В_работе"
        );
        $this->db->update("tasks",$date,"taskId=$id");
    }
    private function saveChange($data,$taskId){
        $date = date('Y-m-d');
        $data['dateChange'] = $date;
        $data['taskId'] = $taskId;
        $this->db->insert('change',$data);
    }
    function updateTask($data,$taskId,$bool){
        if($bool==1){
            $this->saveChange($data,$taskId);
        }
        $this->db->update("tasks",$data,"taskId=".$taskId);
    }
    function attachFile($taskId,$fileName){
        $data['fileTask']=$fileName;
        $this->db->update("tasks",$data,"taskId=$taskId");
    }
    function changeStatusTask($id,$access){
        if($access!=2){
            $data['notefication'] = 1;
        }
        $data['statusTask'] = 'Выполнена';
        $this->db->update("tasks",$data,"taskId=$id");
    }
    function inWork($id){
        $data['notefication'] = 0;
        $data['statusTask'] = 'В_работе';
        $this->db->update("tasks",$data,"taskId=$id");
    }
    function mesReject($id,$reason,$persent){
        $this->db->select('userID,name');
        $this->db->from('tasks');
        $this->db->where("taskId=$id");
        $userID = $this->db->get();
        $row =$userID->row();
        $data['userID'] = $row->userID;
        $data['message'] = $reason;
        $read['read'] = 0;
        $data['nameTask'] = $row->name;
        $data['taskId'] = $id;
        $this->db->insert("messages",$data);
        $this->db->update("tasks",["persent"=>$persent],"taskId=$id");
    }
    function readMes($id){
        $data['read']= 1;
        $this->db->update("messages",$data,"messageId=$id");
    }
    function done($id){
        $data['notefication'] = 0;
        $data['persent'] = 100;
        $this->db->update("tasks",$data,"taskId=$id");
    }
}