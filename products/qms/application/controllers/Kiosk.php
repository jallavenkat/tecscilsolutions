<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Kiosk extends CI_Controller {
	public function index() {
		$data["menu"] = "home";
		$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
		$data['services']=$this->sql->getTableRowDataOrder("services",array("status" => 1),"orderpos","ASC");
		$this->load->view("kiosk/header",$data);
		$this->load->view("kiosk/index",$data);
		$this->load->view("kiosk/footer",$data);
	}
	
	public function createUserToken()
	{
		extract($_REQUEST);
		//echo $service;
		$servicecounter=$this->sql->getTableRowData("service_at_counter",array("status" => 1,"serviceID" => $service,"DATE(createDate)" => @date("Y-m-d")));
		
		$user=$this->sql->getTableRowData("user_at_counter",array("status" => 1,"counterID" => @$servicecounter[0]->counterID,"DATE(createDate)" => @date("Y-m-d")));
		
		$lasttoken=$this->sql->getTableRowDataArrayOrderLimit("tokens",array("status" => 1, "DATE(tokenStoreTime)" => @date("Y-m-d")),array('n','s','c','m'),"tokenStatus","tokenStoreTime","DESC",0,1);
		
		if(@sizeOf($lasttoken) > 0)
		{
			$tokennumber = @$lasttoken[0]->tokenNumber+1;
		}
		else{
			$tokennumber='0001';
		}
		
		$originaltoken=@date('Ymdhis')+$tokennumber;
		//$token=substr($originaltoken, -4);
		$params=array(
			'tokenNumber' => $tokennumber,
			'originalNumber' => $originaltoken,
			//'tellerID' => @$user[0]->userID,
			'counterID' => @$servicecounter[0]->counterID,
			'serviceID' => @$service,
			'tokenStoreTime' => @date("Y-m-d H:i:s"),
		);
		$ins = $this->sql->storeItems("tokens",$params);
		if($ins > 0)
		{
			$pms=array(
				'tokenID' => $tokennumber,
				'serviceID' => @$service,
				'counterID' => @$servicecounter[0]->counterID,
				'tokenStoreTime' => @date("Y-m-d H:i:s"),
			);
			$ins1 = $this->sql->storeItems("tokens_at_services",$pms);
			echo 1;
		}
	}
	
	public function display() {
		$data["menu"] = "home";
		$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
		$data['services']=$this->sql->getTableRowDataOrder("services",array("status" => 1),"orderpos","ASC");
		$data['items']=$this->sql->getTableRowData("displayscreens",array("status" => 1, "displayDefault" => 1));
		
		$tokens=$this->sql->getTableRowDataArrayOrder("tokens",array("status" => 1, "DATE(tokenStoreTime)" => @date("Y-m-d")),array('n','s'),"tokenStatus","tokenStoreTime","ASC");
		
		$tokensarr=array();
		if(@sizeOf($tokens) > 0)
		{
			for($i=0;$i<sizeOf($tokens);$i++)
			{
				$tokensarr[]=array(
					'id' => $tokens[$i]->id,
					'tokenNumber' => $tokens[$i]->tokenNumber,
					'originalNumber' => $tokens[$i]->originalNumber,
					'service' => $this->sql->getTableRowData("services",array("id" => $tokens[$i]->serviceID)),
					'counter' => $this->sql->getTableRowData("counters",array("id" => $tokens[$i]->counterID)),
				);
			}
		}
		$data['tokens']=@json_encode($tokensarr);
		$this->load->view("kiosk/display-header",$data);
		$this->load->view("kiosk/display",$data);
		$this->load->view("kiosk/footer",$data);
	}
	
	public function displayToken()
	{
		$token=$this->sql->getTableRowDataOrder("tokens",array("DATE(tokenVisitTime)" => @date("Y-m-d"),'tokenStatus' => 's','isBuzz' => 1),"tokenStoreTime","ASC");
		
		if(@sizeOf($token) > 0)
		{
			$buzzToken = @$token[0]->tokenNumber;
			$buzz = @$token[0]->isBuzz;
			$params=array(
				'isBuzz' => 0
			);
			$upd=$this->sql->updateItems("tokens",$params,array("tokenNumber" => $buzzToken));
			
		}
		else
		{
			$buzzToken = '';
			$buzz = 0;
		}
		echo @json_encode(array('token' => $buzzToken,'buzz' => $buzz));
	}
}