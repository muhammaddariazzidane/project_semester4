<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    // jika yang mengakses bukan warga
    if ($this->session->role_id != 3) {
      $email = $this->session->email;
      $data['user'] = $this->Profile_model->getuser($email);
      $data['penerima'] = $this->Penerima_model->getPenerima();

      $this->form_validation->set_rules('warga_id', 'Nama Warga', 'required');
      $this->form_validation->set_rules('bantuan_id', 'Bantuan yang di dapat', 'required');

      if ($this->form_validation->run() == false) {
        // ini view yang akan di tampilkan
        $data['content'] = $this->load->view('dashboard/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Semua field harus terisi');
        // redirect('dashboard');
      } else {
        $warga_id = $this->input->post('warga_id');
        $bantuan_id = $this->input->post('bantuan_id');
        $role_id = $this->session->role_id;


        if ($role_id == 1) {
          $penerima = $this->db->get_where(
            'penerima_bantuan',
            [
              'warga_id' => $warga_id,
              'bantuan_id' => $bantuan_id
            ]
          )->row();

          if ($penerima->is_active == 1) {
            if ($penerima->printed == 1) {
              $this->session->set_flashdata('info', 'Penerima BLT sudah mengambil BLT');
              redirect('dashboard');
            }
            $this->session->set_flashdata('info', 'Penerima BLT sudah ada');
            redirect('dashboard');
          } else {
            // insert jika data belum ada
            if ($penerima->warga_id == $warga_id) {
              $this->session->set_flashdata('info', 'Penerima BLT sudah ada');
              redirect('dashboard');
              // var_dump($penerima->warga_id);
              // die;
            } else {

              $data = [
                'warga_id' => $this->input->post('warga_id'),
                'bantuan_id' => $this->input->post('bantuan_id'),
                'is_active' => 1,
                'printed' => 0
              ];
              $this->db->insert('penerima_bantuan', $data);
              $this->session->set_flashdata('success', 'berhasil menambahkan penerima BLT');
              redirect('dashboard');
            }
            # code...
          }
        } else {
          // jika rt yang mengajukan
          $penerima = $this->db->get_where(
            'penerima_bantuan',
            [
              'warga_id' => $warga_id,
              'bantuan_id' => $bantuan_id
            ]
          )->row();

          if ($penerima) {
            // cek warga penerima blt sudah di aktivasi atau belum
            if ($penerima->is_active != 1) {

              $this->session->set_flashdata('warning', 'Silahkan tunggu warga tersebut diaktivasi oleh admin');
              redirect('dashboard');
            } else {
              $this->session->set_flashdata('warning', 'Data warga penerima BLT sudah ada');
              redirect('dashboard');
            }
            // jika warga sudah cetak
            if ($penerima->printed == 1) {
              $this->session->set_flashdata('warning', 'Warga sudah mengambil BLT, tidak dapat diajukan lagi');
              redirect('dashboard');
            }
          } else {
            // var_dump($warga_id);
            // die;
            // insert jika data belum ada
            // $this->Penerima_model->store();
            $this->session->set_flashdata('success', 'berhasil mengajukan warga, silahkan tunggu diaktivasi oleh admin');
            redirect('dashboard');
          }
        }
      }
    } else {
      // jika user biasa akan mengakses method ini
      show_error('Forbidden', 403);
      // redirect('/');
    }
  }
  public function data()
  {
    $data['admin'] = $this->db->get_where('user', ['role_id' => 1])->num_rows();
    $data['rt'] = $this->db->get_where('user', ['role_id' => 2])->num_rows();
    $data['users'] = $this->db->get_where('user', ['role_id' => 3])->num_rows();
    $data['all'] = $this->User_model->getUsers();
    $email = $this->session->email;
    $data['user'] = $this->Profile_model->getuser($email);
    // var_dump($data['user']);
    // die;
    $data['content'] = $this->load->view('data/index', $data, true);
    // ini adalah layout nya
    $this->load->view('layouts/dashboard', $data);
    $this->session->set_flashdata('error', 'Isi data warga dengan benar');
  }
  public function warga()
  {
    if ($this->session->role_id != 3) {

      $data['warga'] = $this->db->order_by('id DESC')->get('warga')->result();
      $email = $this->session->email;
      $data['user'] = $this->Profile_model->getuser($email);

      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('nik', 'Nik', 'required|is_unique[warga.nik]');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('status_perkawinan', 'Status perkawinan', 'required');
      $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');

      if ($this->form_validation->run() == false) {
        // 
        $data['content'] = $this->load->view('warga/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Isi data warga dengan benar');
        // 
      } else {
        // insert data warga
        $this->Warga_model->store();
        $this->session->set_flashdata('success', 'Berhasil menambahkan data warga');
        redirect('dashboard/warga');
      }
    } else {
      // jika user biada akan mengakses method ini
      show_error('Forbidden', 403);
    }
  }
  public function bantuan()
  {
    if ($this->session->role_id == 1) {
      $data['bantuan'] = $this->db->get('bantuan')->result();
      $email = $this->session->email;
      $data['user'] = $this->Profile_model->getuser($email);

      $this->form_validation->set_rules('nama_bantuan', 'Nama Bantuan', 'required|max_length[10]');
      $this->form_validation->set_rules('jenis', 'Jenis', 'required|max_length[10]');

      if ($this->form_validation->run() == false) {
        $data['content'] = $this->load->view('bantuan/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Isi data bantuan dengan benar');
        // $this->load->view('welcome_message');
      } else {
        $this->Bantuan_model->store();
        redirect('dashboard/bantuan');
      }
    } else {
      if ($this->session->role_id == 3) {
        $this->load->view('errors/html/error_403');
      }
      redirect('dashboard');
    }
  }
  public function kegiatan()
  {
    if ($this->session->role_id != 3) {
      // mengambil data kegiatan
      $data['kegiatan'] = $this->Kegiatan_model->getKegiatan();
      $email = $this->session->email;
      $data['user'] = $this->Profile_model->getuser($email);

      $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|max_length[15]');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

      if ($this->form_validation->run() == false) {
        // ini view
        $data['content'] = $this->load->view('kegiatan/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Semua field harus terisi dengan benar');
      } else {

        // menangkap field foto_kegiatan dan mengambil nama gambar nya
        $foto = $_FILES['foto_kegiatan']['name'];
        if ($foto) {
          // config untuk upload gambar
          $upload_config['upload_path'] = './assets/img/kegiatan/';
          $upload_config['allowed_types'] = 'gif|jpg|png';
          $upload_config['max_size'] = 12048; // 2MB
          $upload_config['encrypt_name'] = TRUE;

          $this->load->library('upload', $upload_config);

          if ($this->upload->do_upload('foto_kegiatan')) {
            $foto = $this->upload->data();
            $foto = $foto['file_name'];
            $this->Kegiatan_model->store($foto);
            $this->session->set_flashdata('success', 'Berhasil Menambahkan kegiatan');
            redirect('dashboard/kegiatan');
          } else {
            echo $this->upload->display_errors();
          }
        }
      }
    } else {
      $this->load->view('errors/html/error_403');
    }
  }
  public function berita()
  {
    if ($this->session->role_id != 3) {
      // mengambil data kegiatan
      $email = $this->session->email;
      $data['berita'] = $this->Berita_model->getBerita();
      $data['user'] = $this->Profile_model->getuser($email);

      $this->form_validation->set_rules('nama_berita', 'Nama Berita', 'required|max_length[20]');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

      if ($this->form_validation->run() == false) {
        // ini view
        $data['content'] = $this->load->view('berita/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Semua field harus terisi dengan benar');
      } else {
        // menangkap field foto_kegiatan dan mengambil nama gambar nya
        $foto = $_FILES['foto_berita']['name'];
        if ($foto) {
          // config untuk upload gambar
          $upload_config['upload_path'] = './assets/img/berita/';
          $upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
          $upload_config['max_size'] = 12048; // 2MB
          $upload_config['encrypt_name'] = TRUE;

          $this->load->library('upload', $upload_config);

          if ($this->upload->do_upload('foto_berita')) {
            $foto = $this->upload->data();
            $foto = $foto['file_name'];
            $this->Berita_model->store($foto);
            $this->session->set_flashdata('success', 'Berhasil Menambahkan Berita');
            redirect('dashboard/berita');
          } else {
            echo $this->upload->display_errors();
          }
        }
      }
    } else {
      $this->load->view('errors/html/error_403');
    }
  }
  public function wisata()
  {
    if ($this->session->role_id == 1) {
      // mengambil data kegiatan
      $data['wisata'] = $this->db->get('wisata')->result();
      $email = $this->session->email;
      $data['user'] = $this->Profile_model->getuser($email);
      $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

      if ($this->form_validation->run() == false) {
        // ini view
        $data['content'] = $this->load->view('wisata/index', $data, true);
        // ini adalah layout nya
        $this->load->view('layouts/dashboard', $data);
        $this->session->set_flashdata('error', 'Semua field harus terisi dengan benar');
      } else {
        $this->Wisata_model->store();
      }
    } else {
      $this->load->view('errors/html/error_403');
    }
  }
}
