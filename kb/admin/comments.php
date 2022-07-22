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
    echo '<p class="header"> Comments / <a href="addComment.php?brand='.$brand.'&category='.$category.'">Add Comment </a> / <a href="addMeal.php?brand='.$brand.'&category='.$category.'">Add '.$pageName.'</a> / <a href="meals.php?brand='.$brand.'&category='.$category.'">'.$pageName.'s</a></P>';
    require_once '../template/verticalMenu.tpl';
?>
<div class="well">
    <?php
        if(isset($_GET['deletedCommentID'])){
            $deletedCommentID = $_GET['deletedCommentID'];
            if(Meal::delete($deletedCommentID)){
                echo '<div class="greenMessage">
                        <p>The Comment has been Deleted Successfully !</p>
                    </div>';
                    header('Refresh: 10; comments.php?brand='.$_GET['brand'].'&category='.$_GET['category'].'');
            }else{
                echo '<div class="redMessage">
                        <p>The Comment is not Deleted Please Try Again !</p>
                    </div>';
                    header('Refresh: 10; comments.php?brand='.$_GET['brand'].'&category='.$_GET['category'].'');
            }
        }
        if(isset($_GET['action'])){
            if($_GET['action'] == 'delete'){
                echo'<div class="form-container" style="margin-bottom:20px;">
                        <form action="?commentID='.$_GET['commentID'].'&brand='.$_GET['brand'].'&category='.$_GET['category'].'" method="GET" accept-charset="utf-8">
                            <label for="exampleInputText"  style="font-size:20px">Delete The Comment ?</label>
                            <button type="submit" class="pull-right" style="margin-left:20px">NO</button>
                            <button type="submit" class="pull-right" formaction="?deletedCommentID='.$_GET['commentID'].'&brand='.$_GET['brand'].'&category='.$_GET['category'].'" formmethod="GET">YES</button>
                        </form>
                </div>';
            }
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th class="col-md-6">Comment</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $comments = Categorycomment::retreiveCommentsBycategoryAndBrand($category, $brand);
                if(is_array($comments) && count($comments)>0){
                    foreach($comments as $comment) {
                        echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$comment['comment'].'</td>
                                <td><a href="editComment.php?commentID='.$comment['commentID'].'&brand='.$comment['brand'].'&category='.$comment['category'].'"><img class="icon" src="../../images/edit-box.png"></a></td>
                                <td><a href="comments.php?commentID='.$comment['commentID'].'&brand='.$comment['brand'].'&category='.$comment['category'].'&action=delete"><img class="icon" src="../../images/trash-bin.png"></a></td>
                            </tr>';
                    }
                }else{
                    echo '<tr>
                            <td colspan="3"> There\'s no Comments !! </td>
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

