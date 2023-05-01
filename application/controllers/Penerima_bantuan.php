<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima_bantuan extends CI_Controller
{
  public function store()
  {

    // $this->form_validation->set_rules('warga_id', 'Nama Warga', 'required');
    // $this->form_validation->set_rules('bantuan_id', 'Bantuan yang di dapat', 'required');

    // if ($this->form_validation->run() == false) {
    //   $this->session->set_flashdata('error', 'Semua field harus terisi');
    //   redirect('dashboard');
    // } else {
    //   $warga_id = $this->input->post('warga_id');
    //   $bantuan_id = $this->input->post('bantuan_id');
    //   $role_id = $this->session->role_id;

    //   if ($role_id == 1) {
    //     # code...
    //     $penerima = $this->db->get_where(
    //       'penerima_bantuan',
    //       [
    //         'warga_id' => $warga_id,
    //         'bantuan_id' => $bantuan_id
    //       ]
    //     )->row();

    //     if ($penerima->is_active == 1) {
    //       if ($penerima->printed == 1) {
    //         $this->session->set_flashdata('info', 'Penerima BLT sudah mengambil BLT');
    //         redirect('dashboard');
    //       }
    //       $this->session->set_flashdata('info', 'Penerima BLT sudah ada');
    //       redirect('dashboard');
    //     } else {
    //       // insert jika data belum ada
    //       if ($penerima->warga_id == $warga_id) {
    //         $this->session->set_flashdata('info', 'Penerima BLT sudah ada');
    //         redirect('dashboard');
    //         // var_dump($penerima->warga_id);
    //         // die;
    //       } else {

    //         $data = [
    //           'warga_id' => $this->input->post('warga_id'),
    //           'bantuan_id' => $this->input->post('bantuan_id'),
    //           'is_active' => 1,
    //           'printed' => 0
    //         ];
    //         $this->db->insert('penerima_bantuan', $data);
    //         $this->session->set_flashdata('success', 'berhasil menambahkan penerima BLT');
    //         redirect('dashboard');
    //       }
    //       # code...
    //     }
    //   } else {
    //     // jika rt yang mengajukan
    //     $penerima = $this->db->get_where(
    //       'penerima_bantuan',
    //       [
    //         'warga_id' => $warga_id,
    //         'bantuan_id' => $bantuan_id
    //       ]
    //     )->row();

    //     if ($penerima) {
    //       // cek warga penerima blt sudah di aktivasi atau belum
    //       if ($penerima->is_active != 1) {
    //         $this->session->set_flashdata('warning', 'Silahkan tunggu warga tersebut diaktivasi oleh admin');
    //         redirect('dashboard');
    //       } else {
    //         $this->session->set_flashdata('warning', 'Data warga penerima BLT sudah ada');
    //         redirect('dashboard');
    //       }
    //       // jika warga sudah cetak
    //       if ($penerima->printed == 1) {
    //         $this->session->set_flashdata('warning', 'Warga sudah mengambil BLT, tidak dapat diajukan lagi');
    //         redirect('dashboard');
    //       }
    //     } else {

    //       // insert jika data belum ada
    //       $this->Penerima_model->store();
    //       $this->session->set_flashdata('success', 'berhasil mengajukan warga, silahkan tunggu diaktivasi oleh admin');
    //       redirect('dashboard');
    //     }
    //   }
    // }
  }

  public function updateAktif($pID = null)
  {
    $penerima = $this->db->get_where('penerima_bantuan', ['id' => $pID])->row();
    // $this->form_validation->set_rules('wa')
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
    // $data = $this->db->get_where('penerima_bantuan', ['id' => $pID])->row();
    $data['data'] = $this->Penerima_model->getByID($pID);
    // var_dump($data);
    // die;
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
