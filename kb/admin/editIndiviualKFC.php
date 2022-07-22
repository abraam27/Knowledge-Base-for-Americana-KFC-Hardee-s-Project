<!-- header -->
<?php
    $brand = 1;
    $category = 1;
    require_once'../../model/meal.php';
    require_once'../../lib/price.php';
    require_once'../../lib/ingredient.php';
    require_once'../../lib/comment.php';
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> Individual Meals / <a href="addPackage.html">Add Individual Meal</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset ($_POST['edit'])){
            //collect data
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
                $mealID = $_POST['mealID'];
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
                    $check = FALSE;
                    if(isset($_FILES['mealImage']['name'])){
                        $mealImage = $_FILES['mealImage']['name'];
                        $mealImageTmp = $_FILES['mealImage']['tmp_name'];
                        $meal = new Meal($mealName, $channel, $mainoffer, $availability, $taste, $category, $brand, $mealImage, $mealImageTmp, $mealID);
                        $check = $meal->updateMeal();
                    }else{
                        $meal = new Meal($mealName, $channel, $mainoffer, $availability, $taste, $category, $brand, $mealID);
                        $check = $meal->updateMeal();
                    }
                    if($check){
                        if($rprice > 0){
                            if(isset($_POST['rpriceID']) && ($_POST['rpriceID'])){
                                $price = new Price(1, $rprice, $mealID);
                                $price->update($_POST['rpriceID']);
                            }else{
                                $price = new Price(1, $rprice, $mealID);
                                $price->add();
                            }
                        }
                        if($mprice > 0){
                            if(isset($_POST['mpriceID']) && ($_POST['mpriceID'])){
                                $price = new Price(2, $mprice, $mealID);
                                $price->update($_POST['mpriceID']);
                            }else{
                                $price = new Price(2, $mprice, $mealID);
                                $price->add();
                            }
                        }
                        if($lprice > 0){
                            if(isset($_POST['lpriceID']) && ($_POST['lpriceID'])){
                                $price = new Price(3, $lprice, $mealID);
                                $price->update($_POST['lpriceID']);
                            }else{
                                $price = new Price(3, $lprice, $mealID);
                                $price->add();
                            }
                        }
                        if($ingredient1 != ""){
                            if(isset($_POST['ingredient1ID']) && is_numeric($_POST['ingredient1ID'])){
                                $ingredient = new Ingredient($ingredient1, $mealID);
                                $ingredient->update($_POST['ingredient1ID']);
                            }else{
                                $ingredient = new Ingredient($ingredient1, $mealID);
                                $ingredient->add();
                            }
                            
                        }
                        if($ingredient2 != ""){
                            if(isset($_POST['ingredient2ID']) && is_numeric($_POST['ingredient2ID'])){
                                $ingredient = new Ingredient($ingredient2, $mealID);
                                $ingredient->update($_POST['ingredient2ID']);
                            }else{
                                $ingredient = new Ingredient($ingredient2, $mealID);
                                $ingredient->add();
                            }
                        }
                        if($comment1 != ""){
                            if(isset($_POST['comment1ID']) && is_numeric($_POST['comment1ID'])){
                                $comment = new Comment($comment1, $mealID);
                                $comment->update($_POST['comment1ID']);
                            }else{
                                $comment = new Comment($comment1, $mealID);
                                $comment->add();
                            }
                        }
                        if($comment2 != ""){
                            if(isset($_POST['comment2ID']) && is_numeric($_POST['comment2ID'])){
                                $comment = new Comment($comment2, $mealID);
                                $comment->update($_POST['comment2ID']);
                            }else{
                                $comment = new Comment($comment2, $mealID);
                                $comment->add();
                            }
                        }
                        if($comment3 != ""){
                            if(isset($_POST['comment3ID']) && is_numeric($_POST['comment3ID'])){
                                $comment = new Comment($comment3, $mealID);
                                $comment->update($_POST['comment3ID']);
                            }else{
                                $comment = new Comment($comment3, $mealID);
                                $comment->add();
                            }
                        }
                        echo '<div class="greenMessage">
                                <p>The Meal has been Updated Successfully !</p>
                            </div>';
                    }else{
                        echo '<div class="redMessage">
                                <p>The Meal is not Updated Please try Again !</p>
                            </div>';
                    }
                }else{
                    echo '<div class="redMessage">
                        <p>The Meal is not Updated Please Add At Least One Price And Try Again !</p>
                    </div>';
                }
            }else{
                echo '<div class="redMessage">
                        <p>The Meal is not Updated Please Add The Meal Name And Try Again !</p>
                    </div>';
            }
        }
        
    ?>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
            <?php
                if(isset($_GET['mealID'])){
                    $mealID = $_GET['mealID'];
                    $meal = Meal::retreiveMealByID($mealID);
                    $prices = Price::retreivePricesByMealID($mealID);
                    $ingredients = Ingredient::retreiveIgredientsByMealID($mealID);
                    $comments = Comment::retreiveCommentsByMealID($mealID);
                    echo '<div class="form-group col-md-12">
                            <label for="exampleInputText">Meal Name</label>
                            <input type="text" name="mealName" value="'.$meal['mealName'].'" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Enter English Name">
                        </div>';
                    $rprice = 0;
                    $mprice = 0; 
                    $lprice = 0;
                    $rpriceID = 0;
                    $mpriceID = 0; 
                    $lpriceID = 0;
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                $rprice = $price['price'];
                                $rpriceID = $price['priceID'];
                            }elseif($price['size'] == 2){
                                $mprice = $price['price'];
                                $mpriceID = $price['priceID'];
                            }else{
                                $lprice = $price['price'];
                                $lpriceID = $price['priceID'];
                            }
                        }
                    }
                    echo '<div class="form-group col-md-4">
                            <label for="exampleInputText">Requler Price</label>
                            <input type="text" name="rprice" value="'.$rprice.'" class="form-control" id="exampleInputText" placeholder="Requler">
                            <input type="hidden" value="'.$rpriceID.'" name="rpriceID">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Medium Price</label>
                            <input type="text" name="mprice" value="'.$mprice.'" class="form-control" id="exampleInputText" placeholder="Medium">
                            <input type="hidden" value="'.$mpriceID.'" name="mpriceID">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputText">Large Price</label>
                            <input type="text" name="lprice" value="'.$lprice.'" class="form-control" id="exampleInputText" placeholder="Large">
                            <input type="hidden" value="'.$lpriceID.'" name="lpriceID">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputText">Channals</label>
                            <input type="text" name="channel" value="'.$meal['channel'].'" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="Online / App / Talabat ...">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlFile1">Meal Image</label>
                            <input type="file" name="mealImage" class="form-control-file" id="exampleFormControlFile1">
                        </div>';
                    if($meal['mainoffer'] == 1){
                        echo '<div class="checkbox col-md-12">
                                <label>
                                    <input type="checkbox" value="1" name="mainoffer" checked>
                                    Main Offer
                                </label>
                            </div>';
                    }else{
                        echo '<div class="checkbox col-md-12">
                                <label>
                                    <input type="checkbox" value="1" name="mainoffer">
                                    Main Offer
                                </label>
                            </div>';
                    }
                    if($meal['availability'] == 0){
                        echo '<div class="checkbox col-md-12">
                                <label>
                                <input type="checkbox" value="0" name="availability" checked>
                                Not Available
                                </label>
                            </div>';
                    }else{
                        echo '<div class="checkbox col-md-12">
                                <label>
                                <input type="checkbox" value="0" name="availability">
                                Not Available
                                </label>
                            </div>';
                    }
                    if($meal['taste'] == 2){
                        echo '<div class="form-group col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="1" name="normal" checked> Normal
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="1" name="spicy" checked> Spicy
                                </label>
                            </div>';
                    }elseif($meal['taste'] == 1){
                        echo '<div class="form-group col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="1" name="normal"> Normal
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="1" name="spicy" checked> Spicy
                                </label>
                            </div>';
                    }else{
                        echo '<div class="form-group col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="1" name="normal" checked> Normal
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="1" name="spicy"> Spicy
                                </label>
                            </div>';
                    }
                    $j = 1;
                    if(is_array($ingredients) && count($ingredients)>0){
                        foreach($ingredients as $ingredient) {
                            echo '<div class="form-group col-md-12">
                                    <label >Ingredeient</label>
                                    <textarea class="form-control"  name="ingredient'.$j.'" rows="3">'.$ingredient['ingredient'].'</textarea>
                                    <input type="hidden" value="'.$ingredient['ingredientID'].'" name="ingredient'.$j.'ID">
                                </div>';
                            $j++;
                        }
                    }
                    for($i = 0 ; $i < (2 - count($ingredients)) ; $i++){
                        echo '<div class="form-group col-md-12">
                                <label >Ingredeient</label>
                                <textarea class="form-control"  name="ingredient'.$j.'" rows="3"></textarea>
                            </div>';
                        $j++;
                    }
                    $j = 1;
                    if(is_array($comments) && count($comments)>0){
                        foreach($comments as $comment) {
                            echo '<div class="form-group col-md-12">
                                    <label >Comment</label>
                                    <textarea class="form-control"  name="comment'.$j.'" rows="3">'.$comment['comment'].'</textarea>
                                    <input type="hidden" value="'.$comment['commentID'].'" name="comment'.$j.'ID">
                                </div>';
                            $j++;
                        }
                    }
                    for($i = 0 ; $i < (3 - count($comments)) ; $i++){
                        echo '<div class="form-group col-md-12">
                                <label >Comment</label>
                                <textarea class="form-control"  name="comment'.$j.'" rows="3"></textarea>
                            </div>';
                        $j++;
                    }
                    echo '<input type="hidden" value="'.$mealID.'" name="mealID">
                    <button type="submit" name="edit" value="edit" class="btn btn-secondary btn-lg btn-block">EDIT</button>
                    ';
                }
            ?>
        </form>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

