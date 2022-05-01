<?php
require "Connessione.php";

class MySQL {
  private $connessione;
  private $index;

  function __construct($index) {
    $sql = new Connessione();
    $this->connessione = $sql->connect(); 
    $this->index=$index;
  }

  function get($page, $size) {
    $employees=array();
    $query = 'select * from employees limit '.$page*$size.','.$size;
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
    
    while($row = $result->fetch_assoc()){
      array_push($employees, array("id"=>$row['id'], "birthDate"=>$row['birth_date'], "firstName"=>$row['first_name'], "lastName"=>$row['last_name'], "gender"=>$row['gender'], "hireDate"=>$row['hire_date'], 
                  'links_' =>array( 'self'=>array('href'=>$this->index."?id=".$row['id']), 
                              'employee'=>array('href'=>$this->index."?id=".$row['id']))
                )); 
    }
    return $employees;
  }

  function getID($id) {
    $query = 'select * from employees where id='.$id;
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
    
    while($row = $result->fetch_assoc()){
      $employee = array("id"=>$row['id'], "birthDate"=>$row['birth_date'], "firstName"=>$row['first_name'], "lastName"=>$row['last_name'], "gender"=>$row['gender'], "hireDate"=>$row['hire_date'], 
                  'links_' =>array( 'self'=>array('href'=>$this->index."?id=".$row['id']), 
                              'employee'=>array('href'=>$this->index."?id=".$row['id']))
                ); 
    }
    return $employee;
  }

  function count(){
    $query = 'select count(id) as count from employees';
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
   
    while ($row = $result->fetch_assoc()){
      return $row['count'];
    }
  }

  function post($data){
    $query = "INSERT INTO employees(birth_date, first_name, gender, hire_date, last_name) VALUES ('{$data->birthDate}','{$data->firstName}','{$data->gender}','{$data->hireDate}','{$data->lastName}');";
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
  }

  function delete($id){
    $query = "DELETE FROM employees WHERE id = '{$id}';";
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
  }

  function put($data){
    $query = "UPDATE employees 
    SET birth_date = '{$data->birthDate}',
    first_name = '{$data->firstName}',
    gender = '{$data->gender}',
    hire_date = '{$data->hireDate}',
    last_name = '{$data->lastName}' 
    WHERE id = '{$data->id}';";
    $result = $this->connessione->query($query)
    or die('Query fallita ' . mysqli_error($this->connessione) . '' . mysqli_errno($this->connessione));
  }
}
?>