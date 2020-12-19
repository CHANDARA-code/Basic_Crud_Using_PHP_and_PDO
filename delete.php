
<?php
if( isset($_GET['id']) ){
    ob_start();
    echo'
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
</head>
<style>
    form
    {
    font-family: "Open Sans";
    }
    #wrapper
    {
    border: 1px solid #888;
    padding:20px;
    background-color: yellow;
    margin:15%;
    }
</style>
<body>
<form method="post" >
    <div class="row">
        <div class="col-4"></div>
        <div id="wrapper" class="text-center col-2" >
            <label for="yes_no_radio">Are you sure to delete this user</label>
            <div >
                <button type="submit" name="yes" class="btn btn-danger">Yes</button>
                <a href="List_all_user.php" class="btn btn-success"> No</a>
            </div>
        </div>
        <div class="col-4"></div>
   </div>
</form>


</body>
</html>
    ';

    if(isset($_POST['yes'])){

        $pdo = new PDO('mysql:host=localhost;dbname=datatest','root','');
        $id = $_GET['id'];
        //echo $id;
//    $statement = $pdo->prepare("DELETE * FROM user_test where id= :id");
//    $statement->bindValue(':id', $id);
//    $delete = $statement->execute();
        $delete = $pdo->prepare("delete from user_test where id =".$id);  //Get ID from button delete
        $delete->execute();
        if (!$delete) {
            die("Cannot delete");
        }
        echo "<br>" . '<h1 style=" color: green;" >Delete Successful</h1>';
        header("Refresh:2;url=List_all_user.php");

    }
}

else {
    echo '<h1 style=" color:#c5cf0c;"> Warning: System Do Not Get ID of User For Deleting </h1>';
}

?>

<!--$query = $pdo->prepare("DELETE * FROM user WHERE id='.$id'");-->
<!--$query->execute();-->
<!--$delete = $query->execute();-->

