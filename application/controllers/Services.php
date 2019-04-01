<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Services extends CI_Controller {
	public function index() {
		$data["menu"] = "services";
		$menu=$this->sql->getTableRowDataOrder("menus",array("status" => 1,'menuAlias' => 'services'),"id","ASC");
		$data['metas']=$this->sql->getTableRowDataOrder("pages",array("status" => 1,'menuid' => @$menu[0]->id),"id","ASC");
		$data['socials']=$this->sql->getTableRowDataOrder("socials",array("status" => 1),"id","ASC");
		$this->load->view("header",$data);
		$this->load->view("services",$data);
		$this->load->view("footer",$data);
	}
}