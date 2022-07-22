<?php
require_once '../../config.php';
require_once '../../model/DatabaseModel.php';
class Price extends DatabaseModel
{
    // property
    protected $priceID;
    protected $size;
    protected $price;
    protected $mealID;
    // table name
    protected static $tableName = "price";
    // all fields in tabel
    protected $tableFields = array(
        'size',
        'price',
        'mealID'
    );
    public function __construct($size, $price, $mealID, $priceID="")
    {
        $this->size = $size;
        $this->price = $price;
        $this->mealID = $mealID;
        $this->priceID = $priceID;
    }
    public static function retreivePricesByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM price WHERE mealID = '$mealID'");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $prices = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $prices;
    }
    public static function deletePriceByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM price WHERE mealID='$mealID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}