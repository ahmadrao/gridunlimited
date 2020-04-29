<?php

 ?>
 <title>Admin - Add Video</title>
 <script>
 $(document).ready(function() {
     var i=1;
     $('#addmore').click(function(){
         i++;
         $('.x').append('<div class="col-md-4" id="rowx'+i+'"><div class="form-group"><input type="text"class="form-control" id="title" placeholder="Video Title"  name="title[]"></div></div><div  class="col-md-5" id="rowy'+i+'"><div class="form-group"><input type="url"class="form-control" id="url" placeholder="Video Url"   name="url[]"></div></div></div><div class="col-md-1 btn_remove" id="rowz'+i+'"><a id="'+i+'" name="remove" class="btn btn_remove btn-danger">X</a></div>')
     })
    $(document).on('click','.btn_remove',function(){
        var btn_id=$(this).attr("id");
        $("#rowx"+btn_id+"").remove();
        $("#rowy"+btn_id+"").remove();
        $("#rowz"+btn_id+"").remove();
    });
    
 });
 </script>
 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="float-left d-inline">Add Video</h4>
                    <a href="<?php echo base_url().'index.php/admin/list_video'?>"><button class="btn  btn-primary float-right">Manage Videos</button></a>
                   
                  </div>
                  <div class="card-body">
                  	<form action="<?php echo base_url().'index.php/admin/add_video'?>" method="post" name="createvideo">
                    <div class="row x">
					 <div class="col-md-12">
	                    	    <div class="form-group">
		                    		<select class="form-control"   name="category">
									<option>Select Category</option>
									<?php if(!empty($cats))
									{
							foreach($cats as $category)
							{
					?>
					<option value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
					<?php
							}
									}
									?>
									</select>
									<span style="color:red"><?php echo form_error('category'); ?></span>
		                    	</div>
	                    </div>
	                    <div class="col-md-4">
	                    	    <div class="form-group">
		                    		<input type="text"class="form-control" id="title" placeholder="Video Title" value="<?php echo set_value('title'); ?>"  name="title[]">
									<span style="color:red"><?php echo form_error('title'); ?></span>
		                    	</div>
	                    </div>
						    <div class="col-md-5">
	                    	    <div class="form-group">
		                    		<input type="url"class="form-control" id="url" placeholder="Video Url" value="<?php echo set_value('url'); ?>"  name="url[]">
									<span style="color:red"><?php echo form_error('url'); ?></span>
		                    	</div>
	                    </div>
	                 	 
	                    
	                  
                    </div>
                    <div class="row" style="margin-top:-30px;">
                    <div class="col-md-10" ></div>
                     <div class="col-md-2" >
	                    	    <a id="addmore" name="addmore" class="btn btn-success">Add more</a>
	                    </div>
	                    </div>
                      <div class="col-md-12">
	                    	    <button type="submit" name="submit" class="btn btn-success">
	                    	      Add Video</button>
	                    	    <button type="reset"  class="btn btn-danger"><i class="fas fa trash"></i> Clear</button>
	                </div>	
                    	</form>
                    
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </section>
         <?php ?>
      </div>
      <?php ?>