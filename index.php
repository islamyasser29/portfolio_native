<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'lib/Home.php';
require_once 'lib/About.php';
require_once 'lib/Project.php';
require_once 'lib/Contact.php';
require_once 'helper/output.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/Exception.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="template/images/portfolio-icon-3.jpg" type="image/x-icon">
    <link rel="stylesheet" href="template/css/bootstrap.min.css" />
    <link rel="stylesheet" href="template/css/all.min.css" />
    <link rel="stylesheet" href="template/css/animate.min.css" />
    <link rel="stylesheet" href="template/css/base.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700;900&family=Ubuntu:wght@300;400;500;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <title>Portfolio</title>
  </head>
  <body class="bg-light">
    <!-- str navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
      <div class="container-lg">
        <a class="navbar-brand text-danger fs-2 fw-bold animate__animated animate__bounce animate__infinite animate__pulse" href="#home">Portfolio</a>
        <button class="navbar-toggler text-danger border-0 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa-solid fa-bars-staggered"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav text-center">
            <li class="nav-item px-5">
              <a class="nav-link active fw-bold text-danger" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link text-danger" href="#about">About</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link text-danger" href="#services">Services</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link text-danger" href="#portfolio">Portfolio</a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link text-danger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
    <!-- str home section -->
    
    <section class="home py-5" id="home">
      <div class="container-lg">
        <div class="row min-vh-100 align-items-center align-content-center">
          <div class="col-md-6 col-sm-12 mt-5 mt-md-0 text-center">
              <?php
                $allHome = Home::retreiveAllHome();
                if(is_array($allHome) && count($allHome)>0){
                      foreach ($allHome as $home):
                        echo'<div class="profile-card card img-thumbnail shadow">
                                    <img src="upload/'.$home['profile_image'].'" class="profile-image" alt="profile image" >
                                  </div>
                                </div>';
                   ?>
          <div class="col-md-6  col-sm-12 mt-5 mt-md-0">
            <div class="home-text text-center">
              <p class="text-muted fs-4 mb-1">Hello I'm</p>
              <?php 
                echo'<h1 class="text-danger text-uppercase fs-2 fw-bold">
                                   '.$home['specialty'].'
                                  </h1>
                                  <h2 class="fs-4 text-center bg-danger text-white py-2">
                                    '.$home['name'].'
                                  </h2>
                                  <p class="text-muted mt-4">
                                   '.$home['intro'].'
                                  </p>
                                  <a href="#portfolio" class="btn btn-danger px-3 m-auto"
                                    >My Work</a
                                  >
                                </div>
                              </div>
                            </div>';
                endforeach;
                }else{
                    echo getMessage("no news found");
                }
              ?>
      </div>
    </section>
    <!-- end home section -->
    <!-- str about section -->
    <section class="about py-5" id="about">
      <div class="container-lg py-5">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-title text-center">
              <h2 class="fw-bold mb-5">About Me</h2>
            </div>
          </div>
        </div>
                        <?php
               $allAbout = About::retreiveAllAbout();
                if(is_array($allAbout) && count($allAbout)>0){
                      foreach ($allAbout as $about):
                        echo'<div class="row d-flex align-items-center">
                                        <div class="col-md-6 mb-5">
                                          <div class="about-text">
                                            <h3 class="fs-3 mb-3">'.$about['title'].'</h3>
                                            <p class="text-muted">
                                             '.$about['theme'].'
                                            </p>
                                          </div>
                                          <div class="row">
                                            <div class="col-lg-12 d-flex align-items-center">
                                              <a href="upload/'.$about['upload_cv'].'" download="computer" class="btn btn-danger me-5">Download CV</a>';
                   endforeach;
                }else{
                    echo getMessage("no news found");
                }
?>
        
                <div class="social-links">
                  <a class="text-dark me-1 px-2" href="https://www.facebook.com/eslam.esoo.98229/"><i class="fab fa-facebook-f"></i></a>
                  <a class="text-dark me-1 px-2" href="https://www.linkedin.com/in/islam-yasser-255ab2276/"><i class="fab fa-linkedin-in"></i></a>
                  <a class="text-dark me-1 px-2" href="https://github.com/islamyasser29/"><i class="fa-brands fa-github"></i></a>
                </div>
              </div>
          </div>
        </div>
        <div class="col-md-6 mb-5">
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-html5 fs-6 text-danger px-1"></i> HTML</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 95%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-css3 fs-6 text-danger px-1"></i> CSS</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 95%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-square-js fs-6 text-danger px-1"></i> JS</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 80%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-bootstrap fs-6 text-danger px-1"></i> Bootstrap</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 100%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-php fs-6 text-danger px-1"></i> PHP</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 80%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-solid fa-database fs-6 text-danger px-1"></i> MySQL</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 70%"></div>
            </div>
          </div>
          <div class="skill-item mb-4">
            <h3 class="fs-6"><i class="fa-brands fa-laravel fs-6 text-danger px-1"></i> Laravel</h3>
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
              <div class="progress-bar bg-danger" style="width: 80%"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end about section -->
    <!-- str services section -->
    <section class="services py-5" id="services">
      <div class="container-lg py-4">
        <div class="row justify-content-center">
          <div class="col-lg-8  col-sm-12">
            <div class="section-title text-center">
              <h2 class="fw-bold mb-5">What I Do</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-lg-6 col-sm-12 mb-3">
            <div class="services-item shadow-sm p-4 rounded bg-white">
              <div class="icon my-3 text-danger fs-3">
                <i class="fas fa-code"></i>
              </div>
              <h3 class="fs-3 py-2">Web Development</h3>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ratione exercitationem necessitatibus, veritatis illum</p>
            </div>
          </div>
          <div class="col-lg-6 col-sm-12 mb-3">
            <div class="services-item shadow-sm p-4 rounded bg-white">
              <div class="icon my-3 text-danger fs-3">
                <i class="fas fa-lightbulb"></i>
              </div>
              <h3 class="fs-3 py-2">Web Design</h3>
              <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ratione exercitationem necessitatibus, veritatis illum</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end services section -->
    <!-- str portfolio section -->
    <section class="portfolio py-5" id="portfolio">
      <div class="container-lg">
        <div class="row justify-content-center">
          <div class="col-lg-8  col-sm-12">
            <div class="section-title text-center">
              <h2 class="fw-bold mb-5">Latest Works</h2>
            </div>
          </div>
        </div>
        <div class="row">
            
            <?php
               $allProject = Project::retreiveAllProject();
                if(is_array($allProject) && count($allProject)>0){
                    foreach ($allProject as $project):
                        echo'<div class="col-md-6 col-lg-4 text-center mb-5">
                                        <div class="card img-thumbnail shadow" style="width: 25rem;">
                                          <div class="inner">
                                            <img src="upload/'.$project['image_project'].'" class="card-img-top" alt="" >
                                          </div>
                                          <div class="card-body">
                                            <h5 class="card-title">'.$project['title'].'</h5>
                                            <p class="card-text">'.$project['paragraph'].'</p>
                                            <a href="'.$project['link_project'].'" class="btn btn-danger" target="_blank">Check Here</a>
                                          </div>
                                        </div>
                                      </div>';
                    endforeach;
                }else{
                    echo getMessage("no news found");
                }
?>
          
          
          
        
        </div>
      </div>
    </section>
    <!-- end portfolio section -->
    <!-- str freelancer section -->
    <section class="freelancer-available py-5 bg-danger">
      <div class="container-lg py-4">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <p class="text-light fs-5">Do You Any Project ?</p>
            <h2 class="fs-1 text-white mb-4">I'm Available For Freelancer Project</h2>
            <a href="#contact" class="btn btn-outline-light">Here Me</a>
          </div>
        </div>
      </div>
    </section>
    <!-- end freelancer section -->
    <!-- str content section -->
    <section class="contact py-5" id="contact">
      <div class="container-lg py-4">
        <div class="row justify-content-center">
          <div class="col-lg-8  col-sm-12">
            <div class="section-title text-center">
              <h2 class="fw-bold mb-5">Contact Me</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="contact-item  d-flex mb-3">
              <div class="icon fs-4 text-danger"><i class="fa-solid fa-envelope"></i></div>
              <?php
               $allContact = Contact::retreiveAllContact();
                                if(is_array($allContact) && count($allContact)>0){
                                    foreach ($allContact as $contact):
                                        echo'<div class="text ms-3">
                                                        <h3 class="fs-5">Email</h3>
                                                        <p class="text-muted">'.$contact['email'].'</p>
                                                      </div>
                                                    </div>
                                                    <div class="contact-item  d-flex mb-3 ">
                                                      <div class="icon fs-4 text-danger"><i class="fa-solid fa-phone"></i></div>
                                                      <div class="text ms-3">
                                                        <h3 class="fs-5">Phone</h3>
                                                        <p class="text-muted"><span class="text-danger fw-bold fs-5 mx-2" >+(20)</span>'.$contact['phone'].'</p>
                                                      </div>
                                                    </div>
                                                  </div>';
                                    endforeach;
                                }else{
                                    echo getMessage("no news found");
                                }
                ?>
              
          <div class="col-md-7">
            <div class="contact-form">
                <form action="#contact" method="POST">
                  <?php

                            if(isset($_POST['send'])){
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $msg = $_POST['msg'];
                            $subject = $_POST['subject'];
                            if($name == null){
                                echo getNullMessage("name");
                            }else if($email == null){
                                echo getNullMessage("email");
                            }else if($msg == null){
                                echo getNullMessage("msg");
                            }else if($subject == null){
                                echo getNullMessage("subject");
                            }else{
                                //Load Composer's autoloader
                                

                                //Create an instance; passing `true` enables exceptions
                                $mail = new PHPMailer(true);

                                try {
                                    //Server settings
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = 'yeslam960@gmail.com';                     //SMTP username
                                    $mail->Password   = 'uivxupufmuwyaucd';                               //SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                    //Recipients
                                    $mail->setFrom('yeslam960@gmail.com', 'Web Portfolio');
                                    $mail->addAddress('yeslam960@gmail.com', 'Islam Yasser');     //Add a recipient

                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = "Subject - $subject";
                                    $mail->Body    = "Name - $name <br> Email - $email <br> Massage - $msg";

                                    $mail->send();
                                    echo getSuccessMessage();
                                } catch (Exception $e) {
                                    echo getFailMessage();
                                }
                            }
                            }
                        ?>
                <div class="row">
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-4">
                    <input type="text" placeholder="Your Name"  name="name" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                  </div>
                  <div class="col-lg-6 mb-4">
                    <input type="email" placeholder="Your Email" name="email" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mb-4">
                    <input type="text" placeholder="Subject" name="subject" class="form-control form-control-lg fs-6 border-0 shadow-sm">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mb-4">
                    <textarea rows="5" placeholder="Your Massage" name="msg" class="form-control form-control-lg fs-6 border-0 shadow-sm"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-danger px-3" name="send"><i class="fa-solid fa-paper-plane me-2"></i>Send Me</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end content section -->
    <!-- str footer -->
    <footer class="footer">
      <div class="container-lg border-top py-4">
        <div class="row">
          <div class="col-lg-12">
            <p class="m-0 text-center text-muted">&copy; 2023 By Islam-Yasser</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- end footer -->
    <script src="template/js/bootstrap.bundle.min.js"></script>
    <script src="template/js/all.min.js"></script>
    <script src="template/js/jquery-3.7.0.min.js"></script>
    <script src="template/js/plugins.js"></script>
  </body>
</html>
