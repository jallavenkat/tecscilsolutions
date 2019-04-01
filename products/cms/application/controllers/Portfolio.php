<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Portfolio extends CI_Controller {
public function index() {
$data["menu"] = "portfolio";
$this->load->view("header",$data);
$this->load->view("index",$data);
$this->load->view("footer",$data);
}
}