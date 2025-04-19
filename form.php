<?php
    $pdo = new PDO("mysql:host=localhost;dbname=web55j;charset=utf8","admin","1234");


    switch($_GET["do"]){
        case "login":
            // 登入
            $username = $_POST["username"];
            $password = $_POST["password"];
            // echo $username;
            // echo $password;

            $user = $pdo->query("select * from users where `username`='$username' ")->fetch();
            
            if(empty($user)){
                echo "使用者不存在";
            }else{
                if($user["password"] !== $password){
                    echo "密碼錯誤";
                }else{
                    echo "登入成功";
                }
            }

            break;
        case "logout":
            // 登出
            break;
        case "users":
            $users = $pdo->query("select * from users")->fetchAll();
            echo json_encode($users);
            break;
        case "del_user":
            $user_id = $_GET["id"];
            $pdo->query("delete from users where id='$user_id'");
            break;
        case "create":
            $username = $_POST["username"];
            $password = $_POST["password"];
            $user = $pdo->query("select count(*) from users where username='$username'")->fetch();
            if($user[0] == 0){
                $pdo->query("INSERT INTO `users`(`id`, `username`, `password`) VALUES ('','$username','$password')");
                echo "true";
            }else{
                echo "false";
            }
            break;
        case "edit":
            $username = $_POST["username"]; // user
            $password = $_POST["password"]; // 4567
            $id = $_POST["id"]; // 使用者ID
            $user = $pdo->query("select count(*) from users where username='$username' AND id != '$id' ")->fetch();
            if($user[0] == 0){
                $pdo->query("UPDATE `users` SET `username`='$username',`password`='$password' WHERE id = '$id' ");
                echo "true";
            }else{
                echo "false";
            }
            break;
    }

    // if($_GET === "login"){
    //     //登入
    // }else if($_GET === "logout"){
    //     //登出
    // }