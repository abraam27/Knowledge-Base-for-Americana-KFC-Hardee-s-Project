<!-- header -->
<?php
    require_once '../../lib/categorycomment.php';
    $commentID = 0;
    $comment = "";
    $pageName = "";
    if(isset($_GET['commentID'])){
        $commentID = $_GET['commentID'];
        $comment = Categorycomment::readByID($commentID);
    }else{
        header('HomePage.php');
    }
    require_once '../template/adminHeader.tpl';
    echo '<p class="header"> Edit Comment / <a href="comments.php?brand='.$comment['brand'].'&category='.$comment['category'].'"> Comments </a> / <a href="meals.php?brand='.$comment['brand'].'&category='.$comment['category'].'">'.$pageName.'s</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset ($_POST['edit'])){
            //collect data
            if(isset($_POST['comment']) && ($_POST['comment'] != "")){
                $updatedComment = $_POST['comment'];
                $commentID = $_POST['commentID'];
                $comment = Categorycomment::readByID($commentID);
                $comment = new Categorycomment($updatedComment, $comment['category'], $comment['brand']);
                if($comment->update($commentID)){
                    echo '<div class="greenMessage">
                            <p>The Comment has been Updated Successfully !</p>
                        </div>';
                        header('Refresh: 10; comments.php?brand='.$comment['brand'].'&category='.$comment['category'].'');
                }else{
                    echo '<div class="redMessage">
                            <p>The Comment is not Updated Please try Again !</p>
                        </div>';
                        header('Refresh: 10; editComment.php?commentID='.$comment['commentID'].'');
                }
            }else{
                echo '<div class="redMessage">
                        <p>The Comment is not Updated Please try Again !</p>
                    </div>';
                    header('Refresh: 10; editComment.php?commentID='.$comment['commentID'].'');
            }
        }
        
    ?>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
            <?php
                echo '<div class="form-group col-md-12">
                        <label >Comment</label>
                        <textarea class="form-control"  name="comment" rows="5">'.$comment['comment'].'</textarea>
                    </div>';
                echo '<input type="hidden" value="'.$commentID.'" name="commentID">
                <button type="submit" name="edit" value="edit" class="btn btn-secondary btn-lg btn-block">EDIT</button>';
            ?>
        </form>
    </div>
</div>
<!-- footer -->
<?php
    require_once '../template/adminFooter.tpl';
?>

