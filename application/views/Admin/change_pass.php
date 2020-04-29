<?php
$this->load->view('Videos/includes/header');
 ?>
 <title>Admin - Change Password</title>
 <script>
 function checkpass()
{
	var pass=document.getElementById("newpass").value;
	var repass=document.getElementById("cnewpass").value;
	var sp=document.getElementById("sp");
	var sbt=document.getElementById("sbt");
	if(pass==repass)
	{
		sp.innerHTML="Both passwords matched";
		sp.style.color="green";
		sbt.style.display="inline-block";
	}
	else
	{
		sp.innerHTML="Passwords not matched";
		sp.style.color="red";
		sbt.style.display="none";
	}
}
</script>
 
 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="float-left d-inline">Change Password</h4>
                   
                  </div>
                  			  <?php
			  $failure=$this->session->userdata('failure');
if($failure!="")
{
	?>
	<div class="alert alert-danger col-md-12 col-sm-12" ><?php echo $failure; ?></div>
<?php
}
?>
                  <div class="card-body">
                  	<form action="<?php echo base_url().'index.php/admin/change_password'?>" method="post" name="change_pass">
                    <div class="row">
	                    <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<input type="text"class="form-control" placeholder="Old Password" value="<?php echo set_value('oldpass'); ?>"  name="oldpass">
									<span style="color:red"><?php echo form_error('oldpass'); ?></span>
		                    	</div>
	                    </div>
	                    
	                   <!-- <div class="col-md-6">
	                    	    <div class="form-group">
		                    		<input type="url" class="form-control" placeholder="Video link" name="title" required="required">
		                    	</div>
	                    </div>-->
	                    <div class="col-md-12">
	                    	    <div class="form-group">
		                  <input type="password" placeholder="New Password" id="newpass" class="form-control" name="newpass"  value="<?php echo set_value('newpass'); ?>"/> 
									<span style="color:red"><?php echo form_error('newpass'); ?></span>
		                    	</div>
						
	                    </div>
	                     <div class="col-md-12">
	                    	    <div class="form-group">
		                  <input type="password" placeholder="Confirm New Password"  oninput="checkpass()" class="form-control" id="cnewpass" name="cnewpass"  value="<?php echo set_value('cnewpass'); ?>"/> 
									<span style="color:red"><?php echo form_error('cnewpass'); ?></span>
		                    	</div>
						
	                    </div>
	                    <span id="sp"></span>
	                    <div class="col-md-12">
	                    	    <button type="submit" name="submit" id="sbt" class="btn btn-success">
	                    	     Update</button>
	                    	    <button type="reset"  class="btn btn-danger"><i class="fas fa trash"></i> Clear</button>
	                </div>	
                    	</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </section>
       <?php $this->load->view('Videos/includes/setting'); ?>
      </div>
       <?php $this->load->view('Videos/includes/footer'); ?>