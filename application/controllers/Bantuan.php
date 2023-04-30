<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bantuan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function delete($id)
  {
    $this->db->delete('bantuan', ['id' => $id]);
    $this->session->set_flashdata('success', 'Berhasil menghapus bantuan');
    redirect('dashboard/bantuan');
  }
}
