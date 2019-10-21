<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('xcrud');
        $result = check_admin();
        if(empty($result))
        {
         redirect(ADMINURI.'login');
        }
        $this->load->model('Setting_Model', 'sm');
        $this->load->model('Modules_Model', 'mm');
        $this->load->model('Auth_Model', 'am');
        $data = getAllObjects();
        $this->load->vars($data);
    }

    public function index()
    {
        $segment = slugifyToString($this->uri->segment(3));
        $xcrud = xcrud_get_instance();
        $xcrud->table('module_cms');
        $xcrud->unset_title();
        $xcrud->relation('heading_id','module_cms_headings','id','name');
        $xcrud->join('heading_id', 'module_cms_headings', 'id', [],"not_insert");
        if(!empty($segment)){
            $xcrud->where('module_cms_headings.name',$segment);
        }
        $xcrud->order_by('order_by','asc');
        $xcrud->column_callback('order_by', 'orderInputCms');
        $data['title'] = 'CMS Pages';
        $data['head'] = 'CMS Pages';
        $data['content'] = $xcrud->render();
        $data["base_url"] = base_url(ADMINURI.'cms/delete_all_cms');
        $data['main_content'] = 'Admin/xcrud';
        $data['crumbdata'] = array('CMS');
        $data['crumb'] = 'Admin/crumb';
        $this->load->view('Admin/template', $data);
    }
    public function delete_all_cms()
    {
        $this->mm->delete_all_cms($this->input->post('primery_keys'));

    }
    public function chagne_order()
    {
        $this->sm->ChangeOrder($this->input->post('id'),$this->input->post('value'));
    }
    public function page_headings()
    {
        $xcrud = xcrud_get_instance();
        $xcrud->table('module_cms_headings');
        $xcrud->unset_title();
        $data['title'] = 'CMS Pages';
        $data['head'] = 'CMS Pages';
        $data['content'] = $xcrud->render();
        $data["base_url"] = base_url(ADMINURI.'cms/delete_all_cms_headings');
        $data['main_content'] = 'Admin/xcrud';
        $data['crumbdata'] = array('CMS');
        $data['crumb'] = 'Admin/crumb';
        $this->load->view('Admin/template', $data);
    }
    public function delete_all_cms_headings()
    {
        $this->mm->delete_all_cms_headings($this->input->post('primery_keys'));

    }


}