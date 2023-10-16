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
              <h3 class="fs-4 mb-3 text-center">Add Home</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                  <div class="contact-form">
                    <form action="addHome.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                                <div class="col-lg-12 mb-4">
                                          <?php
                                                if(isset($_POST['addHome'])){
                                                    // collect data 
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
                                                        $home = new Home($name, $specialty,$intro,$image_name, $image_tmp);

                                                        if($home->addHome()){
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
                          placeholder="Name"
                          name="name"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input
                          type="text"
                          placeholder="Specialty"
                          name="specialty"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input
                          type="text"
                          placeholder="Intro"
                          name="intro"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="mb-3 text-center mb-4">
                            <input class="form-control shadow-sm" type="file" id="formFile" name="profile_image">
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" name="addHome" class="btn btn-success px-3">
                            Add home
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
