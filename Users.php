<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('s3');
    }


    public function upload_image() {
        $fileTempName = $_FILES['image_name'];
        $aws_object_url = $this->s3->sendFile($bucketName, $fileTempName);
    }

    public function delete_image($delImageName) {
        $del_url = $this->s3->deleteFile($bucketName, $delImageName);
    }

}
