<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_barang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model','barang');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('barang_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_barang/create_action'),
            'get' => $this->barang_model->get_id_brand(),
            'get2' => $this->barang_model->get_id_satuan(),
            'get3' => $this->barang_model->get_id_category(),
            'get4' => $this->barang_model->get_id_jns_brg(),
			'kode' => $this->barang->kode(),
			'brand_selected' => $this->input->post('ID_BRAND') ? $this->input->post('NAMA_BRAND') : '', 
            'satuan_selected' => $this->input->post('ID_SATUAN') ? $this->input->post('NAMA_SATUAN') : '', 
            'category_selected' => $this->input->post('ID_CATEGORY') ? $this->input->post('NAMA_CATEGORY') : '', 
            'jns_brg_selected' => $this->input->post('ID_JNS_BRG') ? $this->input->post('NAMA_JNS_BRG') : '', 
             
   	 );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/barang/barang_view', $data);
        $this->load->view('admin/barang/modal_detail');
    }
    public function create()
    {
        
    }
	public function ajax_list()
	{
		$list = $this->barang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $barang) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $barang->NAMA_BRAND;
			$row[] = $barang->NAMA_SATUAN;
            $row[] = $barang->NAMA_CATEGORY;
            $row[] = $barang->NAMA_JNS_BRG;
			$row[] = $barang->NAMA_BRG;
			$row[] = $barang->STOK;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_barang('."'".$barang->ID_BRG."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang('."'".$barang->ID_BRG."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Detail" onclick="detail_barang('."'".$barang->ID_BRG."'".')"><i class="glyphicon glyphicon-list-alt"></i> Detail</a>
					';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->barang->count_all(),
						"recordsFiltered" => $this->barang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->barang->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_BRAND' => $this->input->post('ID_BRAND') , 
				'ID_SATUAN' => $this->input->post('ID_SATUAN') , 
				'ID_CATEGORY' => $this->input->post('ID_CATEGORY') , 
				'ID_JNS_BRG' => $this->input->post('ID_JNS_BRG') , 
				'NOMOR_BRG' => $this->input->post('NOMOR_BRG') , 
				'NAMA_BRG' => $this->input->post('NAMA_BRG'),
				'HARGA_BELI' => $this->input->post('HARGA_BELI'),
				'HARGA_JUAL' => $this->input->post('HARGA_JUAL'),
				'STOK' => $this->input->post('STOK'),
							);
		$insert = $this->barang->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'ID_BRAND' => $this->input->post('ID_BRAND') , 
			'ID_SATUAN' => $this->input->post('ID_SATUAN') , 
			'ID_CATEGORY' => $this->input->post('ID_CATEGORY') , 
			'ID_JNS_BRG' => $this->input->post('ID_JNS_BRG') , 
			'NOMOR_BRG' => $this->input->post('NOMOR_BRG') , 
			'NAMA_BRG' => $this->input->post('NAMA_BRG'),
			'HARGA_BELI' => $this->input->post('HARGA_BELI'),
			'HARGA_JUAL' => $this->input->post('HARGA_JUAL'),
			'STOK' => $this->input->post('STOK'),
						);
		$this->barang->update(array('ID_BRG' => $this->input->post('ID_BRG')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_detail($id)
	{
		$data = $this->barang->get_detail_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_delete($ID_BRG)
	{
		$this->barang->delete_by_id($ID_BRG);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_BRG') == '')
		{
			$data['inputerror'][] = 'NOMOR_BRG';
			$data['error_string'][] = 'Nomor barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('NAMA_BRG') == '')
		{
			$data['inputerror'][] = 'NAMA_BRG';
			$data['error_string'][] = 'Nama barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('HARGA_BELI') == '')
		{
			$data['inputerror'][] = 'HARGA_BELI';
			$data['error_string'][] = 'Harga Beli barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('HARGA_JUAL') == '')
		{
			$data['inputerror'][] = 'HARGA_JUAL';
			$data['error_string'][] = 'Harga Jual barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('STOK') == '')
		{
			$data['inputerror'][] = 'STOK';
			$data['error_string'][] = 'Stok barang is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

