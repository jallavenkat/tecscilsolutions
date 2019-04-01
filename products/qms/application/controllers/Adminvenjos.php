<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminvenjos extends CI_Controller {

	public function index()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='dashboard';
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
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
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
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
				'uname' => $email,
				'upass' => SHA1($password),
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
	
	
	public function logo()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='logo';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/logo",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createLogo()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='logo';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-logo",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveLogo()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if(@$_FILES['logo']['name'] != '')
			{
				$logo=time()."_".$_FILES['logo']['name'];
			}
			else{
				$logo='';
			}
			if(@$_FILES['brandLogo']['name'] != '')
			{
				$brandLogo=time()."_".$_FILES['brandLogo']['name'];
			}
			else{
				$brandLogo='';
			}
			if(@$_FILES['favicon']['name'] != '')
			{
				$favicon=time()."_".$_FILES['favicon']['name'];
			}
			else{
				$favicon='';
			}
			$params=array(
				'logoFile' => $logo,
				'brandLogo' => $brandLogo,
				'favicon' => $favicon,
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->storeItems('logo',$params);
			if($insert > 0)
			{
				if(@$_FILES['logo']['name'] != '')
				{
					@move_uploaded_file($_FILES['logo']['tmp_name'],'uploads/files/'.$logo);
				}
				if(@$_FILES['brandLogo']['name'] != '')
				{
					@move_uploaded_file($_FILES['brandLogo']['tmp_name'],'uploads/files/'.$brandLogo);
				}
				if(@$_FILES['favicon']['name'] != '')
				{
					@move_uploaded_file($_FILES['favicon']['tmp_name'],'uploads/files/'.$favicon);
				}
				$this->session->set_userdata(array('logoSuccess' => 'Successfully added item'));
				redirect('adminvenjos/logo');
			}
			else{
				$this->session->set_userdata(array('logoFail' => 'Failed to added item'));
				redirect('adminvenjos/logo');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editLogo($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='logo';
			$data['rowid'] = $rowid;
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['item']=$this->sql->getTableRowData("logo",array("id" => $rowid));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-logo",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateLogo()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$rowid=$this->input->post('rowid');
			if(@$_FILES['logo']['name'] != '')
			{
				$logo=time()."_".$_FILES['logo']['name'];
				$removelogo=$this->sql->removeImage("logo","files",array('id' => $rowid),"logoFile");
			}
			else{
				$logo=$this->input->post('hiddenlogo');
			}
			if(@$_FILES['brandLogo']['name'] != '')
			{
				$brandLogo=time()."_".$_FILES['brandLogo']['name'];
				$removeBrandLogo=$this->sql->removeImage("logo","files",array('id' => $rowid),"brandLogo");
			}
			else{
				$brandLogo=$this->input->post('hiddenbrandLogo');
			}
			if(@$_FILES['favicon']['name'] != '')
			{
				$favicon=time()."_".$_FILES['favicon']['name'];
				
				$removefavicon=$this->sql->removeImage("logo","files",array('id' => $rowid),"favicon");
			}
			else{
				$favicon=$this->input->post('hiddenfavicon');
			}
			$params=array(
				'logoFile' => $logo,
				'brandLogo' => $brandLogo,
				'favicon' => $favicon,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->updateItems('logo',$params,array("id" => $rowid));
			if($insert > 0)
			{
				if(@$_FILES['logo']['name'] != '')
				{
					@move_uploaded_file($_FILES['logo']['tmp_name'],'uploads/files/'.$logo);
				}
				if(@$_FILES['brandLogo']['name'] != '')
				{
					@move_uploaded_file($_FILES['brandLogo']['tmp_name'],'uploads/files/'.$brandLogo);
				}
				if(@$_FILES['favicon']['name'] != '')
				{
					@move_uploaded_file($_FILES['favicon']['tmp_name'],'uploads/files/'.$favicon);
				}
				$this->session->set_userdata(array('logoSuccess' => 'Successfully update item'));
				redirect('adminvenjos/logo');
			}
			else{
				$this->session->set_userdata(array('logoFail' => 'Failed to update item'));
				redirect('adminvenjos/logo');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function company()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='company';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['company']=$this->sql->getTableAllData("company");
			$this->load->view("admin/header",$data);
			$this->load->view("admin/company",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createCompany()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='company';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-company",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function saveCompany()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'comAdrs' => $this->input->post('comAdrs'),
				'comMail' => $this->input->post('comMail'),
				'comEmail' => $this->input->post('comEmail'),
				'comMobile' => $this->input->post('comMobile'),
				'comFax' => $this->input->post('comFax'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->storeItems('company',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('companySuccess' => 'Successfully added item'));
				redirect('adminvenjos/company');
			}
			else{
				$this->session->set_userdata(array('companyFail' => 'Failed to added item'));
				redirect('adminvenjos/company');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editCompany($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['rowid'] = $rowid;
			$data['menu']='company';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['item']=$this->sql->getTableRowData("company",array("id" => $rowid));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-company",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function updateCompany()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$rowid = $this->input->post('rowid');
			$params=array(
				'comAdrs' => $this->input->post('comAdrs'),
				'comMail' => $this->input->post('comMail'),
				'comEmail' => $this->input->post('comEmail'),
				'comMobile' => $this->input->post('comMobile'),
				'comFax' => $this->input->post('comFax'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->updateItems('company',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('companySuccess' => 'Successfully update item'));
				redirect('adminvenjos/company');
			}
			else{
				$this->session->set_userdata(array('companyFail' => 'Failed to update item'));
				redirect('adminvenjos/company');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	function clean($string) 
	{
		$string = strtolower($string);
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	
	public function displays()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='displays';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("displayscreens","id","ASC");
			$sound=$this->sql->getTableAllDataOrder("displayconfigs","id","ASC");
			$json=array(
				'displays' => @$items,
				'displaysound' => @$sound
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/displays",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createDisplayItem()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='displays';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-display",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveDisplay()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if($this->input->post('displayDefault') == 1)
			{
				$up=$this->sql->updateItems("displayscreens",array('displayDefault' => 0));
			}
			$params=array(
				'displayMode' => $this->input->post('displayMode'),
				'displayWidth' => $this->input->post('displayWidth'),
				'displayHeight' => $this->input->post('displayHeight'),
				'displayDefault' => $this->input->post('displayDefault'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('displayscreens',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('dispSuccess' => 'Successfully added item'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('dispFail' => 'Failed to added item'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editDisplayItem($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='displays';
			$data['rowid'] = $rowid;
			$data['item'] = $this->sql->getTableRowData("displayscreens",array('id' => $rowid));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-display",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateDisplay()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if($this->input->post('displayDefault') == 1)
			{
				$up=$this->sql->updateItems("displayscreens",array('displayDefault' => 0));
			}
			$params=array(
				'displayMode' => $this->input->post('displayMode'),
				'displayWidth' => $this->input->post('displayWidth'),
				'displayHeight' => $this->input->post('displayHeight'),
				'displayDefault' => $this->input->post('displayDefault'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('displayscreens',$params,array('id' => $this->input->post("rowid")));
			if($insert > 0)
			{
				$this->session->set_userdata(array('dispSuccess' => 'Successfully update item'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('dispFail' => 'Failed to update item'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function makeDefaultScreen($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$up=$this->sql->updateItems("displayscreens",array('displayDefault' => 0));
			$params=array(
				'displayDefault' => 1,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('displayscreens',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('dispSuccess' => 'Successfully update item'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('dispFail' => 'Failed to update item'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function changeDisplayStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('displayscreens',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('dispSuccess' => 'Successfully change status item'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('dispFail' => 'Failed to change status item'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveDisplayConfig()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$item=$this->sql->getTableAllData("displayconfigs");
			if(@sizeOf($item) > 0)
			{
				$params=array(
					'isSound' => $this->input->post('isSound'),
					'updateDate' => @date("Y-m-d H:i:s")
				);
				$insert=$this->sql->updateItems('displayconfigs',$params,array('id' => 1));
			}
			else{
				$params=array(
					'isSound' => $this->input->post('isSound'),
					'createDate' => @date("Y-m-d H:i:s"),
					'updateDate' => @date("Y-m-d H:i:s")
				);
				$insert=$this->sql->storeItems('displayconfigs',$params);
			}
			
			if($insert > 0)
			{
				$this->session->set_userdata(array('dispsoundSuccess' => 'Successfully udpate settings'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('dispsoundSuccess' => 'Failed to  udpate settings'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function services()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='services';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("services","orderpos","ASC");
			$json=array(
				'services' => @$items
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/services",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createService()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='services';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-service",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveService()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'serviceName' => $this->input->post('serviceName'),
				'serviceCode' => $this->input->post('serviceCode'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('services',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('serSuccess' => 'Successfully added item'));
				redirect('adminvenjos/services');
			}
			else{
				$this->session->set_userdata(array('serFail' => 'Failed to added item'));
				redirect('adminvenjos/services');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editService($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='services';
			$data['rowid'] = $rowid;
			$data['item'] = $this->sql->getTableRowData("services",array('id' => $rowid));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-service",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateService()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'serviceName' => $this->input->post('serviceName'),
				'serviceCode' => $this->input->post('serviceCode'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('services',$params,array('id' => $this->input->post('rowid')));
			if($insert > 0)
			{
				$this->session->set_userdata(array('serSuccess' => 'Successfully update item'));
				redirect('adminvenjos/services');
			}
			else{
				$this->session->set_userdata(array('serFail' => 'Failed to update item'));
				redirect('adminvenjos/services');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function changeServiceStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('services',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('serSuccess' => 'Successfully change status item'));
				redirect('adminvenjos/services');
			}
			else{
				$this->session->set_userdata(array('serFail' => 'Failed to change status item'));
				redirect('adminvenjos/services');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function counters()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='counters';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("counters","id","ASC");
			$json=array(
				'counters' => @$items
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/counters",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createCounter()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='counters';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-counter",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveCounter()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'counterName' => $this->input->post('counterName'),
				'counterCode' => $this->input->post('counterCode'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('counters',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('counterSuccess' => 'Successfully added item'));
				redirect('adminvenjos/counters');
			}
			else{
				$this->session->set_userdata(array('counterFail' => 'Failed to added item'));
				redirect('adminvenjos/counters');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editCounter($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='counters';
			$data['rowid'] = $rowid;
			$data['item'] = $this->sql->getTableRowData("counters",array('id' => $rowid));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-counter",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateCounter()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'counterName' => $this->input->post('counterName'),
				'counterCode' => $this->input->post('counterCode'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('counters',$params,array('id' => $this->input->post('rowid')));
			if($insert > 0)
			{
				$this->session->set_userdata(array('counterSuccess' => 'Successfully update item'));
				redirect('adminvenjos/counters');
			}
			else{
				$this->session->set_userdata(array('counterFail' => 'Failed to update item'));
				redirect('adminvenjos/counters');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function changeCounterStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('counters',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('counterSuccess' => 'Successfully change status item'));
				redirect('adminvenjos/counters');
			}
			else{
				$this->session->set_userdata(array('counterFail' => 'Failed to change status item'));
				redirect('adminvenjos/counters');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function users()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='users';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("users","id","ASC");
			$itemsarr=array();
			if(@sizeOf($items) > 0)
			{
				for($i=0;$i<sizeOf($items);$i++)
				{
					$itemsarr[]=array(
						'id' => $items[$i]->id,
						'uname' => $items[$i]->uname,
						'upass' => $items[$i]->upass,
						'firstname' => $items[$i]->firstname,
						'lastname' => $items[$i]->lastname,
						'email' => $items[$i]->email,
						'role' => $this->sql->getTableRowData("roles",array("id"=>$items[$i]->role)),
						'status' => $items[$i]->status,
						'createDate' => $items[$i]->createDate,
						'updateDate' => $items[$i]->updateDate,
					);
				}
			}
			$json=array(
				'users' => @$itemsarr
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/users",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createUser()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='users';
			$data['roles']=$this->sql->getTableRowData("roles",array("status" => 1));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-user",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveUser()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'uname' => $this->input->post('uname'),
				'upass' => SHA1('user'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('users',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('usrSuccess' => 'Successfully added user'));
				redirect('adminvenjos/users');
			}
			else{
				$this->session->set_userdata(array('usrFail' => 'Failed to added user'));
				redirect('adminvenjos/users');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editUser($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='users';
			$data['rowid'] = $rowid;
			$data['roles']=$this->sql->getTableRowData("roles",array("status" => 1));
			$data['item'] = $this->sql->getTableRowData("users",array('id' => $rowid));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-user",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateUser()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'uname' => $this->input->post('uname'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('users',$params,array('id' => $this->input->post('rowid')));
			if($insert > 0)
			{
				$this->session->set_userdata(array('usrSuccess' => 'Successfully update user'));
				redirect('adminvenjos/users');
			}
			else{
				$this->session->set_userdata(array('usrFail' => 'Failed to update user'));
				redirect('adminvenjos/users');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function changeUserStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('users',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('usrSuccess' => 'Successfully update item'));
				redirect('adminvenjos/users');
			}
			else{
				$this->session->set_userdata(array('usrFail' => 'Failed to update item'));
				redirect('adminvenjos/users');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function roles()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='roles';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("roles","id","ASC");
			$json=array(
				'roles' => @$items
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/roles",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createRole()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='roles';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-role",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveRole()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'roleName' => $this->input->post('roleName'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('roles',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('roleSuccess' => 'Successfully added item'));
				redirect('adminvenjos/roles');
			}
			else{
				$this->session->set_userdata(array('usrFail' => 'Failed to added item'));
				redirect('adminvenjos/roles');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editRole($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='roles';
			$data['rowid'] = $rowid;
			$data['item'] = $this->sql->getTableRowData("roles",array('id' => $rowid));
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-role",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function updateRole()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'roleName' => $this->input->post('roleName'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('roles',$params,array('id' => $this->input->post('rowid')));
			if($insert > 0)
			{
				$this->session->set_userdata(array('roleSuccess' => 'Successfully update item'));
				redirect('adminvenjos/roles');
			}
			else{
				$this->session->set_userdata(array('usrFail' => 'Failed to update item'));
				redirect('adminvenjos/roles');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function changeRoleStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->updateItems('roles',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('roleSuccess' => 'Successfully update item'));
				redirect('adminvenjos/roles');
			}
			else{
				$this->session->set_userdata(array('roleFail' => 'Failed to update item'));
				redirect('adminvenjos/roles');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function assignServiceToCounter()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='serviceassigncounter';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['services']=$this->sql->getTableRowDataOrder("services",array("status" => 1),"serviceName","ASC");
			$data['counters']=$this->sql->getTableRowDataOrder("counters",array("status" => 1),"counterName","ASC");
			$items=$this->sql->getTableRowData("service_at_counter",array("status" => 1));
			$itemsarr=array();
			if(@sizeOf($items) > 0)
			{
				for($i=0;$i<sizeOf($items);$i++)
				{
					$itemsarr[]=array(
						'id' => $items[$i]->id,
						'service' => $this->sql->getTableRowData("services",array("id" => $items[$i]->serviceID)),
						'counter' => $this->sql->getTableRowData("counters",array("id" => $items[$i]->counterID)),
						'status' => $items[$i]->status,
						'createDate' => $items[$i]->createDate,
					);
				}
			}
			$json=array(
				'assigns' => $itemsarr
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/assignServiceToCounters",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function saveServiceAssigns()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'serviceID' => $this->input->post('serviceID'),
				'counterID' => $this->input->post('counterID'),
				'createDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('service_at_counter',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignSuccess' => 'Successfully assigned service'));
				redirect('adminvenjos/assignServiceToCounter');
			}
			else{
				$this->session->set_userdata(array('assignFail' => 'Failed to assigned service'));
				redirect('adminvenjos/assignServiceToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function changeAssignServiceCounterStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
			);
			$insert=$this->sql->updateItems('service_at_counter',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignSuccess' => 'Successfully update item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
			else{
				$this->session->set_userdata(array('assignSuccess' => 'Failed to update item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function deleteServiceAssignItem($rowid, $status)
	{
		/* if(@$this->session->userdata('is_logged_in') == 1)
		{
			$del=$this->sql->removeItems('service_at_counter',array('id' => $rowid));
			if($del > 0)
			{
				$this->session->set_userdata(array('assignSuccess' => 'Successfully removed item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
			else{
				$this->session->set_userdata(array('assignSuccess' => 'Failed to remove item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		} */
		
		
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
			);
			$insert=$this->sql->updateItems('service_at_counter',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignSuccess' => 'Successfully update item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
			else{
				$this->session->set_userdata(array('assignSuccess' => 'Failed to update item'));
				redirect('adminvenjos/assignServiceToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
		
	}
	
	public function assignUserToCounter()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='serviceusercounter';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['users']=$this->sql->getTableRowDataOrder("users",array("status" => 1,'role' => 3),"firstname","ASC");
			$data['counters']=$this->sql->getTableRowDataOrder("counters",array("status" => 1),"counterName","ASC");
			$items=$this->sql->getTableRowDataNoWhereArray("user_at_counter",array(1,2),"status");
			$itemsarr=array();
			if(@sizeOf($items) > 0)
			{
				for($i=0;$i<sizeOf($items);$i++)
				{
					$itemsarr[]=array(
						'id' => $items[$i]->id,
						'user' => $this->sql->getTableRowData("users",array("id" => $items[$i]->userID)),
						'counter' => $this->sql->getTableRowData("counters",array("id" => $items[$i]->counterID)),
						'status' => $items[$i]->status,
						'createDate' => $items[$i]->createDate,
					);
				}
			}
			$json=array(
				'assigns' => $itemsarr
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/assignUserToCounters",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	public function saveUserAssigns()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'userID' => $this->input->post('userID'),
				'counterID' => $this->input->post('counterID'),
				'assignDate' => @date("Y-m-d H:i:s"),
				'createDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('user_at_counter',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignUsrSuccess' => 'Successfully assigned user'));
				redirect('adminvenjos/assignUserToCounter');
			}
			else{
				$this->session->set_userdata(array('assignUsrFail' => 'Failed to assigned user'));
				redirect('adminvenjos/assignUserToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function changeAssignUserCounterStatus($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
			);
			$insert=$this->sql->updateItems('user_at_counter',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignUsrSuccess' => 'Successfully update item'));
				redirect('adminvenjos/assignUserToCounter');
			}
			else{
				$this->session->set_userdata(array('assignUsrFail' => 'Failed to update item'));
				redirect('adminvenjos/assignUserToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function deleteUserAssignItem($rowid,$status)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'status' => $status,
			);
			$insert=$this->sql->updateItems('user_at_counter',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$this->session->set_userdata(array('assignUsrSuccess' => 'Successfully removed item'));
				redirect('adminvenjos/assignUserToCounter');
			}
			else{
				$this->session->set_userdata(array('assignUsrFail' => 'Failed to remove item'));
				redirect('adminvenjos/assignUserToCounter');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function updateServiceOrderPos()
	{
		$row = $this->input->post("row");
		$set=0;
		if(@sizeOf($row) > 0)
		{
			for($i=0;$i<sizeOf($row);$i++)
			{
				$number=$this->input->post("no_".$row[$i]);
				$params=array(
					'orderpos' => $number
				);
				$update=$this->sql->updateItems("services",$params,array("id" => $row[$i]));
				if($update > 0)
				{
					$set=1;
				}
			}
		}
		if($set == 1)
		{
			$this->session->set_userdata(array(
				"serSuccess" => "Successfully update order"
			));
			redirect(base_url()."adminvenjos/services");
		}
		else{
			$this->session->set_userdata(array(
				"serFail" => "Failed to update order"
			));
			redirect(base_url()."adminvenjos/services");
		}
	}
	
	
	public function kiosksettings()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='kiosksettings';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$items=$this->sql->getTableAllDataOrder("kiosksettings","id","ASC");
			$json=array(
				'settings' => @$items
			);
			$data['json'] = @json_encode($json);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/kiosk-settings",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function saveKioskSettings()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if($this->input->post('displayDefault') == 1)
			{
				$up=$this->sql->updateItems("displayscreens",array('displayDefault' => 0));
			}
			$params=array(
				'displayMode' => $this->input->post('displayMode'),
				'displayWidth' => $this->input->post('displayWidth'),
				'displayHeight' => $this->input->post('displayHeight'),
				'displayDefault' => $this->input->post('displayDefault'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			$insert=$this->sql->storeItems('displayscreens',$params);
			if($insert > 0)
			{
				$this->session->set_userdata(array('kioskSuccess' => 'Successfully updated settings'));
				redirect('adminvenjos/displays');
			}
			else{
				$this->session->set_userdata(array('kioskFail' => 'Failed to update settings'));
				redirect('adminvenjos/displays');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
}
