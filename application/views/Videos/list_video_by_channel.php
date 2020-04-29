<?php $this->load->view('Videos/includes/header');?>
 <!-- Main Content -->
 <title>Admin - Manage Videos</title>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="display: inline;float: left;">Manage Videos</h4>
                    <a href="<?php echo base_url().'index.php/admin/add_video'?>"><button style="display: inline;float: right;" class="btn btn-primary float-right">Add Video</button></a>
					<?php
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
                            <th>Video Title</th>
                            <th>Video</th>
                            <th>Category Status</th>
                            <th>Video Status</th>
                            <th>Added At</th>
                            <th>Last Updatd At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php if(!empty($videos))
						{
							$k=1;
							foreach($videos as $video)
							{
							    $link = $video['video_url'];
							    $video_id = explode("?v=", $link);
                                $video_id = $video_id[1];
					?>
                          <tr>
                            <td><?php echo $k; ?></td>
                            <td><?php echo $video['category']; ?></td>
                            <td><?php echo $video['title']; ?></td>
                           
                            <td >
							<iframe width="150" height="80" src="https://www.youtube.com/embed/<?php echo $video_id; ?>?rel=0&showinfo=0&color=white&iv_load_policy=3<?php //echo $video['video_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							
							</td>
							<td style="<?php echo ($video['statusc']=="published")? 'color:green':'color:red' ;?>"><?php echo $video['statusc']; ?></td>
						    <td style="<?php echo ($video['status']=="published")? 'color:green':'color:red' ;?>"><?php echo $video['status']; ?></td>
                            <td><?php echo $video['added_at']; ?></td>
                            <td><?php echo $video['updated_at']; ?></td>
                            <td><div class="btn-group" wfd-id="96">
                      <button type="button" class="btn btn-danger" wfd-id="231">Split Dropdown</button>
                      <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" wfd-id="230">
                        <span class="sr-only" wfd-id="98">Action</span>
                      </button>
                      <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(119px, -2px, 0px); top: 0px; left: 0px; will-change: transform;" wfd-id="97">
                        <a class="dropdown-item" href="<?php echo base_url().'index.php/admin/edit_video/'.$video['id']?>">Edit</a>
                        <div class="dropdown-divider"></div>
                         <?php
                        if($video['status']=="published"){
                        ?>
                         <a  style="color:red" class="dropdown-item" href="<?php echo base_url().'index.php/admin/unpublish_video/'.$video['id']?>">Unpublish</a>
                        <?php
                        }
                        else 
                        {?>
                         <a style="color:green" class="dropdown-item" href="<?php echo base_url().'index.php/admin/publish_video/'.$video['id']?>">Publish</a>
                         <?php
                        }?>
                        <a class="dropdown-item" href="<?php echo base_url().'index.php/admin/delete_video/'.$video['id']?>">Delete</a>
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