

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelas</h1>
    <p class="mb-4">Data Kelas yang tersedia di Nusamandiri.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kelas</h6>
      </div>
      <div class="card-body">
        <form action="<?=base_url()?>api/classes" method="post" id="tambah-kelas">
          <div class="form-tambah">
            <div class="form-tambah-kolom">
              <label>Program</label>
              <select class="form-control" name="class_program">
                  <?php
                  foreach ($list_prodi as $list_prodi) {
                  ?>
                    <option value="<?=$list_prodi->prodi_code?>"><?=$list_prodi->prodi_name?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-tambah-kolom">
              <label>Guide</label>
              <select class="form-control" name="class_guide">
                  <?php
                  foreach ($list_dosen as $list_dosen) {
                  ?>
                    <option value="<?=$list_dosen->dosen_code?>"><?=$list_dosen->dosen_name?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
          </div>
          <div class="form-tambah-submit">
            <!-- <input type="submit" value="Submit" class="btn btn-success"> -->
            <button type="submit" href="#" class="btn btn-success btn-icon-split">
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Code</th>
                <th>Program</th>
                <th>Dosen</th>
                <th>Member</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($list_kelas as $list_kelas) {
              ?>
              <tr>
                <td><?=$list_kelas->class_code;?></td>
                <td><?=$list_kelas->prodi_name;?></td>
                <td><?=$list_kelas->dosen_name;?></td>
                <td><a href="#"><?=$list_kelas->jml_member;?> Member</a></td>
                <td>
                  <a type="submit" href="<?=base_url()?>api/classes/delete/<?=$list_kelas->class_code?>" class="btn btn-danger btn-circle btn-sm">
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
