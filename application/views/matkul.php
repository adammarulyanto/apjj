

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mata Kuliah</h1>
    <p class="mb-4">Data Mata Kuliah yang tersedia pada database Nusamandiri.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Matkul</h6>
      </div>
      <div class="card-body">
        <form action="<?=base_url()?>api/matkul" method="post" id="tambah-matkul">
          <div class="form-tambah">
            <div class="form-tambah-kolom">
              <label>Name</label>
              <input type="text" class="form-control" name="matkul_name">
            </div>
            <div class="form-tambah-kolom">
              <label>SKS</label>
              <input type="number" class="form-control" name="matkul_sks">
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Matkul</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>SKS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($list_matkul as $list_matkul) {
              ?>
              <tr>
                <td><?=$list_matkul->matkul_code;?></td>
                <td><?=$list_matkul->matkul_name;?></td>
                <td><?=$list_matkul->matkul_sks;?></td>
                <td>
                  <a type="submit" href="<?=base_url()?>api/dosen/delete?dosen_code=<?=$list_matkul->matkul_code?>" class="btn btn-danger btn-circle btn-sm">
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
