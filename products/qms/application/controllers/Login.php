<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Login extends CI_Controller {
	public function index() {
		$data["menu"] = "home";
		$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
		$data['services']=$this->sql->getTableRowDataOrder("services",array("status" => 1),"orderpos","ASC");
		if(@$this->session->userdata('is_logged_in') != 1)
		{
			$this->load->view("header",$data);
			$this->load->view("login/index",$data);
			$this->load->view("footer",$data);
		}
		else
		{
			$user = $this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			if(@sizeOf($user) > 0)
			{
				if(@$user[0]->role == 3)
				{
					redirect("teller");
				}
			}
		}
	}
	
	public function verifyMe()
	{
		$params=array(
			'uname' => $this->input->post('username'),
			'upass' => SHA1($this->input->post('password'))
		);
		$user = $this->sql->getTableRowData("users",$params);
		//print_r($user);
		if(@sizeOf($user) > 0)
		{
			$variables = array(
				'userid' => @$user[0]->id,
				'username' => @$user[0]->username,
				'role' => @$user[0]->role,
				'email' => @$user[0]->email,
				'is_logged_in' => 1
			);
			$this->session->set_userdata($variables);
			if(@$user[0]->role == 3)
			{
				redirect("teller");
			}
		}
		else{
			$this->session->set_userdata(array('logFail' => 'Invlaid Username/Password'));
			redirect('teller');
		}
	}
	
	public function logout() {
		$sessons=array(
			'userid' => '',
			'username' => '',
			'role' => '',
			'email' => '',
			'is_logged_in' => 0
		);
		$this->session->set_userdata($sessons);
		$this->session->unset_userdata($sessons);
		$this->session->sess_destroy();
		
		redirect(base_url('login'));
		
	}
}
