<?php
$this->load->view('Videos/includes/header');
 ?>
 <title>Admin - Edit Video</title>
 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="float-left d-inline">Edit Video</h4>
                    <a href="<?php echo base_url().'index.php/admin/list_video'?>"><button class="btn  btn-primary float-right">Manage Videos</button></a>
                  </div>
                  <div class="card-body">
                  	<form action="<?php echo base_url().'index.php/admin/edit_video/'.$video['id'];?>" method="post" name="editvideo">
                    <div class="row">
					 <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<select class="form-control"   name="category">
									<option>Select Category</option>
									<?php if(!empty($cats))
									{
							foreach($cats as $category)
							{
								?>
					<option <?= ($category['id']==$video['category_id'])?'selected':'' ?> value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
					<?php	
							}
									}
									?>
									</select>
									<span style="color:red"><?php echo form_error('category'); ?></span>
		                    	</div>
	                    </div>
	                    <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<input type="text"class="form-control" placeholder="Video Title" value="<?php echo set_value('title',$video['title']); ?>"  name="title">
									<span style="color:red"><?php echo form_error('title'); ?></span>
		                    	</div>
	                    </div>
						    <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<input type="url"class="form-control" placeholder="Video Url" value="<?php echo set_value('url',$video['video_url']); ?>"  name="url">
									<span style="color:red"><?php echo form_error('url'); ?></span>
		                    	</div>
	                    </div>
	                    
	                   <!-- <div class="col-md-6">
	                    	    <div class="form-group">
		                    		<input type="url" class="form-control" placeholder="Video link" name="title" required="required">
		                    	</div>
	                    </div>-->
	                    <div class="col-md-12">
	                    	    <button type="submit" name="submit" class="btn btn-success">
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