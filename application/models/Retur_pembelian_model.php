<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_pembelian_model extends CI_Model {

	var $table = 'tb_retur_pembelian';
	var $column_order = array('ID_RETUR_PEMBELIAN','JENIS_PENERIMAAN_BRG','CB_NAMA','NOMOR_RETUR_PEMBELIAN',null);
	var $column_search = array('ID_RETUR_PEMBELIAN','JENIS_PENERIMAAN_BRG','CB_NAMA','NOMOR_RETUR_PEMBELIAN');
	var $order = array('ID_RETUR_PEMBELIAN' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    function get_idpenerimaan()
    {
        // ambil data dari db
        $this->db->order_by('ID_PENERIMAAN_BRG', 'asc');
        $result = $this->db->get('tb_penerimaan_barang');
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $data[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $data[$row->ID_PENERIMAAN_BRG] = $row->JENIS_PENERIMAAN_BRG;
            }
        }
        return $data;
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
    
	private function _get_datatables_query()
	{
		
		$this->db->select('tb_retur_pembelian.*,tb_penerimaan_barang.JENIS_PENERIMAAN_BRG as JENIS_PENERIMAAN_BRG,
						   tb_cabang.CB_NAMA as CB_NAMA');
		$this->db->join('tb_penerimaan_barang','tb_penerimaan_barang.ID_PENERIMAAN_BRG = tb_retur_pembelian.ID_PENERIMAAN_BRG','left');
		$this->db->join('tb_cabang','tb_cabang.CB_ID = tb_retur_pembelian.CB_ID','left');	
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
		$this->db->where('ID_RETUR_PEMBELIAN',$id);
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
		$this->db->where('ID_RETUR_PEMBELIAN', $id);
		$this->db->delete($this->table);
	}


}
