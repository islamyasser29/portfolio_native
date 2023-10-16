<?php
require_once 'auth.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
require_once '../lib/Project.php';
require_once '../helper/output.php';
?>        
<div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">Project</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                  
                     <?php
                            if(isset($_GET['action'], $_GET['id'])){
                                // collect data 
                                $action = $_GET['action']; // may be delete or edit
                                $id = $_GET['id'];
                                switch($action){
                                    case 'delete':
                                        if(Project::deleteProject($id)){
                                            echo getSuccessMessage();
                                        }else{
                                            echo getFailMessage();
                                        }
                                        break;
                                    case 'edit':
                                        $project = Project::retreiveProject($id);
                                        if(is_array($project)){
                                            echo '<div class="contact-form">
                                                             <form action="project.php" method="POST" enctype="multipart/form-data">
                                                              <div class="row">
                                                                </div>
                                                              </div>
                                                              <div class="row">
                                                                <div class="mb-3 text-center mb-4">
                                                                  <div class="profile-box m-auto">
                                                                    <img class="profile-image" src="../upload/'.$project['image_project'].'" alt="">
                                                                  </div>
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                    <input type="hidden" name="id" value="'.$project['id'].'" class="form-control form-control-lg fs-6 border-0 shadow-sm"/>
                                                                 </div>
                                                                <div class="col-lg-12 mb-4">
                                                                  <input
                                                                    type="text"
                                                                    placeholder="Title"
                                                                    name="title"
                                                                    value="'.$project['title'].'"
                                                                    class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                                  />
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                  <input
                                                                    type="text"
                                                                    placeholder="Paragraph"
                                                                    name="paragraph"
                                                                    value="'.$project['paragraph'].'"
                                                                    class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                                  />
                                                                </div>
                                                                <div class="col-lg-12 mb-4">
                                                                  <input
                                                                    type="text"
                                                                    placeholder="link"
                                                                    name="link_project"
                                                                    value="'.$project['link_project'].'"
                                                                    class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                                  />
                                                                </div>
                                                              </div>
                                                              <div class="mb-3 text-center mb-4">
                                                                  <input class="form-control shadow-sm" type="file" id="formFile" name="image_project">
                                                                </div>
                                                              </div>
                                                              <div class="row">
                                                                <div class="col-lg-12 text-center">
                                                                    <button type="submit" class="btn btn-success px-3" name="update_project">
                                                                    Update Project
                                                                  </button>
                                                                </div>
                                                              </div>
                                                            </form>
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
        if(isset($_POST['update_project'])){
            // collect data 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $paragraph = $_POST['paragraph'];
            $image_name = $_FILES['image_project']['name'];
            $image_tmp = $_FILES['image_project']['tmp_name'];
            $link_project = $_POST['link_project'];
            // check data valid or no 
            if($title == null){
                echo getNullMessage("title");
            }else if($paragraph == null){
                echo getNullMessage("paragraph");
            }else if($link_project == null){
                echo getNullMessage("link project");
            }else{
                // operations 
                $project = new Project($title, $paragraph,$image_name, $image_tmp, $link_project, $id);
                if($project->updateProject()){
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
                      <th scope="col">Paragraph</th>
                      <th scope="col">links</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                                                <?php
                                   $allProject = Project::retreiveAllProject();
                                   if(is_array($allProject) && count($allProject)>0){
                                       foreach ($allProject as $project):
                                           echo '<tr>
                                                       <td>'.$project['id'].'</td>
                                                       <td>'.$project['title'].'</td>
                                                       <td>'.$project['paragraph'].'</td>
                                                       <td><a href="'.$project['link_project'].'" class="link-success" target="_blank">link here</a></td>
                                                       <td><a class="btn btn-danger" href="?action=delete&id='.$project['id'].'">Delete</a></td>
                                                       <td><a class="btn btn-info" href="?action=edit&id='.$project['id'].'">Edit</a></td>
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
                  
            <div class="col-lg-12 text-center">
                  <a class="btn btn-success" href="addProject.php" >Add Project</a>
            </div>
      <!-- /#page-content-wrapper -->
    </div>
    <?php
require_once 'template/script.tpl';
?>