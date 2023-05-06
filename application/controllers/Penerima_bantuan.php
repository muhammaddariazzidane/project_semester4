<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima_bantuan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function updateAktif($pID = null)
  {
    $penerima = $this->db->get_where('penerima_bantuan', ['id' => $pID])->row();
    if ($penerima) {
      if ($penerima->is_active) {
        $data = [
          'is_active' => 0
        ];
        $this->db->where('id', $penerima->id);
        $this->db->update('penerima_bantuan', $data);
        $this->session->set_flashdata('success', 'berhasil menonaktivasi penerima BLT');

        redirect('dashboard');
      } else {
        $data = [
          'is_active' => 1
        ];
        $this->db->where('id', $penerima->id);
        $this->db->update('penerima_bantuan', $data);
        $this->session->set_flashdata('success', 'berhasil mengaktivasi penerima BLT');

        redirect('dashboard');
      }
    }
  }

  public function edit($pID)
  {
    $data['data'] = $this->Penerima_model->getByID($pID);

    $email = $this->session->email;
    $data['user'] = $this->Profile_model->getuser($email);
    $this->form_validation->set_rules('is_active', 'Aktif', 'required');
    $this->form_validation->set_rules('warga_id', 'Warga', 'required');
    $this->form_validation->set_rules('bantuan_id', 'Bantuan', 'required');

    if ($this->form_validation->run() == false) {
      // ini view yang akan di tampilkan
      $data['content'] = $this->load->view('penerima/edit', $data, true);
      // ini adalah layout nya
      $this->load->view('layouts/dashboard', $data);
    } else {
      $this->Penerima_model->update($pID);
      $this->session->set_flashdata('success', 'Berhasil mengubah data penerima bantuan');
      redirect('dashboard');
    }
  }
  public function delete($pID = null)
  {
    // $this->db->where('id', $pID);
    $this->db->delete('penerima_bantuan', ['id' => $pID]);
    $this->session->set_flashdata('success', 'Berhasil menghapus data penerima bantuan');
    redirect('dashboard');
  }
}
