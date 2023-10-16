<?php
require_once 'auth.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
require_once '../lib/About.php';
require_once '../helper/output.php';
?>        
<div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">About</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                           <?php
                            if(isset($_GET['action'], $_GET['id'])){
                                // collect data 
                                $action = $_GET['action']; // may be delete or edit
                                $id = $_GET['id'];
                                switch($action){
                                    case 'delete':
                                        if(About::deleteAbout($id)){
                                            echo getSuccessMessage();
                                        }else{
                                            echo getFailMessage();
                                        }
                                        break;
                                    case 'edit':
                                        $about = About::retreiveAbout($id);
                                        if(is_array($about)){
                                                    echo '<div class="contact-form">
                                                                        <form action="about.php" method="POST" enctype="multipart/form-data">
                                                                          <div class="row">
                                                                            </div>
                                                                          </div>
                                                                          <div class="row">
                                                                          <div class="col-lg-12 mb-4">
                                                                                <input type="hidden" name="id" value="'.$about['id'].'" class="form-control form-control-lg fs-6 border-0 shadow-sm"/>
                                                                             </div>
                                                                            
                                                                            <div class="col-lg-12 mb-4">
                                                                              <input
                                                                                type="text"
                                                                                name="title"
                                                                                value="'.$about['title'].'"
                                                                                placeholder="Title"
                                                                                class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                                              />
                                                                            </div>
                                                                            <div class="col-lg-12 mb-4">
                                                                              <input
                                                                                type="text"
                                                                                name="theme"
                                                                                value="'.$about['theme'].'"
                                                                                placeholder="Theme"
                                                                                class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                                              />
                                                                            </div>
                                                                              <div class="mb-3 text-center mb-4">
                                                                              <label for="formFile" class="form-label">Upload CV</label>
                                                                              <input class="form-control shadow-sm" type="file" id="formFile" name="uplaod_cv">
                                                                            </div>
                                                                          </div>
                                                                          </div>
                                                                          <div class="row">
                                                                            <div class="col-lg-12 text-center">
                                                                                <button type="submit" class="btn btn-success px-3 " name="update_about">
                                                                                Update About
                                                                              </button>
                                                                            </div>
                                                                          </div>
                                                                        </form>
                                                                      </div>
                                                                      </div>
                                                                    </div>';
                                        }else{
                                            echo getMessage("no home found");
                                        }
                                        break;
                                    default:
                                        echo getMessage("invalid action");
                                }
                            }
                            ?>

              <?php
                      if(isset($_POST['update_about'])){
            // collect data 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $theme = $_POST['theme'];
            $cv_name = $_FILES['uplaod_cv']['name'];
            $cv_tmp = $_FILES['uplaod_cv']['tmp_name'];
            // check data valid or no 
            if($title == null){
                echo getNullMessage("title");
            }else if($theme == null){
                echo getNullMessage("theme");
            }else{
                // operations 
                $about = new About($title, $theme,$cv_name, $cv_tmp, $id);
                if($about->updateAbout()){
                    echo getSuccessMessage();
                }else{
                    echo getFailMessage();
                }
            }
        }
    ?>
                <table
                  class="table bg-white rounded shadow-sm table-hover text-center"
                  id="home"
                >
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Theme</th>
                      <th scope="col">Delete</th>
                      <th scope="col">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                                   $allAbout = About::retreiveAllAbout();
                                   if(is_array($allAbout) && count($allAbout)>0){
                                       foreach ($allAbout as $about):
                                           echo '<tr>
                                                       <td>'.$about['id'].'</td>
                                                       <td>'.$about['title'].'</td>
                                                       <td>'.$about['theme'].'</td>
                                                       <td><a class="btn btn-danger" href="?action=delete&id='.$about['id'].'">Delete</a></td>
                                                       <td><a class="btn btn-info" href="?action=edit&id='.$about['id'].'">Edit</a></td>
                                                </tr>';
                                       endforeach;
                                   }else{
                                       echo '<tr>
                                                       <td colspan="5" class="text-danger" role="alert">no editor found</td>
                                                   </tr>';
                                           }
                       ?>                     
                  </tbody>
                </table>
                    <div class="mb-3 text-center">
                        <a class="btn btn-success" href="addAbout.php" >Add About</a>
                   </div>
           </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
    </div>
    <?php
require_once 'template/script.tpl';
?>