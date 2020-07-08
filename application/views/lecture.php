

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelas Ajar</h1>
    <p class="mb-4">Data Kelas Ajar yang tersedia pada database Nusamandiri.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kelas Ajar</h6>
      </div>
      <div class="card-body">
        <form action="<?=base_url()?>api/lecture" method="post" id="tambah-dosen">
          <div class="form-tambah">
            <div class="form-tambah-kolom">
              <label>Mata Kuliah</label>
              <select class="form-control" name="matkul_code">
                  <?php
                  foreach ($list_matkul as $list_matkul) {
                  ?>
                    <option value="<?=$list_matkul->matkul_code?>"><?=$list_matkul->matkul_name?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-tambah-kolom">
              <label>Kelas</label>
              <select class="form-control" name="class_code">
                  <?php
                  foreach ($list_kelas as $list_kelas) {
                  ?>
                    <option value="<?=$list_kelas->class_code?>"><?=$list_kelas->class_code?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-tambah-kolom">
              <label>Dosen</label>
              <select class="form-control" name="dosen_code">
                  <?php
                  foreach ($list_dosen as $list_dosen) {
                  ?>
                    <option value="<?=$list_dosen->dosen_code?>"><?=$list_dosen->dosen_code?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-tambah-kolom">
              <label>Hari</label>
              <select class="form-control" name="start_day">
                  <option value="1">Senin</option>
                  <option value="2">Selasa</option>
                  <option value="3">Rabu</option>
                  <option value="4">Kamis</option>
                  <option value="5">Jumat</option>
                  <option value="6">Sabtu</option>
                  <option value="7">Minggu</option>
              </select>
            </div>
            <div class="form-tambah-kolom">
              <label>Mulai</label>
              <input type="time" class="form-control" name="start_hour">
            </div>
            <div class="form-tambah-kolom">
              <label>Berakhir</label>
              <input type="time" class="form-control" name="end_hour">
            </div>
          </div>
          <div class="form-tambah-submit">
            <!-- <input type="submit" value="Submit" class="btn btn-success"> -->
            <button type="submit" href="#" class="btn btn-success btn-icon-split" onClick="document.getElementById("tambah-dosen").submit()">
               <span class="icon text-white-50">
                 <i class="fas fa-check"></i>
               </span>
               <span class="text">Submit</span>
            </button>
            <input type="reset" value="Clear" class="btn btn-default">
          </div>
        </form>
      </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas Ajar</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Kelas</th>
                <th>Dosen</th>
                <th>Matkul(sks)</th>
                <th>Hari</th>
                <th>Waktu (dari-sampai)</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($list_lecture as $list_lecture) {
              ?>
              <tr>
                <td><?=$list_lecture->class_code;?></td>
                <td><?=$list_lecture->dosen_name;?></td>
                <td><?=$list_lecture->matkul_name;?> (<?=$list_lecture->matkul_sks;?>)</td>
                <td><?=$list_lecture->start_day;?></td>
                <td><?=$list_lecture->stat;?></td>
                <td><?=$list_lecture->start_hour;?> - <?=$list_lecture->end_hour;?></td>
                <td>
                  <a type="submit" href="<?=base_url()?>lecture/delete?lecture_id=<?=$list_lecture->lecture_id?>" class="btn btn-danger btn-circle btn-sm">
                  <i class="fas fa-trash"></i>
                </a>
                </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
