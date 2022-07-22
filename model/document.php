<?php
require_once '../../config.php';
class Document
{
    // property, attrs, fields, member vars
    private $documentID;
    private $documentName;
    private $type;
    private $createdDate;
    private $createdTime;
    private $createdBy;
    private $updatedDate;
    private $updatedTime;
    private $updatedBy;
    private $fileName;
    private $fileNameTmp;
    // behavior, member function, method, action
    public function __construct($documentName, $type, $createdDate, $createdTime, $createdBy, $updatedDate, $updatedTime, $updatedBy, $fileName="", $fileNameTmp="", $documentID="")
    {
        $this->documentName = $documentName;
        $this->type = $type;
        $this->createdDate = $createdDate;
        $this->createdTime = $createdTime;
        $this->createdBy = $createdBy;
        $this->updatedDate = $updatedDate;
        $this->updatedTime = $updatedTime;
        $this->updatedBy = $updatedBy;
        $this->fileName = $fileName;
        $this->fileNameTmp = $fileNameTmp;
        $this->documentID = $documentID;
    }
    public function addMeal()
    {   
        // get connection
        global $dbh;
        if(is_uploaded_file($this->fileNameTmp)){
            // rename image
            $this->fileName = time() . $this->fileName;
            if(move_uploaded_file($this->fileNameTmp, "../../upload/".$this->fileName)){
                // get connection
                global $dbh;
                $sql = $dbh->prepare("INSERT INTO meal(documentName, type, createdDate, createdTime, createdBy, updatedDate, updatedTime, updatedBy, fileName) VALUES('$this->documentName', '$this->type', '$this->createdDate', '$this->createdTime', '$this->createdBy', '$this->updatedDate', '$this->updatedTime', '$this->updatedBy', '$this->fileName')");
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
            $sql = $dbh->prepare("INSERT INTO meal(documentName, createdDate, createdTime, createdBy, updatedDate, updatedTime, updatedBy) VALUES('$this->documentName', '$this->type', '$this->createdDate', '$this->createdTime', '$this->createdBy', '$this->updatedDate', '$this->updatedTime', '$this->updatedBy')");
            if($sql->execute()){
                return $dbh->lastInsertId();;
            }else{
                return false;
            }
        }        
        
    }
    public static function deleteDocumentByID($documentID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM document WHERE documentID='$documentID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateDocument()
    {   
        if( $this->fileName == ""){
            global $dbh;
            $sql = $dbh->prepare("UPDATE meal SET documentName='$this->documentName', type='$this->type', createdDate='$this->createdDate', createdTime='$this->createdTime', createdBy='$this->createdBy', updatedDate='$this->updatedDate', updatedTime='$this->updatedTime', updatedBy='$this->updatedBy' WHERE documentID='$this->documentID'");
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            if(is_uploaded_file($this->fileNameTmp)){
                // rename image
                $this->fileName = time(). $this->fileName;
                if(move_uploaded_file($this->fileNameTmp, "../../upload/".$this->fileName)){
                    // get connection
                    global $dbh;
                    $sql = $dbh->prepare("UPDATE meal SET documentName='$this->documentName', type='$this->type', createdDate='$this->createdDate', createdTime='$this->createdTime', createdBy='$this->createdBy', updatedDate='$this->updatedDate', updatedTime='$this->updatedTime', updatedBy='$this->updatedBy', fileName='$this->fileName' WHERE documentID='$this->documentID'");
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
    public static function retreiveDocumentByID($documentID)
    {
        // get connection
        global $dbh;
        $document = $dbh->prepare("SELECT * FROM document WHERE documentID='$documentID'");
        $sql->execute();
        $document = $sql->fetch(PDO::FETCH_ASSOC);
        return $document;
    }
    public static function retreiveAllDocuments()
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM document ORDER BY documentID DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $alldocuments = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $alldocuments;
    }
    public static function retreiveAllDocumentssByType($type)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM Meal WHERE type = '$type' ORDER BY documentID DESC");
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