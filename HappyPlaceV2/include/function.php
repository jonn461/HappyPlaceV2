<?php
/* ***************|DATABASE CONNECTING|*************** */
    function db_connect(){
        include_once('db_connect.php');
        include_once('db_login.php');
    };
/* ***************|CLEANING USER INPUT|*************** */
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
/* ***************|REGISTER|*************** */
    function register($username, $email, $password, $confirm, $firstName, $lastName, $street, $zip, $city){
        
    }
/* ***************||*************** */
/* ***************||*************** */
/* ***************||*************** */
/* ***************||*************** */
?>