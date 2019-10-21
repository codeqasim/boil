<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MX_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->helper('xcrud');
    }

    public function index()
	{
        $xcrud = xcrud_get_instance();
        $xcrud->table('accounts');
        $xcrud->columns('thumb,account_type_id,first_name,last_name,email,status');
        $xcrud->fields('thumb,account_type_id,status,first_name,last_name,email,status');
        $xcrud->relation('account_type_id','accounts_types','id','type');
        $xcrud->change_type('thumb', 'image', '', array(
            'path'=>"../../uploads/accounts",
            'width' => 200,
            'height' => 200));
        $xcrud->unset_title();
        $data['title'] = 'Accounts';
        $xcrud->order_by('id','desc');
        $data['head'] = 'Accounts';
        $data['content'] = $xcrud->render();
        $data['main_content'] = 'admin/xcrud';
        $this->load->view('admin/alerts');
        $this->load->view('admin/template', $data);

    }

    public function login()
    {
        $data['title'] = 'login';
        $data['main_content'] = 'admin/login';
        $this->load->view('admin/template', $data);

    }

    public function signup()
    {
        $data['title'] = 'signup';
        $data['main_content'] = 'admin/signup';
        $this->load->view('admin/template', $data);

    }

}