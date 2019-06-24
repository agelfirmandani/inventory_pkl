<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

	var $table = 'tb_stok';
	var $column_order = array('ID_STOK','NAMA_GDG','NAMA_BRG','NO_SERI','JUMLAH',null); //set column field database for datatable orderable
	var $column_search = array('ID_STOK','NAMA_GDG','NAMA_BRG','NO_SERI','JUMLAH'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('ID_STOK' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    function get_idgudang()
    {
        // ambil data dari db
        $this->db->order_by('ID_GDG', 'asc');
        $result = $this->db->get('tb_gudang');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_GDG] = $row->NAMA_GDG;
            }
        }
        return $data;
    }
    function get_idbarang()
    {
        // ambil data dari db
        $this->db->order_by('ID_BRG', 'asc');
        $result = $this->db->get('tb_barang');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_BRG] = $row->NAMA_BRG;
            }
        }
        return $data;
    }
    
	private function _get_datatables_query()
	{
		$this->db->select('tb_stok.*,tb_gudang.NAMA_GDG as NAMA_GDG,
						   tb_barang.NAMA_BRG as NAMA_BRG');
		$this->db->join('tb_gudang','tb_gudang.ID_GDG = tb_stok.ID_GDG','left');
		$this->db->join('tb_barang','tb_barang.ID_BRG = tb_stok.ID_BRG','left');		
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
		$this->db->where('ID_STOK',$id);
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
		$this->db->where('ID_STOK', $id);
		$this->db->delete($this->table);
	}

	public function kode(){
		$this->db->select('RIGHT(tb_stok.NO_SERI,2) as NO_SERI', FALSE);
		$this->db->order_by('NO_SERI','ASC');    
		$this->db->limit(1);    
		$query = $this->db->get('tb_stok');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			 //cek kode jika telah tersedia    
			 $data = $query->row();      
			 $kode = intval($data->NO_SERI) + 1; 
		}
		else{      
			 $kode = 1;  //cek jika kode belum terdapat pada table
		}
			$tgl=date('dmY'); 
			$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			$kodetampil = "ST"."5".$tgl.$batas;  //format kode
			return $kodetampil;  
	   }
}
