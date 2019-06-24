<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_order extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model','order');
	}

	public function index()
	{
         $this->load->helper('url'); 
         // load model dan form helper
        $this->load->model('order_model');
        $this->load->helper('form_helper');
        $data = array(
            'action' => site_url('admin/C_order/create_action'),
			'get' => $this->order_model->get_idcabang(),
			'kode' => $this->order_model->kode(),
            'cabang_selected' => $this->input->post('CB_ID') ? $this->input->post('CB_NAMA') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer');
		$this->load->view('admin/order/order_view', $data);
		$this->load->view('admin/order/modal_detail');
    }

	public function ajax_list()
	{
		$list = $this->order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $order) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $order->CB_NAMA;
			$row[] = $order->NOMOR_ORDER;
            $row[] = $order->TGL_ORDER;
            $row[] = $order->NAMA_DIKIRIM_ORDER;
            $row[] = $order->ALAMAT_ORDER;
			$row[] = $order->SUBTOTAL_ORDER;
			$row[] = $order->TGL_KIRIM_ORDER;
            	//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_order('."'".$order->ID_ORDER."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_order('."'".$order->ID_ORDER."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				  <a class="btn btn-sm btn-info" href="javascript:void(0)" title="Detail" onclick="detail_order('."'".$order->ID_ORDER."'".')"><i class="glyphicon glyphicon-list-alt"></i> Detail</a> 
				  ';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->order->count_all(),
						"recordsFiltered" => $this->order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->order->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ID_ORDER' => $this->input->post('ID_ORDER'),
				'CB_ID' => $this->input->post('CB_ID') , 
				'NOMOR_ORDER' => $this->input->post('NOMOR_ORDER') , 
				'TGL_ORDER' => $this->input->post('TGL_ORDER') , 
				'TYPE_ORDER' => $this->input->post('TYPE_ORDER') , 
				'NAMA_DIKIRIM_ORDER' => $this->input->post('NAMA_DIKIRIM_ORDER') , 
				'ALAMAT_ORDER' => $this->input->post('ALAMAT_ORDER') , 
				'HP_FAX_ORDER' => $this->input->post('HP_FAX_ORDER') , 
				'SUBTOTAL_ORDER' => $this->input->post('SUBTOTAL_ORDER'),
				'PPN_ORDER' => $this->input->post('PPN_ORDER'),
				'TOTAL_ORDER' => $this->input->post('TOTAL_ORDER'),
                'TGL_KIRIM_ORDER' => $this->input->post('TGL_KIRIM_ORDER'),
                'TUNAI_ORDER' => $this->input->post('TUNAI_ORDER'),
                'DP_ORDER' => $this->input->post('DP_ORDER'),
							);
		$insert = $this->order->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'ID_ORDER' => $this->input->post('ID_ORDER'),
			'CB_ID' => $this->input->post('CB_ID') , 
			'NOMOR_ORDER' => $this->input->post('NOMOR_ORDER') , 
			'TGL_ORDER' => $this->input->post('TGL_ORDER') , 
			'TYPE_ORDER' => $this->input->post('TYPE_ORDER') , 
			'NAMA_DIKIRIM_ORDER' => $this->input->post('NAMA_DIKIRIM_ORDER') , 
			'ALAMAT_ORDER' => $this->input->post('ALAMAT_ORDER') , 
			'HP_FAX_ORDER' => $this->input->post('HP_FAX_ORDER') , 
			'SUBTOTAL_ORDER' => $this->input->post('SUBTOTAL_ORDER'),
			'PPN_ORDER' => $this->input->post('PPN_ORDER'),
			'TOTAL_ORDER' => $this->input->post('TOTAL_ORDER'),
			'TGL_KIRIM_ORDER' => $this->input->post('TGL_KIRIM_ORDER'),
			'TUNAI_ORDER' => $this->input->post('TUNAI_ORDER'),
			'DP_ORDER' => $this->input->post('DP_ORDER'),
		);
		$this->order->update(array('ID_ORDER' => $this->input->post('ID_ORDER')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_detail($id)
	{
		$data = $this->order->get_detail_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_delete($ID_ORDER)
	{
		$this->order->delete_by_id($ID_ORDER);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('NOMOR_ORDER') == '')
		{
			$data['inputerror'][] = 'NOMOR_ORDER';
			$data['error_string'][] = 'Nomor barang is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TGL_ORDER') == '')
		{
			$data['inputerror'][] = 'TGL_ORDER';
			$data['error_string'][] = 'Tanggal Order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TYPE_ORDER') == '')
		{
			$data['inputerror'][] = 'TYPE_ORDER';
			$data['error_string'][] = 'Type order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('NAMA_DIKIRIM_ORDER') == '')
		{
			$data['inputerror'][] = 'NAMA_DIKIRIM_ORDER';
			$data['error_string'][] = 'Nama dikirim order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('ALAMAT_ORDER') == '')
		{
			$data['inputerror'][] = 'ALAMAT_ORDER';
			$data['error_string'][] = 'Alamat Order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('HP_FAX_ORDER') == '')
		{
			$data['inputerror'][] = 'HP_FAX_ORDER';
			$data['error_string'][] = 'Hp Fax is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('SUBTOTAL_ORDER') == '')
		{
			$data['inputerror'][] = 'SUBTOTAL_ORDER';
			$data['error_string'][] = 'Subtotal Order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('PPN_ORDER') == '')
		{
			$data['inputerror'][] = 'PPN_ORDER';
			$data['error_string'][] = 'PPn Order is required';
			$data['status'] = FALSE;
        }
        /*if($this->input->post('TOTAL_ORDER') == '')
		{
			$data['inputerror'][] = 'TOTAL_ORDER';
			$data['error_string'][] = 'Total Order is required';
			$data['status'] = FALSE;
        }*/
        if($this->input->post('TGL_KIRIM_ORDER') == '')
		{
			$data['inputerror'][] = 'TGL_KIRIM_ORDER';
			$data['error_string'][] = 'Tanggal Kirim Order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('TUNAI_ORDER') == '')
		{
			$data['inputerror'][] = 'TUNAI_ORDER';
			$data['error_string'][] = 'Tunai Order is required';
			$data['status'] = FALSE;
        }
        if($this->input->post('DP_ORDER') == '')
		{
			$data['inputerror'][] = 'DP_ORDER';
			$data['error_string'][] = 'DP Order is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

