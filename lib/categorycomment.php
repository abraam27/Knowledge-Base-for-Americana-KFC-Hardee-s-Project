<?php
require_once '../../config.php';
require_once '../../model/DatabaseModel.php';
class Categorycomment extends DatabaseModel
{
    // property
    protected $categorycommentID;
    protected $comment;
    protected $category;
    protected $brand;
    // table name
    protected static $tableName = "categorycomment";
    // all fields in tabel
    protected $tableFields = array(
        'comment',
        'category',
        'brand'
    );
    public function __construct($comment, $category, $brand, $categorycommentID="")
    {
        $this->comment = $comment;
        $this->category = $category;
        $this->brand = $brand;
        $this->categorycommentID = $categorycommentID;
    }
    public static function retreiveCommentsBycategoryAndBrand($category,$brand)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM categorycomment WHERE category = '$category' AND brand = '$brand'");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $comments = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }
}