<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Sales APP</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="icon" href="./img/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
</head>
<body>
    <header>
        <div><img src="./img/logo.png" id="logo"></div> 
        <div id="title">PIZZA SALES APP</div> 
        <div id="menu">                        
            <a href="javascript:void(0);" class="icon" onclick="displayMenu()">&#9776;</a>
        </div>      
    </header>
    <nav id="linkMenu">       
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            
                session_start();
                if(isset($_SESSION['type_user'])){
                    if($_SESSION['type_user']==4){
                        echo "<li><a href='report.php'>Report</a></li>";
                    }
                }
                if(isset($_SESSION['login_user'])){
                    echo "<li><a href='sales.php'>Sales</a></li>
                    
                    <li><a href='logout.php'>Logout</a></li>";
                }
                else{
                    echo "<li><a href='login.php'>Login</a></li>";
                }
            ?>
        </ul>        
    </nav>
    <main>
        <h2>The following order has been generated:</h2> 
        <?php
         if (isset($_POST['quantityPizzas'])){
            $quantity=$_POST['quantityPizzas'];
            $totalPrice=$_POST['totalPrice'];
            $payment=$_POST['payment'];
            $user=$_SESSION['user_id'];
            
            //Select customer by phone
            $customerID=$_POST['customerPhone'];

            //Create user
            $createName=$_POST['createName'];
            $createPhone=$_POST['createPhone'];
            $createAddress=$_POST['createAddress'];
            $createPostal=$_POST['createPostal'];

            // Establish a MySQL connection
            $conn = mysqli_connect("localhost", "root", "", "pizza_sales");

            //CREATE CUSTOMER
            if($customerID==-1){
                $queryInsertCustomer = "insert into client (name,phone_number,address,postal_code) values ('".$createName."','".$createPhone."','".$createAddress."','".$createPostal."')";
                // echo $queryInsertCustomer."<br>";
                $result = $conn->query($queryInsertCustomer);
                
                $queryCustomerID="select id from client where phone_number='".$createPhone."'";
                // echo $queryCustomerID."<br>";
                $result = $conn->query($queryCustomerID);          
                if ($result->num_rows >0){
                    while($row = $result->fetch_assoc()) {
                        $customerID=intval($row['id']);
                    }
                }
            }

            //INSERT ORDER TABLE           
            $queryInsertOrder = "insert into pizza_sales.order (client_id, total_price, payment_type,user_id ) values ('".$customerID."','".$totalPrice."','".$payment."','".$user."')";
            // echo $queryInsertOrder."<br>";
            $result = $conn->query($queryInsertOrder);  

            //SELECT ID ORDER
            $querySelectID = "SELECT max(id) as id FROM pizza_sales.order";
                
            $result = $conn->query($querySelectID);          
            if ($result->num_rows >0){
                while($row = $result->fetch_assoc()) {
                    $orderID=intval($row['id']);
                }
            }

            for($i=1; $i<=$quantity;$i++){
                $idPizza=$_POST['id_'.$i];
                $unitPrice=$_POST['price_'.$i];
                $queryInsertSubOrder="insert into sub_order (order_id,pizza_id,unit_price) values ('".$orderID."','".$idPizza."','".$unitPrice."')";
                // echo $queryInsertSubOrder."<br>";
                $result = $conn->query($queryInsertSubOrder); 
            }
            
            //$result = $conn->query($query);
            echo "<div style='text-align:center;'> <h2>ORDER NUMBER: ".$orderID."</h2>
            <a href='./invoice/pdfg.php?orderID=".$orderID."' target='_blank'> PRINT INVOICE</a>
                    </div>";

                   
        
         }
        ?>          
    <br><br>
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
   
</body>
</html>