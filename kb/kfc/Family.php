<!-- header -->
<?php
    require_once '../../lib/categorycomment.php';
    $brand = 1;
    $category = 2;
    $pageName = "Family";
    require_once '../template/header.tpl';
?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="well" id="well">
            <input type="text" id="search" placeholder="Search..">
            <div class="bodyContext" id="bodyContext">
                <?php
                    require_once 'Family_data.php';
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
            $(document).ready(function(){
                var name = "";
                $("input").keyup(function(){
                    // get data from input
                    name = $(this).val();
                    // load ajax
                    $.ajax({
                        url:"Family_data.php?name="+name,
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
                    url:"Family_data.php?name="+name,
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
