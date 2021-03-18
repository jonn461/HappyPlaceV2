<?php
/* ***************|INCLUDE|*************** */
    include_once("include/function.php");
/* ***************|SET VARIBLES|*************** */
    $email=$username=$firstName=$lastName=$street=$city=$zip='';
    $alertfill=$alertPassword=$alertZipLength=$alertZipLetter=$alertUsername=$alertEmail='';
    $error=0;
    /* ***************|CHECK USER INPUT|*************** */
    if(isset($_POST['register'])){
        $username=test_input($_POST['username']);
        $email=test_input($_POST['email']);
        $password=test_input($_POST['password']);
        $confirm=test_input($_POST['confirm']);
        $firstName=test_input($_POST['firstName']);
        $lastName=test_input($_POST['lastName']);
        $street=test_input($_POST['street']);
        $zip=test_input($_POST['zipCode']);
        $city=test_input($_POST['city']);
        /* ***************|CHECK IF EVRITHING IS FILLED. IF NOT MAKE STICKY|*************** */
        if(!empty($username) AND !empty($email) AND !empty($password) AND !empty($confirm) AND !empty($firstName) AND !empty($lastName) AND !empty($street) AND !empty($zip) AND !empty($city)){
            /* ***************|CHECK IF POSTAL CODE IS 4 NUMBERS LONG|*************** */
            $alertUsername=checkUsername($username);
            $alertEmail=checkemail($email);
            if($alertUsername!=''){
                $error=1;
            }
            if($alertEmail!=''){
                $error=1;
            }
            if(strlen($zip) == 4){
            }else{
                $alertZipLength='<p class="error">The Postal-code is to long or to short!</p>';
                $error=1;
            }
            /* ***************|CHECK IF POSTAL CODE ARE ONLY NUMBERS|*************** */
            if(is_numeric($zip)==true){
            }else{
                $alertZipLetter='<p class="error">The postal-code is not alowed to contain letters!</p>';
                $error=1;
            }
            /* ***************|CHECK IF PASSWORDS ARE SAME|*************** */
            if($password==$confirm){
                $alertPassword=checkPassword($password);
                if($alertPassword==''){
                    register($username, $email, $password, $firstName, $lastName, $street, $zip, $city);
                }
            }else{
                $alertPassword='<p class="error">Those passwords didn’t match. Try again.</p>';
                $error=1;
            }
        }else{
            $alertfill='<p class="error">Please fill out everything!</p>';
            $error=1;
        }
    /* ***************|IF ERROR=0 CONTINUE|*************** */
        if($error==0){

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/stylesheet.css">
        <title>Sign Up</title>
    </head>
    <body>
        <div id="title"><h1>Sign Up</h1></div>
        <fieldset class="center">
            <form method="post" action="<?php $_SERVER['PHP_SELF']?>" accept-charset="utf-8">
                <div class="column">
                    <label class="row" for="username"><p class="labelText">Username</p><input type="text" name="username" value="<?php echo $username; ?>" cityholder="Username"></label>
                    <label class="row" for="email"><p class="labelText">E-Mail</p></E-Mail><input type="email" name="email" value="<?php echo  $email; ?>" cityholder="E-Mail"></label>
                    <div class="space"><?php echo $alertUsername;echo $alertEmail; ?></div>

                    <p class="note">Use 8 or more characters with a mix of letters and numbers </p>
                    <label class="row" for="password"><p class="labelText">Password</p><input type="password" name="password" cityholder="Password"></label>
                    <label class="row" for="confirm"><p class="labelText">Confirm Password</p><input type="password" name="confirm" cityholder="Confirm"></label>
                    <div class="space"><?php echo $alertPassword; ?></div>

                    <label class="row" for="firstName"><p class="labelText">Name</p><input type="text" name="firstName" value="<?php echo $firstName ?>" cityholder="First Name"></label>
                    <label class="row" for="lastName"><p class="labelText"></p><input type="text" name="lastName" value="<?php echo $lastName ?>" cityholder="Last Name"></label>
                    <div class="space"></div>

                    <label class="row" for="street"><p class="labelText">Address</p><input type="text" name="street" value="<?php echo $street; ?>" cityholder="Street and number"></label>
                    <label class="row" for="zipCode"><p class="labelText"></p><input type="text" name="zipCode" value="<?php echo $zip; ?>" cityholder="Postal-code"></label>
                    <label class="row" for="city"><p class="labelText"></p><input type="text" name="city" value="<?php echo $city; ?>" cityholder="City"></label>
                    <div class="space"><?php echo $alertfill;echo $alertZipLength;echo $alertZipLetter; ?></div>

                    <lable id="button" for="register">
                        <input type="submit" name="register" value="Register">
                    </lable>
                </div>
            </form>
        </fieldset>

    </body>
</html>