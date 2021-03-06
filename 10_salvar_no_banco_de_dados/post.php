<?php

if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    if($name == ""){
        echo json_encode(["status"=>false,"msg"=>"Fill in a name"]);exit;
    }
    if($email == ""){
        echo json_encode(["status"=>false,"msg"=>"Fill in a email"]);exit;
    }
    if($tel == ""){
        echo json_encode(["status"=>false,"msg"=>"Fill in a telephone"]);exit;
    }
    $id = save($_POST);
    if($id){
        echo json_encode(["status"=>true,"msg"=>"Success! Id: {$id}"]);exit;
    }else{
        echo json_encode(["status"=>false,"msg"=>"Error Db!"]);exit;
    }
}
function conn(){
    $conn = new \PDO("mysql:host=localhost;dbname=ajax_jquery","root","root");
    return $conn;
}
function save($data){
    $db = conn();
    $query ="Insert into `contacts` (`name`,`email`,`tel`) VALUES (:name,:email,:tel)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name',$data['name']);
    $stmt->bindValue(':email',$data['email']);
    $stmt->bindValue(':tel',$data['tel']);
    $stmt->execute();
    return $db->lastInsertId();
}
