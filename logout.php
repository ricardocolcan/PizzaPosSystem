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
            session_start();
            unset($_SESSION['login_user']);
            unset($_SESSION['type_user']);
            unset($_SESSION['user_id']);
            
            echo '<h2>Logout sucessfully.</h2>';
            header('Refresh: 2; URL = login.php');
         ?>
    </main>
    <footer>
        <p class="copyright">&copy; PizzApp 2023</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script type="text/javascript" src="./js/base.js"></script>
</body>
</html>