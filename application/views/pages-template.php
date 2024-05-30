<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    $this->load->view("pages-template/Header",$title);
    $this->load->view("body/$pages");
    $this->load->view("pages-template/SideBar",$numero_client);
    $this->load->view("pages-template/footer");
?>