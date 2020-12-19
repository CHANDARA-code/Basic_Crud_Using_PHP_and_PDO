
<?php
//include'dbconnect.php'; //dbconnect is for database connection with PDO
$pdo = new PDO('mysql:host=localhost;dbname=datatest','root','');//connect to db(phpmyadmin)

if(isset($_POST['submit'])) {//check name & price input or not


$DOB=$_POST['DOB'];
$gender=$_POST['gender'];
$class = $_POST['class'];
$username=$_POST['username'];
$email=$_POST['email'];
$pwd= password_hash($_POST['Re_pswd'],PASSWORD_DEFAULT);
$image = $_FILES['files']['name'];
$imagepath = $_FILES['files']['tmp_name'];
move_uploaded_file($imagepath,"image/$image");

   
    if(!empty( $DOB &&$imagepath&&$gender&&$class&&$username&&$email&&$pwd&&$image)){ //check if vairale product name & price isn't empty

        $insert = $pdo->prepare("Insert into user_test(username,gender,class,DOB,email,password,image) values (:username,:gender,:class,:DOB,:email,:password,:image)");
        //insert into table tb_product has 2 arguments which name & price with values

        $insert->bindParam(':username',$username);
        $insert->bindParam(':gender',$gender);
        $insert->bindParam(':class',$class);
        $insert->bindParam(':DOB',$DOB);
        $insert->bindParam(':email',$email);
        $insert->bindParam(':password',$pwd);
        $insert->bindParam(':image',$image);
        $insert->execute();
        
        if($insert->rowCount()){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwd;
            $_SESSION['email'] = $email;
            echo "<br>".'<h1 style="color: green">Insert Successful</h1>';
            header("Refresh:1;url=login.html");
        }
        else{
            echo "<br>".'Insert Failed';
        }
    }

}


else{
        echo 'FIelds is empty';
    }
?>
