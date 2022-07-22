<!-- header -->
<?php
    require_once '../../lib/categorycomment.php';
    $brand = 1;
    $category = 1;
    $pageName = "Individual Meals";
    require_once '../template/header.tpl';
?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="well" id="well">
            <input type="text" id="search" placeholder="Search....">
            <div class="bodyContext" id="bodyContext">
                <?php
                    require_once 'Individual_data.php';
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
                        url:"Individual_data.php?mealName="+mealName+"&category="+category+"&brand="+brand,
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
                    url:"Individual_data.php?mealName="+mealName+"&category="+category+"&brand="+brand,
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
