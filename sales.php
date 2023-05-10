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
    <main><br>
        <div id="orderSummary">
            <form action="selectCustomer.php" method='POST'>
                <div id="cart"></div>
                <div id='button_form'></div>
                <div id='quantity_pizzas_form'></div>
            </form>
        </div>
        <br>

        <div id="table">
        <?php 
            // Establish a MySQL connection
            $conn = mysqli_connect("localhost", "root", "", "pizza_sales");
            
            // SQL query to fetch information of registerd users and find user match.
            $query = "SELECT * FROM pizza ";
            
            $result = $conn->query($query);
            // print_r($result);
            if ($result->num_rows >0){
                while($row = $result->fetch_assoc()) {
                    // print_r($row);
                    echo "<div class='product'><b><span id='name".$row['id']."'>".$row['name']."</span></b><br>
                    <img class='imgProducts' src='img/".$row['image']."' width='50%'><br>Price $".$row['price']."<br><small>".$row['description']."</small><br>
                    <button type='button' value='".$row['price']."' onclick='addPizza(".$row['id'].",".$row['price'].")'>Add</button>
                </div>";
                }
            } 
            ?>            
        </div>
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
   
</body>
</html>