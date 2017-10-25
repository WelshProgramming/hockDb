<?php
require_once "connect.php";

if (isset($_GET['activePage']))
    $currentpage=$_GET['activePage'] . ".php";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NHL Database Project</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<header>
    <div id="logo">
        <h1><a href="index.php"><img src="images/logo.png"</a></h1>
        <h2>NHL</h2>
    </div>
    <nav id="menu">
        <ul>
            <li class="first"><a href="index.php" title="">Home</a></li>
            <li><a href="index.php?activePage=divisions" title="">Divisions</a></li>
            <li><a href="index.php?activePage=games" title="">Games</a></li>
        </ul>
    </nav>
</header>
<!-- start page -->
<section id="page">
        <div>
        <?php
        if(!isset($_REQUEST['activePage']))
           require "welcome.php";
        else
           require $currentpage;
            ?>
        </div>
</section>
<div class="cleaner"></div>


<!-- end page -->
<footer id="footer">
    <p class="fcenter">All right reserved. National Hockey League<a href="index.php"></a> </p>
</footer>


</body>
</html>
<?php
//mysqli_close($conn);
?>