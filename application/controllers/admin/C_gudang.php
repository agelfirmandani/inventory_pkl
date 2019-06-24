<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gudang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('gudang_model','gudang');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('gudang_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_gudang/create_action'),
            'get' => $this->gudang_model->get_idcbg(),
            'get2' => $this->gudang_model->get_jnsgdg(),
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('NAMA_CABANG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'jns_gdg_selected' => $this->input->post('ID_JNS_GDG') ? $this->input->post('NAMA_JNS_GDG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/gudang/gudang_view', $data);
    }
    public function create()
    {
        
    }
	public function ajax_list()
	{
		$list = $this->gudang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $gudang) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $gudang->CB_NAMA;
			$row[] = $gudang->NAMA_JNS_GDG;
            $row[] = $gudang->NAMA_GDG;
            $row[] = $gudang->ALAMAT_GDG;
			$row[] = $gudang->KOTA_GDG;
			// $row[] = $gudang->TELP_GDG;
			// $row[] = $gudang->FAX_GDG;
			// $row[] = $gudang->EMAIL_GDG;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_gudang('."'".$gudang->ID_GDG."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="gudang('."'".$gudang->ID_GDG."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->gudang->count_all(),
						"recordsFiltered" => $this->gudang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->gudang->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_GDG' => $this->input->post('ID_GDG'),
				'CB_ID' => $this->input->post('CB_ID') , 
				'ID_JNS_GDG' => $this->input->post('ID_JNS_GDG') , 
				'NAMA_GDG' => $this->input->post('NAMA_GDG') , 
				'ALAMAT_GDG' => $this->input->post('ALAMAT_GDG') , 
				'KOTA_GDG' => $this->input->post('KOTA_GDG') , 
				'TELP_GDG' => $this->input->post('TELP_GDG'),
				'FAX_GDG' => $this->input->post('FAX_GDG'),
				'EMAIL_GDG' => $this->input->post('EMAIL_GDG'),
		);
		$insert = $this->gudang->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
                'CB_ID' => $this->input->post('CB_ID') , 
                'ID_JNS_GDG' => $this->input->post('ID_JNS_GDG') , 
                'NAMA_GDG' => $this->input->post('NAMA_GDG') , 
                'ALAMAT_GDG' => $this->input->post('ALAMAT_GDG') , 
                'KOTA_GDG' => $this->input->post('KOTA_GDG') , 
                'TELP_GDG' => $this->input->post('TELP_GDG'),
                'FAX_GDG' => $this->input->post('FAX_GDG'),
                'EMAIL_GDG' => $this->input->post('EMAIL_GDG'),
		);
		$this->gudang->update(array('ID_GDG' => $this->input->post('ID_GDG')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_GDG)
	{
		$this->gudang->delete_by_id($ID_GDG);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NAMA_GDG') == '')
		{
			$data['inputerror'][] = 'NAMA_GDG';
			$data['error_string'][] = 'Nama Gudang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('ALAMAT_GDG') == '')
		{
			$data['inputerror'][] = 'ALAMAT_GDG';
			$data['error_string'][] = 'Alamat Gudang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('KOTA_GDG') == '')
		{
			$data['inputerror'][] = 'KOTA_GDG';
			$data['error_string'][] = 'Kota Gudang barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TELP_GDG') == '')
		{
			$data['inputerror'][] = 'TELP_GDG';
			$data['error_string'][] = 'Telp Gudang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('FAX_GDG') == '')
		{
			$data['inputerror'][] = 'FAX_GDG';
			$data['error_string'][] = 'Fax Gudang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('EMAIL_GDG') == '')
		{
			$data['inputerror'][] = 'EMAIL_GDG';
			$data['error_string'][] = 'Email Gudang is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

