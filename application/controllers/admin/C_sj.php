<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sj extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->model('sj_model','sj');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('sj_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_sj/create_action'),
            'get' => $this->sj_model->get_idcabang(),
            'get2' => $this->sj_model->get_idorder(),
			'kode' => $this->sj->kode(),
			'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'order_selected' => $this->input->post('ID_ORDER') ? $this->input->post('NAMA_DIKIRIM_ORDER') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/sj/sj_view', $data);
    }
    public function create()
    {
        
    }
	public function ajax_list()
	{
		$list = $this->sj->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $sj) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $sj->CB_NAMA;
			$row[] = $sj->NAMA_ORDER;
            $row[] = $sj->NOMOR_SJ;
            $row[] = $sj->JENIS_SJ;
            $row[] = $sj->TGL_SJ;
            $row[] = $sj->TGL_KIRIM_SJ;
            $row[] = $sj->EKSPEDISI_SJ;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_sj('."'".$sj->ID_SJ."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_sj('."'".$sj->ID_SJ."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->sj->count_all(),
						"recordsFiltered" => $this->sj->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->sj->get_by_id($id);
		$data->TGL_SJ = ($data->TGL_SJ == '0000-00-00') ? '' : $data->TGL_SJ; 
		$data->TGL_KIRIM_SJ = ($data->TGL_SJ == '0000-00-00') ? '' : $data->TGL_KIRIM_SJ; 
		
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'CB_ID' => $this->input->post('CB_ID') , 
				'ID_ORDER' => $this->input->post('ID_ORDER') , 
				'NOMOR_SJ' => $this->input->post('NOMOR_SJ') , 
                'JENIS_SJ' => $this->input->post('JENIS_SJ') ,
                'TGL_SJ' => $this->input->post('TGL_SJ') ,
                'TGL_KIRIM_SJ' => $this->input->post('TGL_KIRIM_SJ') ,
                'EKSPEDISI_SJ' => $this->input->post('EKSPEDISI_SJ') ,
		);
		$insert = $this->sj->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'CB_ID' => $this->input->post('CB_ID'),
				'ID_ORDER' => $this->input->post('ID_ORDER'),
				'NOMOR_SJ' => $this->input->post('NOMOR_SJ'),
				'JENIS_SJ' => $this->input->post('JENIS_SJ') ,
                'TGL_SJ' => $this->input->post('TGL_SJ') ,
                'TGL_KIRIM_SJ' => $this->input->post('TGL_KIRIM_SJ') ,
                'EKSPEDISI_SJ' => $this->input->post('EKSPEDISI_SJ') ,
			);
		$this->sj->update(array('ID_SJ' => $this->input->post('ID_SJ')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_SJ)
	{
		$this->sj->delete_by_id($ID_SJ);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_SJ') == '')
		{
			$data['inputerror'][] = 'NOMOR_SJ';
			$data['error_string'][] = 'No. Surat Jalan is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('JENIS_SJ') == '')
		{
			$data['inputerror'][] = 'JENIS_SJ';
			$data['error_string'][] = 'Jenis Surat Jalan is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TGL_SJ') == '')
		{
			$data['inputerror'][] = 'TGL_SJ';
			$data['error_string'][] = 'Tangal Surat Jalan is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TGL_KIRIM_SJ') == '')
		{
			$data['inputerror'][] = 'TGL_KIRIM_SJ';
			$data['error_string'][] = 'Tanggal Kirim is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('EKSPEDISI_SJ') == '')
		{
			$data['inputerror'][] = 'EKSPEDISI_SJ';
			$data['error_string'][] = 'Ekspedisi Surat Jalan is required';
			$data['status'] = FALSE;
        }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

