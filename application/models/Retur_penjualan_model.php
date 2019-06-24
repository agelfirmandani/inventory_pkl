<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_penjualan_model extends CI_Model {

	var $table = 'tb_retur_penjualan';
	var $column_order = array('CB_NAMA','JENIS_SJ','NOMOR_RETUR_PENJUALAN','STATUS_PENGEMBALIAN_BARANG','TGL_RETUR_PENJUALAN','AKSI_BAYAR_PENJUALAN','ALASAN_RETUR_PENJUALAN',null); //set column field database for datatable orderable
	var $column_search = array('CB_NAMA','JENIS_SJ','NOMOR_RETUR_PENJUALAN','STATUS_PENGEMBALIAN_BARANG','TGL_RETUR_PENJUALAN','AKSI_BAYAR_PENJUALAN','ALASAN_RETUR_PENJUALAN'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('ID_RETUR_PENJUALAN' => 'asc'); // default order 

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

    function get_idsj()
    {
        // ambil data dari db
        $this->db->order_by('ID_SJ', 'asc');
        $result = $this->db->get('tb_surat_jalan');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_SJ] = $row->EKSPEDISI_SJ;
            }
        }
        return $data;
    }
    
	private function _get_datatables_query()
	{
		$this->db->select('tb_retur_penjualan.*,tb_cabang.CB_NAMA as CB_NAMA,
						   tb_surat_jalan.JENIS_SJ as JENIS_SJ');
		$this->db->join('tb_cabang','tb_cabang.CB_ID = tb_retur_penjualan.CB_ID','left');
		$this->db->join('tb_surat_jalan','tb_surat_jalan.ID_SJ = tb_retur_penjualan.ID_SJ','left');
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
		$this->db->where('ID_SURAT_PENJUALAN',$id);
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
		$this->db->where('ID_SURAT_PENJUALAN', $id);
		$this->db->delete($this->table);
	}


}
