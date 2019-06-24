<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_satuan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('satuan_model','satuan');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/satuan/satuan_view');
	}

	public function ajax_list()
	{
		$list = $this->satuan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $satuan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $satuan->NAMA_SATUAN;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_satuan('."'".$satuan->ID_SATUAN."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_satuan('."'".$satuan->ID_SATUAN."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->satuan->count_all(),
						"recordsFiltered" => $this->satuan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->satuan->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_SATUAN' => $this->input->post('ID_SATUAN'),
				'NAMA_SATUAN' => $this->input->post('NAMA_SATUAN'),
							);
		$insert = $this->satuan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'NAMA_SATUAN' => $this->input->post('NAMA_SATUAN'),
            
			);
		$this->satuan->update(array('ID_SATUAN' => $this->input->post('ID_SATUAN')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_SATUAN)
	{
		$this->satuan->delete_by_id($ID_SATUAN);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_SATUAN') == '')
		{
			$data['inputerror'][] = 'NAMA_SATUAN';
			$data['error_string'][] = 'NAMA SATUAN is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

