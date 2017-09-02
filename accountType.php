<!DOCTYPE html>
<!--
Website : justDrive.com
developers : Vijay Kerure,Amol Patil.
-->
<?php
    
    include 'core/init.php';
    
    if($user->loggedIn()===true){
        header('Location: home.php');
        exit();
    }
    if(empty($_SESSION['RegisterSucess'])===false)
    {        
       // $_SESSION['RegisterSucess']= "You are sucessfully registered with justDrop.<br/>=> Confirmation email code is sent on your registered email-id.<br/>=> For Login first activate the account.<br/>=> Select your account type(default is STARTER).";
        header('Location: Signup.php');
        exit();
    }
    
?>


<html>    
    <?php include 'includes/head.php';?>
    <style type="text/css" media="screen">
    /*Pricing table and price blocks*/
		.pricing_table {
			line-height: 150%; 
			font-size: 12px; 
			margin: 0 auto; 
			width: 75%; 
			max-width: 800px; 
			padding-top: 10px;
			margin-top: 100px;
		}
		
		.price_block {
			text-align: center; 
			width: 100%; 
			color: #fff; 
			float: left; 
			list-style-type: none; 
			transition: all 0.25s; 
			position: relative; 
			box-sizing: border-box;
			
			margin-bottom: 10px; 
			border-bottom: 1px solid transparent; 
		}
		
		/*Price heads*/
		.pricing_table h3 {
			text-transform: uppercase; 
			padding: 5px 0; 
			background: url(images/bckg.png); 
			margin: -10px 0 1px 0;
		}
		
		/*Price tags*/
		.price {
			display: table; 
			background: url(images/bck.png); 
			width: 100%; 
			height: 70px; 
		}
                .storage {
			display: table; 
			background: white; 
			width: 100%; 
			height: 70px; 
                        color:black;
		}
		.price_figure {
			font-size: 24px; 
			text-transform: uppercase; 
			vertical-align: middle; 
			display: table-cell;
		}
		.price_number {
			font-weight: bold; 
			display: block;
		}
		.price_tenure {
			font-size: 11px; 
		}
		
		/*Features*/
		.features {
                    background: #ffffff; 
			color: #000;
		}
		.features li {
			padding: 8px 15px;
			border-bottom: 1px solid #ccc; 
			font-size: 11px; 
			list-style-type: none;
                        
		}
		
		.footer {
			padding: 15px; 
			background: #ffffff;
		}
                
                .action_button {
			text-decoration: none; 
			color: #fff; 
			font-weight: bold; 
			border-radius: 5px; 
			background: linear-gradient(#666, #333); 
			padding: 5px 20px; 
			font-size: 11px; 
			text-transform: uppercase;
		}
		
		.price_block:hover {
			box-shadow: 0 0 0px 5px rgba(0, 0, 0, 0.5); 
			transform: scale(1.04) translateY(-5px); 
			z-index: 1; 
			border-bottom: 0 none;
		}
		.price_block:hover .price {
			background:linear-gradient(#DB7224, #F9B84A); 
			box-shadow: inset 0 0 45px 1px #DB7224;
		}
		.price_block:hover h3 {
			background: #222;
		}
		.price_block:hover .action_button {
			background: linear-gradient(#F9B84A, #DB7224); 
		}
                @media only screen and (min-width : 480px) and (max-width : 768px) {
			.price_block {width: 50%;}
			.price_block:nth-child(odd) {border-right: 1px solid transparent;}
			.price_block:nth-child(3) {clear: both;}
			
			.price_block:nth-child(odd):hover {border: 0 none;}
		}
		@media only screen and (min-width : 768px){
			.price_block {width: 25%;}
			.price_block {border-right: 1px solid transparent; border-bottom: 0 none;}
			.price_block:last-child {border-right: 0 none;}
			
			.price_block:hover {border: 0 none;}
		}
		
    </style>
    <body>
        <?php include 'includes/topBar.php';?>        
       
	<!-- MAIN CONTENT -->
	<div id="content-white"> 
            <div style="width:70%;margin:0 auto;max-width: 400px; "><?php if(isset($_SESSION['RegisterSucess'])===true){ echo $utility->output_infoMessage($_SESSION['RegisterSucess']);$_SESSION['RegisterSucess']='';}?></div>
            <ul class="pricing_table">
		<li class="price_block">
			<h3>Starter</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">FREE</span>
				</div>
			</div>
                        <div class="storage">
				<div class="price_figure">
					<span class="price_number">10GB</span>
                                        
				</div>
			</div>
			<ul class="features">
				<li>Storage</li>				
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
                            <a href="javascript:alert('Congradulation,\nYou are sucessfully Registred STARTER plan.\nThank you for using JustDrop.\nLogin to get your Free sapce.');" class="action_button">GET</a>
			</div>
		</li>
                <li class="price_block">
			<h3>BASIC</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">$9.99</span>
					<span class="price_tenure">per month</span>
				</div>
			</div>
			<div class="storage">
				<div class="price_figure">
					<span class="price_number">100GB</span>
                                        
				</div>
			</div>
			<ul class="features">
				<li>Storage</li>				
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">Buy Now</a>
			</div>
		</li>
                <li class="price_block">
			<h3>PREMIUM</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">$19.99</span>
					<span class="price_tenure">per month</span>
				</div>
			</div>
			<div class="storage">
				<div class="price_figure">
					<span class="price_number">400GB</span>
                                        
				</div>
			</div>
			<ul class="features">
				<li>Storage</li>				
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">Buy Now</a>
			</div>
		</li>
                <li class="price_block">
			<h3>PRO</h3>
			<div class="price">
				<div class="price_figure">
					<span class="price_number">$39.99</span>
					<span class="price_tenure">per month</span>
				</div>
			</div>
			<div class="storage">
				<div class="price_figure">
					<span class="price_number">1TB</span>
                                        
				</div>
			</div>
			<ul class="features">
				<li>Storage</li>				
				<li>24/7 Email support</li>
			</ul>
			<div class="footer">
				<a href="#" class="action_button">Buy Now</a>
			</div>
		</li>
            </ul>
        </div>
    </body>
</html>
