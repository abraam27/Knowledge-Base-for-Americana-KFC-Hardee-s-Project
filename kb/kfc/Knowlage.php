<!-- header -->
<?php
    require_once '../../lib/categorycomment.php';
    $brand = $_GET['brand'];
    $category =  $_GET['category'];
    $pageName = "";
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

        }
    }else{
        
    }
    require_once '../template/header.tpl';
?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="well" id="well">
            <input type="text" id="search" placeholder="Search....">
            <div class="bodyContext" id="bodyContext">
                <?php
                    require_once 'Meals_data.php';
                ?>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/footer.tpl';
?>
        <script>
            var category = "<?php echo"$category"?>";
            var brand = "<?php echo"$brand"?>";
            $(document).ready(function(){
                var mealName = "";
                $("input").keyup(function(){
                    // get data from input
                    mealName = $(this).val();
                    // load ajax
                    $.ajax({
                        url:"Meals_data.php?mealName="+mealName+"&category="+category+"&brand="+brand,
                        success:function(data){
                            $("#bodyContext").html(data);
                        },
                        error:function(data){
                            $("#bodyContext").html(data);
                        }
                    });
                });
                // load ajax
                $.ajax({
                    url:"Meals_data.php?mealName="+mealName+"&category="+category+"&brand="+brand,
                    success:function(data){
                        $("#bodyContext").html(data);
                    },
                    error:function(data){
                        $("#bodyContext").html(data);
                    }
                });
            });
        </script>
	</body>
</html>
