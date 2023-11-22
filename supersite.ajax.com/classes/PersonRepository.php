<?php

class PersonRepository
{
    public $saveStatement;
    public $getStatement;
    public $deleteStatement;
    public $editStatement;
    public function __construct($pdo){
        $this->saveStatement = $pdo ->prepare("INSERT INTO people(firstName, lastName, email, phone) VALUES (?,?,?,?)");
        $this->getStatement = $pdo ->prepare("SELECT id, firstName, lastName, email, phone FROM people WHERE id=?");
        $this->deleteStatement = $pdo ->prepare("DELETE FROM people WHERE id=?");
        $this->editStatement = $pdo ->prepare("UPDATE people SET firstName=?, lastName=?, email=?, phone=? WHERE id=?");
    }

    public function savePerson($firstName, $lastName, $email, $phone){
        return $this->saveStatement->execute([$firstName, $lastName, $email, $phone]);
    }
    public function listPerson(){
        $listPerson = [];
        foreach (Unit::GetPdo()->query("SELECT id, firstName, lastName, email, phone FROM people", PDO::FETCH_ASSOC) as $row){
           $listPerson[] = $row;
        }
        return $listPerson;
    }

    public function deletePerson($idPerson){
        $this->deleteStatement->execute([$idPerson]);
        return \MongoDB\BSON\toJSON(200);
    }

    public function editPerson($firstName, $lastName, $email, $phone, $id){
        return $this->editStatement->execute([$firstName, $lastName, $email, $phone, $id]);
    }

    public function getPerson($idPerson){
      foreach (Unit::GetPdo()->query("SELECT id, firstName, lastName, email, phone FROM people WHERE id=$idPerson", PDO::FETCH_ASSOC) as $row){
          return $row;
       }
       // return $this->getStatement->execute([$idPerson]);
        /*foreach ($this->getStatement->execute([$idPerson]) as $row){
            return $row;
        }*/
    }

}