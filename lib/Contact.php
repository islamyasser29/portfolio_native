<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Contact
{
    private $id;
    private $phone;
    private $email;
    public function __construct($phone, $email, $id="")
    {
        $this->phone = $phone;
        $this->email = $email;
        $this->id = $id;
    }
   public function addContact()
    {
        // get connection
        global $dbh;
        // prepare before execute 
        $sql = $dbh->prepare("INSERT INTO contact(phone, email) VALUES('$this->phone', '$this->email')");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function deleteContact($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM contact WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateContact()
    {
        // get connection
        global $dbh;
        // prepare query before execute
        $sql = $dbh->prepare("UPDATE contact SET phone='$this->phone', email = '$this->email' WHERE id='$this->id'");
        // execure sql query 
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function retreiveContact($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM contact WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $contact = $sql->fetch(PDO::FETCH_ASSOC);
        return $contact;
    }
    public static function retreiveAllContact()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM contact");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allContact= $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allContact;
    }
}