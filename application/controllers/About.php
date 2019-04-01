<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class About extends CI_Controller {
public function index() {
$data["menu"] = "about";
$this->load->view("header",$data);
$this->load->view("index",$data);
$this->load->view("footer",$data);
}
}