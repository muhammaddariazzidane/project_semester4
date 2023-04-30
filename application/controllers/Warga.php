<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function store()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('nik', 'Nik', 'required|is_unique[warga.nik]');
    $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('agama', 'Agama', 'required');
    $this->form_validation->set_rules('status_perkawinan', 'Status perkawinan', 'required');
    $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');

    if ($this->form_validation->run() == false) {

      $this->session->set_flashdata('error', 'Isi data warga dengan benar');
      redirect('dashboard/warga');
    } else {
      // insert data warga
      $this->Warga_model->store();
      $this->session->set_flashdata('success', 'Berhasil menambahkan data warga');
      redirect('dashboard/warga');
    }
  }

  public function delete($id)
  {
    // $this->db->delete('warga', ['id' => $id]);
    // $this->session->set_flashdata('success', 'Berhasil menghapus data warga');
    // redirect('warga');

    // menghapus 2 tabel sekaligus
    $this->db->delete('warga', ['id' => $id]);
    if ($this->db->affected_rows() > 0) {
      $this->db->delete('penerima_bantuan', ['warga_id' => $id]);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Berhasil menghapus data warga');
      } else {
        $this->session->set_flashdata('error', 'Gagal menghapus data penerima bantuan');
      }
    } else {
      $this->session->set_flashdata('error', 'Gagal menghapus data warga');
    }
    redirect('dashboard/warga');
  }
}
