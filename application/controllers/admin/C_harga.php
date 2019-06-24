<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_harga extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('harga_model','harga');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('harga_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_harga/create_action'),
            'get' => $this->harga_model->get_idbarang(),
            'get2' => $this->harga_model->get_idcabang(),
            'barang_selected' => $this->input->post('ID_BRG') ? $this->input->post('NAMA_BRG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/harga/harga_view', $data);
    }
    public function create()
    {
        
    }
	public function ajax_list()
	{
		$list = $this->harga->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $harga) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $harga->CB_NAMA;
			$row[] = $harga->NAMA_BRG;
            $row[] = $harga->HARGA_BELI;
            $row[] = $harga->HARGA_JUAL;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_harga('."'".$harga->ID_HARGA."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_harga('."'".$harga->ID_HARGA."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->harga->count_all(),
						"recordsFiltered" => $this->harga->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->harga->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'CB_ID' => $this->input->post('CB_ID') ,
				'ID_BRG' => $this->input->post('ID_BRG') ,  
				'HARGA_BELI' => $this->input->post('HARGA_BELI') ,
				'HARGA_JUAL' => $this->input->post('HARGA_JUAL') ,
							);
		$insert = $this->harga->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'CB_ID' => $this->input->post('CB_ID') ,
			'ID_BRG' => $this->input->post('ID_BRG') ,  
			'HARGA_BELI' => $this->input->post('HARGA_BELI') ,
			'HARGA_JUAL' => $this->input->post('HARGA_JUAL') ,
			
			);
		$this->harga->update(array('ID_HARGA' => $this->input->post('ID_HARGA')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_HARGA)
	{
		$this->harga->delete_by_id($ID_HARGA);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('HARGA_BELI') == '')
		{
			$data['inputerror'][] = 'HARGA_BELI';
			$data['error_string'][] = 'Harga Beli is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('HARGA_JUAL') == '')
		{
			$data['inputerror'][] = 'HARGA_JUAL';
			$data['error_string'][] = 'Harga Jual is required';
			$data['status'] = FALSE;
        }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

