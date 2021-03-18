<?php

/* ***************|CLEANING USER INPUT|*************** */
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/* ***************|REGISTER|*************** */
function register($username, $email, $password, $firstName, $lastName, $street, $zip, $city){
    include('db/db_login.php');
    include('db/db_connect.php');
    /* ***************|INSERT QUERY|*************** */
    $prepStatRegister = $db -> prepare("INSERT INTO
    user(username,email,password,firstname,lastname,street,zip,city)
    VALUES(:username,:email,:password,:firstname,:lastname,:street,:zip,:city)");
    /* ***************|HASHING PASSWORD|*************** */
    $hashdpw = password_hash($password, PASSWORD_BCRYPT);
    /* ***************|PREPARET STATEMENTS FOR QUERY|*************** */
    $prepStatRegister -> bindParam(':username', $username);
    $prepStatRegister -> bindParam(':email', $email);
    $prepStatRegister -> bindParam(':password', $hashdpw);
    $prepStatRegister -> bindParam(':firstname', $firstName);
    $prepStatRegister -> bindParam(':lastname', $lastName);
    $prepStatRegister -> bindParam(':street', $street);
    $prepStatRegister -> bindParam(':zip', $zip);
    $prepStatRegister -> bindParam(':city', $city);
    /* ***************|EXECUTE QUERY|*************** */
    $prepStatRegister -> execute();
}
/* ***************|PASSWORD STRENGTH CHECK|*************** */
function checkPassword($pwd) {
    $errors='';
    if (strlen($pwd) < 8) {
        $errors = "<p class=\"error\">Password is to short!</p>";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors = "<p class=\"error\">Password needs to contain at least one number!</p>";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors = "<p class=\"error\">Password needs to contain at least one letter!</p>";
    }     

    return ($errors);
}
/* ***************|CHECK IF USER EXIST IN DB|*************** */
function checkUsername($user){
    include('db/db_login.php');
    include('db/db_connect.php');
    $error='';
    $result='';
    $dbcheck= $db ->prepare("SELECT user.username FROM user WHERE username=:username");
    $dbcheck -> bindParam(':username',$user);
    $dbcheck -> execute();
    $result = $dbcheck-> fetch();
    if($result==false){
        $error='<p class="error">The Username is already taken!</p>';
    }
    return($error);
}
/* ***************|CHECK IF E-MAIL EXIST IN DB|*************** */
function checkemail($email){
    include('db/db_login.php');
    include('db/db_connect.php');
    $error='';
    $result='';
    $dbcheck= $db ->prepare("SELECT user.email FROM user WHERE email=:email");
    $dbcheck -> bindParam(':email',$email);
    $dbcheck -> execute();
    $result = $dbcheck-> fetch();
    if($result!=''){
        $error='<p class="error">The E-mail is already in use!</p>';
    }
    return($error);
}
?>