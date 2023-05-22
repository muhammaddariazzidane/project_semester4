<div class="container-fluid">

  <!-- khusus admin -->
  <?php if ($this->session->role_id == 1) : ?>
    <!-- modal create -->
    <?php $this->load->view('components/modal/modal_penerima') ?>
    <!-- modal create -->
    <h4 class="pt-4">Data penerima BLT</h4>

    <!-- alert info -->
    <?php $this->load->view('components/alert/info') ?>
    <!-- alert info -->
    <!-- alert sukses -->
    <?php $this->load->view('components/alert/success') ?>
    <!-- alert sukses -->
    <!-- alert warning -->
    <?php $this->load->view('components/alert/warning') ?>
    <!-- alert warning -->
    <!-- alert error -->
    <?= validation_errors() ? $this->load->view('components/alert/error', '', true) : '' ?>
    <!-- alert error -->


    <div class="d-flex justify-content-between my-3">
      <!-- <div class="d-flex gap-3"> -->
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal3">
        Tambah penerima BLT
      </button>
      <!-- </div> -->
      <a href="<?= base_url('pdf/cetak_data_penerima') ?>" class="btn btn-dark shadow d-flex gap-2"><span>Cetak</span><i style="color: red;" class="fas fs-6 fa-file-pdf"></i></a>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered rounded-4 text-center table-hover shadow">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIK</th>
            <th scope="col">Tgl Lahir</th>
            <th scope="col">Jenis kelamin</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nama Bantuan</th>
            <th scope="col">Aktif</th>
            <th scope="col">Status</th>
            <th scope="col">Pengaturan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($penerima as $p) : ?>
            <tr>
              <th scope="row"><?= $i++ ?></th>
              <td><?= $p->nama ?></td>
              <td><?= $p->nik ?></td>
              <td><?= $p->tgl_lahir ?></td>
              <td><?= $p->jenis_kelamin ?></td>
              <td><?= $p->alamat ?></td>
              <td><?= $p->nama_bantuan ?></td>
              <td>
                <div class="form-check">
                  <input class="form-check-input " type="checkbox" disabled id="flexCheckChecked" <?= cek_aktif($p->is_active, $p->pID) ?>>
                </div>
              </td>
              <?= ($p->printed == 0) ? '<td>Belum dicetak</td>' : '<td>Dicetak</td>' ?>


              <td>
                <a class="badge <?= $p->is_active ? 'text-bg-danger' : 'text-bg-success' ?> pb-2" href="<?= base_url('penerima_bantuan/updateAktif/') . $p->pID ?>"><?= $p->is_active ? 'Nonaktif' : 'Aktivasi' ?></a>
              </td>
              <td class="d-flex gap-1 justify-content-center align-items-center">
                <a onclick="return confirm('yakin mau hapus data penerima bantuan?')" href="<?= base_url('penerima_bantuan/delete/') . $p->pID ?>" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="<?= base_url('penerima_bantuan/edit/') . $p->pID ?>" class="btn btn-sm btn-primary">
                  <i class="fas fa-pencil-alt"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>
</div>
<?php endif ?>


<!-- khusus RT -->
<?php if ($this->session->role_id == 2) : ?>
  <!-- alert info -->
  <?php $this->load->view('components/alert/info') ?>
  <!-- alert info -->
  <!-- alert sukses -->
  <?php $this->load->view('components/alert/success') ?>
  <!-- alert sukses -->
  <!-- alert warning -->
  <?php $this->load->view('components/alert/warning') ?>
  <!-- alert warning -->
  <!-- alert error -->
  <?= validation_errors() ? $this->load->view('components/alert/error', '', true) : '' ?>
  <!-- alert error -->

  <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal4" type="button">Tambah pengajuan</button>

  <?php $this->load->view('components/modal/modal_pengajuan') ?>
  <!-- khusus RT -->
<?php endif ?>
</div>