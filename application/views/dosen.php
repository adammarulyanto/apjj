

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dosen</h1>
    <p class="mb-4">Data dosen yang tersedia pada database Nusamandiri.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Dosen</h6>
      </div>
      <div class="card-body">
        <form action="<?=base_url()?>api/dosen" method="post" id="tambah-dosen">
          <div class="form-tambah">
            <div class="form-tambah-kolom">
              <label>Firstname</label>
              <input type="text" class="form-control" name="dosen_firstname">
            </div>
            <div class="form-tambah-kolom">
              <label>Lastname</label>
              <input type="text" class="form-control" name="dosen_lastname">
            </div>
            <div class="form-tambah-kolom">
              <label>Birth Date</label>
              <input type="date" class="form-control" name="dosen_birthdate">
            </div>
            <div class="form-tambah-kolom">
              <label>Email</label>
              <input type="email" class="form-control" name="dosen_email">
            </div>
            <div class="form-tambah-kolom">
              <label>Password</label>
              <input type="password" class="form-control" name="dosen_password">
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Dosen</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Code</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Birth Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($list_dosen as $list_dosen) {
              ?>
              <tr>
                <td><?=$list_dosen->dosen_code;?></td>
                <td><?=$list_dosen->dosen_firstname;?> <?=$list_dosen->dosen_lastname;?></td>
                <td><?=$list_dosen->dosen_email;?></td>
                <td><?=$list_dosen->dosen_birthdate;?></td>
                <td>
                  <a type="submit" href="<?=base_url()?>dosen/delete?dosen_code=<?=$list_dosen->dosen_code?>" class="btn btn-danger btn-circle btn-sm">
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
