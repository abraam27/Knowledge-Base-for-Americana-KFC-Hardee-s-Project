<?php
require_once '../../config.php';
require_once '../../model/DatabaseModel.php';
class Comment extends DatabaseModel
{
    // property
    protected $commentID;
    protected $comment;
    protected $mealID;
    // table name
    protected static $tableName = "comment";
    // all fields in tabel
    protected $tableFields = array(
        'comment',
        'mealID'
    );
    public function __construct($comment, $mealID, $commentID="")
    {
        $this->comment = $comment;
        $this->mealID = $mealID;
        $this->commentID = $commentID;
    }
    public static function retreiveCommentsByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM comment WHERE mealID = '$mealID'");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $comments = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }
    public static function deleteCommentByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM comment WHERE mealID='$mealID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}