<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	var $table = 'tb_barang';
	var $column_order = array('NAMA_BRAND','NAMA_SATUAN','NAMA_CATEGORY','NAMA_JNS_BRG','NAMA_BRG','STOK',null);
	//'ID_SATUAN','ID_CATEGORY','ID_JNS_BRG','NOMOR_BRG','NAMA_BRG','HARGA_BELI','HARGA_JUAL','STOK',null); //set column field database for datatable orderable
	var $column_search = array('NAMA_BRAND','NAMA_SATUAN','NAMA_CATEGORY','NAMA_JNS_BRG','NAMA_BRG','STOK');
	//'ID_SATUAN','ID_CATEGORY','ID_JNS_BRG','NOMOR_BRG','NAMA_BRG','HARGA_BELI','HARGA_JUAL','STOK'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('ID_BRG' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    function get_id_brand()
    {
        // ambil data dari db
        $this->db->order_by('ID_BRAND', 'asc');
        $result = $this->db->get('tb_brand');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_BRAND] = $row->NAMA_BRAND;
            }
        }
        return $data;
    }
    function get_id_satuan()
    {
        // ambil data dari db
        $this->db->order_by('ID_SATUAN', 'asc');
        $result = $this->db->get('tb_satuan');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_SATUAN] = $row->NAMA_SATUAN;
            }
        }
        return $data;
    }
    function get_id_category()
    {
        // ambil data dari db
        $this->db->order_by('ID_CATEGORY', 'asc');
        $result = $this->db->get('tb_category');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_CATEGORY] = $row->NAMA_CATEGORY;
            }
        }
        return $data;
    }
    function get_id_jns_brg()
    {
        // ambil data dari db
        $this->db->order_by('ID_JNS_BRG', 'asc');
        $result = $this->db->get('tb_jns_brg');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_JNS_BRG] = $row->NAMA_JNS_BRG;
            }
        }
        return $data;
    }
	private function _get_datatables_query()
	{
		
		$this->db->select('tb_barang.*,tb_brand.NAMA_BRAND as NAMA_BRAND,
						   tb_satuan.NAMA_SATUAN as NAMA_SATUAN,
						   tb_category.NAMA_CATEGORY as NAMA_CATEGORY,
						   tb_jns_brg.NAMA_JNS_BRG as NAMA_JNS_BRG');
		$this->db->join('tb_brand','tb_brand.ID_BRAND = tb_barang.ID_BRAND','left');
		$this->db->join('tb_satuan','tb_satuan.ID_SATUAN = tb_barang.ID_SATUAN','left');		
		$this->db->join('tb_category','tb_category.ID_CATEGORY = tb_barang.ID_CATEGORY','left');		
		$this->db->join('tb_jns_brg','tb_jns_brg.ID_JNS_BRG = tb_barang.ID_JNS_BRG','left');		
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
		$this->db->where('ID_BRG',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function get_detail_id($id)
	{
		$this->db->select('tb_barang.*,tb_brand.NAMA_BRAND as NAMA_BRAND,
						   tb_satuan.NAMA_SATUAN as NAMA_SATUAN,
						   tb_category.NAMA_CATEGORY as NAMA_CATEGORY,
						   tb_jns_brg.NAMA_JNS_BRG as NAMA_JNS_BRG');
		$this->db->join('tb_brand','tb_brand.ID_BRAND = tb_barang.ID_BRAND','left');
		$this->db->join('tb_satuan','tb_satuan.ID_SATUAN = tb_barang.ID_SATUAN','left');		
		$this->db->join('tb_category','tb_category.ID_CATEGORY = tb_barang.ID_CATEGORY','left');		
		$this->db->join('tb_jns_brg','tb_jns_brg.ID_JNS_BRG = tb_barang.ID_JNS_BRG','left');		
		$this->db->from($this->table);
		$this->db->where('ID_BRG',$id);
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
		$this->db->where('ID_BRG', $id);
		$this->db->delete($this->table);
	}
	public function kode(){
		$this->db->select('RIGHT(tb_barang.NOMOR_BRG,2) as NOMOR_BRG', FALSE);
		$this->db->order_by('NOMOR_BRG','ASC');    
		$this->db->limit(1);    
		$query = $this->db->get('tb_barang');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			 //cek kode jika telah tersedia    
			 $data = $query->row();      
			 $kode = intval($data->NOMOR_BRG) + 1; 
		}
		else{      
			 $kode = 1;  //cek jika kode belum terdapat pada table
		}
			$tgl=date('dmY'); 
			$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			$kodetampil = "BRG"."5".$tgl.$batas;  //format kode
			return $kodetampil;  
	   }


}
