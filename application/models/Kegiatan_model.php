<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{

  public function store($foto)
  {
    $data = [
      'nama_kegiatan' => $this->input->post('nama_kegiatan'),
      'deskripsi' => $this->input->post('deskripsi'),
      'foto_kegiatan' => $foto,
      'user_id' => $this->session->id,
      'post_at' => time()
    ];
    $this->db->insert('kegiatan', $data);
  }
  public function getKegiatan()
  {
    return $this->db->order_by('id DESC')->get('kegiatan')->result();
  }
  public function getKegiatanById($id)
  {
    $this->db->select('kegiatan.id, user.username , user.id as uID, user.email, user.image , kegiatan.nama_kegiatan , kegiatan.post_at , kegiatan.deskripsi , kegiatan.user_id , kegiatan.foto_kegiatan');
    $this->db->join('user', 'kegiatan.user_id = user.id');
    $this->db->from('kegiatan');
    $this->db->where('kegiatan.id =', $id);
    $query = $this->db->get();
    // $query = $this->db->get_where('kegiatan', ['id' => $id]);
    return $query->row();
    // var_dump($query->row());
    // die;
  }
}
