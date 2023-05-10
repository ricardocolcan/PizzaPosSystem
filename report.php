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
        <div style="text-align:center;"><h2>SALES REPORT AND GENERATED INVOICE</h2> </div>
        <div id="tableReport">
            <div class='columnTitle'>ORDER NUMBER</div>
            <div class='columnTitle'>CUSTOMER NAME</div>
            <div class='columnTitle'>ORDER DATE</div>
            <div class='columnTitle'>TOTAL PRICE</div>
            <div class='columnTitle'>PAYMENT TYPE</div>
            <div class='columnTitle'>SOLD BY</div>
            
        <?php
         
            // Establish a MySQL connection
            $conn = mysqli_connect("localhost", "root", "", "pizza_sales");

            

            //SELECT ID QUERY SALES
            $querySelectID = "select op.id as order_number,c.name, op.order_time,op.total_price,pt.type,u.full_name as user from pizza_sales.order as op, client as c, payment_type as pt, pizza_sales.user as u where op.client_id=c.id and pt.id=op.payment_type and u.id=op.user_id order by order_number desc";
                
            $result = $conn->query($querySelectID);          
            if ($result->num_rows >0){
                while($row = $result->fetch_assoc()) {
                    $orderID=intval($row['order_number']);
                    $customerName=$row['name'];
                    $orderDate=$row['order_time'];
                    $totalPrice=$row['total_price'];
                    $paymentType=$row['type'];
                    $userOrder=$row['user'];
                    echo "<div class='rowOrder'><a href='./invoice/pdfg.php?orderID=".$orderID."' target='_blank'>".$orderID."</a></div>
                        <div>".$customerName."</div>
                        <div>".$orderDate."</div>
                        <div class='rowOrder'>$".$totalPrice."</div>
                        <div class='rowOrder'>".$paymentType."</div>
                        <div class='rowOrder'>".$userOrder."</div>";

                }
            }  
        ?>  
        </div>        
    <br><br>
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
   
</body>
</html>


