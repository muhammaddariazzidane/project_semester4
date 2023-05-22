<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima_model extends CI_Model
{
  public function store()
  {
    $data = [
      'warga_id' => $this->input->post('warga_id'),
      'bantuan_id' => $this->input->post('bantuan_id'),
      'is_active' => 0,
      'printed' => 0,
      'taken' => 0
    ];
    $this->db->insert('penerima_bantuan', $data);
  }
  public function update($pID)
  {
    $data = [
      'warga_id' => $this->input->post('warga_id'),
      'bantuan_id' => $this->input->post('bantuan_id'),
      'is_active' => $this->input->post('is_active'),
      'printed' => $this->input->post('printed'),
    ];

    $this->db->where('id', $pID);
    $this->db->update('penerima_bantuan', $data);
  }
  public function getPenerima($keyword = null)
  {
    if ($keyword) {
      $this->db->select('penerima_bantuan.id as pID, warga.id as wID, warga.nama, warga.nik, warga.alamat, warga.jenis_kelamin, warga.tgl_lahir, bantuan.nama_bantuan, penerima_bantuan.is_active, bantuan.id as bID, bantuan.nominal,penerima_bantuan.printed');
      $this->db->join('bantuan', 'penerima_bantuan.bantuan_id = bantuan.id');
      $this->db->join('warga', 'penerima_bantuan.warga_id = warga.id');
      $this->db->from('penerima_bantuan');
      $this->db->where('penerima_bantuan.is_active = 1 AND penerima_bantuan.printed = 0');
      // $this->db->order_by('penerima_bantuan.id DESC');
      $this->db->like('warga.nik', $keyword);
      $query = $this->db->get();
      return $query->result();
    }
    $this->db->select('penerima_bantuan.id as pID, warga.id as wID, warga.nama, warga.nik, warga.alamat, warga.jenis_kelamin, warga.tgl_lahir, bantuan.nama_bantuan, penerima_bantuan.is_active, bantuan.id as bID,bantuan.nominal, penerima_bantuan.printed');
    $this->db->join('bantuan', 'penerima_bantuan.bantuan_id = bantuan.id');
    $this->db->join('warga', 'penerima_bantuan.warga_id = warga.id');
    $this->db->from('penerima_bantuan');
    // $this->db->where('penerima_bantuan.is_active = 1');
    $this->db->order_by('penerima_bantuan.id DESC');

    $query = $this->db->get();
    return $query->result();
  }
  public function cetakID($pID = null)
  {
    $this->db->select('penerima_bantuan.id as pID, warga.id as wID, warga.nama, warga.nik, warga.alamat, warga.jenis_kelamin, warga.tgl_lahir, bantuan.nama_bantuan, penerima_bantuan.is_active, bantuan.id as bID, bantuan.nominal');
    $this->db->join('bantuan', 'penerima_bantuan.bantuan_id = bantuan.id');
    $this->db->join('warga', 'penerima_bantuan.warga_id = warga.id');
    $this->db->from('penerima_bantuan');
    $this->db->where('penerima_bantuan.is_active = 1  AND penerima_bantuan.id =' . $pID);

    $query = $this->db->get();
    return $query->row();
  }
  public function cetakAll()
  {
    $this->db->select('penerima_bantuan.id as pID, warga.id as wID, warga.nama, warga.nik, warga.alamat, warga.jenis_kelamin, warga.tgl_lahir, bantuan.nama_bantuan, penerima_bantuan.is_active, bantuan.id as bID, bantuan.nominal, penerima_bantuan.printed');
    $this->db->join('bantuan', 'penerima_bantuan.bantuan_id = bantuan.id');
    $this->db->join('warga', 'penerima_bantuan.warga_id = warga.id');
    $this->db->from('penerima_bantuan');
    $this->db->order_by('penerima_bantuan.id DESC');

    $query = $this->db->get();
    return $query->result();
  }
  public function getByID($pID)
  {
    $this->db->select('penerima_bantuan.id as pID, warga.id as wID, warga.nama, warga.nik, warga.alamat, warga.jenis_kelamin, warga.tgl_lahir, bantuan.nama_bantuan, penerima_bantuan.is_active,penerima_bantuan.printed, bantuan.id as bID, bantuan.nominal');
    $this->db->join('bantuan', 'penerima_bantuan.bantuan_id = bantuan.id');
    $this->db->join('warga', 'penerima_bantuan.warga_id = warga.id');
    $this->db->from('penerima_bantuan');
    $this->db->where('penerima_bantuan.id =' . $pID);

    $query = $this->db->get();
    return $query->row();
  }
}
