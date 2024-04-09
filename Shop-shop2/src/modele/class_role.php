<?php
class Role {
    private $db;
    private $select;

    public function _construct($db){
        $this->db = $db;
        $this->select = $db->prepare("select id, libelle from role");
    }

    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();
    }
}
?>