
 <title>Admin - Add Category</title>
 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="float-left d-inline">Add Channel</h4>
                    <a href="<?php echo base_url().'index.php/admin/add_category'?>"><button class="btn  btn-primary float-right">Manage channels</button></a>
                  </div>
                  <div class="card-body">
                  	<form action="<?php echo base_url().'index.php/admin/add_category'?>" method="post" name="createCategory" enctype="multipart/form-data">
                    <div class="row">
	                    <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<input type="text"class="form-control" placeholder="Chanel name" value="<?php echo set_value('category'); ?>"  name="category">
										<span style="color:red"><?php echo form_error('category'); ?></span>
		                    	</div>
	                    </div>
	                    
	                   <!-- <div class="col-md-6">
	                    	    <div class="form-group">
		                    		<input type="url" class="form-control" placeholder="Video link" name="title" required="required">
		                    	</div>
	                    </div>-->
	                    <div class="col-md-12">
	                    	    <div class="form-group">
		                  <input type="text" placeholder="Channel Description" class="form-control" name="desc"  value="<?php echo set_value('desc'); ?>"/> 
									<span style="color:red"><?php echo form_error('desc'); ?></span>
		                    	</div>
						
	                    </div>
	                      <div class="col-md-12">
	                    	    <div class="form-group">
		                  <input type="file"  class="form-control" name="file" required  /> 
		                  <span style="color:red"><?php if(isset($upload_error)){echo $upload_error; } ?></span>
								
		                    	</div>
						
	                    </div>
	                    <div class="col-md-12">
	                    	    <button type="submit" name="submit" class="btn btn-success">
	                    	      Add channel</button>
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
         
      </div>
     