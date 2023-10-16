<?php
require_once 'auth.php';
require_once '../helper/output.php';
require_once '../lib/Contact.php';
require_once 'template/slider.tpl';
require_once 'template/navbar.tpl';
?>
        <div class="container-fluid px-4 min-vh-100">
          <div class="row g-3 my-2">
            <div class="row my-5">
              <h3 class="fs-4 mb-3 text-center">Add Contact</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">
                  <div class="contact-form">
                    <form action="addContact.php" method="POST">
                      <div class="row">
                                <div class="col-lg-12 mb-4">
                                          <?php
                                                if(isset($_POST['addContact'])){
                                                    // collect data 
                                                    $phone = $_POST['phone'];
                                                    $email = $_POST['email'];
                                                    // check data valid or no 
                                                    if($phone == null){
                                                        echo getNullMessage("phone");
                                                    }else if($email == null){
                                                        echo getNullMessage("email");
                                                    }else if(!is_numeric($phone)){
                                                        echo getNonNumericMessage("phone");
                                                    }else{
                                                        // operations 
                                                        $contact = new Contact($phone, $email);
                                                        if($contact->addContact()){
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
                          type="phone"
                          placeholder="Phone"
                          name="phone"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input
                          type="email"
                          placeholder="Email"
                          name="email"
                          class="form-control form-control-lg fs-6 border-0 shadow-sm"
                          />
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" name="addContact" class="btn btn-success px-3">
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
