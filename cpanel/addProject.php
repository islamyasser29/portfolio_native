<?php
require_once 'auth.php';
require_once '../helper/output.php';
require_once '../lib/Project.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
?>
        <div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">Add Project</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                  <div class="contact-form">
                    <form action="addProject.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                                <div class="col-lg-12 mb-4">
                                          <?php
                                                if(isset($_POST['addProject'])){
                                                        // collect data 
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
                                                            $project = new Project($title, $paragraph,$image_name, $image_tmp, $link_project);
                                                            if($project->addProject()){
                                                                echo getSuccessMessage();
                                                            }else{
                                                                echo getFailMessage();
                                                            }
                                                        }
                                                    }
                                                ?>
                                 </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 mb-4">
                          <input
                          type="text"
                          placeholder="Title"
                          name="title"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input
                          type="text"
                          placeholder="Paragraph"
                          name="paragraph"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input
                          type="text"
                          placeholder="link project"
                          name="link_project"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="mb-3 text-center mb-4">
                            <input class="form-control shadow-sm" type="file" id="formFile" name="image_project">
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" name="addProject" class="btn btn-success px-3">
                            Add Project
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
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
