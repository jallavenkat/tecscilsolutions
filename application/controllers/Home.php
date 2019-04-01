<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends CI_Controller {
	public function index() {
		$data["menu"] = "home";
		$data['logo']=$this->sql->getTableRowData("logo",array("status" => 1));
		$data['socials']=$this->sql->getTableRowDataOrder("socials",array("status" => 1),"id","ASC");
		$menu=$this->sql->getTableRowDataOrder("menus",array("status" => 1,'menuAlias' => 'home'),"id","ASC");
		$data['metas']=$this->sql->getTableRowDataOrder("pages",array("status" => 1,'menuid' => @$menu[0]->id),"id","ASC");
		$data['socials']=$this->sql->getTableRowDataOrder("socials",array("status" => 1),"id","ASC");
		$data['about']=$this->sql->getTableRowDataOrder("pages",array("status" => 1,'menuid' => 4),"id","ASC");
		$this->load->view("header",$data);
		$this->load->view("index",$data);
		$this->load->view("footer",$data);
	}
}