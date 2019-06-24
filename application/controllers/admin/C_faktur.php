<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_faktur extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('faktur_model','faktur');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('faktur_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_faktur/create_action'),
            'get' => $this->faktur_model->get_idcabang(),
            'get2' => $this->faktur_model->get_idsjalan(),
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CABANG_NAMA') : '', 
            's_jalan_selected' => $this->input->post('ID_SJ') ? $this->input->post('JENIS_SJ') : '', 
   	 );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/faktur/faktur_view', $data);
        $this->load->view('admin/faktur/modal_detail');
    }

	public function ajax_list()
	{
		$list = $this->faktur->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $faktur) {
			$no++;
			$row = array();
			$row[] = $faktur->ID_FAKTUR;
			$row[] = $faktur->CB_NAMA;
			$row[] = $faktur->JENIS_SJ;
			$row[] = $faktur->NOMOR_FAKTUR;
            $row[] = $faktur->TUJUAN_TRANSFER_FAKTUR;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_faktur('."'".$faktur->ID_FAKTUR."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_faktur('."'".$faktur->ID_FAKTUR."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Detail" onclick="detail_faktur('."'".$faktur->ID_FAKTUR."'".')"><i class="glyphicon glyphicon-list-alt"></i> Detail</a>
					';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->faktur->count_all(),
						"recordsFiltered" => $this->faktur->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->faktur->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_FAKTUR' => $this->input->post('ID_FAKTUR'),
				'ID_SJ' => $this->input->post('ID_SJ') , 
				'NOMOR_FAKTUR' => $this->input->post('NOMOR_FAKTUR') , 
				'TGL_FAKTUR' => $this->input->post('TGL_FAKTUR') , 
				'JATUH_TEMPO_FAKTUR' => $this->input->post('JATUH_TEMPO_FAKTUR') , 
				'SUBTOTAL_FAKTUR' => $this->input->post('SUBTOTAL_FAKTUR') , 
				'POTONGAN_FAKTUR' => $this->input->post('POTONGAN_FAKTUR'),
				'UANGMUKA_FAKTUR' => $this->input->post('UANGMUKA_FAKTUR'),
				'TOTAL_FAKTUR' => $this->input->post('TOTAL_FAKTUR'),
				'TUJUAN_TRANSFER_FAKTUR' => $this->input->post('TUJUAN_TRANSFER_FAKTUR'),
							);
		$insert = $this->faktur->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'ID_SJ' => $this->input->post('ID_SJ') , 
            'NOMOR_FAKTUR' => $this->input->post('NOMOR_FAKTUR') , 
            'TGL_FAKTUR' => $this->input->post('TGL_FAKTUR') , 
            'JATUH_TEMPO_FAKTUR' => $this->input->post('JATUH_TEMPO_FAKTUR') , 
            'SUBTOTAL_FAKTUR' => $this->input->post('SUBTOTAL_FAKTUR') , 
            'POTONGAN_FAKTUR' => $this->input->post('POTONGAN_FAKTUR'),
            'UANGMUKA_FAKTUR' => $this->input->post('UANGMUKA_FAKTUR'),
            'TOTAL_FAKTUR' => $this->input->post('TOTAL_FAKTUR'),
            'TUJUAN_TRANSFER_FAKTUR' => $this->input->post('TUJUAN_TRANSFER_FAKTUR'),
				
			);
		$this->faktur->update(array('ID_FAKTUR' => $this->input->post('ID_FAKTUR')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_detail($id)
	{
		$data = $this->faktur->get_detail_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_delete($ID_FAKTUR)
	{
		$this->faktur->delete_by_id($ID_FAKTUR);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_FAKTUR') == '')
		{
			$data['inputerror'][] = 'NOMOR_FAKTUR';
			$data['error_string'][] = 'Nomor faktur is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TGL_FAKTUR') == '')
		{
			$data['inputerror'][] = 'TGL_FAKTUR';
			$data['error_string'][] = 'Tanggal is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('JATUH_TEMPO_FAKTUR') == '')
		{
			$data['inputerror'][] = 'JATUH_TEMPO_FAKTUR';
			$data['error_string'][] = 'Jatuh Tempo is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('SUBTOTAL_FAKTUR') == '')
		{
			$data['inputerror'][] = 'SUBTOTAL_FAKTUR';
			$data['error_string'][] = 'Subtotal is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('POTONGAN_FAKTUR') == '')
		{
			$data['inputerror'][] = 'POTONGAN_FAKTUR';
			$data['error_string'][] = 'Potongan is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('UANGMUKA_FAKTUR') == '')
		{
			$data['inputerror'][] = 'UANGMUKA_FAKTUR';
			$data['error_string'][] = 'Uang muka is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TOTAL_FAKTUR') == '')
		{
			$data['inputerror'][] = 'TOTAL_FAKTUR';
			$data['error_string'][] = 'Total is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TUJUAN_TRANSFER_FAKTUR') == '')
		{
			$data['inputerror'][] = 'TUJUAN_TRANSFER_FAKTUR';
			$data['error_string'][] = 'Tujuan Transfer is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

