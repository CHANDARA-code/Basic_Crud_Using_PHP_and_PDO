<!--<html>-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
<!--    <link rel="icon" type="image/gif" sizes="60x60" href="PHP_logo1.png">-->
<!--    <title>Login</title>-->
<!--</head>-->
<!--<body>-->
<?php
//$username=$_POST['username'];
//$pwdInputform=$_POST['pwd'];
//$email=$_POST['email'];
//
//$pdo = new PDO('mysql:host=localhost;dbname=datatest','root','');
//$stmt = $pdo->query("select *from user_test");
//
//while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
//
//    $Verifypwd = password_verify($pwdInputform,$row['password']);
//
//    if( ($username == $row['username']) && ($email == $row['email']) && ($Verifypwd ==1 ) ){
//
//        session_start();
//        $_SESSION['username']=$row['username'];
//        echo "<br>" . '<h1 style=" color: green;" >Login Successful</h1>';
//        header("Refresh: 3;url=List_all_user.php");
//        exit();
//    }
//}
//    if (($username!=$row['username']) && ($email != $row['email']) && ($Verifypwd !=1)){
//        echo "<br>" . '<h1 style=" color: green;" >Login Failed Missing Email or Username or Incorrect Password</h1>';
//        header("Refresh: 2; url=login.html");
//    }
//
//?>
<!---->
<!--</body>-->
<!--</html>-->

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/gif" sizes="60x60" href="PHP_logo1.png">
    <title>Login</title>
</head>
<body>
<?php
$username=$_POST['username'];
$pwdInputform=$_POST['pwd'];

$email=$_POST['email'];
$pdo = new PDO('mysql:host=localhost;dbname=datatest','root','');
$stmt = $pdo->query("select *from user_test");

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $Verifypwd = password_verify($pwdInputform,$row['password']);
    if( ($username == $row['username']) && ($email == $row['email']) && ($Verifypwd ==1 ) ){

        session_start();
        $_SESSION['username']=$row['username'];
        echo "<br>" . '<h1 style=" color: green;" ><br> Login Successful <br> </h1>';
        header("Refresh: 2;url=List_all_user.php");
        break;
        //exit();
    }
    elseif (($username!=$row['username']) && ($email != $row['email']) && ($Verifypwd !=1)){
        echo "<br>" . '<h1 style=" color: green;" > <br>Login Failed Missing Email or Username or Incorrect Password <br> </h1>';
        header("Refresh: 2; url=login.html");
    }

}

?>

</body>
</html>