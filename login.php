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
            <li><a href='login.php'>Login</a></li>
        </ul>        
    </nav>
    <main>
        <?php
            if(isset($_SESSION['login_user'])){
                echo "User already logged";
            }
            else{
        ?>
        <form action="authentication.php" method="POST">
            <h3>LOGIN TO PIZZA SALES APP</h3>
            <label for="user">User</label> <input type="text" name="username"><br>
            <label for="password">Password</label> <input type="password" name="password"><br><br>
            <input type="submit" value="Login"><br><br>
        </form>
        <?php } ?>
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
</body>
</html>