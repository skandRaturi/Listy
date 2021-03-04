<?php
if(isset($_POST['item'])){
    $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con));
    $name = $_POST['item'];
    $ammount = $_POST['ammount'];
    $sql = "INSERT INTO `listy`.`shoping_list` (`name`, `ammount`) VALUES ('$name', '$ammount');";
    
    if($con->query($sql)==true){
        echo 'successfully inserted';
    }else{
        echo "Error: $sql <br> $con->error";
    }
    $con->close();
}
elseif(isset($_POST['method'])){    
    if($_POST['method'] == 'put'){
        $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con));
        $sql = "TRUNCATE TABLE `listy`.`shoping_list`;";
        if($con->query($sql)==true){
            echo 'successfully deleted';
        }else{
            echo "Error: $sql <br> $con->error";
        }
        $con->close();
    }
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
</head>

<body>
    <div class="container">
        <h1 class="display-4">L!sty</h1>
        <div class="container text-center">
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
                            <input type="Submit" value="Add" class="btn btn-sm btn-block btn-outline-success">
                        </div>
                    </form>
                </div>
                <br>
            </div>
            <div id="shoppingList" class="">
                <h2 class="display-5 text-left">Your shopping list</h2>
                <div class="list-group">
                    <?php 
                        $con = mysqli_connect("localhost", "root", "", "listy", "3308") or die(mysqli_error($con)); 
                    ?>                    
                    <form action="index.php" method="post">
                        <input type="hidden" name="method" value="put"/>
                        <button type="submit" class="btn btn-outline-danger btn-block container-fluid" id="deleteButton">Delete</button>
                    </form>
                    <?php
                        $sql = "Select * from `shoping_list`;";
                        $result = mysqli_query($con, $sql);
                        if(!empty($result)){
                            while($row = mysqli_fetch_array($result)){
                    ?>
                    <li class="list-group-item list-group-item-active items">
                        <span class="float-left"><?php echo $row["name"]; ?></span>
                        <span class="float-right"><?php echo $row["ammount"]; ?></span>
                    </li>
                    <?php                        
                            }
                        }
                        $con->close();                       
                    ?>
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