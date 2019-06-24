<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_retur_pembelian extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('retur_pembelian_model','retur_pembelian');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('retur_pembelian_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_retur_pembelian/create_action'),
            'get' => $this->retur_pembelian_model->get_idpenerimaan(),
            'get2' => $this->retur_pembelian_model->get_idcabang(),
            'jns_selected' => $this->input->post('ID_PENERIMAAN_BRG') ? $this->input->post('JENIS_PENERIMAAN_BRG') : '', 
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('NAMA_CABANG') : '',
   	 );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/retur_pembelian/retur_pembelian_view', $data);
    }

	public function ajax_list()
	{
		$list = $this->retur_pembelian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $retur_pembelian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $retur_pembelian->JENIS_PENERIMAAN_BRG;
			$row[] = $retur_pembelian->CB_NAMA;
            $row[] = $retur_pembelian->NOMOR_RETUR_PEMBELIAN;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_retur_pembelian('."'".$retur_pembelian->ID_RETUR_PEMBELIAN."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_retur_pembelian('."'".$retur_pembelian->ID_RETUR_PEMBELIAN."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->retur_pembelian->count_all(),
						"recordsFiltered" => $this->retur_pembelian->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->retur_pembelian->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_RETUR_PEMBELIAN' => $this->input->post('ID_RETUR_PEMBELIAN'),
				'ID_PENERIMAAN_BRG' => $this->input->post('ID_PENERIMAAN_BRG') , 
				'CB_ID' => $this->input->post('CB_ID') , 
				'NOMOR_RETUR_PEMBELIAN' => $this->input->post('NOMOR_RETUR_PEMBELIAN') , 
							);
		$insert = $this->retur_pembelian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'ID_RETUR_PEMBELIAN' => $this->input->post('ID_RETUR_PEMBELIAN'),
            'ID_PENERIMAAN_BRG' => $this->input->post('ID_PENERIMAAN_BRG') , 
            'CB_ID' => $this->input->post('CB_ID') , 
            'NOMOR_RETUR_PEMBELIAN' => $this->input->post('NOMOR_RETUR_PEMBELIAN') ,
			);
		$this->retur_pembelian->update(array('ID_RETUR_PEMBELIAN' => $this->input->post('ID_RETUR_PEMBELIAN')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_detail($id)
	{
		$data = $this->retur_pembelian->get_detail_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_delete($ID_RETUR_PEMBELIAN)
	{
		$this->retur_pembelian->delete_by_id($ID_RETUR_PEMBELIAN);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_RETUR_PEMBELIAN') == '')
		{
			$data['inputerror'][] = 'NOMOR_RETUR_PEMBELIAN';
			$data['error_string'][] = 'Nomor Retur Pembelian is required';
			$data['status'] = FALSE;
        }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

