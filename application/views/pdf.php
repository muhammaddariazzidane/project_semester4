<!DOCTYPE html>
<html lang="en">

<head>
  <title>Document</title>
  <style>
    html {
      box-sizing: border-box;
    }

    .table-line {
      width: 100%;
      border-collapse: collapse;
      /* border-bottom: 1px solid red; */
      margin-bottom: 40px;
    }

    .table-line th {
      background: green;
      color: #FFFFFF;
      padding: 1em;
      text-align: left;
      text-transform: uppercase;
      text-align: center;
    }

    .table-line td {
      border: 1px solid green;
      text-align: center;
      color: black;
      padding: 1em;
    }
  </style>
</head>

<body>
  <div style="background-color: #ddd; padding: 2rem; border-radius: 50%; ">
    <h2 align=" center" style="margin-top:  -1px; text-transform: uppercase;">Bukti penerima bantuan</h2>
    <div>
      <table align=" center" class="table-line">
        <thead>
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">NIK</th>
            <th scope="col">TGL Lahir</th>
            <th scope="col">jenis kelamin</th>
            <th scope="col">Alamat</th>
            <th scope="col">Bantuan</th>
            <th scope="col">Nominal</th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <td><?= $penerima->nama ?></td>
            <td><?= $penerima->nik ?></td>
            <td><?= $penerima->tgl_lahir ?></td>
            <td><?= $penerima->jenis_kelamin ?></td>
            <td><?= $penerima->alamat ?></td>
            <td><?= $penerima->nama_bantuan ?></td>
            <td><?= $penerima->nominal ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>