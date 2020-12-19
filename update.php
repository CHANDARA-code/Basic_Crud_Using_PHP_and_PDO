<?php
if(isset($_GET['id']) ) {
        ob_start();
        $db = new PDO('mysql:host=localhost;dbname=datatest','root','');
        $id = $_GET['id'];
//    $result=$db->prepare("select *from user_test where id = $id");
//    $result->execute();
        $result = $db->prepare("SELECT * FROM user_test where id=:id LIMIT 1");
        $result->bindValue(":id", $id);
        $result->execute();
        $row = $result->fetch();

        $pdo = new PDO('mysql:host=localhost;dbname=datatest', 'root', '');//connect to db(phpmyadmin)

        if ( isset($_POST['submit']) ){

            $DOB = $_POST['DOB'];
            $gender = $_POST['gender'];
            $class = $_POST['class'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pwd = password_hash($_POST['Re_pswd'], PASSWORD_DEFAULT);
            $image = $_FILES['files']['name'];
            $imagepath = $_FILES['files']['tmp_name'];
            move_uploaded_file($imagepath, "image/$image");


            if (!empty($DOB && $imagepath && $gender && $class && $username && $email && $pwd&& $image)) { //check if vairale product name & price isn't empty

                $sql = "UPDATE user_test set username=:username, gender=:gender,class=:class,DOB=:DOB,email=:email,password=:password,image=:image where id=:id";
                $insert = $pdo->prepare($sql);

                $insert->bindParam(':username', $username);
                $insert->bindParam(':gender', $gender);
                $insert->bindParam(':class', $class);
                $insert->bindParam(':DOB', $DOB);
                $insert->bindParam(':email', $email);
                $insert->bindParam(':password', $pwd);
                $insert->bindParam(':image',$image);
                $insert->bindParam(':id',$id);
                $insert->execute();

                if ($insert->rowCount()) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $pwd;
                    $_SESSION['email'] = $email;
                    echo "<br>" . '<h1 style=" color: green;" >Update Successful</h1>';
                    //header("Refresh: 0.001s; Location=login.html");
                    header('Location: List_all_user.php');
                }
                else {
                    echo "<br>" . '<h1 style=" color:red;" >Update Failed</h1>';
                }
            }
            else{
                echo "<br>" . '<h1 style=" color:red;" >Submit Form Do not Work</h1>';
           }
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/gif" sizes="60x60" href="PHP_logo1.png">
    <title>signup</title>
    <style>
        body{
            background-image:url(https://ona-niptict-group6.netlify.app/image/NIPTICT12.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        label{
            font-size: 15px;
        }
    </style>
</head>
<body>
<!-- username, email, gender,class and password  by using Bootstrap. -->
<?PHP //echo specialhtml($_SERVER['PHP_SELF'])?>
<div class="container">
    <form action="#" method="POST" enctype="multipart/form-data">

        <div class="card"class="w-75 p-3" style="width:800px;margin: auto; background: rgba(255, 255, 255, 0.5);">
            <h2 style="text-align: center;">****Update Your Information****</h2>
            <img class="card-img-top" src="https://signup.trybooking.com/media/imgs/653488ddd926ab077de00f6d07ada3535e6dc186.png" alt="Card image" style="width:100px;height: 100px;margin: auto;">
            <div class="card-body">

                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="name" class="form-control" id="username" placeholder="Enter Username" name="username" value="<?php echo $row['username']; ?>"required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="class">Class:</label>
                    <input type="radio" id="Class_A" name="class" value="A">
                    <label for="class">Class_A</label>
                    <input type="radio" id="Class_B" name="class" value="B">
                    <label for="class">Class_B</label>
                    <input type="radio" id="Class_C" name="class" value="C">
                    <label for="class">Class_C</label>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="radio" id="male" name="gender" value="Male"required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="Other"required>
                    <label for="other">Other</label>
                </div>

                <div class="form-group">
                    <label for="DOB">Date of Birth</label>
                    <input type="date" id="start" name="DOB" value="today" min="1900-01-01" max="2050-12-12">
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <input type="file" id="image" name="files" value="<?php echo $row['image']; ?>"required><!--accept="image/png, image/jpeg"-->
                </div>

                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                </div>

                <div class="form-group">
                    <label for="pwd">Confirm Password:</label>
                    <input type="password" class="form-control" id="Re_pwd" placeholder="Enter password" name="Re_pswd"onChange="isPasswordMatch();"/>
                    <div id="divCheckPasswordT" class="text-success"></div>
                    <div id="divCheckPasswordF" class="text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary col-md-4" name="submit">Update</button>
                <a href="List_all_user.php"><span class="btn btn-warning">Cancle</span></a>
            </div>
        </div>
    </form>
<!--    --><?php //$_SESSION['id']=$row['id'] ?>
</div>
<script>
    function isPasswordMatch() {
        var password = $("#pwd").val();
        var confirmPassword = $("#Re_pwd").val();

        if (password != confirmPassword) $("#divCheckPasswordF").html("Passwords do not match!");
        else $("#divCheckPasswordT").html("Passwords match.");
    }

    $(document).ready(function () {
        $("#Re_pswd").keyup(isPasswordMatch);
    });
</script>
</body>
</html>

<?php
}else {
    echo '<h1 style=" color:#c5cf0c;"> Warning: System Do Not Get ID of User For Updating </h1>';
}
?>
