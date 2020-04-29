<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function indexes()
	{
		$this->load->view('front/home');
	}

	public function index($vidid = "")
	{

		// print_r($vidid);
		// exit();
		$this->load->model('Video_model');
		$cats = $this->Video_model->all_category();

		$data = array();
		$data['vid_cat'] = $vidid;



		// print_r($vidid);
		// exit();


		if ($vidid == "") {
			$cats = $this->Video_model->all_category();
			$data['vid_cat'] = "";
			// print_r($cats);
			// exit();
		} else {
			$cats = $this->Video_model->all_categories($vidid);
			$data['vid_cat'] = $vidid;
			// $data['vid_cat'] = $this->Video_model->get_video_category($vidid);
			// print_r($cats);
			// print_r($data);
			// exit();
		}
		$data['cats'] = $cats;

		// print_r($data);
		// exit();
		//echo $cats;
		//d//ir();
		$this->load->view('front/livetv', $data);
	}

	public function end_video($id)
	{
		$this->load->model('Video_model');
		echo $this->Video_model->end_video($id);
	}

	public function start_video($id)
	{
		$this->load->model('Video_model');
		echo $this->Video_model->start_video($id);
	}
}
