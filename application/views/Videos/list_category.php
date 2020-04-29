<?php $this->load->view('Videos/includes/header');?>
 <!-- Main Content -->
 <title>Admin - Manage Channels</title>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="display: inline;float: left;">Manage Channels</h4>
                    <a href="<?php echo base_url().'index.php/admin/add_category'?>"><button style="display: inline;float: right;" class="btn btn-primary float-right">Add channel</button></a>
					<?php
					$successp=$this->session->userdata('successp');
if($successp!="")
{
	?>
	<div class="alert alert-success col-md-6 col-sm-12" ><?php echo $successp; ?></div>
<?php
}
$success=$this->session->userdata('success');
if($success!="")
{
	?>
	<div class="alert alert-success col-md-6 col-sm-12" ><?php echo $success; ?></div>
<?php
}
					?>
					
										<?php
$failure=$this->session->userdata('failure');
if($failure!="")
{
	?>
	<div class="alert alert-danger col-md-6 col-sm-12"><?php echo $failure; ?></div>
<?php
}
					?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Channel Name</th>
                            <th>Description</th>
                            <th>Category Image</th>
                            <th>Status</th>
                            <th>Added At</th>
                            <th>Last Updatd At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php if(!empty($cats))
						{
							$k=1;
							foreach($cats as $category)
							{
					?>
                          <tr>
                            <td><?php echo $k; ?></td>
                            <td><?php echo $category['category']; ?></td>
                            <td><?php echo $category['description']; ?></td>
                            <td><img src="<?php echo  ($category['image']=="")?base_url().'/assets/uploads/nophoto.png':base_url().'/assets/uploads/'.$category['image'];?>" height="50px" width="50px" /></td>
                            <td style="<?php echo ($category['status']=="published")? 'color:green':'color:red' ;?>"><?php echo $category['status']; ?></td>
                            <td><?php echo $category['added_at']; ?></td>
                            <td><?php echo $category['updated_at']; ?></td>
                            <td><div class="btn-group" wfd-id="96">
                      <button type="button" class="btn btn-danger" wfd-id="231">Split Dropdown</button>
                      <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" wfd-id="230">
                        <span class="sr-only" wfd-id="98">Action</span>
                      </button>
                      <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(119px, -2px, 0px); top: 0px; left: 0px; will-change: transform;" wfd-id="97">
                        <a class="dropdown-item" href="<?php echo base_url().'index.php/admin/list_video_by_category/'.$category['id']?>">Added Videos</a>
                        <a class="dropdown-item" href="<?php echo base_url().'index.php/admin/edit_category/'.$category['id']?>">Edit</a>
                        <div class="dropdown-divider"></div>
                        <?php
                        if($category['status']=="published"){
                        ?>
                         <a  style="color:red" class="dropdown-item" href="<?php echo base_url().'index.php/admin/unpublish_category/'.$category['id']?>">Unpublish</a>
                        <?php
                        }
                        else 
                        {?>
                         <a style="color:green" class="dropdown-item" href="<?php echo base_url().'index.php/admin/publish_category/'.$category['id']?>">Publish</a>
                         <?php
                        }?>
                        <a class="dropdown-item" href="<?php echo base_url().'index.php/admin/delete_category/'.$category['id']?>">Delete</a>
                        
                       </div>
                    </div></td>
                          </tr>
						<?php $k++;} }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </section>
        <?php $this->load->view('Videos/includes/setting');
		?>
      </div>
      <?php $this->load->view('Videos/includes/footer');?>