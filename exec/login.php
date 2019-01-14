<?php

require_once '../config.php';
require_once '../lib/pdo.php';

$db = new Database;

$db->query("SELECT id FROM `users` WHERE `username` = :username AND `password` = :password;");

       $db->bind(':username', $_POST['username']);
       $db->bind(':password', md5($_POST['password']));

         if($db->execute()){  

             $row = $db->single(); 

             if(!empty($row['id'])){
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: ".SITE_URL); 
                    exit();
             } else {
                    $_SESSION['login_error'] = 'Incorrect username and password.';
                    header("Location: ".SITE_URL); 
                    exit();
             }
         }
