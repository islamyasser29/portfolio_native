<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Project
{
    private $id;
    private $title;
    private $paragraph;
    private $image_name;
    private $image_tmp;
    private $link_project;
    
    public function __construct($title, $paragraph,$image_name, $image_tmp,$link_project, $id="")
    {
        $this->title = $title;
        $this->paragraph = $paragraph;
        $this->image_name = $image_name;
        $this->image_tmp = $image_tmp;
        $this->link_project = $link_project;
        $this->id = $id;
    }
    public function addProject()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO project(title, paragraph, image_project ,link_project) VALUES('$this->title', '$this->paragraph', '$this->image_name', '$this->link_project')");
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
    public static function deleteProject($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM project WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateProject()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                global $dbh;
                // prepare query before execute
                $sql = $dbh->prepare("UPDATE project SET title='$this->title', paragraph = '$this->paragraph', image_project ='$this->image_name' ,link_project ='$this->link_project' WHERE id='$this->id'");
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
    public static function retreiveProject($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM project WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $project = $sql->fetch(PDO::FETCH_ASSOC);
        return $project;
    }
    public static function retreiveAllProject()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM project");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allProject = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allProject;
    }
}