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
              <h3 class="fs-4 mb-3 text-center">Contact</h3>
              <div class="col">
                <div class="col-md-7 my-5 m-auto">

                     <?php
                            if(isset($_GET['action'], $_GET['id'])){
                                // collect data 
                                $action = $_GET['action']; // may be delete or edit
                                $id = $_GET['id'];
                                switch($action){
                                    case 'delete':
                                        if(Contact::deleteContact($id)){
                                            echo getSuccessMessage();
                                        }else{
                                            echo getFailMessage();
                                        }
                                        break;
                                    case 'edit':
                                        $contact = Contact::retreiveContact($id);
                                        if(is_array($contact)){
                                            echo '<div class="contact-form">
                                                       <form action="contact.php" method="POST">
                                                          <div class="row">
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                          <div class="col-lg-12 mb-4">
                                                              <input type="hidden" name="id" value="'.$contact['id'].'" class="form-control form-control-lg fs-6 border-0 shadow-sm"/>
                                                            <div class="col-lg-12 mb-4">
                                                              <input
                                                                type="phone"
                                                                placeholder="Phone"
                                                                name="phone"
                                                                value="'.$contact['phone'].'"
                                                                class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                              />
                                                            </div>
                                                            <div class="col-lg-12 mb-4">
                                                              <input
                                                                type="email"
                                                                placeholder="Email"
                                                                 name="email"
                                                                 value="'.$contact['email'].'"
                                                                class="form-control form-control-lg fs-6 border-0 shadow-sm"
                                                              />
                                                            </div>
                                                          </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-lg-12 text-center">
                                                              <button type="submit" class="btn btn-success px-3" name="update_contact">
                                                                Update Contact
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
        if(isset($_POST['update_contact'])){
            // collect data 
            $id = $_POST['id'];
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
                $contact = new Contact($phone, $email, $id);
                if($contact->updateContact()){
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
                      <th scope="col">Phone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Delete</th>
                      <th scope="col">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                                   $allContact = Contact::retreiveAllContact();
                                   if(is_array($allContact) && count($allContact)>0){
                                       foreach ($allContact as $contact):
                                           echo '<tr>
                                                       <td>'.$contact['id'].'</td>
                                                       <td>'.$contact['phone'].'</td>
                                                       <td>'.$contact['email'].'</td>
                                                       <td><a class="btn btn-danger" href="?action=delete&id='.$contact['id'].'">Delete</a></td>
                                                       <td><a class="btn btn-info" href="?action=edit&id='.$contact['id'].'">Edit</a></td>
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
                        <a class="btn btn-success" href="addContact.php" >Add Contact</a>
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