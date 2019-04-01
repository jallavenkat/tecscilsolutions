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
				$this->session->set_userdata(array('logoFaile' => 'Failed to added item'));
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
	
	public function socials()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='socials';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['items']=$this->sql->getTableAllData("socials");
			$this->load->view("admin/header",$data);
			$this->load->view("admin/socials",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createSocial()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='socials';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-social",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function saveSocial()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if(@$_FILES['socIcon']['name'] != '')
			{
				$socIcon=time().'_'.$_FILES['socIcon']['name'];
			}
			else{
				$socIcon='';
			}
			$params=array(
				'socName' => $this->input->post('socName'),
				'socIcon' => $socIcon,
				'socURL' => $this->input->post('socURL'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->storeItems('socials',$params);
			if($insert > 0)
			{
				if(@$_FILES['socIcon']['name'] != '')
				{
					@move_uploaded_file($_FILES['socIcon']['tmp_name'],'uploads/files/'.@$socIcon);
				}
				$this->session->set_userdata(array('socSuccess' => 'Successfully added item'));
				redirect('adminvenjos/socials');
			}
			else{
				$this->session->set_userdata(array('socFail' => 'Failed to added item'));
				redirect('adminvenjos/socials');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editSocial($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['rowid'] = $rowid;
			$data['menu']='socials';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['item']=$this->sql->getTableRowData("socials",array("id" => $rowid));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-social",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function updateSocial()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$rowid = $this->input->post('rowid');
			if(@$_FILES['socIcon']['name'] != '')
			{
				$socIcon=time().'_'.$_FILES['socIcon']['name'];
				$remove=$this->sql->removeImage("socials","files",array('id' => $rowid),"socIcon");
			}
			else{
				$socIcon=$this->input->post('hiddensocIcon');
			}
			$params=array(
				'socName' => $this->input->post('socName'),
				'socIcon' => $socIcon,
				'socURL' => $this->input->post('socURL'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->updateItems('socials',$params,array('id' => $rowid));
			if($insert > 0)
			{
				if(@$_FILES['socIcon']['name'] != '')
				{
					@move_uploaded_file($_FILES['socIcon']['tmp_name'],'uploads/files/'.@$socIcon);
				}
				$this->session->set_userdata(array('socSuccess' => 'Successfully update item'));
				redirect('adminvenjos/socials');
			}
			else{
				$this->session->set_userdata(array('socFail' => 'Failed to update item'));
				redirect('adminvenjos/socials');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function menus()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='menus';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['items']=$this->sql->getTableAllData("menus");
			$this->load->view("admin/header",$data);
			$this->load->view("admin/menus",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createMenu()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='menus';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-menu",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function saveMenu()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$params=array(
				'menuTitle' => $this->input->post('menuTitle'),
				'menuAlias' => $this->clean($this->input->post('menuTitle')),
				'menuSeoCustom' => @strtolower($this->clean($this->input->post('menuSeoCustom'))),
				'isHome' => $this->input->post('isHome'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->storeItems('menus',$params);
			if($insert > 0)
			{
				$mn=$this->clean(trim($this->input->post('menuTitle')));
				$mns=@explode("-",$mn);
				$controllername='';
				$mtxt='';
				if(@sizeOf($mns) > 0)
				{
					for($m=0;$m<sizeOf($mns);$m++)
					{
						if($m == 0)
						{
							$mtxt .= $mns[$m];
							$controllername = @ucfirst($mns[$m]);
						}
						else{
							$mtxt .= @ucfirst($mns[$m]);
						}
						
					}
				}
				if($this->input->post('isHome') == 1)
				{
					$urlapth=base_url();
				}
				else{
					$urlapth='index.php/'.$mtxt.'/index/'.$insert;
				}
				$prms=array(
					'menuSeoURL' => $urlapth
				);
				$up=$this->sql->updateItems("menus",$prms,array('id' => $insert));
				
				$apath=FCPATH;
				$path_to_file=$apath."application/config/routes.php";
				$handle = fopen($path_to_file, 'w');
				ftruncate($handle, 0);
				$menus=$this->sql->getTableRowDataOrder("menus",array("status" => 1),"id","ASC");
				
				$str='<?php';
				$str .="\n".'defined("BASEPATH") OR exit("No direct script access allowed");';
				$str .= "\n".'&#36;route["default_controller"] = "home";';
				$str .= "\n".'&#36;route["404_override"] = "";';
				$str .= "\n".'&#36;route["translate_uri_dashes"] = FALSE;';
				
				if(@sizeOf($menus) > 0)
				{
					for($s=0;$s<sizeOf($menus);$s++)
					{
						if(@trim(@trim($menus[$s]->menuSeoCustom) != ''))
						{
							if($menus[$s]->menuSeoURL == '/')
							{
								$str .= "\n"."&#36;route['".@$this->clean($menus[$s]->menuSeoCustom)."']='".base_url()."';";
							}
							else{
								$str .= "\n"."&#36;route['".@$this->clean($menus[$s]->menuSeoCustom)."']='".$menus[$s]->menuSeoURL."';";
							}
						}
					}
				}
				if(@$str != '')
				{
					$file_contents = str_replace("&#36;","$",$str);
					$data = $file_contents;
					fwrite($handle, $data);
				}
				
				if(@$controllername != '')
				{
					$apath1=FCPATH;
					$path_to_file1=$apath1."application/controllers/".@$controllername.".php";
					$handle1 = fopen($path_to_file1, 'w');
					ftruncate($handle1, 0);
					$str1='<?php';
					$str1 .="\n".'defined("BASEPATH") OR exit("No direct script access allowed");';
					$str1 .= "\n".'class '.@ucfirst($controllername).' extends CI_Controller {';
					$str1 .= "\n".'public function index() {';
					$str1 .= "\n".'&#36;data["menu"] = "'.@strtolower($controllername).'";';
					$str1 .= "\n".'&#36;this->load->view("header",&#36;data);';
					$str1 .= "\n".'&#36;this->load->view("index",&#36;data);';
					$str1 .= "\n".'&#36;this->load->view("footer",&#36;data);';
					$str1 .= "\n".'}';
					$str1 .= "\n".'}';
					
					if(@$str1 != '')
					{
						$file_contents1 = str_replace("&#36;","$",$str1);
						$data1 = $file_contents1;
						fwrite($handle1, $data1);
					}
				}
				
				$this->session->set_userdata(array('menuSuccess' => 'Successfully added item'));
				redirect('adminvenjos/menus');
			}
			else{
				$this->session->set_userdata(array('menuFail' => 'Failed to added item'));
				redirect('adminvenjos/menus');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editMenu($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['rowid'] = $rowid;
			$data['menu']='menus';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['item']=$this->sql->getTableRowData("menus",array("id" => $rowid));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-menu",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function updateMenu()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$rowid = $this->input->post('rowid');
			$params=array(
				'menuTitle' => $this->input->post('menuTitle'),
				'menuAlias' => $this->clean($this->input->post('menuTitle')),
				'menuSeoCustom' => $this->clean($this->input->post('menuSeoCustom')),
				'isHome' => $this->input->post('isHome'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->updateItems('menus',$params,array('id' => $rowid));
			if($insert > 0)
			{
				$mn=$this->clean(trim($this->input->post('menuTitle')));
				$mns=@explode("-",$mn);
				$mtxt='';
				if(@sizeOf($mns) > 0)
				{
					for($m=0;$m<sizeOf($mns);$m++)
					{
						if($m == 0)
						{
							$mtxt .= $mns[$m];
						}
						else{
							$mtxt .= @ucfirst($mns[$m]);
						}
						
					}
				}
				
				if($this->input->post('isHome') == 1)
				{
					$urlapth=base_url();
				}
				else{
					$urlapth='index.php/'.$mtxt.'/index/'.$rowid;
				}
				$prms=array(
					'menuSeoURL' => $urlapth
				);
				$up=$this->sql->updateItems("menus",$prms,array('id' => $rowid));
				
				$apath=FCPATH;
				$path_to_file=$apath."application/config/routes.php";
				$handle = fopen($path_to_file, 'w');
				ftruncate($handle, 0);
				$menus=$this->sql->getTableRowDataOrder("menus",array("status" => 1),"id","ASC");
				
				$str='<?php';
				$str .="\n".'defined("BASEPATH") OR exit("No direct script access allowed");';
				$str .= "\n".'&#36;route["default_controller"] = "home";';
				$str .= "\n".'&#36;route["404_override"] = "";';
				$str .= "\n".'&#36;route["translate_uri_dashes"] = FALSE;';
				
				if(@sizeOf($menus) > 0)
				{
					for($s=0;$s<sizeOf($menus);$s++)
					{
						if(@trim(@trim($menus[$s]->menuSeoCustom) != ''))
						{
							if($menus[$s]->menuSeoURL == '/')
							{
								$str .= "\n"."&#36;route['".@$this->clean($menus[$s]->menuSeoCustom)."']='".base_url()."';";
							}
							else{
								$str .= "\n"."&#36;route['".@$this->clean($menus[$s]->menuSeoCustom)."']='".$menus[$s]->menuSeoURL."';";
							}
						}
					}
				}
				if(@$str != '')
				{
					$file_contents = str_replace("&#36;","$",$str);
					$data = $file_contents;
					fwrite($handle, $data);
				}
				$this->session->set_userdata(array('menuSuccess' => 'Successfully update item'));
				redirect('adminvenjos/menus');
			}
			else{
				$this->session->set_userdata(array('menuFail' => 'Failed to update item'));
				redirect('adminvenjos/menus');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function pages()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='pages';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$pages=$this->sql->getTableAllData("pages");
			$items=array();
			if(@sizeOf($pages) > 0)
			{
				for($i=0;$i<sizeOf($pages);$i++)
				{
					$items[]=array(
						'id' => $pages[$i]->id,
						'menu' => $this->sql->getTableRowData("menus",array("id" => $pages[$i]->menuid)),
						'pTitle' => $pages[$i]->pTitle,
						'pShortDesc' => $pages[$i]->pShortDesc,
						'pBanner' => $pages[$i]->pBanner,
						'metaTitle' => $pages[$i]->metaTitle,
						'metaDesc' => $pages[$i]->metaDesc,
						'metaKeys' => $pages[$i]->metaKeys,
						'createDate' => $pages[$i]->createDate,
						'updateDate' => $pages[$i]->updateDate
					);
				}
			}
			$data['items'] = @json_encode($items);
			$this->load->view("admin/header",$data);
			$this->load->view("admin/pages",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function createPage()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['menu']='pages';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['pages']=$this->sql->getTableRowData("pages",array("status" => 1));
			$data['menus']=$this->sql->getTableRowDataOrder("menus",array("status" => 1),"orderpos","ASC");
			$this->load->view("admin/header",$data);
			$this->load->view("admin/create-page",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function savePage()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			if(@$_FILES['pBanner']['name'] != '')
			{
				$pBanner=time()."_".$_FILES['pBanner']['name'];
			}
			else{
				$pBanner='';
			}
			$params=array(
				'menuid' => $this->input->post('menuid'),
				'pTitle' => $this->input->post('pTitle'),
				'pShortDesc' => $this->input->post('pShortDesc'),
				'pBanner' => $pBanner,
				'metaTitle' => @$this->input->post('metaTitle'),
				'metaDesc' => @$this->input->post('metaDesc'),
				'metaKeys' => @$this->input->post('metaKeys'),
				'createDate' => @date("Y-m-d H:i:s"),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->storeItems('pages',$params);
			if($insert > 0)
			{
				if(@$_FILES['pBanner']['name'] != '')
				{
					@move_uploaded_file($_FILES['pBanner']['tmp_name'],"uploads/files/".$pBanner);
				}
				$this->session->set_userdata(array('pageSuccess' => 'Successfully added item'));
				redirect('adminvenjos/pages');
			}
			else{
				$this->session->set_userdata(array('pageFail' => 'Failed to added item'));
				redirect('adminvenjos/pages');
			}
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	public function editPage($rowid)
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data['rowid'] = $rowid;
			$data['menu']='pages';
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$data['adminuser']=$this->sql->getTableRowData("users",array("id" => $this->session->userdata('userid')));
			$data['menus']=$this->sql->getTableRowDataOrder("menus",array("status" => 1),"orderpos","ASC");
			$data['item']=$this->sql->getTableRowData("pages",array("id" => $rowid));
			$this->load->view("admin/header",$data);
			$this->load->view("admin/edit-page",$data);
			$this->load->view("admin/footer",$data);
		}
		else
		{
			redirect('adminvenjos/login');
		}
	}
	
	
	public function updatePage()
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$rowid = $this->input->post('rowid');
			if(@$_FILES['pBanner']['name'] != '')
			{
				$pBanner=time()."_".$_FILES['pBanner']['name'];
			}
			else{
				$pBanner=$this->input->post('hiddenpBanner');
			}
			$params=array(
				'menuid' => $this->input->post('menuid'),
				'pTitle' => $this->input->post('pTitle'),
				'pShortDesc' => $this->input->post('pShortDesc'),
				'pBanner' => $pBanner,
				'metaTitle' => @$this->input->post('metaTitle'),
				'metaDesc' => @$this->input->post('metaDesc'),
				'metaKeys' => @$this->input->post('metaKeys'),
				'updateDate' => @date("Y-m-d H:i:s")
			);
			
			$insert=$this->sql->updateItems('pages',$params,array('id' => $rowid));
			if($insert > 0)
			{
				if(@$_FILES['pBanner']['name'] != '')
				{
					@move_uploaded_file($_FILES['pBanner']['tmp_name'],"uploads/files/".$pBanner);
				}
				$this->session->set_userdata(array('pageSuccess' => 'Successfully update item'));
				redirect('adminvenjos/pages');
			}
			else{
				$this->session->set_userdata(array('pageFail' => 'Failed to update item'));
				redirect('adminvenjos/pages');
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
}
