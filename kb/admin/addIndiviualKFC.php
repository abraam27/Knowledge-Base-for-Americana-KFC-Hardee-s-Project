<!-- header -->
<?php
    $brand = 1;
    $category = 1;
    require_once '../../model/meal.php';
    require_once '../../lib/price.php';
    require_once '../../lib/ingredient.php';
    require_once '../../lib/comment.php';
    require_once '../template/adminHeader.tpl';
    echo '<p class="header">Add Individual Meal / <a href="indiviualMealsKFC.php"> Individual Meals </a> / <a href="addComment.php?brand='.$brand.'&category='.$category.'"> Add Comment </a> / <a href="comments.php?brand='.$brand.'&category='.$category.'"> Comments </a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_POST['add'])){
            $mealID = 0;
            $mealName = "";
            $rprice = 0;
            $mprice = 0;
            $lprice = 0;
            $channel = "";
            $mainoffer = 0;
            $availability = 1;
            $normal = 0;
            $spicy = 0;
            $ingredient1 = "";
            $ingredient2 = "";
            $comment1 = "";
            $comment2 = "";
            $comment3 = "";
            $mealImage = "";
            $mealImageTmp = "";
            if(isset($_POST['mealName']) && ($_POST['mealName'] != "")){
                $mealName = $_POST['mealName'];
                if((isset($_POST['rprice']) && ($_POST['rprice'] != "") && is_numeric($_POST['rprice'])) || (isset($_POST['mprice']) && ($_POST['mprice'] != "") && is_numeric($_POST['mprice'])) || (isset($_POST['lprice']) && ($_POST['lprice'] != "") && $_POST['lprice'])){
                    if(isset($_POST['rprice'])){
                        $rprice = $_POST['rprice'];
                    }
                    if(isset($_POST['mprice'])){
                        $mprice = $_POST['mprice'];
                    }
                    if(isset($_POST['lprice'])){
                        $lprice = $_POST['lprice'];
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
                        if($ingredient1 != ""){
                            $ingredient = new Ingredient($ingredient1, $mealID);
                            $ingredient->add();
                        }
                        if($ingredient2 != ""){
                            $ingredient = new Ingredient($ingredient2, $mealID);
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
                        echo '<div class="greenMessage">
                                <p>The Meal has been Added Successfully !</p>
                            </div>';
                    }else{
                        echo '<div class="redMessage">
                                <p>The Meal is not Added Please try Again !</p>
                            </div>';
                    }
                }else{
                    echo '<div class="redMessage">
                        <p>The Meal is not Added Please Add At Least One Price And Try Again !</p>
                    </div>';
                }
            }else{
                echo '<div class="redMessage">
                        <p>The Meal is not Added Please Add The Meal Name And Try Again !</p>
                    </div>';
            }

        }
    ?>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-group col-md-12">
                <label for="exampleInputText">Meal Name</label>
                <input type="text" name="mealName" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter English Name">
            </div>
            <div class="form-group col-md-4">
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
            </div>
            <div class="form-group col-md-12">
                <label for="exampleInputText">Channals</label>
                <input type="text" name="channel" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Online / App / Talabat ...">
            </div>
            <div class="form-group col-md-12">
                <label for="exampleFormControlFile1">Meal Image</label>
                <input type="file" name="mealImage" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="checkbox col-md-12">
                <label>
                  <input type="checkbox" value="1" name="mainoffer">
                  Main Offer
                </label>
            </div>
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
                <label >Ingredients in English</label>
                <textarea class="form-control"  name="ingredient1" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label >Ingredients in Arabic</label>
                <textarea class="form-control"  name="ingredient2" rows="3"></textarea>
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
            <button type="submit" name="add" value="add" class="btn btn-secondary btn-lg btn-block">ADD</button>
        </form>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

