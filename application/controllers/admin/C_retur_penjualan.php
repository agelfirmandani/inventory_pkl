<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_retur_penjualan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('retur_penjualan_model','retur_penjualan');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('retur_penjualan_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_retur_penjualan/create_action'),
            'get' => $this->retur_penjualan_model->get_idcabang(),
            'get2' => $this->retur_penjualan_model->get_idsj(),
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'sj_selected' => $this->input->post('ID_SJ') ? $this->input->post('EKSPEDISI_SJ') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
    );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/retur_penjualan/retur_penjualan_view', $data);
    }

	public function ajax_list()
	{
		$list = $this->retur_penjualan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $retur_penjualan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $retur_penjualan->CB_NAMA;
			$row[] = $retur_penjualan->JENIS_SJ;
            $row[] = $retur_penjualan->NOMOR_RETUR_PENJUALAN;
            $row[] = $retur_penjualan->STATUS_PENGEMBALIAN_BARANG;
            $row[] = $retur_penjualan->TGL_RETUR_PENJUALAN;
            $row[] = $retur_penjualan->AKSI_BAYAR_PENJUALAN;
            $row[] = $retur_penjualan->ALASAN_RETUR_PENJUALAN;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_retur_penjualan('."'".$retur_penjualan->ID_RETUR_PENJUALAN."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_retur_penjualan('."'".$retur_penjualan->ID_RETUR_PENJUALAN."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->retur_penjualan->count_all(),
						"recordsFiltered" => $this->retur_penjualan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->retur_penjualan->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_RETUR_PENJUALAN' => $this->input->post('ID_RETUR_PENJUALAN'),
				'CB_ID' => $this->input->post('CB_ID') , 
				'ID_SJ' => $this->input->post('ID_SJ') , 
				'NOMOR_RETUR_PENJUALAN' => $this->input->post('NOMOR_RETUR_PENJUALAN') , 
				'STATUS_PENGEMBALIAN_BARANG' => $this->input->post('STATUS_PENGEMBALIAN_BARANG') , 
                'TGL_RETUR_PENJUALAN' => $this->input->post('TGL_RETUR_PENJUALAN') , 
                'AKSI_BAYAR_PENJUALAN' => $this->input->post('AKSI_BAYAR_PENJUALAN') , 
                'ALASAN_RETUR_PENJUALAN' => $this->input->post('ALASAN_RETUR_PENJUALAN') , 
		);
		$insert = $this->retur_penjualan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
            'CB_ID' => $this->input->post('CB_ID') , 
            'ID_SJ' => $this->input->post('ID_SJ') , 
            'NOMOR_RETUR_PENJUALAN' => $this->input->post('NOMOR_RETUR_PENJUALAN') , 
            'STATUS_PENGEMBALIAN_BARANG' => $this->input->post('STATUS_PENGEMBALIAN_BARANG') , 
            'TGL_RETUR_PENJUALAN' => $this->input->post('TGL_RETUR_PENJUALAN') , 
            'AKSI_BAYAR_PENJUALAN' => $this->input->post('AKSI_BAYAR_PENJUALAN') , 
            'ALASAN_RETUR_PENJUALAN' => $this->input->post('ALASAN_RETUR_PENJUALAN') , 
		);
		$this->retur_penjualan->update(array('ID_RETUR_PENJUALAN' => $this->input->post('ID_RETUR_PENJUALAN')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_RETUR_PENJUALAN)
	{
		$this->retur_penjualan->delete_by_id($ID_RETUR_PENJUALAN);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_RETUR_PENJUALAN') == '')
		{
			$data['inputerror'][] = 'NOMOR_RETUR_PENJUALAN';
			$data['error_string'][] = 'Nomor Retur is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('STATUS_PENGEMBALIAN_BARANG') == '')
		{
			$data['inputerror'][] = 'STATUS_PENGEMBALIAN_BARANG';
			$data['error_string'][] = 'Status Pengembalian is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TANGGAL_RETUR_PENJUALAN') == '')
		{
			$data['inputerror'][] = 'TANGGAL_RETUR_PENJUALAN';
			$data['error_string'][] = 'Tanggal Retur is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('AKSI_BAYAR_PENJUALAN') == '')
		{
			$data['inputerror'][] = 'AKSI_BAYAR_PENJUALAN';
			$data['error_string'][] = 'Aksi Bayar is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('ALASAN_RETUR_PENJUALAN') == '')
		{
			$data['inputerror'][] = 'ALASAN_RETUR_PENJUALAN';
			$data['error_string'][] = 'Alasan Retur is required';
			$data['status'] = FALSE;
        }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

