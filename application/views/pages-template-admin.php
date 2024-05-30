<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    $this->load->view("pages-template-admin/Header",$title);
    $this->load->view("body/$pages");
    $this->load->view("pages-template-admin/SideBar",$nom_service);
    $this->load->view("pages-template-admin/footer");
?>