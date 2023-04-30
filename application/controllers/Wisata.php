
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{


  public function delete($id)
  {
    is_logged_in();
    // Ambil data wisata berdasarkan id
    $wisata = $this->db->get_where('wisata', ['id' => $id])->row();

    // Hapus file foto pertama
    unlink(FCPATH . 'assets/img/wisata/' . $wisata->foto_pertama);

    // Hapus file foto kedua jika ada
    if ($wisata->foto_kedua) {
      unlink(FCPATH . 'assets/img/wisata/' . $wisata->foto_kedua);
    }

    // Hapus file foto ketiga jika ada
    if ($wisata->foto_ketiga) {
      unlink(FCPATH . 'assets/img/wisata/' . $wisata->foto_ketiga);
    }

    // Hapus data dari tabel wisata berdasarkan id
    // $this->db->where('id', $id);
    $this->db->delete('wisata', ['id' => $id]);

    // Tampilkan pesan berhasil dan redirect ke halaman wisata
    $this->session->set_flashdata('success', 'Data wisata berhasil dihapus');
    redirect('dashboard/wisata');
  }
}
