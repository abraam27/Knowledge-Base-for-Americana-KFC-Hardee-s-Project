<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
		<?php
			if($brand == 1){
				if($category == 1){
					$pageName = "Individual Meal";
				}elseif($category == 2){
					$pageName = "Family Meal";
				}elseif($category == 3){
					$pageName = "Sandwich";
				}elseif($category == 4){
					$pageName = "Kids Meal";
				}elseif($category == 5){
					$pageName = "Sides Item";
				}elseif($category == 6){
					$pageName = "Souce";
				}elseif($category == 7){
					$pageName = "Drink";
				}elseif($category == 8){
					$pageName = "Dessert";
				}else{
					header('HomePage.php');
				}
			}elseif($brand == 2){
				if($category == 1){
					$pageName = "Beef Sandwich";
				}elseif($category == 2){
					$pageName = "Chicken Sandwich";
				}elseif($category == 3){
					$pageName = "Sea Food Meal";
				}elseif($category == 4){
					$pageName = "Offer";
				}elseif($category == 5){
					$pageName = "Kids Meal";
				}elseif($category == 6){
					$pageName = "Side";
				}elseif($category == 7){
					$pageName = "Souce";
				}elseif($category == 8){
					$pageName = "Drink";
				}elseif($category == 9){
					$pageName = "Dessert";
				}else{
					header('HomePage.php');
				}
			}else{
				header('HomePage.php');
			}
			if($brand == 1){
				echo '<title>KFC - '.$pageName.'</title>';
			}elseif($brand == 2){
				echo '<title>Hardees - '.$pageName.'</title>';
			}else{
				echo '<title>Americana - '.$pageName.'</title>';
			}
		?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Americana Knowladge">
        <meta name="author" content="Abraam Emad">
        <?php
            if($brand == 1){
                echo '<link rel="shortcut icon" href="../../images/kfc.png" />';
            }elseiF($brand == 2){
                echo '<link rel="shortcut icon" href="../../images/hardees1.png" />';
            }else{
                echo '<link rel="shortcut icon" href="../../images/logo.png" />';
            }
        ?>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The styles -->
		<link rel="stylesheet" href="../../css/reset-min.css" />
		<link rel="stylesheet" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../css/cheatsheet.css" />
		<link rel="stylesheet" href="../../css/base.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="welcome">
				<div class="container">
					<p>Welcome to Admin Dashboard.</p>
				</div>
			</div>
			<div id="adminNav">
				<div class="container">
					<div class="left-container">
					<?php
						if($brand == 1){
							echo '<img src="../../images/kfc.png"/>';
						}elseif($brand == 2){
							echo '<img src="../../images/hardees1.png"/>';
						}else{
							echo '<img src="../../images/logo.png"/>';
						}
					?>
					</div>
					<div class="right-container">

