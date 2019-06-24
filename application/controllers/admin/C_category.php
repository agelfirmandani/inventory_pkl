<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_category extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model','category');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/category/category_view');
	}

	public function ajax_list()
	{
		$list = $this->category->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $category) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $category->NAMA_CATEGORY;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_category('."'".$category->ID_CATEGORY."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_brand('."'".$category->ID_CATEGORY."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->category->count_all(),
						"recordsFiltered" => $this->category->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->category->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_CATEGORY' => $this->input->post('ID_CATEGORY'),
				'NAMA_CATEGORY' => $this->input->post('NAMA_CATEGORY'),
							);
		$insert = $this->category->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'NAMA_CATEGORY' => $this->input->post('NAMA_CATEGORY'),
            
			);
		$this->category->update(array('ID_CATEGORY' => $this->input->post('ID_CATEGORY')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_CATEGORY)
	{
		$this->category->delete_by_id($ID_CATEGORY);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_CATEGORY') == '')
		{
			$data['inputerror'][] = 'NAMA_CATEGORY';
			$data['error_string'][] = 'NAMA CATEGORY is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

