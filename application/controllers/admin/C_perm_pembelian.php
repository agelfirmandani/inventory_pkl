<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_perm_pembelian extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('perm_pembelian_model','pp');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('perm_pembelian_model');
		$this->load->helper('form_helper');
		//$data['PP_NOMOR'] = $this->pp->kode();
        $data = array(
            'action' => site_url('admin/C_perm_pembelian/create_action'),
            'get' => $this->pp->get_idcabang(),
			'get2' => $this->pp->get_idgdg(),
			'get3' => $this->pp->get_idbrg(),
			'kode' => $this->pp->kode(),
			'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
			'gudang_selected' => $this->input->post('ID_GDG') ? $this->input->post('NAMA_GDG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
			'barang_selected' => $this->input->post('ID_BRG') ? $this->input->post('NAMA_BRG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
    );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/perm_pembelian/perm_pembelian_view', $data);
	}
	public function ajax_list()
	{
		$list = $this->pp->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pp) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pp->PP_NOMOR;
			$row[] = $pp->CB_NAMA;
            $row[] = $pp->PP_TGL;
			$row[] = $pp->PP_TGL_BUTUH;
			$row[] = $pp->PP_JENIS;
			$row[] = $pp->NAMA_GDG;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_perm_pembelian('."'".$pp->ID_PERM_PEMBELIAN."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_perm_pembelian('."'".$pp->ID_PERM_PEMBELIAN."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pp->count_all(),
						"recordsFiltered" => $this->pp->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($id)
	{
		$data = $this->pp->get_by_id($id);
		$data->PP_TGL = ($data->PP_TGL == '0000-00-00') ? '' : $data->PP_TGL; // if 0000-00-00 set tu empty for datepicker compatibility
		$data->PP_TGL_BUTUH = ($data->PP_TGL_BUTUH == '0000-00-00') ? '' : $data->PP_TGL_BUTUH; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_PERM_PEMBELIAN' => $this->input->post('ID_PERM_PEMBELIAN') ,
				'PP_NOMOR' => $this->input->post('PP_NOMOR') ,  
				'CB_ID' => $this->input->post('CB_ID') ,  
				'PP_TGL' => $this->input->post('PP_TGL') ,
				'PP_TGL_BUTUH' => $this->input->post('PP_TGL_BUTUH') , 
				'PP_JENIS' => $this->input->post('PP_JENIS') , 
				'ID_GDG' => $this->input->post('ID_GDG') ,
							);
		$insert = $this->pp->save($data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_update()
	{
		$this->_validate();
		$data = array(  
				'PP_NOMOR' => $this->input->post('PP_NOMOR') ,
				'CB_ID' => $this->input->post('CB_ID') ,  
				'PP_TGL' => $this->input->post('PP_TGL') , 
				'PP_TGL_BUTUH' => $this->input->post('PP_TGL_BUTUH') , 
				'PP_JENIS' => $this->input->post('PP_JENIS') , 
				'ID_GDG' => $this->input->post('ID_GDG') ,
            
			);
		$this->pp->update(array('ID_PERM_PEMBELIAN' => $this->input->post('ID_PERM_PEMBELIAN')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_PERM_PEMBELIAN)
	{
		$this->pp->delete_by_id($ID_PERM_PEMBELIAN);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('PP_NOMOR') == '')
		{
			$data['inputerror'][] = 'PP_NOMOR';
			$data['error_string'][] = 'Nomor permintaan pembelian is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('PP_TGL') == '')
		{
			$data['inputerror'][] = 'PP_TGL';
			$data['error_string'][] = 'Tanggal Permintaaan pembelian is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('PP_TGL_BUTUH') == '')
		{
			$data['inputerror'][] = 'PP_TGL_BUTUH';
			$data['error_string'][] = 'Tanggal Butuh is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('PP_JENIS') == '')
		{
			$data['inputerror'][] = 'PP_JENIS';
			$data['error_string'][] = 'Jenis Permintaaan pembelian is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	}
	function add(){
		$this->load->helper('url'); 
		// load model dan form helper
	   $this->load->model('perm_pembelian_model');
	   $this->load->helper('form_helper');
	   //$data['PP_NOMOR'] = $this->pp->kode();
	   $data = array(
		   'action' => site_url('admin/C_perm_pembelian/create_action'),
		   'get' => $this->pp->get_idcabang(),
		   'get2' => $this->pp->get_idgdg(),
		   'get3' => $this->pp->get_idbrg(),
		   'kode' => $this->pp->kode(),
		   'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
		   'gudang_selected' => $this->input->post('ID_GDG') ? $this->input->post('NAMA_GDG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
		   'barang_selected' => $this->input->post('ID_BRG') ? $this->input->post('NAMA_BRG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
		   
   );
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/perm_pembelian/form',$data);
	  }

}

