<?php
require_once '../../config.php';
class Meal
{
    // property, attrs, fields, member vars
    private $mealID;
    private $mealName;
    private $channel;
    private $mainoffer;
    private $availability;
    private $taste;
    private $category;
    private $brand;
    private $mealImage;
    private $mealImageTmp;
    // behavior, member function, method, action
    public function __construct($mealName, $channel, $mainoffer, $availability, $taste, $category, $brand, $mealImage="", $mealImageTmp="", $mealID="")
    {
        $this->mealName = $mealName;
        $this->channel = $channel;
        $this->mainoffer = $mainoffer;
        $this->availability = $availability;
        $this->taste = $taste;
        $this->category = $category;
        $this->brand = $brand;
        $this->mealImage = $mealImage;
        $this->mealImageTmp = $mealImageTmp;
        $this->mealID = $mealID;
    }
    public function addMeal()
    {   
        // get connection
        global $dbh;
        if(is_uploaded_file($this->mealImageTmp)){
            // rename image
            $this->mealImage = time() . $this->mealImage;
            if(move_uploaded_file($this->mealImageTmp, "../../upload/".$this->mealImage)){
                // get connection
                global $dbh;
                $sql = $dbh->prepare("INSERT INTO meal(mealName, channel, mainoffer, availability, taste, category, brand, mealImage) VALUES('$this->mealName', '$this->channel', '$this->mainoffer', '$this->availability', '$this->taste', '$this->category', '$this->brand', '$this->mealImage')");
                if($sql->execute()){
                    return $dbh->lastInsertId();;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            global $dbh;
            $sql = $dbh->prepare("INSERT INTO meal(mealName, channel, mainoffer, availability, taste, category, brand) VALUES('$this->mealName', '$this->channel', '$this->mainoffer', '$this->availability', '$this->taste', '$this->category', '$this->brand')");
            if($sql->execute()){
                return $dbh->lastInsertId();;
            }else{
                return false;
            }
        }        
        
    }
    public static function deleteMealByID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM meal WHERE mealID='$mealID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateMeal()
    {   
        if( $this->mealImage == ""){
            global $dbh;
            $sql = $dbh->prepare("UPDATE meal SET mealName='$this->mealName', channel='$this->channel', mainoffer='$this->mainoffer', availability='$this->availability', taste='$this->taste', category='$this->category', brand='$this->brand' WHERE mealID='$this->mealID'");
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            if(is_uploaded_file($this->mealImageTmp)){
                // rename image
                $this->mealImage = time(). $this->mealImage;
                if(move_uploaded_file($this->mealImageTmp, "../../upload/".$this->mealImage)){
                    // get connection
                    global $dbh;
                    $sql = $dbh->prepare("UPDATE meal SET mealName='$this->mealName', channel='$this->channel', mainoffer='$this->mainoffer', availability='$this->availability', taste='$this->taste', category='$this->category', brand='$this->brand', mealImage='$this->mealImage' WHERE mealID='$this->mealID'");
                    if($sql->execute()){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
    public static function retreiveMealByID($mealID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM meal WHERE mealID='$mealID'");
        $sql->execute();
        $meal = $sql->fetch(PDO::FETCH_ASSOC);
        return $meal;
    }
    public static function retreiveAllMeals()
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM meal ORDER BY mealID DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $allMeals = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allMeals;
    }
    public static function retreiveAllMealsByNamesCategoryAndBrand($mealName, $category, $brand)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM Meal WHERE mealName like '%$mealName%' AND category = '$category' AND brand = '$brand' ORDER BY mealID DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $allmeals = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allmeals;
    }
    public static function retreiveAllMealsByCategoryAndBrand($category,$brand)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM meal WHERE category = '$category' AND brand = '$brand' ORDER BY mealID DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $allmeals = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allmeals;
    }
    public static function DonorLogin($name,$password)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT * from donor WHERE (username = '$name' or email = '$name') And password = '$password'");
        $sql->execute();
        $fetch = $sql->fetch(PDO::FETCH_ASSOC);
        if(is_array($fetch)){
            return $fetch["donorID"];
        }else{
            return FALSE;
        }
    }
}