<?php
include "main.php";

class Student extends Main {
    protected $table = 'tbl_student';
    private $name;
    private $dep;
    private $age;

    public function setName($name) {
        $this->name = $name;
    }

    public function setDep($dep) {
        $this->dep = $dep;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function insert() {
        $sql = "INSERT INTO $this->table(name, dep, age) VALUES(:name, :dep, :age)";
        $stmt = DB::prepareOwn($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':dep', $this->dep);
        $stmt->bindParam(':age', $this->age);

        return $stmt->execute();
    }

    public function updateById($id) {
        $sql = "UPDATE $this->table SET name=:name, dep=:dep, age=:age WHERE id=:id";
        $stmt = DB::prepareOwn($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':dep', $this->dep);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();

    }

}

