<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Model_user extends CI_Model {

        public function cek_user($data) {
            $query = $this->db->get_where('tb_admin', $data);
            return $query;
        }
        public function prosesregister($user,$pass, $level){
        $data = array(
          'username' => $user,
          'password' => $pass,
          'level' => $level
        );
        $this->db->insert('tb_admin',$data);
    }
    }

?>