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
    }
    require_once '../template/header.tpl';
?>
<!-- content -->
<div id="content">
    <div class="container">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="../../upload/1656562907786152.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="../../upload/1656562572483251.jpg" style="width:100%">
            </div>
         </div>
        <div class="well" id="well">
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
            let slideIndex = 0;
            showSlides();

            function showSlides() {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}
                slides[slideIndex-1].style.display = "block";  
                setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
        </script>
	</body>
</html>
