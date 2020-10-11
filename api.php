<?php

$conn= new mysqli('localhost','root','','vue_php_crud');

$response=[
    'error' => false,
];


$action= 'read';
if(isset($_GET["action"])){
    $action=$_GET["action"];
}

if($action=='read'){
    $users= array();
    $result= $conn->query("SELECT * FROM `users`");
    while($row= $result->fetch_assoc()){
        array_push($users,$row);
    }
    $response['users']=$users;

}
elseif($action=='create'){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $username=$_POST['username'];

    $result= $conn->query("INSERT INTO `users`(`name`, `username`, `email`) VALUES ('$name','$username','$email')");

    if($result){
        $response['message']='User Successfully Added';
    }else{
        $response['error']=true;
        $response['message']='Something went worng!';
    }

}
elseif($action=='update'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $username=$_POST['username'];

    $result=$conn->query("UPDATE `users` SET `name`='$name',`username`='$username',`email`='$email' WHERE `id`='$id'");

    if($result){
        $response['message']='User Successfully Updated';
    }else{
        $response['error']=true;
        $response['message']='Something went worng!';
    }
}
elseif($action=='delete'){
    $id=$_POST['id'];
    $result=$conn->query("DELETE FROM `users` WHERE `id`='$id'");

    if($result){
        $response['message']='User Successfully Delated';
    }else{
        $response['error']=true;
        $response['message']='Something went worng!';
    }
}
else{
    die('invalid action');
}


    header("content-type: application/json");
    echo json_encode($response);

