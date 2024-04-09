<?php
class Type{
    private $db;
    private $insert; 
    private $select;
    public function __construct($db){

    $this->db = $db;

    $this -> select = $db->prepare("select id, libelle from type order by libelle");
    $this->insert = $this->db->prepare("insert into type(libelle) values (:libelle)");

}

public function select()
{
    $this->select->execute();
    if ($this->select->errorCode()!=0){
    print_r($this->select->errorInfo());
    }
    return $this->select->fetchAll();
}

public function insert($libelle)
    {
        $r = true;
        $this
            ->insert
            ->execute(array(
            ':libelle' => $libelle,           
        ));
        if ($this
            ->insert
            ->errorCode() != 0)
        {
            print_r($this
                ->insert
                ->errorInfo());
            $r = false;
        }
        return $r;
    }

}
?>