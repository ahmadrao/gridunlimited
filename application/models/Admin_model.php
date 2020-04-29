<?php
class Admin_model extends CI_model {
	function add_category($cat)
	{
		$this->db->insert('category',$cat);
	}
	function all_category()
	{
		return $cats=$this->db->get('category')->result_array();
	}
	function get_category_by_id($catid)
	{
		$this->db->where('id',$catid);
		return $cat=$this->db->get('category')->row_array();
	}
	function update_category($catid,$formArray)
	{
		$this->db->where('id',$catid);
		$this->db->update('category',$formArray);
	}
	function publisher_category($catid,$formArray)
	{
		$this->db->where('id',$catid);
		$this->db->update('category',$formArray);
	}
	function delete_category($catid)
	{
		$this->db->where('id',$catid);
		$this->db->delete('category');
	}
	function add_video($video)
	{
		$this->db->insert('videos',$video);
	}
	function all_videos()
	{
	    $select = 'videos.*,category.category ,category.status as statusc';
		return $videos=$this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->result_array();
	}
		function all_videos_by_category($id)
	{
	    $select = 'videos.*,category.category,category.status as statusc';
	     $this->db->where('category_id',$id);
	     
		 return $videos=$this->db->select($select)->join('category', 'category.id = videos.category_id')->get('videos')->result_array();
	
	}
// 	function all_videos_by_category($catid)
// 	{
// 	    $cat = $this->db->select('category')->where('id', $catid)->get('category')->row();
// 	    $this->db->where('category',$cat->category);
// 		return $videos=$this->db->get('videos')->result_array();
// 	}
	function get_video_by_id($vid)
	{
		$this->db->where('id',$vid);
		return $video=$this->db->get('videos')->row_array();
	}
	function update_video($vid,$formArray)
	{
		$this->db->where('id',$vid);
		$this->db->update('videos',$formArray);
	}
	function delete_video($vid)
	{
		$this->db->where('id',$vid);
		$this->db->delete('videos');
	}
	
	
	function publisher_video($vid,$formArray)
	{
		$this->db->where('id',$vid);
		$this->db->update('videos',$formArray);
	}
	
	function get_admin_by_email($email)
	{
		$this->db->where('email',$email);
		return $video=$this->db->get('admin')->row_array();
	}
	function check_pass_by_email($email,$oldpass)
	{
	    $where = "email='$email' AND password='$oldpass'";
		$this->db->where($where);
		return $video=$this->db->get('admin')->row_array();
	}
		function update_pass($admin,$formArray)
	{
		$this->db->where('email',$admin);
		$this->db->update('admin',$formArray);
	}
}
 ?>