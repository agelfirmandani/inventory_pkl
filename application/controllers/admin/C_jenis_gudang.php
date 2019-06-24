<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_gudang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('jns_gdg_model','jns_gdg');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/jns_gdg/jns_gdg_view');
	}

	public function ajax_list()
	{
		$list = $this->jns_gdg->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jns_gdg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $jns_gdg->NAMA_JNS_GDG;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_jns_gdg('."'".$jns_gdg->ID_JNS_GDG."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jns_gdg('."'".$jns_gdg->ID_JNS_GDG."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jns_gdg->count_all(),
						"recordsFiltered" => $this->jns_gdg->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->jns_gdg->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_JNS_GDG' => $this->input->post('ID_JNS_GDG'),
				'NAMA_JNS_GDG' => $this->input->post('NAMA_JNS_GDG'),
							);
		$insert = $this->jns_gdg->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'NAMA_JNS_GDG' => $this->input->post('NAMA_JNS_GDG'),
            
			);
		$this->jns_gdg->update(array('ID_JNS_GDG' => $this->input->post('ID_JNS_GDG')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_JNS_GDG)
	{
		$this->jns_gdg->delete_by_id($ID_JNS_GDG);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_JNS_GDG') == '')
		{
			$data['inputerror'][] = 'NAMA_JNS_GDG';
			$data['error_string'][] = 'NAMA Jenis Barang is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

