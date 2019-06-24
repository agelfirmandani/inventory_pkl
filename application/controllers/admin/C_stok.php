<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_stok extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('stok_model','stok');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('stok_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_stok/create_action'),
            'get' => $this->stok_model->get_idgudang(),
			'get2' => $this->stok_model->get_idbarang(),
			'kode' => $this->stok->kode(),
            'gudang_selected' => $this->input->post('ID_GDG') ? $this->input->post('NAMA_GDG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'barang_selected' => $this->input->post('ID_BRG') ? $this->input->post('NAMA_BRG') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
        $this->load->view('admin/stok/stok_view', $data);
    }

	public function ajax_list()
	{
		$list = $this->stok->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $stok) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $stok->NO_SERI;
            $row[] = $stok->NAMA_GDG;
            $row[] = $stok->NAMA_BRG;
			$row[] = $stok->JUMLAH;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_stok('."'".$stok->ID_STOK."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_stok('."'".$stok->ID_STOK."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->stok->count_all(),
						"recordsFiltered" => $this->stok->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->stok->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'NO_SERI' => $this->input->post('NO_SERI') , 
				'ID_GDG' => $this->input->post('ID_GDG') , 
				'ID_BRG' => $this->input->post('ID_BRG') , 
				'JUMLAH' => $this->input->post('JUMLAH') ,
							);
		$insert = $this->stok->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'NO_SERI' => $this->input->post('NO_SERI'),
				'ID_GDG' => $this->input->post('ID_GDG'),
				'ID_BRG' => $this->input->post('ID_BRG'),
				'JUMLAH' => $this->input->post('JUMLAH'),
				
			);
		$this->stok->update(array('ID_STOK' => $this->input->post('ID_STOK')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($ID_STOK)
	{
		$this->stok->delete_by_id($ID_STOK);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NO_SERI') == '')
		{
			$data['inputerror'][] = 'NO_SERI';
			$data['error_string'][] = 'No. Seri is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('JUMLAH') == '')
		{
			$data['inputerror'][] = 'JUMLAH';
			$data['error_string'][] = 'Jumlah is required';
			$data['status'] = FALSE;
        }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

