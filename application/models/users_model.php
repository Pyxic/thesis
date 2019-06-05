<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    function autorization($email,$pass){
        
    }
    function getCurrentUser(){
        $userId = $_SESSION['userId'];
        $this->db->select("name");
        $this->db->from("users");
        $this->db->where("userID=$userId");
        $currentUser = $this->db->get();
        $row = $currentUser->row();
        return $row->name;
    }
    function getFullName(){
        $userId = $_SESSION['userId'];
        $this->db->select("name,serName");
        $this->db->from("users");
        $this->db->where("userID=$userId");
        $currentUser = $this->db->get();
        $row = $currentUser->row();
        return $row;
    }
    function getEmail(){
        $userId = $_SESSION['userId'];
        $this->db->select("email");
        $this->db->from("users");
        $this->db->where("userID=$userId");
        $currentUser = $this->db->get();
        $row = $currentUser->row();
        return $row->email;
    }
    function getAccess(){
        $userId = $_SESSION['userId'];
        $this->db->select("status");
        $this->db->from("users");
        $this->db->where("userID=$userId");
        $currentUser = $this->db->get();
        $row = $currentUser->row();
        return $row->status;
    }
    function checkUser($email){
        $companyId = $this->session->userdata('companyId');
        $query = $this->db->query("SELECT email from users where email like '$email' and companyId=$companyId");
        $result = $query->row();
        if($result){
            return false;
        }
        return true;
    }
    function getNoDepart($departId){
        $companyId = $this->session->userdata('companyId');
        $this->db->select("name, serName, userID");
        $this->db->from("users");
        $this->db->where("departId!=$departId and companyId=$companyId");
        $query = $this->db->get();
        return $query->result_array();
    }
    function setDepart($id,$departId){
        $query = $this->db->query("SELECT departId from users where userID=$id");
        $row = $query->row();
        if($row->departId!=0)return false;
        $data['departId'] =$departId;
        $this->db->update("users",$data,"userID=$id");
        return true;
    }
    function deleteMember($userID,$projectId){
        $this->db->delete("membersProjects","userID=$userID and projectId=$projectId");
        $this->db->update("tasks",["userID"=>null],"userID=$userID");
        $this->db->update("users",["countProjects"=>"countProjects-1"],"userID=$userID");
    }
    function search($query){
        $this->db->select("*");
        $this->db->from("users");
        $companyId = $this->session->userdata('companyId');
        $this->db->where("companyId=$companyId");
        $this->db->like("name",$query,'after');
        $this->db->or_like("serName",$query,'after');
        $res = $this->db->get();
        return $res->result_array();
    }
    function getCompanyName(){
        $companyId = $this->session->userdata('companyId');
        $this->db->select("NameCompany");
        $this->db->from("company");
        $this->db->where("companyId=$companyId");
        $query = $this->db->get();
        $row = $query->row();
        return $row->NameCompany;
    }
}