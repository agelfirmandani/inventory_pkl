<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_barang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('jns_brg_model','jns_brg');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/jns_brg/jns_brg_view');
	}

	public function ajax_list()
	{
		$list = $this->jns_brg->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jns_brg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $jns_brg->NAMA_JNS_BRG;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_jns_brg('."'".$jns_brg->ID_JNS_BRG."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jns_brg('."'".$jns_brg->ID_JNS_BRG."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jns_brg->count_all(),
						"recordsFiltered" => $this->jns_brg->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->jns_brg->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_JNS_BRG' => $this->input->post('ID_JNS_BRG'),
				'NAMA_JNS_BRG' => $this->input->post('NAMA_JNS_BRG'),
							);
		$insert = $this->jns_brg->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'NAMA_JNS_BRG' => $this->input->post('NAMA_JNS_BRG'),
            
			);
		$this->jns_brg->update(array('ID_JNS_BRG' => $this->input->post('ID_JNS_BRG')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_JNS_BRG)
	{
		$this->jns_brg->delete_by_id($ID_JNS_BRG);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_JNS_BRG') == '')
		{
			$data['inputerror'][] = 'NAMA_JNS_BRG';
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

