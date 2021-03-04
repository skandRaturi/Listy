<?php
if(isset($_POST['item'])){
    $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con));
    $name = $_POST['item'];
    $ammount = $_POST['ammount'];
    $sql = "INSERT INTO `listy`.`shoping_list` (`name`, `ammount`) VALUES ('$name', '$ammount');";
    
    if($con->query($sql)==false){
        echo "Error: $sql <br> $con->error";
    }
    $con->close();
}
elseif(isset($_POST['method'])){    
    $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con));
    if($_POST['method'] == 'deleteList'){
        $sql = "TRUNCATE TABLE `listy`.`shoping_list`;";
        if($con->query($sql)==true){
            echo 'successfully deleted';
        }else{
            echo "Error: $sql <br> $con->error";
        }
    }elseif($_POST['method'] == 'deleteItem'){
        $id = $_POST['id'];
        $sql = "DELETE FROM `listy`.`shoping_list` WHERE id = '$id';";
        if($con->query($sql)==true){
            echo 'successfully deleted';
        }else{
            echo "Error: $sql <br> $con->error";
        }
    }
    $con->close();    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listy</title>
    <link rel="stylesheet" href="public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/app.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="display-4">L!sty</h1>
        <div class="container text-center" id="content">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <form action="index.php" method="post" id="newItem" class="text-aling-center">
                        <h3 class="form-group">Add new Item To your List</h3>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="item" id="itemName" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" name="ammount" id="itemQuant" class="form-control"
                                    placeholder="Ammount" min="1" max='100'>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="Submit" value="ADD" class="btn btn-sm btn-block btn-outline-success">
                        </div>
                    </form>
                </div>
                <br>
            </div>
            <div id="shoppingList" class="">
                <h2 class="display-5 text-left">Your Shopping list</h2>
                <div class="list-group list-group-flush">
                    <?php 
                        $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con)); 
                    ?>                    
                    <form action="index.php" method="post">
                        <input type="hidden" name="method" value="deleteList"/>
                        <button type="submit" class="btn btn-danger btn-block container-fluid" id="deleteButton">DELETE LIST</button>
                    </form>
                    <?php
                        $sql = "Select id, name, ammount from `shoping_list`;";
                        $result = mysqli_query($con, $sql);
                        if(!empty($result)){
                            while($row = mysqli_fetch_array($result)){
                    ?>
                    <li class="list-group-item list-group-item-active items" type="submit">
                        <span class="float-left"><?php echo $row["name"]; ?></span>
                        <form action="index.php" method="post" class="float-right hideClass">
                            <input type="hidden" name="method" value="deleteItem"/> 
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">                               
                            <button type="submit" class="deleteItem badge badge-danger btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-low" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                        <span class="float-right"><?php echo $row["ammount"]; ?></span>
                    </li>
                    <?php                        
                            }
                        }
                        $con->close();                       
                    ?>
                    <li class="list-group-item m-0 p-0"></li>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/lib/jquery.min.js"></script>
    <script src="public/js/bootstrap/bootstrap.js"></script>
    <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="public/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>