<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function delete($id)
  {

    // Menghapus gambar
    $data['berita'] = $this->db->get_where('berita', ['id' => $id])->row();
    unlink(FCPATH . 'assets/img/berita/' . $data['berita']->foto_berita);

    // Menghapus komentar
    $this->db->delete('comment_berita', ['berita_id' => $id]);

    // Menghapus berita
    $this->db->delete('berita', ['id' => $id]);

    $this->session->set_flashdata('success', 'Berhasil Menghapus berita');
    redirect('dashboard/berita');
  }
}
