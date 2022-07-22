<?php
require_once '../../config.php';
require_once '../../model/meal.php';
require_once '../../lib/ingredient.php';
require_once '../../lib/comment.php';
require_once '../../lib/price.php';
function retreiveData($mealName)
{
    $meals = Meal::retreiveAllMealsByNamesCategoryAndBrand($mealName, 2 , 1);
    if(is_array($meals) && count($meals)>0){
        foreach($meals as $meal) {
            echo '<div class="box">
                    <div class="name"> <p>'.$meal['mealName'].'</p> </div>
                    <div class="pic family">
                        <img src="../../upload/'.$meal['mealImage'].'">
                        <div class="overlay">';
                            $ingredients = Ingredient::retreiveIgredientsByMealID($meal['mealID']);
                            if(is_array($ingredients) && count($ingredients)>0){
                                foreach($ingredients as $ingredient) {
                                    echo '<div class="text">'.$ingredient['ingredient'].'</div>';
                                }
                            }
                            echo'
                        </div>
                    </div>';
                        $prices = Price::retreivePricesByMealID($meal['mealID']);
                        if(is_array($prices) && count($prices)>0){
                            echo ' <p class="price">';
                            $numItems = count($prices);
                            $i = 0;
                            foreach($prices as $price) {
                                if(++$i === $numItems) {
                                    if($price['size'] == 1){
                                        echo 'Reg : '.$price['price'].'</p>';
                                        break;
                                    }elseif($price['size'] == 2){
                                        echo 'Med : '.$price['price'].'</p>';
                                    }else{
                                        echo 'Lrg : '.$price['price'].'</p>';
                                    }
                                    break;
                                }
                                if($price['size'] == 1){
                                    echo 'Reg : '.$price['price'].' | ';
                                }elseif($price['size'] == 2){
                                    echo 'Med : '.$price['price'].' | ';
                                }else{
                                    echo 'Lrg : '.$price['price'].' | ';
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
                    }
                    echo'
                </div>';
        }
    }
}

if(isset($_GET['name'])){
    retreiveData($_GET['name']);
}
?>
