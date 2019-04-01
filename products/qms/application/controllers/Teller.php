<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Teller extends CI_Controller {
	public function index() {
		$data["menu"] = "home";
		$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
		$user=$this->sql->getTableRowData("users",array("status" => 1,'id' => @$this->session->userdata('userid')));
		$data['user']=$user;
		$userCounter=$this->sql->getTableRowData("user_at_counter",array("status" => 1,'userid' => @$this->session->userdata('userid')));
		if(@sizeOf($userCounter) > 0)
		{
			$userService=$this->sql->getTableRowData("service_at_counter",array("status" => 1,'counterID' => @$userCounter[0]->counterID));
			$service=$this->sql->getTableRowData("services",array("status" => 1,'id' => @$userService[0]->serviceID));
		}
		else{
			$userService=array();
			$service=array();
		}
		$data['services']=$this->sql->getTableRowDataOrder("services",array("status" => 1),"orderpos","ASC");
		$data['servicetokens']=$this->sql->getTableRowDataOrder("tokens_at_services",array("DATE(tokenStoreTime)" => @date("Y-m-d"),"tokenStatus" => 0,"serviceID" => @$service[0]->id),"tokenStoreTime","ASC");
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$this->load->view("header",$data);
			$this->load->view("teller/index",$data);
			$this->load->view("footer",$data);
		}
		else
		{
			redirect('login');
		}
		
	}
	public function process() 
	{
		if(@$this->session->userdata('is_logged_in') == 1)
		{
			$data["menu"] = "home";
			$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
			$user=$this->sql->getTableRowData("users",array("status" => 1,'id' => @$this->session->userdata('userid')));
			$data['user']=$user;
			$userCounter=$this->sql->getTableRowData("user_at_counter",array("status" => 1,'userid' => @$this->session->userdata('userid')));
			if(@sizeOf($userCounter) > 0)
			{
				$userService=$this->sql->getTableRowData("service_at_counter",array("status" => 1,'counterID' => @$userCounter[0]->counterID));
				$service=$this->sql->getTableRowData("services",array("status" => 1,'id' => @$userService[0]->serviceID));
			}
			else{
				$userService=array();
				$service=array();
			}
			$data['myservice'] = $service;
			$data['mycounter'] = $userCounter;
			if(@sizeOf($service) > 0)
			{
				$tokens=$this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n','s','m'),"tokenStatus","tokenStoreTime","ASC");
				
				$serves=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d"),'tellerID' => @$this->session->userdata('userid'),'counterID' => @$userCounter[0]->counterID),array('s'),"tokenStatus","tokenStoreTime","ASC",0,1);
				
				$totaltokens=$this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC");
				
			}
			else{
				$tokens=array();
				$serves = array();
				$totaltokens = array();
			}
			
			//print_r($tokens);
			$data['tokens']=$tokens;
			$data['serveTokens']=$serves;
			$data['totaltokens']=$totaltokens;
			
			$services=$this->sql->getTableRowDataOrder("services",array("status" => 1),"serviceName","ASC");
			$servicesarr=array();
			if(@sizeOf($services) > 0)
			{
				for($s=0;$s<sizeOf($services);$s++)
				{
					$servicesarr[]=array(
						'id' => $services[$s]->id,
						'serviceName' => $services[$s]->serviceName,
						'tokens' => $this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$services[$s]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n','s'),"tokenStatus","tokenStoreTime","ASC"),
						'missedtokens' => $this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$services[$s]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('m'),"tokenStatus","tokenStoreTime","ASC"),
						'multitokens' => $this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$services[$s]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n','s'),"tokenStatus","tokenStoreTime","ASC")
					);
				}
			}
			$data['counterlist'] = @json_encode($servicesarr);
			$this->load->view("header",$data);
			$this->load->view("teller/teller",$data);
		}
		else
		{
			redirect('login');
		}
		
	}
	public function nextToken() 
	{
		$user=$this->sql->getTableRowData("users",array("status" => 1,'id' => @$this->session->userdata('userid')));
		$userCounter=$this->sql->getTableRowData("user_at_counter",array("status" => 1,'userid' => @$this->session->userdata('userid')));
		if(@sizeOf($userCounter) > 0)
		{
			$userService=$this->sql->getTableRowData("service_at_counter",array("status" => 1,'counterID' => @$userCounter[0]->counterID));
			$service=$this->sql->getTableRowData("services",array("status" => 1,'id' => @$userService[0]->serviceID));
			
			
		}
		else{
			$userService=array();
			$service=array();
		}
		$tokens=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC",0,1);
		
		$serves=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d"),'tellerID' => @$this->session->userdata('userid'),'counterID' => @$userCounter[0]->counterID),array('s'),"tokenStatus","tokenStoreTime","ASC",0,1);
		
		
		$paramsupdate=array(
			'tokenClosedTime' => @date("Y-m-d H:i:s"),
			'tokenStatus' => 'c',
			'isBuzz' => 0
		);
		$upd = $this->sql->updateItems("tokens",$paramsupdate,array('tokenStatus' => 's','tellerID' => @$this->session->userdata('userid'),'counterID' => @$userCounter[0]->counterID));
		
		if(@sizeOf($tokens) > 0)
		{
			$nextToken = @$tokens[0]->tokenNumber;
			$params=array(
				'tellerID' => @$this->session->userdata('userid'),
				'counterID' => @$userCounter[0]->counterID,
				'tokenVisitTime' => @date("Y-m-d H:i:s"),
				'tokenStatus' => 's',
				'isBuzz' => 1
			);
			$upd = $this->sql->updateItems("tokens",$params,array('tokenNumber' => @$nextToken));
		}
		else{
			$nextToken = '';
		}
		$totaltokens=$this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC");
		if(@sizeOf($totaltokens) > 0)
		{
			$remainingTokens = @sizeOf($totaltokens);
		}
		else{
			$remainingTokens = '';
		}
		if(@sizeOf($serves) > 0)
		{
			$cToken = @$serves[0]->tokenNumber;
		}
		else{
			$cToken = '';
		}
		
		$data['token']=$nextToken;
		$data['remainingTokens']=$remainingTokens;
		$data['currentToken']=@$cToken;
		echo @json_encode($data);
	}
	public function getTokens() 
	{
		$user=$this->sql->getTableRowData("users",array("status" => 1,'id' => @$this->session->userdata('userid')));
		$userCounter=$this->sql->getTableRowData("user_at_counter",array("status" => 1,'userid' => @$this->session->userdata('userid')));
		if(@sizeOf($userCounter) > 0)
		{
			$userService=$this->sql->getTableRowData("service_at_counter",array("status" => 1,'counterID' => @$userCounter[0]->counterID));
			$service=$this->sql->getTableRowData("services",array("status" => 1,'id' => @$userService[0]->serviceID));
			
			
		}
		else{
			$userService=array();
			$service=array();
		}
		$tokens=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC",0,1);
		
		$serves=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d"),'tellerID' => @$this->session->userdata('userid'),'counterID' => @$userCounter[0]->counterID),array('s'),"tokenStatus","tokenStoreTime","ASC",0,1);
		
		if(@sizeOf($tokens) > 0)
		{
			$nextToken = @$tokens[0]->tokenNumber;
		}
		else{
			$nextToken = '';
		}
		$totaltokens=$this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC");
		if(@sizeOf($totaltokens) > 0)
		{
			$remainingTokens = @sizeOf($totaltokens);
		}
		else{
			$remainingTokens = '';
		}
		if(@sizeOf($serves) > 0)
		{
			$cToken = @$serves[0]->tokenNumber;
		}
		else{
			$cToken = '';
		}
		
		$data['token']=$nextToken;
		$data['remainingTokens']=$remainingTokens;
		$data['currentToken']=@$cToken;
		echo @json_encode($data);
	}
	public function getTotalTokens() 
	{
		$user=$this->sql->getTableRowData("users",array("status" => 1,'id' => @$this->session->userdata('userid')));
		$userCounter=$this->sql->getTableRowData("user_at_counter",array("status" => 1,'userid' => @$this->session->userdata('userid')));
		if(@sizeOf($userCounter) > 0)
		{
			$userService=$this->sql->getTableRowData("service_at_counter",array("status" => 1,'counterID' => @$userCounter[0]->counterID));
			$service=$this->sql->getTableRowData("services",array("status" => 1,'id' => @$userService[0]->serviceID));
			
			
		}
		else{
			$userService=array();
			$service=array();
		}
		$tokens=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => @date("Y-m-d")),array('n'),"tokenStatus","tokenStoreTime","ASC",0,1);
		if(@sizeOf($tokens) > 0)
		{
			$data['token']=@sizeOf($tokens);
			echo @json_encode($data);
		}
		else{
			$cdate=@date("Y-m-d");
			$yesterday = @date("Y-m-d",strtotime("-1 days",strtotime($cdate)));
			$tokens=$this->sql->getTableRowDataOrder("tokens",array("status" => 1, "serviceID" => @$service[0]->id,"DATE(tokenStoreTime)" => $yesterday),"tokenStoreTime","ASC");
			if(@sizeOf($tokens) > 0)
			{
				
			}
			$data['token']=0;
			echo @json_encode($data);
		}
		
	}
	
	public function buzzToKen() 
	{
		extract($_REQUEST);
		if(@$token != '')
		{
			$params=array(
				'isBuzz' => 1
			);
			$upd = $this->sql->updateItems("tokens",$params,array('tokenNumber' => @$token));
			if($upd > 0)
			{
				echo 1;
			}
			else{
				echo 0;
			}
		}
		else{
			echo 0;
		}
	}
}