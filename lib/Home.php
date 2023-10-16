<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Home
{
    private $id;
    private $name;
    private $specialty;
    private $intro;
    private $image_name;
    private $image_tmp;
    public function __construct($name, $specialty,$intro,$image_name, $image_tmp, $id="")
    {
        $this->name = $name;
        $this->specialty = $specialty;
        $this->intro = $intro;
        $this->image_name = $image_name;
        $this->image_tmp = $image_tmp;
        $this->id = $id;
    }
    public function addHome()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO home(name, specialty, intro, profile_image) VALUES('$this->name', '$this->specialty', '$this->intro', '$this->image_name')");
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
    public static function deleteHome($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM home WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateHome()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                global $dbh;
                // prepare query before execute
                $sql = $dbh->prepare("UPDATE home SET name='$this->name', specialty = '$this->specialty', intro = '$this->intro', profile_image ='$this->image_name' WHERE id='$this->id'");
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
    public static function retreiveHome($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM home WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $home = $sql->fetch(PDO::FETCH_ASSOC);
        return $home;
    }
    public static function retreiveAllHome()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM home");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allHome = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allHome;
    }
    
   
  
}