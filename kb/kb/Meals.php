<!-- header -->
<?php
    require_once '../../lib/categorycomment.php';
    $brand = 0;
    $category = 0;
    $pageName = "";
    if(isset($_GET['brand'], $_GET['category'])){
        $brand = $_GET['brand'];
        $category =  $_GET['category'];
    }else{
        header('Home.php');
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
