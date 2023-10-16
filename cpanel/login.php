<?php
require_once '../lib/Admin.php';
require_once '../helper/output.php';
require_once 'template/header_login.tpl';
?>
<body class="login">
    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
          <div class="card">
            <div class="card-body mb-5">
              <div class="text-center py-2 mb-3">
                <i class="fa-solid fa-user fs-1 text-info"></i>
              </div>
                <form action="" method="POST">
                    <?php
                        if(isset($_POST['login'])){
                            // collect data
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            // check data valid or no 
                            if($username == null){
                                echo getNullMessage("username");
                            }elseif($password == null){
                                echo getNullMessage("password");
                            }else{
                                if(Admin::Login($username, $password)){
                                    // redirect to index page 
                                    header("Location: index.php");
                                    // for security 
                                    exit();
                                }else{
                                    echo getMessage("error happend");
                                }
                            }
                        }
                    ?>
                   
                <input
                  type="text"
                  class="form-control my-4 py-2"
                  placeholder="Username"
                  name="username"
                />
                <input
                  type="Password"
                  class="form-control my-4 py-2"
                  placeholder="Password"
                  name="password"
                />
                <div class="text-center">
                    <button type="submit" class="btn btn-info px-5" name="login">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
require_once 'template/script.tpl';
?>
