<!-- header -->
<?php
    require_once '../../model/meal.php';
    require_once '../../lib/price.php';
    require_once '../../lib/ingredient.php';
    require_once '../../lib/comment.php';
    $brand = 0;
    $category = 0;
    $pageName = "";
    $deleted = FALSE;
    if(isset($_GET['mealID'])){
        $mealID = $_GET['mealID'];
        $meal = Meal::retreiveMealByID($mealID);
        $brand = $meal['brand'];
        $category = $meal['category'];
    }
    if(isset($_GET['brand'], $_GET['category'])){
        $brand = $_GET['brand'];
        $category = $_GET['category'];
    }
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> '.$pageName.'s / <a href="addMeal.php?brand='.$brand.'&category='.$category.'"> Add '.$pageName.' </a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_GET['mealID'])){
            $mealID = $_GET['mealID'];
            Price::deletePriceByMealID($mealID);
            Comment::deleteCommentByMealID($mealID);
            Ingredient::deleteIngredientByMealID($mealID);
            if(Meal::deleteMealByID($mealID)){
                echo '<div class="greenMessage">
                        <p>The Meal has been Deleted Successfully !</p>
                    </div>';
                    header('Refresh: 5; meals.php?brand='.$brand.'&category='.$category.'');
            }else{
                echo '<div class="redMessage">
                        <p>The Meal is not Deleted Please Try Again !</p>
                    </div>';
                    header('Refresh: 5; meals.php?brand='.$brand.'&category='.$category.'');
            }
        }
    ?>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <table id="myTable" class="table table-striped">
        <tr class="header">
            <th>#</th>
            <th class="col-md-6">Name</th>
            <th>Available</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
            $i = 1;
            $meals = Meal::retreiveAllMealsByCategoryAndBrand($category, $brand);
            if(is_array($meals) && count($meals)>0){
                foreach($meals as $meal) {
                    echo '<tr>
                            <td>'.$i++.'</td>
                            <td><a href="mealDetails.php?mealID='.$meal['mealID'].'" class="mealDetails">'.$meal['mealName'].'</a></td>';
                            if($meal['availability']){
                                echo '<td><img class="icon" src="../../images/avail.png"></td>';
                            }else{
                                echo '<td><img class="icon" src="../../images/notavail.png"></td>';
                            }
                            echo'
                            <td><a href="editMeal.php?mealID='.$meal['mealID'].'"><img class="icon" src="../../images/edit-box.png"></a></td>
                            <td><a href="mealDetails.php?mealID='.$meal['mealID'].'&action=delete"><img class="icon" src="../../images/trash-bin.png"></a></td>
                        </tr>';
                }
            }else{
                echo '<tr>
                        <td colspan="4"> There\'s no Meals !! </td>
                    </tr>';
            }
        ?>
    </table>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

