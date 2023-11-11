<?php
include "../database/database.php";
$obj= new Database();

$obj->insert('users',['name'=>'javlon']);
$data = $obj->getResult();
print_r($data)

?>