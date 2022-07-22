<?php
require_once '../../config.php';
require_once '../../model/DatabaseModel.php';
class Ingredient extends DatabaseModel
{
    // property
    protected $ingredientID;
    protected $ingredient;
    protected $mealID;
    // table name
    protected static $tableName = "ingredient";
    // all fields in tabel
    protected $tableFields = array(
        'ingredient',
        'mealID'
    );
    public function __construct($ingredient, $mealID, $ingredientID="")
    {
        $this->ingredient = $ingredient;
        $this->mealID = $mealID;
        $this->ingredientID = $ingredientID;
    }

    public static function retreiveIgredientsByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM ingredient WHERE mealID = '$mealID'");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $ingredients = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $ingredients;
    }
    public static function deleteIngredientByMealID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM ingredient WHERE mealID='$mealID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}