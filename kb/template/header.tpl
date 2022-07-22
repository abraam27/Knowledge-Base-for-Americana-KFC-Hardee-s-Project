<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	
    <head>
        <meta charset="utf-8">
		<?php
			if($brand == 1){
				if($category == 1){
					$pageName = "Individual Meals";
				}elseif($category == 2){
					$pageName = "Family Meals";
				}elseif($category == 3){
					$pageName = "Sandwiches";
				}elseif($category == 4){
					$pageName = "Kids Meals";
				}elseif($category == 5){
					$pageName = "Sides Items";
				}elseif($category == 6){
					$pageName = "Souces";
				}elseif($category == 7){
					$pageName = "Drinks";
				}elseif($category == 8){
					$pageName = "Dessert";
				}else{
					header('Home.php');
				}
			}elseif($brand == 2){
				if($category == 1){
					$pageName = "Beef";
				}elseif($category == 2){
					$pageName = "Chicken";
				}elseif($category == 3){
					$pageName = "Sea Food";
				}elseif($category == 4){
					$pageName = "Offers";
				}elseif($category == 5){
					$pageName = "Kids";
				}elseif($category == 6){
					$pageName = "Sides";
				}elseif($category == 7){
					$pageName = "Souces";
				}elseif($category == 8){
					$pageName = "Drinks";
				}elseif($category == 9){
					$pageName = "Dessert";
				}else{
					header('Home.php');
				}
			}else{
				header('Home.php');
			}
			if($brand == 1){
				echo '<title>KFC - '.$pageName.'</title>';
			}elseif($brand == 2){
				echo '<title>Hardees - '.$pageName.'</title>';
			}else{
				echo '<title>Americana - '.$pageName.'</title>';
			}
			
		?>
        <title>Americana Knowlage</title>
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
        <!-- The styles -->
        <link rel="stylesheet" href="../../css/reset-min.css" />
        <link rel="stylesheet" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../css/cheatsheet.css" />
        <link rel="stylesheet" href="../../css/base.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div class="container">
                    <?php
                        if($brand == 1){
                            echo '<img class="logo" src="../../images/kfc.png"/>';
                        }elseiF($brand == 2){
                            echo '<img class="logo" src="../../images/hardees.png"/>';
                        }else{
                            echo '<img class="logo" src="../../images/logo.png"/>';
                        }
                    ?>
				</div>
				
			</div>
			<div id="navbar">
				<div class="container">
					<ul>
						<li><a href="#home">Home</a></li>
						<li class="ddown">
						  <a class="dbtn">Hardee's</a>
						  <div class="ddown-content">
							<a href="Meals.php?brand=2&category=1">Beef</a>
							<a href="Meals.php?brand=2&category=2">Chicken</a>
							<a href="Meals.php?brand=2&category=3">Sea Food</a>
							<a href="Meals.php?brand=2&category=4">Offers</a>
							<a href="Meals.php?brand=2&category=5">Kids</a>
							<a href="Meals.php?brand=2&category=6">Sides</a>
							<a href="Meals.php?brand=2&category=7">Souces</a>
							<a href="Meals.php?brand=2&category=8">Drinks</a>
							<a href="Meals.php?brand=2&category=9">Deserts</a>
						  </div>
						</li>
						<li class="ddown">
							<a class="dbtn">KFC</a>
							<div class="ddown-content">
								<a href="Meals.php?brand=1&category=1">Individual</a>
								<a href="Meals.php?brand=1&category=2">Family</a>
								<a href="Meals.php?brand=1&category=3">Sandwitches</a>
								<a href="Meals.php?brand=1&category=4">Kids</a>
								<a href="Meals.php?brand=1&category=5">Side Items</a>
								<a href="Meals.php?brand=1&category=6">Souces</a>
								<a href="Meals.php?brand=1&category=7">Drinks</a>
								<a href="Meals.php?brand=1&category=8">Deserts</a>
							</div>
						  </li>
						<li><a href="#">Briefing</a></li>
						<li><a href="#">Others</a></li>
						<li><a href="#">Follow up & Complains</a></li>
					</ul>
				</div>
			</div>
            <div id="slideShow">
				<div class="container">
					<div class="headers pageName">
						<?php echo $pageName ?>
					</div>	
                        <?php
                            $comments = Categorycomment::retreiveCommentsBycategoryAndBrand($category,$brand);
							if(is_array($comments) && count($comments)>0){
								echo'<div class="comment">';
                            	foreach($comments as $comment) {
                                	echo '<p>'.$comment['comment'].'</p>';
								}
								echo '</div>';
							}
                        ?>
				</div>
			</div>