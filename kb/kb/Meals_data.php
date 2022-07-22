<?php
require_once '../../config.php';
require_once '../../model/meal.php';
require_once '../../lib/ingredient.php';
require_once '../../lib/comment.php';
require_once '../../lib/price.php';
function retreiveData($mealName, $category, $brand)
{
    $meals = Meal::retreiveAllMealsByNamesCategoryAndBrand($mealName, $category , $brand);
    if(is_array($meals) && count($meals)>0){
        foreach($meals as $meal) {
            if($brand == 1 && ($category == 1 || $category == 2 || $category == 3)){
                echo '<div class="box">';
            }elseif($brand == 2 && ($category == 1 || $category == 2 || $category == 3 || $category == 4)){
                echo '<div class="box">';
            }else{
                echo '<div class="minbox">';
            }
            echo '<div class="name"> <p>'.$meal['mealName'].'</p> </div>';
            if(($brand == 1 && ($category == 1 || $category == 3)) || (($brand == 2 && ($category == 1 || $category == 2 || $category == 3)))){
                echo '<div class="pic">';
            }elseif(($brand == 1 && $category == 2) || ($brand == 2 && $category == 4)){
                echo '<div class="pic family">';
            }else{
                echo '<div class="pic minpic">';
            }
            echo '<img src="../../upload/'.$meal['mealImage'].'">';
            $ingredients = Ingredient::retreiveIgredientsByMealID($meal['mealID']);
            if(is_array($ingredients) && count($ingredients)>0){
                echo '<div class="overlay">';
                foreach($ingredients as $ingredient) {
                    echo '<div class="text">'.$ingredient['ingredient'].'</div>';
                }
                echo '</div>';
            }
            echo '</div>';
            $prices = Price::retreivePricesByMealID($meal['mealID']);
            if(is_array($prices) && count($prices)>0){
                echo ' <p class="price">';
                $numItems = count($prices);
                $i = 0;
                foreach($prices as $price) {
                    if(++$i === $numItems) {
                        if(($brand == 1 && ($category == 1 || $category == 5 || $category == 7)) || ($brand == 2 && ($category == 6 || $category == 7 || $category == 8))){
                            if($price['size'] == 1){
                                echo 'Sml : '.$price['price'].'</p>';
                            }elseif($price['size'] == 2){
                                echo 'Med : '.$price['price'].'</p>';
                            }elseif($price['size'] == 3){
                                echo 'Lrg : '.$price['price'].'</p>';
                            }else{
                                echo 'Fam : '.$price['price'].'</p>';
                            }
                            break;
                        }elseif($brand == 1 && $category == 3){
                            if($price['size'] == 1){
                                echo 'Sand : '.$price['price'].'</p>';
                            }elseif($price['size'] == 2){
                                echo 'Meal : '.$price['price'].'</p>';
                            }else{
                                echo 'Box : '.$price['price'].'</p>';
                            }
                            break;
                        }elseif($brand == 2 && ($category == 1 || $category == 2)){
                            if($price['size'] == 1){
                                echo '<img src="../../images/sandwich.png" width="25" height="25"> : '.$price['price'].'</p>';
                            }else{
                                echo '<img src="../../images/fast_food.png" width="25" height="25"> : '.$price['price'].'</p>';
                            }
                            break;
                        }else{
                            echo ''.$price['price'].'</p>';
                            break;
                        }
                    }
                    if(($brand == 1 && ($category == 1 || $category == 5 || $category == 7)) || ($brand == 2 && ($category == 6 || $category == 7 || $category == 8))){
                        if($price['size'] == 1){
                            echo 'Sml : '.$price['price'].' | ';
                        }elseif($price['size'] == 2){
                            echo 'Med : '.$price['price'].' | ';
                        }elseif($price['size'] == 3){
                            echo 'Lrg : '.$price['price'].' | ';
                        }else{
                            echo 'Fam : '.$price['price'].' | ';
                        }
                    }elseif($brand == 1 && $category == 3){
                        if($price['size'] == 1){
                            echo 'Sand : '.$price['price'].' | ';
                        }elseif($price['size'] == 2){
                            echo 'Meal : '.$price['price'].' | ';
                        }else{
                            echo 'Box : '.$price['price'].' | ';
                        }
                    }elseif($brand == 2 && ($category == 1 || $category == 2)){
                        if($price['size'] == 1){
                            echo '<img src="../../images/sandwich.png" width="25" height="25"> : '.$price['price'].' | ';
                        }else{
                            echo '<img src="../../images/fast_food.png" width="25" height="25"> : '.$price['price'].' | ';
                        }
                    }else{
                        echo ''.$price['price'].' | ';
                    }
                }
            }
            if(is_string($meal['channel'])){
                echo '<div class="channel">'.$meal['channel'].'</div>';
            }
            if($meal['mainoffer']){
                echo '<div class="mainoffer">Main Offer</div>';
            }
            if($meal['availability'] == 0){
                echo '<div class="notavail">Not Available</div>';
            }
            if($meal['taste'] == 0){
                echo '<div class="taste">Normal Only</div>';
            }elseif($meal['taste'] == 1){
                echo '<div class="taste">Spicy Only</div>';
            }
            $comments = Comment::retreiveCommentsByMealID($meal['mealID']);
            if(is_array($comments) && count($comments)>0){
                echo '<div class="boxcomment">';
                foreach($comments as $comment) {
                    echo '<p>'.$comment['comment'].'</p>';
                }
                echo'</div>';
            }
            echo'</div>';
        }
    }
}

if(isset($_GET['mealName'])){
    retreiveData($_GET['mealName'], $_GET['category'], $_GET['brand']);
}
?>
