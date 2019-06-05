<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model{

    function getdb($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function regUser($data,$dataCompany){
        $this->db->insert('company',$dataCompany);
        $companyId = $this->db->query("SELECT companyId from company where nameCompany like '".$dataCompany['nameCompany']."'");
        $back;
        foreach ($companyId->result_array() as $row){
            $data['companyId'] = $row['companyId'];
            $back['companyId'] = $row['companyId'];
        }
        $this->db->insert('users',$data);
        $userId = $this->db->query("SELECT userId from users where email like '".$data['email']."'");
        foreach( $userId->result_array() as $row){
            $back['userId'] = $row['userId'];
        }    
        return $back;
    }

    function addEmployee($data){
        $this->db->insert('users',$data);
        $this->db->select("userID");
        $this->db->from("users");
        $this->db->where("email like '".$data['email']."'");
        $query = $this->db->get();
        $back = $query->row();
        return $back->userID;
    }

    function allUsers(){
        $this->db->select("*");
        $this->db->from("users");
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllCompanies(){
        $this->db->select("*");
        $this->db->from("company");
        $query = $this->db->get();
        return $query->result_array();
    }
}