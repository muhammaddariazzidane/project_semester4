<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function delete($id = null)
  {
    // mengambil data berdasarkan parameter $id untuk menghapus gambar nya
    $data['kegiatan'] = $this->db->get_where('kegiatan', ['id' => $id])->row();
    unlink(FCPATH . 'assets/img/kegiatan/' . $data['kegiatan']->foto_kegiatan);
    // Menghapus komentar
    $this->db->delete('comment_kegiatan', ['kegiatan_id' => $id]);
    // hapus kegiatan
    $this->db->delete('kegiatan', ['id' => $id]);
    $this->session->set_flashdata('success', 'Berhasil Menghapus kegiatan');
    redirect('dashboard/kegiatan');
  }
}
