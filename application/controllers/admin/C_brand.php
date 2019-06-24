<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_brand extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('brand_model','brand');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/brand/brand_view');
	}

	public function ajax_list()
	{
		$list = $this->brand->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $brand) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->NAMA_BRAND;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_brand('."'".$brand->ID_BRAND."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_brand('."'".$brand->ID_BRAND."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->brand->count_all(),
						"recordsFiltered" => $this->brand->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->brand->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
					'NAMA_BRAND' => $this->input->post('NAMA_BRAND'),
							);
		$insert = $this->brand->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'NAMA_BRAND' => $this->input->post('NAMA_BRAND'),
            
			);
		$this->brand->update(array('ID_BRAND' => $this->input->post('ID_BRAND')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_BRAND)
	{
		$this->brand->delete_by_id($ID_BRAND);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_BRAND') == '')
		{
			$data['inputerror'][] = 'NAMA_BRAND';
			$data['error_string'][] = 'NAMA BRAND is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

