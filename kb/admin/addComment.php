<!-- header -->
<?php
    $brand = 0;
    $category = 0;
    $pageName = "";
    if(isset($_GET['brand'], $_GET['category'])){
        $brand = $_GET['brand'];
        $category = $_GET['category'];
    }
    require_once '../../lib/categorycomment.php';
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> Add Comment / <a href="comments.php?brand='.$brand.'&category='.$category.'"> Comments </a> / <a href="addMeal.php?brand='.$brand.'&category='.$category.'">Add '.$pageName.'</a> / <a href="meals.php?brand='.$brand.'&category='.$category.'"> '.$pageName.'s</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_POST['add'])){
            $comment = "";
            if(isset($_POST['comment']) && ($_POST['comment'] != "")){
                $comment = $_POST['comment'];
                $comment = new Categorycomment($comment, $category, $brand);
                $commentID = $comment->add();
                if(commentID){
                    echo '<div class="greenMessage">
                            <p>The Comment has been Added Successfully !</p>
                        </div>';
                        header('Refresh: 10; comments.php?brand='.$comment['brand'].'&category='.$comment['category'].'');
                }else{
                    echo '<div class="redMessage">
                            <p>The Comment is not Added Please try Again !</p>
                        </div>';
                        header('Refresh: 10; addComment.php?brand='.$comment['brand'].'&category='.$comment['category'].'');
                }
            }else{
                echo '<div class="redMessage">
                        <p>The Comment is not Added Please try Again !</p>
                    </div>';
                    header('Refresh: 10; addComment.php?brand='.$comment['brand'].'&category='.$comment['category'].'');
            }
        }
    ?>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
            
            <div class="form-group col-md-12">
                <label >Add Comment</label>
                <textarea class="form-control" name="comment" rows="5"></textarea>
            </div>
            <button type="submit" name="add" value="add" class="btn btn-secondary btn-lg btn-block">ADD</button>
        </form>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

