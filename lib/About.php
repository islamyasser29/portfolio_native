<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class About
{
    private $id;
    private $title;
    private $theme;
    private $cv_name;
    private $cv_tmp;
    public function __construct($title, $theme,$cv_name, $cv_tmp, $id="")
    {
        $this->title = $title;
        $this->theme = $theme;
        $this->cv_name = $cv_name;
        $this->cv_tmp = $cv_tmp;
        $this->id = $id;
    }
    public function addAbout()
    {
        if(is_uploaded_file($this->cv_tmp)){
            // rename orignal name 
            $this->cv_name = time() . $this->cv_name;
            if(move_uploaded_file($this->cv_tmp, "../upload/".$this->cv_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO about(title, theme, upload_cv) VALUES('$this->title', '$this->theme', '$this->cv_name')");
                    // execute sql query 
                    if($sql->execute()){
                         // return news id
                        return $dbh->lastInsertId();
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
    public static function deleteAbout($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM about WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateAbout()
    {
        if(is_uploaded_file($this->cv_tmp)){
            // rename orignal name 
            $this->cv_name = time() . $this->cv_name;
            if(move_uploaded_file($this->cv_tmp, "../upload/".$this->cv_name)){
                // get connection
                global $dbh;
                // prepare query before execute
                $sql = $dbh->prepare("UPDATE about SET title='$this->title', theme = '$this->theme', upload_cv ='$this->cv_name' WHERE id='$this->id'");
                // execure sql query 
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
    public static function retreiveAbout($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM about WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $about = $sql->fetch(PDO::FETCH_ASSOC);
        return $about;
    }
    public static function retreiveAllAbout()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM about");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allAbout = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allAbout;
    }
    
   
  
}