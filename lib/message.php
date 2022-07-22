<?php
require_once '../../config.php';
require_once '../../model/DatabaseModel.php';
class Message extends DatabaseModel
{
    // property
    protected $messageID;
    protected $name;
    protected $email;
    protected $subject;
    protected $message;
    // table name
    protected static $tableName = "message";
    // all fields in tabel
    protected $tableFields = array(
        'name',
        'email',
	'subject',
        'message'
    );
    public function __construct($name, $email, $subject, $message, $messageID="")
    {
        $this->name = $name;
        $this->email = $email;
	$this->subject = $subject;
        $this->message = $message;
        $this->messageID = $messageID;
    }
    public static function retreiveAllMessagesforAdmin()
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM message ORDER BY messageID desc");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $messages = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }
}