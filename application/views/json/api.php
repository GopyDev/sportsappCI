<?php 
$this->output->set_header("Access-Control-Allow-Origin: *");
$this->output->set_header("Access-Control-Allow-Headers: X-Requested-With, Cache-Control");
$this->output->set_content_type('application/json');
//$this->output->set_content_type('text/plain');
echo json_encode($data, true); 
?>