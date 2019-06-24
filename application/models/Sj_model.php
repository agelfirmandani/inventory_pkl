<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sj_model extends CI_Model {

	var $table = 'tb_surat_jalan';
	var $column_order = array('CB_NAMA','NAMA_ORDER','NOMOR_SJ','JENIS_SJ','TGL_SJ','TGL_KIRIM_SJ','EKSPEDISI_SJ',null); //set column field database for datatable orderable
	var $column_search = array('CB_NAMA','NAMA_ORDER','NOMOR_SJ','JENIS_SJ','TGL_SJ','TGL_KIRIM_SJ','EKSPEDISI_SJ'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('ID_SJ' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    function get_idcabang()
    {
        // ambil data dari db
        $this->db->order_by('CB_ID', 'asc');
        $result = $this->db->get('tb_cabang');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->CB_ID] = $row->CB_NAMA;
            }
        }
        return $data;
    }
    function get_idorder()
    {
        // ambil data dari db
        $this->db->order_by('ID_ORDER', 'asc');
        $result = $this->db->get('tb_order');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_ORDER] = $row->NAMA_DIKIRIM_ORDER;
            }
        }
        return $data;
    }
    
	private function _get_datatables_query()
	{
		$this->db->select('tb_surat_jalan.*,tb_cabang.CB_NAMA as CB_NAMA
							,tb_order.NAMA_DIKIRIM_ORDER as NAMA_ORDER');
		$this->db->join('tb_cabang','tb_cabang.CB_ID = tb_surat_jalan.CB_ID','left');
		$this->db->join('tb_order','tb_order.ID_ORDER = tb_surat_jalan.ID_ORDER','left');
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('ID_SJ',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('ID_SJ', $id);
		$this->db->delete($this->table);
	}
	public function kode(){
		$this->db->select('RIGHT(tb_surat_jalan.NOMOR_SJ,2) as NOMOR_SJ', FALSE);
		$this->db->order_by('NOMOR_SJ','ASC');    
		$this->db->limit(1);    
		$query = $this->db->get('tb_surat_jalan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			 //cek kode jika telah tersedia    
			 $data = $query->row();      
			 $kode = intval($data->NOMOR_SJ) + 1; 
		}
		else{      
			 $kode = 1;  //cek jika kode belum terdapat pada table
		}
			$tgl=date('dmY'); 
			$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			$kodetampil = "SJ"."5".$tgl.$batas;  //format kode
			return $kodetampil;  
	   }


}
