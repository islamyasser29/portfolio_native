<?php
require_once 'auth.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
require_once '../lib/Home.php';
?>
<div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-2 fw-bold mb-3 text-center">Show All View</h3>
              <?php
               $allHome = Home::retreiveAllHome();
                if(is_array($allHome) && count($allHome)>0){
                      foreach ($allHome as $home):
                        echo'<div class="col-12 m-auto">
                                <div class="image-profile">
                                  <div class="profile-card card img-thumbnail shadow">
                                    <img
                                       src="../upload/'.$home['profile_image'].'"
                                      class="profile-image"
                                      alt="profile image"
                                    />
                                  </div>
                                  <h2
                                    class="text-center text-success text-uppercase fs-2 fw-bold py-3"
                                  >
                                    '.$home['specialty'].'
                                  </h2>
                                  <p class="text-center text-muted fs-4">
                                    '.$home['intro'].'
                                  </p>
                                </div>
                              </div>';
                   endforeach;
                }else{
                    echo getMessage("no news found");
                }
?>
              
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
    </div>
<?php
require_once 'template/script.tpl';
?>