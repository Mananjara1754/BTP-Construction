<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_generalise extends CI_Model
{

    public function findAll($nom_table){
        $tab = array();
        $request = "SELECT * from %s";
        $request = sprintf($request,$nom_table);
        $query = $this->db->query($request);
        foreach ($query->result_array() as $row) {
            array_push($tab, $row);
        }
    return $tab;
    }
    public function find_last($nom_table){
        $all = $this->findAll($nom_table);
        $last = null;
        if(isset($all)){
            if(count($all)-1 >= 0){
                $last = $all[count($all)-1];
            }
        }
        return $last;
    }

    public function findByRequest($sql){
        $tab = array();
        $request = $sql;
        // echo $sql."</br>";
        // $request = sprintf($request,$nom_table);
        $query = $this->db->query($request);
        foreach ($query->result_array() as $row) {
            array_push($tab, $row);
        }
    return $tab;
    }
    public function findCount($table){
        $tab = array();
        $request = "select count(id_".$table.") as nb from ".$table.";";
        $query = $this->db->query($request);
        foreach ($query->result_array() as $row) {
            array_push($tab, $row);
        }
        if(isset($tab[0]['nb'])){
            return $tab[0]['nb'];
        }
        return 0;
    }
    public function findCountById($colonne,$id,$table){
        $tab = array();
        $request = "select count(id_".$table.") as nb from ".$table." where ".$colonne." = '".$id."';";
        echo $request;
        $query = $this->db->query($request);
        foreach ($query->result_array() as $row) {
            array_push($tab, $row);
        }
        if(isset($tab[0]['nb'])){
            return $tab[0]['nb'];
        }
        return 0;
    }


    public function findByRequest_one_row($sql){
        $request = $sql;
        $query = $this->db->query($request);
        return $query->row_array();
    }

    
    public function findById($nom_table,$id){
        $this->db->where("id_$nom_table", $id);
        $query = $this->db->get($nom_table);
        return $query->row_array();
    }

    public function findBy($nom_table, $column, $value){
        $this->db->where($column, $value);
        $query = $this->db->get($nom_table);
        return $query->row_array();
    }

    
   
}

?>