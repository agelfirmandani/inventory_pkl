<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cabang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('cabang_model','cabang');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/cabang/cabang_view');
	}

	public function ajax_list()
	{
		$list = $this->cabang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cabang) {
			$no++;
			$row = array();
			$row[] = $no;
            $row[] = $cabang->CB_NAMA;
            $row[] = $cabang->CB_ALAMAT;
			$row[] = $cabang->CB_TELP;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cabang('."'".$cabang->CB_ID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_cabang('."'".$cabang->CB_ID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cabang->count_all(),
						"recordsFiltered" => $this->cabang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->cabang->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'CB_ID' => $this->input->post('CB_ID'),
                'CB_NAMA' => $this->input->post('CB_NAMA'),
                'CB_ALAMAT' => $this->input->post('CB_ALAMAT'),
                'CB_TELP' => $this->input->post('CB_TELP'),
							);
		$insert = $this->cabang->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'CB_NAMA' => $this->input->post('CB_NAMA'),
            'CB_ALAMAT' => $this->input->post('CB_ALAMAT'),
            'CB_TELP' => $this->input->post('CB_TELP'),
			);
		$this->cabang->update(array('CB_ID' => $this->input->post('CB_ID')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($CB_ID)
	{
		$this->cabang->delete_by_id($CB_ID);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('CB_NAMA') == '')
		{
			$data['inputerror'][] = 'CB_NAMA';
			$data['error_string'][] = 'NAMA CABANG is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('CB_ALAMAT') == '')
		{
			$data['inputerror'][] = 'CB_ALAMAT';
			$data['error_string'][] = 'ALAMAT CABANG is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('CB_TELP') == '')
		{
			$data['inputerror'][] = 'CB_TELP';
			$data['error_string'][] = 'TELEPON CABANG is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

