<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH . '/libraries/phpqrcode/qrlib.php'; //mengimpor library PHP QR Code

class Pdf extends CI_Controller
{
  public function cetak($pID)
  {
    $data['penerima'] = $this->Penerima_model->cetakID($pID);

    $id = $data['penerima']->pID;
    $nama = $data['penerima']->nama;

    $this->db->set('printed', 1);
    $this->db->where('id', $id);
    $this->db->update('penerima_bantuan');

    $sroot = $_SERVER['DOCUMENT_ROOT'];
    include $sroot . "/desa-tambaksari/application/third_party/dompdf/autoload.inc.php";
    $dompdf = new Dompdf\Dompdf();
    $this->load->view('cetak/bukti_penerima', $data);
    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    $html = $this->output->get_output();
    $dompdf->set_paper($paper_size, $orientation);
    //Convert to PDF
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("bukti-penerima-BLT-$nama.pdf", array('Attachment' => 0));
  }
  public function cetak_data_penerima()
  {
    $data['penerima'] = $this->Penerima_model->cetakAll();

    $sroot = $_SERVER['DOCUMENT_ROOT'];
    include $sroot . "/desa-tambaksari/application/third_party/dompdf/autoload.inc.php";
    $dompdf = new Dompdf\Dompdf();
    $this->load->view('cetak/data_penerima', $data);
    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    $html = $this->output->get_output();
    $dompdf->set_paper($paper_size, $orientation);
    //Convert to PDF
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("data-penerima-BLT.pdf", array('Attachment' => 0));
  }
  public function cetak_data_warga()
  {
    $data['warga'] = $this->db->order_by('id DESC')->get('warga')->result();
    // var_dump($data['warga']);
    // die;
    $sroot = $_SERVER['DOCUMENT_ROOT'];
    include $sroot . "/desa-tambaksari/application/third_party/dompdf/autoload.inc.php";
    $dompdf = new Dompdf\Dompdf();
    $this->load->view('cetak/data_warga', $data);
    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    $html = $this->output->get_output();
    $dompdf->set_paper($paper_size, $orientation);
    //Convert to PDF
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("data-penerima-BLT.pdf", array('Attachment' => 0));
  }
}
