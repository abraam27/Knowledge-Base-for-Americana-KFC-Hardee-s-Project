<!-- header -->
<?php
    $brand = 0;
    $category = 0;
    $pageName = "";
    if(isset($_GET['brand'], $_GET['category'])){
        $brand = $_GET['brand'];
        $category = $_GET['category'];
    }else{
        header('HomePage.php');
    }
    require_once '../../model/meal.php';
    require_once '../../lib/price.php';
    require_once '../../lib/ingredient.php';
    require_once '../../lib/comment.php';
    require_once '../template/adminHeader.tpl';
    echo '<p class="header">Add '.$pageName.' / <a href="meals.php?brand='.$brand.'&category='.$category.'"> '.$pageName.'s </a> / <a href="addComment.php?brand='.$brand.'&category='.$category.'"> Add Comment </a> / <a href="comments.php?brand='.$brand.'&category='.$category.'"> Comments </a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_POST['add'])){
            $mealID = 0;
            $mealName = "";
            $brand = 0;
            $category = 0;
            $rprice = 0;
            $mprice = 0;
            $lprice = 0;
            $fprice = 0;
            $channel = "";
            $mainoffer = 0;
            $availability = 1;
            $normal = 0;
            $spicy = 0;
            $ingredient1 = "";
            $ingredient2 = "";
            $ingredient3 = "";
            $comment1 = "";
            $comment2 = "";
            $comment3 = "";
            $mealImage = "";
            $mealImageTmp = "";
            if(isset($_POST['mealName']) && ($_POST['mealName'] != "")){
                $mealName = $_POST['mealName'];
                $brand = $_POST['brand'];
                $category = $_POST['category'];
                if((isset($_POST['rprice']) && ($_POST['rprice'] != "") && is_numeric($_POST['rprice'])) || (isset($_POST['mprice']) && ($_POST['mprice'] != "") && is_numeric($_POST['mprice'])) || (isset($_POST['lprice']) && ($_POST['lprice'] != "") && is_numeric($_POST['lprice'])) || (isset($_POST['fprice']) && ($_POST['fprice'] != "") && is_numeric($_POST['fprice']))){
                    if(isset($_POST['rprice'])){
                        $rprice = $_POST['rprice'];
                    }
                    if(isset($_POST['mprice'])){
                        $mprice = $_POST['mprice'];
                    }
                    if(isset($_POST['lprice'])){
                        $lprice = $_POST['lprice'];
                    }
                    if(isset($_POST['fprice'])){
                        $fprice = $_POST['fprice'];
                    }
                    if(isset($_POST['channel'])){
                        $channel = $_POST['channel'];
                    }
                    if(isset($_POST['mainoffer'])){
                        $mainoffer = 1;
                    }
                    if(isset($_POST['availability'])){
                        $availability = 0;
                    }
                    if(isset($_POST['normal']) && isset($_POST['spicy'])){
                        $taste = 2;
                    }elseif(isset($_POST['normal'])){
                        $taste = 0;
                    }else{
                        $taste = 1;
                    }
                    if(isset($_POST['ingredient1'])){
                        $ingredient1 = $_POST['ingredient1'];
                    }
                    if(isset($_POST['ingredient2'])){
                        $ingredient2 = $_POST['ingredient2'];
                    }
                    if(isset($_POST['ingredient3'])){
                        $ingredient3 = $_POST['ingredient3'];
                    }
                    if(isset($_POST['comment1'])){
                        $comment1 = $_POST['comment1'];
                    }
                    if(isset($_POST['comment2'])){
                        $comment2 = $_POST['comment2'];
                    }
                    if(isset($_POST['comment3'])){
                        $comment3 = $_POST['comment3'];
                    }
                    if(isset($_FILES['mealImage']['name'])){
                        $mealImage = $_FILES['mealImage']['name'];
                        $mealImageTmp = $_FILES['mealImage']['tmp_name'];
                        $meal = new Meal($mealName, $channel, $mainoffer, $availability, $taste, $category, $brand, $mealImage, $mealImageTmp);
                        $mealID = $meal->addMeal();
                    }else{
                        $meal = new Meal($mealName, $channel, $mainoffer, $availability, $taste, $category, $brand);
                        $mealID = $meal->addMeal();
                    }
                    if($mealID){
                        if($rprice > 0){
                            $price = new Price(1, $rprice, $mealID);
                            $price->add();
                        }
                        if($mprice){
                            $price = new Price(2, $mprice, $mealID);
                            $price->add();
                        }
                        if($lprice){
                            $price = new Price(3, $lprice, $mealID);
                            $price->add();
                        }
                        if($fprice){
                            $price = new Price(4, $fprice, $mealID);
                            $price->add();
                        }
                        if($ingredient1 != ""){
                            $ingredient = new Ingredient($ingredient1, $mealID);
                            $ingredient->add();
                        }
                        if($ingredient2 != ""){
                            $ingredient = new Ingredient($ingredient2, $mealID);
                            $ingredient->add();
                        }
                        if($ingredient3 != ""){
                            $ingredient = new Ingredient($ingredient3, $mealID);
                            $ingredient->add();
                        }
                        if($comment1 != ""){
                            $comment = new Comment($comment1, $mealID);
                            $comment->add();
                        }
                        if($comment3 != ""){
                            $comment = new Comment($comment2, $mealID);
                            $comment->add();
                        }
                        if($comment3 != ""){
                            $comment = new Comment($comment3, $mealID);
                            $comment->add();
                        }
                        header('location: mealDetails.php?mealID='.$mealID.'&message=added');
                    }else{
                        echo '<div class="redMessage">
                                <p>The Meal is not Added Please try Again !</p>
                            </div>';
                            header('location: addMeal.php?brand='.$meal['brand'].'&category='.$meal['category'].'');
                    }
                }else{
                    echo '<div class="redMessage">
                        <p>The Meal is not Added Please Add At Least One Price And Try Again !</p>
                    </div>';
                    header('location: addMeal.php?brand='.$meal['brand'].'&category='.$meal['category'].'');
                }
            }else{
                echo '<div class="redMessage">
                        <p>The Meal is not Added Please Add The Meal Name And Try Again !</p>
                    </div>';
                    header('location: addMeal.php?brand='.$meal['brand'].'&category='.$meal['category'].'');
            }

        }
    ?>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-group col-md-12">
                <label for="exampleInputText"><?php echo $pageName.' ';?>Name</label>
                <input type="text" name="mealName" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter English Name">
            </div>
            <?php
                if(($brand == 1 && $category == 5) || ($brand == 2 && $category == 6)){
                    echo '<div class="form-group col-md-3">
                            <label for="exampleInputText">Requler Price</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Requler">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputText">Medium Price</label>
                            <input type="text" name="mprice" class="form-control" id="exampleInputText" placeholder="Medium">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputText">Large Price</label>
                            <input type="text" name="lprice" class="form-control" id="exampleInputText" placeholder="Large">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputText">Family Price</label>
                            <input type="text" name="fprice" class="form-control" id="exampleInputText" placeholder="Family">
                        </div>';
                }elseif(($brand == 1 && ($category == 1 || $category == 7)) || ($brand == 2 && ($category == 7 || $category == 8))){
                    echo '<div class="form-group col-md-4">
                            <label for="exampleInputText">Requler Price</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Requler">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Medium Price</label>
                            <input type="text" name="mprice" class="form-control" id="exampleInputText" placeholder="Medium">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Large Price</label>
                            <input type="text" name="lprice" class="form-control" id="exampleInputText" placeholder="Large">
                        </div>';
                }elseif($brand == 1 && $category == 3){
                    echo '<div class="form-group col-md-4">
                            <label for="exampleInputText">Sandwich Price</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Sandwich">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Meal Price</label>
                            <input type="text" name="mprice" class="form-control" id="exampleInputText" placeholder="Meal">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Box Price</label>
                            <input type="text" name="lprice" class="form-control" id="exampleInputText" placeholder="Box">
                        </div>';
                }elseif($brand == 1 && $category == 2){
                    echo '<div class="form-group col-md-4">
                            <label for="exampleInputText">Price 1</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Price 1">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Price 2</label>
                            <input type="text" name="mprice" class="form-control" id="exampleInputText" placeholder="Price 2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Price 3</label>
                            <input type="text" name="lprice" class="form-control" id="exampleInputText" placeholder="Price 3">
                        </div>';
                }elseif($brand == 2 && ($category == 1 || $category == 2)){
                    echo '<div class="form-group col-md-6">
                            <label for="exampleInputText">Sandwich Price</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Sandwich">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputText">Combo Price</label>
                            <input type="text" name="mprice" class="form-control" id="exampleInputText" placeholder="Combo">
                        </div>';
                }else{
                    echo '<div class="form-group col-md-12">
                            <label for="exampleInputText">Price</label>
                            <input type="text" name="rprice" class="form-control" id="exampleInputText" placeholder="Price">
                        </div>';
                }
            ?>
            <div class="form-group col-md-12">
                <label for="exampleInputText">Channals</label>
                <input type="text" name="channel" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Online / App / Talabat ...">
            </div>
            <div class="form-group col-md-12">
                <label for="exampleFormControlFile1">Meal Image</label>
                <input type="file" name="mealImage" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <?php
                if(($brand == 1 && ($category == 1 || $category == 3)) || ($brand == 2 && ($category == 1 || $category == 2 || $category == 3))){
                    echo '<div class="checkbox col-md-12">
                            <label>
                            <input type="checkbox" value="1" name="mainoffer">
                            Main Offer
                            </label>
                        </div>';
                }
            ?>
            <div class="checkbox col-md-12">
                <label>
                  <input type="checkbox" value="0" name="availability">
                  Not Available
                </label>
            </div>
            <div class="form-group col-md-12">
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="1" name="normal" checked> Normal
                </label>
                    <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="1" name="spicy" checked> Spicy
                </label>
            </div>
            <div class="form-group col-md-12">
                <label >Ingredients</label>
                <textarea class="form-control"  name="ingredient1" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Ingredients</label>
                <textarea class="form-control"  name="ingredient2" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Ingredients</label>
                <textarea class="form-control"  name="ingredient3" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Comments</label>
                <textarea class="form-control" name="comment1" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Comments</label>
                <textarea class="form-control" name="comment2" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Comments</label>
                <textarea class="form-control" name="comment3" rows="3"></textarea>
            </div>
            <?php
                echo '<input type="hidden" value="'.$category.'" name="category">
                <input type="hidden" value="'.$brand.'" name="brand">';
            ?>
            <button type="submit" name="add" value="add" class="btn btn-secondary btn-lg btn-block">ADD</button>
        </form>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

