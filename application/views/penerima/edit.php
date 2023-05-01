<div class="container-fluid">
  <div class="row mb-2">
    <h3>Edit penerima BLT</h3>
  </div>
  <div class="row">
    <div class="col-lg-6 py-2 shadow">
      <form action="<?= base_url('penerima_bantuan/edit/') . $data->pID ?>" method="post">
        <input type="hidden" name="warga_id" value="<?= $data->wID ?>">
        <input type="hidden" name="bantuan_id" value="<?= $data->bID ?>">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Warga</label>
          <input type="text" name="nama" class="form-control" value="<?= $data->nama ?>" id="nama" readonly placeholder="nama warga">
          <div id="validationServer03Feedback" class="invalid-feedback d-block">
            <?= form_error('nama') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="nik" class="form-label">Nik</label>
          <input type="text" name="nik" class="form-control" value="<?= $data->nik ?>" id="nik" readonly placeholder="nama warga">
          <div id="validationServer03Feedback" class="invalid-feedback d-block">

          </div>
        </div>
        <div class="mb-3">
          <label for="tgl_lahir" class="form-label">Tanggal lahir</label>
          <input type="date" name="tgl_lahir" class="form-control" value="<?= $data->tgl_lahir ?>" id="tgl_lahir" readonly placeholder="nama warga">
          <div id="validationServer03Feedback" class="invalid-feedback d-block">

          </div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?= $data->alamat ?>" id="alamat" placeholder="">
          <div id="validationServer03Feedback" class="invalid-feedback d-block">

          </div>
        </div>
        <div class="mb-3">
          <label for="nama_bantuan" class="form-label">Jenis Bantuan</label>
          <input type="text" name="nama_bantuan" class="form-control" value="<?= $data->nama_bantuan ?>" id="nama_bantuan" placeholder="nama warga" readonly>
          <div id="validationServer03Feedback" class="invalid-feedback d-block">

          </div>
        </div>
        <div class="mb-3">
          <label for="printed" class="form-label">Status</label>
          <select name="printed" class="form-select" aria-label="Default select example">
            <option value="0" <?= $data->printed == 0 ? 'selected' : '' ?>>Belum dicetak</option>
            <option value="1" <?= $data->printed == 1 ? 'selected' : '' ?>>Dicetak</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="printed" class="form-label">Aktif</label>

          <div class="d-flex gap-3">
            <!-- aktif -->
            <div class="form-check">
              <input class="form-check-input" value="1" type="radio" name="is_active" id="is_active1" <?= $data->is_active == 1 ? 'checked' : '' ?>>
              <label class="form-check-label" for="is_active1">
                ya
              </label>
            </div>
            <!-- tidak aktif -->
            <div class="form-check">
              <input class="form-check-input" value="0" type="radio" name="is_active" id="is_active2" <?= $data->is_active == 0 ? 'checked' : '' ?>>
              <label class="form-check-label" for="is_active2">
                Tidak
              </label>
            </div>

          </div>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

    </form>
  </div>
</div>
</div>