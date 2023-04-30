<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH . '/libraries/phpqrcode/qrlib.php'; //mengimpor library PHP QR Code

class Pdf extends CI_Controller
{


  public function cetak($pID = null)
  {
    $data['penerima'] = $this->Penerima_model->cetakID($pID);

    $penerima = $data['penerima']->pID;
    $this->db->set('printed', 1);

    $this->db->where('id', $penerima);
    $this->db->update('penerima_bantuan');


    $sroot = $_SERVER['DOCUMENT_ROOT'];
    include $sroot . "/desa-tambaksari/application/third_party/dompdf/autoload.inc.php";
    $dompdf = new Dompdf\Dompdf();
    $this->load->view('pdf', $data);
    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    $html = $this->output->get_output();
    $dompdf->set_paper($paper_size, $orientation);
    //Convert to PDF
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("bukti-penerima-bantuan.pdf", array('Attachment' => 0));
  }
  public function cetak_all()
  {
    $data['penerima'] = $this->Penerima_model->cetakAll();
    // var_dump($data['penerima'][0]->nama);
    // die;
    $sroot = $_SERVER['DOCUMENT_ROOT'];
    include $sroot . "/desa-tambaksari/application/third_party/dompdf/autoload.inc.php";
    $dompdf = new Dompdf\Dompdf();
    $this->load->view('cetak/all', $data);
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
