<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvenjos extends CI_Controller {

	public function index()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='dashboard';
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/dashboard",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function login()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			redirect('adminvenjos');
		}
		else
		{
			$data['menu']='login';
			$this->load->view("admin/login",$data);
			
		}
	}
	public function verifyUser()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			redirect('adminvenjos');
		}
		else
		{
			extract($_REQUEST);
			$email=$email1;
			$password=$password1;
			$params=array(
				'email' => $email,
				'upassword' => SHA1($password),
			);
			$check=$this->sql->getTableRowData("users",$params);
			if(@sizeOf($check) > 0)
			{
				$this->session->set_userdata(array('userid' => $check[0]->id,'is_logged_in' => 1));
				echo 1;
			}
			else{
				$this->session->set_userdata(array('lFail' => 'Invalid Email ID / Password'));
				echo 'Invalid';
			}
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('is_logged_in');
		$this->session->sess_destroy();
		redirect('adminvenjos');
		
	}
}
