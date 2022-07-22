<!-- header -->
<?php
    require_once '../../model/meal.php';
    require_once '../../lib/price.php';
    require_once '../../lib/ingredient.php';
    require_once '../../lib/comment.php';
    $brand = 0;
    $category = 0;
    $pageName = "";
    $mealID = 0;
    $meal = "";
    if(isset($_GET['mealID'])){
        $mealID = $_GET['mealID'];
        $meal = Meal::retreiveMealByID($mealID);
        $brand = $meal['brand'];
        $category = $meal['category'];
    }else{
        header('location: meals.php?&brand='.$brand.'&category='.$category.'');
    }
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> '.$pageName.' / <a href="addMeal.php?brand='.$brand.'&category='.$category.'"> Add '.$pageName.' </a> / <a href="meals.php?brand='.$meal['brand'].'&category='.$meal['category'].'"> '.$pageName.'s </a> / <a href="editMeal.php?mealID='.$mealID.'">Edit</a> / <a href="mealDetails.php?mealID='.$meal['mealID'].'&action=delete">Delete</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_GET['action'])){
            if($_GET['action'] == 'delete'){
                echo'<div class="form-container" style="margin-bottom:20px;">
                        <form action="mealDetails.php" method="GET" accept-charset="utf-8">
                            <label for="exampleInputText"  style="font-size:20px">Delete It ?</label>
                            <input type="hidden" value="'.$mealID.'" name="mealID">
                            <button type="submit" class="pull-right" style="margin-left:20px">NO</button>
                            <button type="submit" class="pull-right" formaction="meals.php" formmethod="GET">YES</button>
                        </form>
                </div>';
            }
        }
        if(isset($_GET['message'])){
            if($_GET['message'] == 'added'){
                echo '<div class="greenMessage">
                    <p>The Meal has been Added Successfully !</p>
                </div>';
            }
        }
        $prices = Price::retreivePricesByMealID($mealID);
        $ingredients = Ingredient::retreiveIgredientsByMealID($mealID);
        $comments = Comment::retreiveCommentsByMealID($mealID);
        echo '<div class="detailspic">
                <img src="../../upload/'.$meal['mealImage'].'"/>
            </div>
            <table class="table table-striped table1">
                <tr>
                    <th class="col-md-6"> Meal Name : </th>
                    <td class="col-md-6"> '.$meal['mealName'].' </td>
                </tr>
                <tr>
                    <th class="col-md-6"> Brand : </th>';
                    if($meal['brand'] == 1){
                        echo '<td class="col-md-6"> KFC </td>';
                    }else{
                        echo '<td class="col-md-6"> Hardees </td>';
                    }
                    echo'
                </tr>
                <tr>
                    <th class="col-md-6"> Category : </th>
                    <td class="col-md-6"> '.$pageName.' </td>
                </tr>';
                if(($brand == 1 && $category == 5) || ($brand == 2 && $category == 6)){
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                echo '<tr>
                                    <th class="col-md-6"> Reguler Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' </td>
                                </tr>';
                            }elseif($price['size'] == 2){
                                echo '<tr>
                                    <th class="col-md-6"> Medium Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' </td>
                                </tr>';
                            }elseif($price['size'] == 3){
                                echo '<tr>
                                    <th class="col-md-6"> Large Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' </td>
                                </tr>';
                            }else{
                                echo '<tr>
                                    <th class="col-md-6"> Family Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' </td>
                                </tr>';
                            }
                        }
                    }
                }elseif(($brand == 1 && ($category == 1 || $category == 7)) || ($brand == 2 && ($category == 7 || $category == 8))){
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                echo '<tr>
                                    <th class="col-md-6"> Reguler Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }elseif($price['size'] == 2){
                                echo '<tr>
                                    <th class="col-md-6"> Medium Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }else{
                                echo '<tr>
                                    <th class="col-md-6"> Large Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }
                        }
                    }
                }elseif($brand == 1 && $category == 3){
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                echo '<tr>
                                    <th class="col-md-6"> Sandwich Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }elseif($price['size'] == 2){
                                echo '<tr>
                                    <th class="col-md-6"> Meal Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }else{
                                echo '<tr>
                                    <th class="col-md-6"> Box Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }
                        }
                    }
                }elseif($brand == 1 && $category == 2){
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                echo '<tr>
                                    <th class="col-md-6"> Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }elseif($price['size'] == 2){
                                echo '<tr>
                                    <th class="col-md-6"> Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }else{
                                echo '<tr>
                                    <th class="col-md-6"> Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }
                        }
                    }
                }elseif($brand == 2 && ($category == 1 || $category == 2)){
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            if($price['size'] == 1){
                                echo '<tr>
                                    <th class="col-md-6"> Sandwich Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }else{
                                echo '<tr>
                                    <th class="col-md-6"> Combo Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                            }
                        }
                    }
                }else{
                    if(is_array($prices) && count($prices)>0){
                        foreach($prices as $price) {
                            echo '<tr>
                                    <th class="col-md-6"> Price : </th>
                                    <td class="col-md-6"> '.$price['price'].' RQ</td>
                                </tr>';
                        }
                    }
                }
                echo'
                <tr>
                    <th class="col-md-6"> Channels : </th>';
                    if($meal['channel'] == ""){
                        echo '<td class="col-md-6"> ALL </td>
                        </tr>';
                    }else{
                        echo '<td class="col-md-6"> '.$meal['channel'].' </td>
                        </tr>';
                    }
                if(($brand == 1 && ($category == 1 || $category == 3)) || ($brand == 2 && ($category == 1 || $category == 2 || $category == 3))){
                    echo'
                    <tr>
                        <th class="col-md-6"> Main offer : </th>';
                        if($meal['mainoffer'] == 1){
                            echo '<td class="col-md-6"><img class="icon" src="../../images/avail.png"></td>
                            </tr>';
                        }else{
                            echo '<td class="col-md-6"><img class="icon" src="../../images/notavail.png"></td>
                            </tr>';
                        }
                }
                echo'
                <tr>
                    <th class="col-md-6"> Availability : </th>';
                    if($meal['availability'] == 1){
                        echo '<td class="col-md-6"><img class="icon" src="../../images/avail.png"></td>
                        </tr>';
                    }else{
                        echo '<td class="col-md-6"><img class="icon" src="../../images/notavail.png"></td>
                        </tr>';
                    }
                echo'
                <tr>
                    <th class="col-md-6"> Taste :</th>';
                    if($meal['taste'] == 0){
                        echo '<td class="col-md-6"> Normal Only </td>';
                    }elseif($meal['taste'] == 1){
                        echo '<td class="col-md-6"> Spicy Only </td>';
                    }else{
                        echo '<td class="col-md-6"> Normal & Spicy </td>';
                    }
                echo '</tr>';
                if(is_array($ingredients) && count($ingredients)>0){
                    foreach($ingredients as $ingredient) {
                        echo '<tr>
                                <th class="col-md-6"> Ingredient : </th>
                                <td class="col-md-6"> '.$ingredient['ingredient'].' </td>
                            </tr>';
                    }
                }
                if(is_array($comments) && count($comments)>0){
                    foreach($comments as $comment) {
                        echo '<tr>
                                <th class="col-md-6"> Comment : </th>
                                <td class="col-md-6"> '.$comment['comment'].' </td>
                            </tr>';
                    }
                }
                echo'
            </table>';
    
    ?>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

