<!DOCTYPE html>
<!--
Project : justdrop
developers : Vijay Kerure.
-->
<?php
include 'core/init.php';
if($user->loggedIn()===true){
    header('Location: home.php');
    exit();
}
?>

<html>   

<?php include 'includes/head.php';?>

<body>

    <?php include 'includes/topBar.php';?>        

    <!-- MAIN CONTENT -->
    <div id="content-white"> 

        <center>
            <div id="slider">				
                <img src="images/slider/11.png" />
                <img src="images/slider/22.png"  />
                <img src="images/slider/Backup.png"  />
                <img src="images/slider/AcessAnywhere1.png" />
            </div>
        </center>
    </div>

    <!-- Index Page -->
    <div id="indexPage">
        <div class="left">
            <img src="images/cross-b.png" alt="CROSS BROWSER">                
        </div>
        <div class="right cf">
            <p><strong>Cross-Browser Compatible.</strong>
                <br>  
                JustDrop is compilable with any web-browser. Justdrop also supports mobile compilable browsers.
            </p>
        </div>
        <div class="left">
            <p><strong>Access Anywhere.</strong>
                <br>  
                JustDrop is accessed from anywhere using provided user-id and password. ie. User can access their accounts on mobile or pc from anywhere in world.
            </p>
        </div>
        <div class="right cf">
            <img src="images/3.png" alt="Access Anywhere">
        </div>
        
    </div>

    <?php include './includes/footer.php';?>
</body>
</html>