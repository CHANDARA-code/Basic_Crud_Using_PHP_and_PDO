<?php
session_start();

if(isset($_POST['logout']))
{
    session_destroy();
    header('Refresh:0.001;location: login.php');
}
if(isset($_SESSION['username'])){
    
    $db = new PDO('mysql:host=localhost;dbname=datatest','root','');
    $result = $db->query("select *from user_test");

    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/gif" sizes="60x60" href="PHP_logo1.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <title>List All User </title>
    </head>
    <body>
    <div class="container">
        <div class="container" style="margin-top: 30px">
            <form method="post" action="delete.php">
                <button type="submit" name="logout" class="btn btn-danger" onclick=" window.open('login.html','_blank')">Logout</button>
            </form>
        </div>
        <table class="table table-hover" id="list_all_user_info" >
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Class</th>
                <th>Gender</th>
                <th>Profile</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['DOB'] ?></td>
                    <td><?php echo $row['class'] ?></td>
                    <td><?php echo $row['gender'] ?></td>
                    <td>
                        <img src="image/<?php echo $row['image'] ?>" alt="" class="img-thumbnail" style="max-height: 100px; max-width: 100px">
                    </td>
                    <td>

<!--                        <form action="update.php" method="get"> <a href="FormUpdate.html" name="id" value="$id" value=“<?php echo $row[‘id’]; ?>” class="btn btn-success">Update</a> </form>-->
                        <form action="update.php" method="post" >
<!--                            <button name="id" value="--><?php //$id = $row['id']; ?><!--" class="btn btn-success" onclick=" window.open('FormUpdate.html','_blank')">Update</button>-->
                            <a href="update.php?id=<?php echo $row['id'] ?> " class="btn btn-success" >Update</a>
                            <?PHP  $_SESSION['id'] = $row['id']?>
                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="post" >
<!--                            <button name="id" value="--><?php //$id = $row['id']; ?><!--" class="btn btn-danger" onclick=" window.open('delete.php','_blank')">Delete</button>-->
                            <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </form>
                    </td>
                    <?PHP  $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username']
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>
        <!-- Datatable CSS -->
        <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

        <!-- jQuery Library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Datatable JS -->
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#list_all_user_info').DataTable();
            });
        </script>
    </div>
    </body>
    </html>
<?php
}else{
        header('location: signup.php');
    }
?>
