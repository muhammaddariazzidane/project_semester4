<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bantuan_model extends CI_Model
{
  public function store()
  {
    $data = [
      'nama_bantuan' => $this->input->post('nama_bantuan'),
      'jenis' => $this->input->post('jenis'),
      // 'jenis' => $this->input->post('jenis'),
    ];
    if ($this->input->post('nominal')) {
      $data['nominal'] = $this->input->post('nominal');
    }
    // var_dump($data);
    $this->db->insert('bantuan', $data);
    $this->session->set_flashdata('success', 'Berhasil menambahkan bantuan');
  }
}
