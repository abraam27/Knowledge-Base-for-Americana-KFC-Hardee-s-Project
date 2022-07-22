<!-- header -->
<?php
    $brand = 1;
    $category = 1;
    require_once'../../model/meal.php';
    require_once'../../lib/price.php';
    require_once'../../lib/ingredient.php';
    require_once'../../lib/comment.php';
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> Individual Meals / <a href="addIndiviualKFC.php">Add Individual Meal</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_GET['deletedMealID'])){
            $deletedMealID = $_GET['deletedMealID'];
            Price::deletePriceByMealID($deletedMealID);
            Comment::deleteCommentByMealID($deletedMealID);
            Ingredient::deleteIngredientByMealID($deletedMealID);
            if(Meal::delete($deletedMealID)){
                echo '<div class="greenMessage">
                    <p>The Meal has been Deleted Successfully !</p>
                </div>';
            }else{
                echo '<div class="redMessage">
                        <p>The Meal is not Deleted Please Try Again !</p>
                    </div>';
            }
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-6">Meal Name</th>
                <th>Available</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $meals = Meal::retreiveAllMealsByCategoryAndBrand($category, $brand);
                if(is_array($meals) && count($meals)>0){
                    foreach($meals as $meal) {
                        echo '<tr>
                                <td><a href="packages.html" class="mealDetails">'.$meal['mealName'].'</a></td>';
                                if($meal['availability']){
                                    echo '<td><img class="icon" src="../../images/avail.png"></td>';
                                }else{
                                    echo '<td><img class="icon" src="../../images/notavail.png"></td>';
                                }
                                echo'
                                <td><a href="editPackage.html?mealID='.$meal['mealID'].'"><img class="icon" src="../../images/edit-box.png"></a></td>
                                <td><a href="packages.html?mealID='.$meal['mealID'].'"><img class="icon" src="../../images/trash-bin.png"></a></td>
                            </tr>';
                    }
                }else{
                    echo '<tr>
                            <td colspan="4"> There\'s no Meals !! </td>
                        </tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

