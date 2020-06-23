

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mahasiswa</h1>
    <p class="mb-4">Data Mahasiswa yang tersedia pada database Nusamandiri.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Mahasiswa</h6>
      </div>
      <div class="card-body">
        <form action="<?=base_url()?>api/mahasiswa" method="post" id="tambah-mhs">
          <div class="form-tambah">
            <div class="form-tambah-kolom">
              <label>NIM</label>
              <input type="text" class="form-control" name="mhs_nim">
            </div>
            <div class="form-tambah-kolom">
              <label>Firstname</label>
              <input type="text" class="form-control" name="mhs_firstname">
            </div>
            <div class="form-tambah-kolom">
              <label>Lastname</label>
              <input type="text" class="form-control" name="mhs_lastname">
            </div>
            <div class="form-tambah-kolom">
              <label>Birth Date</label>
              <input type="date" class="form-control" name="mhs_birthdate">
            </div>
            <div class="form-tambah-kolom">
              <label>Email</label>
              <input type="email" class="form-control" name="mhs_email">
            </div>
            <div class="form-tambah-kolom">
              <label>Password</label>
              <input type="password" class="form-control" name="mhs_password">
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Birth Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($list_mhs as $list_mhs) {
              ?>
              <tr>
                <td><?=$list_mhs->mhs_nim;?></td>
                <td><?=$list_mhs->mhs_firstname;?> <?=$list_mhs->mhs_lastname;?></td>
                <td><?=$list_mhs->mhs_email;?></td>
                <td><?=$list_mhs->mhs_birthdate;?></td>
                <td>
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
