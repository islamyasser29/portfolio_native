<?php
require_once 'auth.php';
require_once '../helper/output.php';
require_once '../lib/About.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
?>
        <div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">Add About</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                  <div class="contact-form">
                    <form action="addAbout.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                                <div class="col-lg-12 mb-4">
                                          <?php
                                                if(isset($_POST['addAbout'])){
                                                    // collect data 
                                                    $title = $_POST['title'];
                                                    $theme = $_POST['theme'];
                                                    $cv_name = $_FILES['upload_cv']['name'];
                                                    $cv_tmp = $_FILES['upload_cv']['tmp_name'];
                                                    // check data valid or no 
                                                    if($title == null){
                                                        echo getNullMessage("title");
                                                    }else if($theme == null){
                                                        echo getNullMessage("theme");
                                                    }else{
                                                        // operations 
                                                        $about = new About($title, $theme,$cv_name, $cv_tmp);
                                                        if($about->addAbout()){
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
                          placeholder="Theme"
                          name="theme"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="mb-3 text-center mb-4">
                            <input class="form-control shadow-sm" type="file" id="formFile" name="upload_cv">
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" name="addAbout" class="btn btn-success px-3">
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
