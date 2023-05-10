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
    <form action="generateOrder.php" method="POST">
        <br>
    <div id="customerTable">
        <div>
            <p><a href="#" id="clickNewCustomer">Create Customer</a></p>
        </div>
        <div>
            <p><a href="#" id="clickExistsCustomer">Search by Phone</a></p>        
        </div>
        
        <div id='customerNew'>
                <div>Full Name</div>
                <div>Phone number</div>
                <div><input type="text" name="createName"></div>
                <div><input type="text" name="createPhone"></div>
                <div>Address</div> 
                <div>Postal Code</div> 
                <div><input type="text" name="createAddress"></div>
                <div><input type="text" name="createPostal"></div>    
        </div>
        <div id="customerExists">    
            
                <?php
                // Establish a MySQL connection
                $conn = mysqli_connect("localhost", "root", "", "pizza_sales");
                
                $query = "SELECT * FROM client order by name asc";
                
                $result = $conn->query($query);
                // print_r($result);
                if ($result->num_rows >0){
                    echo "<div>Phone</div>
                        <div><select name='customerPhone'><option value='-1'>- Select -</option>";
                    while($row = $result->fetch_assoc()) {
                        // print_r($row);
                        echo "<option value='".$row['id']."'>".$row['phone_number']."</option>";
                    }
                    echo "</select></div>";                   

                } 
                ?> 
            </div>
        </div>
        
        <div id="orderSummary">
                
                <h3>Order Summary</h3>  
                <?php 
                if (isset($_POST['quantityPizzas'])){
                    $quantity=intval($_POST['quantityPizzas']);
                    $total=0;
                    for($i=1; $i<=$quantity;$i++){
                        $id=$_POST['id_'.$i];
                        $name=$_POST['name_'.$i];
                        $price=intval($_POST['price_'.$i]);
                        $total+=$price;
                        echo "<p>".$name." - $".$price."</p>";
                        echo "<input type='hidden' name='id_".$i."' value='".$id."'>
                                <input type='hidden' name='price_".$i."' value='".$price."'>";
                    }
                    echo "<p><b>TOTAL ORDER: $".$total."</b></p>
                    <input type='hidden' name='totalPrice' value='".$total."'>
                    <input type='hidden' name='quantityPizzas' value='".$quantity."'>";
                }

                ?>
        </div>
        <div id="paymentTable">
            <h3>Payment Method</h3>
            <input type="radio" name="payment" value="1" checked> <label for="">CASH</label>
            <input type="radio" name="payment" value="2"> <label for="">DEBIT</label>
            <input type="radio" name="payment" value="3"> <label for="">CREDIT</label>
            <br><br>
            <input type="submit" value="GENERATE ORDER">
        </div>
    
        <br>  
    </form>      
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
   
</body>
</html>