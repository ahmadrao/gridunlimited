<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/app.min.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/bundles/bootstrap-social/bootstrap-social.css'?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/components.css'?>">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/custom.css'?>">
  <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url().'assets/img/logo1.png'?>" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
			  <?php
			  $login=$this->session->userdata('login');
if($login!="")
{
	?>
	<div class="alert alert-danger col-md-12 col-sm-12" ><?php echo $login; ?></div>
<?php
}
$failure1=$this->session->userdata('failure1');
if($failure1!="")
{
	?>
	<div class="alert alert-danger col-md-12 col-sm-12" ><?php echo $failure1; ?></div>
<?php
}
					?>
					
										<?php
$failure=$this->session->userdata('failure');
if($failure!="")
{
	?>
	<div class="alert alert-danger col-md-12 col-sm-12"><?php echo $failure; ?></div>
<?php
}
					?>
              <div class="card-body">
                <form method="POST" action="<?php echo base_url().'index.php/admin/login'?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" value="<?php echo set_value('email'); ?>" name="email" tabindex="1"  autofocus />
					<span style="color:red"><?php echo form_error('email'); ?></span>
                    
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="#" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" value="<?php echo set_value('password'); ?>" class="form-control" name="password" tabindex="2" />
					
                   <span style="color:red"><?php echo form_error('password'); ?></span>
                    
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <!--<div class="text-center mt-4 mb-3">-->
                <!--  <div class="text-job text-muted">Login With Social</div>-->
                <!--</div>-->
                <!--<div class="row sm-gutters">-->
                <!--  <div class="col-6">-->
                <!--    <a class="btn btn-block btn-social btn-facebook">-->
                <!--      <span class="fab fa-facebook"></span> Facebook-->
                <!--    </a>-->
                <!--  </div>-->
                <!--  <div class="col-6">-->
                <!--    <a class="btn btn-block btn-social btn-twitter">-->
                <!--      <span class="fab fa-twitter"></span> Twitter-->
                <!--    </a>-->
                <!--  </div>-->
                </div>
              </div>
            </div>
         
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo base_url().'assets/js/app.min.js'?>"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?php echo base_url().'assets/js/scripts.js'?>"></script>
  <!-- Custom JS File -->
  <script src="<?php echo base_url().'assets/js/custom.js'?>"></script>
</body>

</html>