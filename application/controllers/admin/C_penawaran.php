<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penawaran extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('penawaran_model','penawaran');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('penawaran_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_penawaran/create_action'),
            'get' => $this->penawaran_model->get_idpermpembelian(),
            'get2' => $this->penawaran_model->get_idcabang(),
            'perm_pembelian_selected' => $this->input->post('ID_PERM_PEMBELIAN') ? $this->input->post('PP_JENIS_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
    );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/penawaran/penawaran_view', $data);
    }
    public function create()
    {
        
    }
	public function ajax_list()
	{
		$list = $this->penawaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penawaran) {
			$no++;
			$row = array();
			$row[] = $penawaran->ID_PENAWARAN;
			$row[] = $penawaran->PP_NAMA;
			$row[] = $penawaran->CB_NAMA;
            $row[] = $penawaran->NOMOR_PENAWARAN;
            $row[] = $penawaran->JENIS_PENAWARAN;
			$row[] = $penawaran->TGL_PENAWARAN;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_penawaran('."'".$penawaran->ID_PENAWARAN."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_penawaran('."'".$penawaran->ID_PENAWARAN."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->penawaran->count_all(),
						"recordsFiltered" => $this->penawaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->penawaran->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_PENAWARAN' => $this->input->post('ID_PENAWARAN'),
				'ID_PERM_PEMBELIAN' => $this->input->post('ID_PERM_PEMBELIAN') , 
				'CB_ID' => $this->input->post('CB_ID') , 
				'NOMOR_PENAWARAN' => $this->input->post('NOMOR_PENAWARAN') , 
				'JENIS_PENAWARAN' => $this->input->post('JENIS_PENAWARAN') , 
				'TGL_PENAWARAN' => $this->input->post('TGL_PENAWARAN') , 
							);
		$insert = $this->penawaran->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
                'ID_PERM_PEMBELIAN' => $this->input->post('ID_PERM_PEMBELIAN') , 
				'CB_ID' => $this->input->post('CB_ID') , 
				'NOMOR_PENAWARAN' => $this->input->post('NOMOR_PENAWARAN') , 
				'JENIS_PENAWARAN' => $this->input->post('JENIS_PENAWARAN') , 
				'TGL_PENAWARAN' => $this->input->post('TGL_PENAWARAN') , 
				
			);
		$this->penawaran->update(array('ID_PENAWARAN' => $this->input->post('ID_PENAWARAN')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_PENAWARAN)
	{
		$this->penawaran->delete_by_id($ID_PENAWARAN);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_PENAWARAN') == '')
		{
			$data['inputerror'][] = 'NOMOR_PENAWARAN';
			$data['error_string'][] = 'Nomor penawaran is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('JENIS_PENAWARAN') == '')
		{
			$data['inputerror'][] = 'JENIS_PENAWARAN';
			$data['error_string'][] = 'Jenis Penawaran is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TGL_PENAWARAN') == '')
		{
			$data['inputerror'][] = 'TGL_PENAWARAN';
			$data['error_string'][] = 'Tanggal Penawaran is required';
			$data['status'] = FALSE;
        }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

