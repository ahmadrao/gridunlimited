<?php
class Video_model extends CI_model
{

	function all_category()
	{
		$this->db->where('status', 'published');
		return $cats = $this->db->get('category')->result_array();
	}
	function all_categories($vidid)
	{
		//$this->db->where('status','published');
		$where0 = "id ='$vidid' AND status='published'";
		$this->db->where($where0);
		$videos0 =  $cats = $this->db->get('videos')->result_array();
		$cid = $videos0[0]["category_id"];
		$where1 = "id ='$cid' AND status='published'";
		$this->db->where($where1);
		$videos1 =  $cats = $this->db->get('category')->result_array();
		$where2 = "id !='$cid' AND status='published'";
		$this->db->where($where2);
		$videos2 =  $cats = $this->db->get('category')->result_array();
		$videos = array_merge($videos1, $videos2);

		return $videos;
	}

	function all_videos_by_category($id)
	{
		$select = 'videos.*,category.category,category.status as statusc';
		$where = "category_id='$id' AND videos.status='published'";
		$this->db->where($where);

		return $videos = $this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->result_array();
	}

	function video_by_category($cid = "")
	{
		if ($cid == "")
			$cid = $this->db->get('category')->where('status', 'published')->row()['id'];

		$select = 'videos.*,category.category,category.status as statusc';
		$where = "category_id='$cid' AND videos.status='published' AND ended_at=''";
		$this->db->where($where);

		return $videos = $this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->result_array();
	}

	function isvideos($id)
	{
		$select = 'videos.*,category.category,category.status as statusc';

		$where = "category_id='$id' AND videos.status='published'";
		$this->db->where($where);

		return $videos = $this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->num_rows();
	}


	function new_videos_by_category($vid = "")
	{
		$select = 'videos.*,category.category,category.status as statusc';
		if ($vid != "")
			$this->db->where('videos.id', $vid);

		$this->db->where('videos.status', 'published');
		//$this->db->where('videos.ended_at','');
		return $videos = $this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->result_array();
		//echo $this->db->last_query();
		//exit;
	}

	function get_videos()
	{
		$this->db->where('status', 'published');
		return $cats = $this->db->get('category')->limit(2)->result_array();
	}

	function start_video($id)
	{
		$set = array('started_at' => date('Y-m-d H:i:s'));
		return $cats = $this->db->where('started_at', '')->where('id', $id)->update('videos', $set);
	}

	function end_video($id)
	{
		$set = array('ended_at' => date('Y-m-d H:i:s'));
		return $cats = $this->db->where('started_at != ', '')->where('id', $id)->update('videos', $set);
	}

	public function get_video_category($vidid)
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('id', $vidid);
		$video = $this->db->get();
		return $video->result_array()[0]['category_id'];
	}

	public function next_video_by_category($id)
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('id', $id);
		$video_category_id = $this->db->get()->result_array()[0]['category_id'];
		$this->db->select("*");
		$this->db->from('videos');

		$this->db->where('videos.id >', $id);
		$this->db->where('category_id', $video_category_id);
		$result = $this->db->get()->result_array()[0];
		if ($result) {
			$result = $result;
		} else {
			$this->db->select("*");
			$this->db->from('videos');

			$this->db->where('videos.id <', $id);
			$this->db->where('category_id', $video_category_id);
			$result = $this->db->get()->result_array()[0];
			if ($result) {
				$result = $result;
			} else {
				$this->db->select('*');
				$this->db->from('videos');
				$this->db->where('id', $id);
				$result = $this->db->get()->result_array()[0];
			}
		}
		// print_r($result);
		// exit();
		return $result;
	}
}
