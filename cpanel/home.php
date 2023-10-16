<?php
require_once 'auth.php';
require_once '../helper/output.php';
require_once '../lib/Home.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
?>        
<div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">Home</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                        
       <?php
                            if(isset($_GET['action'], $_GET['id'])){
                                // collect data 
                                $action = $_GET['action']; // may be delete or edit
                                $id = $_GET['id'];
                                switch($action){
                                    case 'delete':
                                        if(Home::deleteHome($id)){
                                            echo getSuccessMessage();
                                        }else{
                                            echo getFailMessage();
                                        }
                                        break;
                                    case 'edit':
                                        $home = Home::retreiveHome($id);
                                        if(is_array($home)){
                                            echo '
                                                <div class="contact-form">
                                                    <form action="home.php" method="POST" enctype="multipart/form-data">
                                                      <div class="row">
                                                      <div class="col-lg-12 mb-4">
                                                                <div class="profile-box m-auto">
                                                                      <img class="profile-image" src="../upload/'.$home['profile_image'].'" alt="">
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-4">
                                                      <div class="row">
                                                        <div class="col-lg-12 mb-4">
                                                          <input
                                                            type="text"
                                                            placeholder="Name"
                                                            name="name"
                                                            value="'.$home['name'].'"
                                                            class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                          />
                                                        </div>
                                                        <div class="col-lg-12 mb-4">
                                                          <input
                                                            type="text"
                                                            placeholder="Specialty"
                                                            name="specialty"
                                                            value="'.$home['specialty'].'"
                                                            class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                          />
                                                        <div class="col-lg-12 mb-4">
                                                           <input type="hidden" name="id" value="'.$home['id'].'" class="form-control form-control-lg fs-6 border-0 shadow-sm"/>
                                                        </div>
                                                        <div class="col-lg-12 mb-4">
                                                          <input
                                                            type="text"
                                                            placeholder="Title"
                                                            name="intro"
                                                            value="'.$home['intro'].'"
                                                            class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                          />
                                                        </div>
                                                        <div class="mb-3 text-center">
                                                          <input class="form-control shadow-sm" type="file" id="formFile" name="profile_image">
                                                        </div>
                                                      </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-lg-12 text-center">
                                                            <button type="submit" class="btn btn-success" name="update_home" >Update Home</button>
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
        if(isset($_POST['update_home'])){
            // collect data 
            $id = $_POST['id'];
            $name = $_POST['name'];
            $specialty = $_POST['specialty'];
            $intro = $_POST['intro'];
            $image_name = $_FILES['profile_image']['name'];
            $image_tmp = $_FILES['profile_image']['tmp_name'];
            // check data valid or no 
            if($name == null){
                echo getNullMessage("name");
            }else if($specialty == null){
                echo getNullMessage("specialty");
            }else if($intro == null){
                echo getNullMessage("intro");
            }else{
                // operations 
                $home = new Home($name, $specialty, $intro,$image_name, $image_tmp, $id);
                if($home->updateHome()){
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
                      <th scope="col"><i class="fa-solid fa-tag  mx-2"></i>ID</th>
                      <th scope="col"><i class="fa-solid fa-star mx-2"></i>Name</th>
                      <th scope="col"><i class="fa-solid fa-ticket mx-2"></i>Specialty</th>
                      <th scope="col"><i class="fa-brands fa-invision mx-2"></i>Intro</th>
                      <th scope="col"><i class="fa-solid fa-trash mx-2"></i>Delete</th>
                      <th scope="col"><i class="fa-solid fa-pencil mx-2"></i>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                                   $allHome = Home::retreiveAllHome();
                                   if(is_array($allHome) && count($allHome)>0){
                                       foreach ($allHome as $home):
                                           echo '<tr>
                                                       <td>'.$home['id'].'</td>
                                                       <td>'.$home['name'].'</td>
                                                       <td>'.$home['specialty'].'</td>
                                                       <td>'.$home['intro'].'</td>
                                                       <td><a class="btn btn-danger" href="?action=delete&id='.$home['id'].'">Delete</a></td>
                                                       <td><a class="btn btn-info" href="?action=edit&id='.$home['id'].'">Edit</a></td>
                                                </tr>';
                                       endforeach;
                                   }else{
                                       echo '<tr>
                                                       <td colspan="6" class="text-danger" role="alert">no editor found</td>
                                                   </tr>';
                                           }
                       ?>                     
                  </tbody>
                </table>
                    <div class="mb-3 text-center">
                        <a class="btn btn-success" href="addHome.php" >Add Home</a>
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