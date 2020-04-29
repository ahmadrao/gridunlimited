<?php
class Admin extends CI_controller
{
	function add_category()
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$config = [
			'upload_path' => './assets/uploads',
			'allowed_types' => 'jpg|png|gif|jpeg',
			'encrypt_name' => TRUE,
		];

		$this->load->library('upload', $config);
		$this->load->model('Admin_model');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('desc', 'Description', 'required');
		//	$this->form_validation->set_rules('file','File','required');
		if ($this->form_validation->run() == false || $this->upload->do_upload('file') == false) {
			$upload_error = $this->upload->display_errors();
			$this->load->view('Videos/includes/header');
			$this->load->view('Videos/add_category', compact('upload_error'));
			$this->load->view('Videos/includes/setting');
			$this->load->view('Videos/includes/footer');
		} else {
			date_default_timezone_set('Asia/Kolkata');

			$formArray = array();
			$formArray['category'] = $this->input->post('category');
			$formArray['description'] = $this->input->post('desc');
			$formArray['added_at'] = date('jS  F Y h:i A');
			$data = $this->upload->data();
			$image = $data['file_name'];
			$formArray['image'] = $image;
			$this->Admin_model->add_category($formArray);
			$this->session->set_flashdata('success', 'Record Added Successfully');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}
	function list_category()
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$cats = $this->Admin_model->all_category();
		$data = array();
		$data['cats'] = $cats;
		$this->load->view('Videos/list_category', $data);
	}
	function edit_category($catid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$config = [
			'upload_path' => './assets/uploads',
			'allowed_types' => 'jpg|png|gif|jpeg',
			'encrypt_name' => TRUE,
		];

		$this->load->model('Admin_model');
		$cats = $this->Admin_model->get_category_by_id($catid);
		$data = array();
		$data['cats'] = $cats;
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('desc', 'Description', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('Videos/edit_category', $data);
		} else {
			$formArray = array();
			$formArray['category'] = $this->input->post('category');
			$formArray['description'] = $this->input->post('desc');
			$formArray['image'] = $this->input->post('oldpic');
			if (isset($_FILES['file'])) :
				$this->load->library('upload', $config);
				$this->upload->do_upload('file');
				$data = $this->upload->data();
				$image = $data['file_name'];
				if ($image == "") {
				} else {
					$formArray['image'] = $image;
				}
			endif;

			$this->Admin_model->update_category($catid, $formArray);
			$this->session->set_flashdata('success', 'Record Updated Successfully');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}
	function delete_category($catid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$cats = $this->Admin_model->get_category_by_id($catid);
		if (empty($cats)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_category');
		}
		$cats1 = $this->Admin_model->all_videos_by_category($catid);
		if (!empty($cats1)) {
			$this->session->set_flashdata('failure', 'Category is used in videos, First delete all videos ');
			redirect(base_url() . 'index.php/admin/list_category');
		} else {
			$this->Admin_model->delete_category($catid);
			$this->session->set_flashdata('success', 'Record Deleted successfully ');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}

	function publish_category($catid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$cat = $this->Admin_model->get_category_by_id($catid);
		if (empty($cat)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_category');
		} else {
			$formArray['status'] = "published";
			$this->Admin_model->publisher_category($catid, $formArray);
			$this->session->set_flashdata('success', 'Channel Published successfully ');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}

	function unpublish_category($catid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$cat = $this->Admin_model->get_category_by_id($catid);
		if (empty($cat)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_category');
		} else {
			$formArray['status'] = "unpublished";
			$this->Admin_model->publisher_category($catid, $formArray);
			$this->session->set_flashdata('success', 'Channel Unublished successfully ');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}



	function add_video()
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('url[]', 'Video Url', 'required');
		$this->form_validation->set_rules('title[]', 'Video Title', 'required');
		if ($this->form_validation->run() == false) {
			// echo validation_errors();
			$this->load->model('Admin_model');
			$cats = $this->Admin_model->all_category();
			$data = array();
			$data['cats'] = $cats;
			$this->load->view('Videos/includes/header');
			$this->load->view('Videos/add_video', $data);
			$this->load->view('Videos/includes/setting');
			$this->load->view('Videos/includes/footer');
		} else {
			date_default_timezone_set('Asia/Kolkata');
			$formArray = array();
			$formArray['category_id'] = $this->input->post('category');
			$formArray['added_at'] = date('jS  F Y h:i A');



			function getYoutubeDuration($vid)
			{
				//$vid - YouTube video ID. F.e. LWn28sKDWXo
				$videoDetails = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=" . $vid . "&part=contentDetails,statistics&key=AIzaSyDI4pS6VKSMqzownkXBghri-L27JltfATo");
				$VidDuration = json_decode($videoDetails, true);
				foreach ($VidDuration['items'] as $vidTime) {
					$VidDuration = $vidTime['contentDetails']['duration'];
				}
				$pattern = '/PT(\d+)M(\d+)S/';
				preg_match($pattern, $VidDuration, $matches);
				$seconds = $matches[1] * 60 + $matches[2];
				// return $seconds;
				// print_r($seconds);
				// exit();
				// // 
				return gmdate("H:i:s", $seconds);
			}
			// echo $final_check;
			// echo getYoutubeDuration($final_check);

			// print_r($this->input->post('title'));
			// exit();

			$title = $this->input->post('title');
			$video_url = $this->input->post('url')[0];
			$final_check = explode("?v=", $video_url)[1];
			$video_url = $this->input->post('url');
			$i = 0;
			foreach ($title as $x) :
				$formArray['title'] = $title[$i];
				$formArray['video_url'] = $video_url[$i];
				$video_id = explode("?v=", $video_url[$i])[1];
				$formArray['duration'] = getYoutubeDuration($video_id);
				print_r($formArray);
				// exit();
				$this->Admin_model->add_video($formArray);
				$i++;
			endforeach;
			$this->session->set_flashdata('success', 'Record Added Successfully');
			redirect(base_url() . 'index.php/admin/list_video');
		}
	}

	function list_video()
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$videos = $this->Admin_model->all_videos();
		$data = array();
		$data['videos'] = $videos;
		$this->load->view('Videos/list_video', $data);
	}

	function list_video_by_category($id)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$videos = $this->Admin_model->all_videos_by_category($id);
		$data = array();
		$data['videos'] = $videos;
		$this->load->view('Videos/list_video_by_channel', $data);
	}



	function edit_video($vid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$video = $this->Admin_model->get_video_by_id($vid);
		$data = array();
		$data['video'] = $video;
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('url', 'Video Url', 'required');
		$this->form_validation->set_rules('title', 'Video Title', 'required');
		if ($this->form_validation->run() == false) {
			//$this->load->view('Videos/edit_video',$data);
			$cats = $this->Admin_model->all_category();
			$data['cats'] = $cats;
			$this->load->view('Videos/edit_video', $data);
		} else {
			$formArray = array();
			$formArray['category'] = $this->input->post('category');
			$formArray['title'] = $this->input->post('title');
			$formArray['video_url'] = $this->input->post('url');
			$this->Admin_model->update_video($vid, $formArray);
			$this->session->set_flashdata('success', 'Record Updated Successfully');
			redirect(base_url() . 'index.php/admin/list_video');
		}
	}
	function delete_video($vid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$video = $this->Admin_model->get_video_by_id($vid);
		if (empty($video)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_video');
		} else {
			$this->Admin_model->delete_video($vid);
			$this->session->set_flashdata('success', 'Record Deleted successfully ');
			redirect(base_url() . 'index.php/admin/list_video');
		}
	}


	function publish_video($vid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$video = $this->Admin_model->get_video_by_id($vid);
		if (empty($video)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_video');
		} else {
			$formArray['status'] = "published";
			$this->Admin_model->publisher_video($vid, $formArray);
			$this->session->set_flashdata('success', 'Video Published successfully ');
			redirect(base_url() . 'index.php/admin/list_video');
		}
	}

	function unpublish_video($vid)
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$video = $this->Admin_model->get_video_by_id($vid);
		if (empty($video)) {
			$this->session->set_flashdata('failure', 'Record Not found in database');
			redirect(base_url() . 'index.php/admin/list_video');
		} else {
			$formArray['status'] = "unpublished";
			$this->Admin_model->publisher_video($vid, $formArray);
			$this->session->set_flashdata('success', 'Video Unublished successfully ');
			redirect(base_url() . 'index.php/admin/list_video');
		}
	}







	function login()
	{
		$this->load->model('Admin_model');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('Admin/login');
		} else {
			$formArray = array();
			$formArray['email'] = $this->input->post('email');
			$formArray['pass'] = $this->input->post('password');
			$admin = $this->Admin_model->get_admin_by_email($formArray['email']);
			if (empty($admin)) {
				$this->session->set_flashdata('failure1', 'Record Not found in database');
				redirect(base_url() . 'index.php/admin/login');
			}
			if ($admin['password'] == $formArray['pass']) {
				$this->session->set_userdata('admin', $formArray['email']);
				redirect(base_url() . 'index.php/admin/list_category');
			} else {
				$this->session->set_flashdata('failure', 'Password is incorrect');
				redirect(base_url() . 'index.php/admin/login');
			}
		}
	}
	function logout()
	{
		unset($_SESSION['failure'],
		$_SESSION['failure1'],
		$_SESSION['success'],
		$_SESSION['admin']);
		redirect(base_url() . 'index.php/admin/login');
	}
	function change_password()
	{
		$admin = $this->session->userdata('admin');
		if ($admin == "") {
			$this->session->set_flashdata('login', 'You have to login First');
			redirect(base_url() . 'index.php/admin/login');
		}
		$this->load->model('Admin_model');
		$this->form_validation->set_rules('oldpass', 'Old Password', 'required');
		$this->form_validation->set_rules('newpass', 'New Password', 'required');
		$this->form_validation->set_rules('cnewpass', 'Confirm New Password', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('Admin/change_pass');
		} else {
			$oldpass = $this->input->post('oldpass');
			$formArray = array();

			$formArray['password'] = $this->input->post('newpass');

			$adminp = $this->Admin_model->check_pass_by_email($admin, $oldpass);
			if (empty($adminp)) {
				$this->session->set_flashdata('failure', 'Old Password not mathced');
				redirect(base_url() . 'index.php/admin/change_password');
			}

			$this->Admin_model->update_pass($admin, $formArray);
			$this->session->set_flashdata('successp', 'Password Updated Successfully');
			redirect(base_url() . 'index.php/admin/list_category');
		}
	}
}
