<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Sales APP</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
    <header>
        <div><img src="./img/logo.png" alt="Logo Wheel Bike" id="logo"></div> 
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
    <?php

    $error="";
if (isset($_POST['username'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];        
        
        // Establish a MySQL connection
        $conn = mysqli_connect("localhost", "root", "", "pizza_sales");
        
        // SQL query to fetch information of registerd users and find user match.
        $query = "SELECT * FROM user WHERE user='$username' AND password='$password'";
        
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['login_user'] = $username; // Initializing Session  
            $error="Login correctly";
            $row = $result->fetch_assoc();
            $_SESSION['type_user']=$row['type_user_id'];
            $_SESSION['user_id']= $row['id'];
            header("location: sales.php"); // Redirecting To Profile Page
        } else {
            $error = "Username or Password is invalid";
        }
        mysqli_close($conn); // Closing Connection
    }
}
?>


               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                  
  

    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
</body>
</html>