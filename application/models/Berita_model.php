<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{
  public function store($foto)
  {
    $data = [
      'nama_berita' => $this->input->post('nama_berita'),
      'deskripsi' => $this->input->post('deskripsi'),
      'foto_berita' => $foto,
      'user_id' => $this->session->userdata('id'),
      'post_at' => time()
    ];
    $this->db->insert('berita', $data);
  }
  public function getBerita()
  {
    $this->db->select('berita.id, user.id as uID, user.username, user.email, user.image ,berita.nama_berita, berita.post_at, berita.deskripsi, berita.user_id, berita.foto_berita');
    $this->db->join('user', 'berita.user_id = user.id');
    $this->db->from('berita');
    $this->db->order_by('berita.id DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
