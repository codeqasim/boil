<?php

class Cms extends MX_Controller {

    public function index()
    {
    	
    }

    public function contact(){

    $this->load->model->('CmsModel');
    $data['fetch']=$this->CmsModel->get();
    $this->theme->view('modules/cms/cms',$data);
}
}

