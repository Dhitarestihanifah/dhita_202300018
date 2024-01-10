<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $subjudul ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i  class="fas fa-plus"></i>Tambah Data
                </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                if (session()->getFlashdata('pesan')){
                  echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> ';
                  echo session()->getFlashdata('pesan');
                  echo '</h5>
                </div>';
                }
                ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Judul</th>
                        <th>nomor</th>
                        <th>tanggal</th>
                        <th>penandatangan</th>
                        <th>kategori</th>
                        <th>status</th>
                        <th>subjek</th>
                        <th>Jumlah</th>
                        <th width="100px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                    foreach ($produk as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['judul']?></td>
                            <td><?= $value['nomor']?></td>
                            <td><?= $value['tanggal']?></td>
                            <td><?= $value['penadatangan']?></td>
                            <td><?= $value['kategori']?></td>
                            <td><?= $value['status']?></td>
                            <td><?= $value['subjek']?></td>
                            <td><?= $value['jumlah']?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit-data<?= $value ['id_produk']?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete-data<?= $value ['id_produk']?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
<!-- add -->
          <div class="modal fade" id="add-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open('Produk/InsertData')?>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Judul</label>
                <input name="judul" class="form-control" placeholder="judul" required>
                    </div>
                    <div class="form-group">
                <label for="">Nomor</label>
                <input name="nomor" class="form-control" placeholder="nomor" required>
                    </div>
                    <div class="form-group">
                <label for="">Tanggal</label>
                <input name="tanggal" type="date" class="form-control" placeholder="Tanggal" required>
                    </div>
                    <div class="form-group">
                <label for="">Penandatangan</label>
                <input name="penadatangan" class="form-control" placeholder="Penadatangan" required>
                    </div>
                    <div class="form-group">
                <label for="">Kategori</label>
                <input name="kategori" class="form-control" placeholder="katgori" required>
                    </div>
                    <div class="form-group">
                <label for="">Status</label>
                <input name="status" class="form-control" placeholder="status" required>
                    </div>
                    <div class="form-group">
                <label for="">Subjek</label>
                <input name="subjek" class="form-control" placeholder="subjek" required>
                    </div>
                    <div class="form-group">
                <label for="">Jumlah</label>
                <input name="jumlah" type="number" class="form-control" placeholder="jumlah" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close()?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- edit -->
      <?php foreach ($produk as $key => $value){?>
        <div class="modal fade" id="edit-data<?= $value['id_produk']?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php echo form_open('Produk/UpdateData/'.$value['id_produk'])?>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Nama Kategori</label>
                <input name="judul" value="<?= $value['judul']?>" class="form-control" placeholder="kategori" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning btn-flat">Save</button>
            </div>
            <?php echo form_close()?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>

<!-- delete -->
      <?php foreach ($produk as $key => $value){?>
        <div class="modal fade" id="delete-data<?= $value['id_produk']?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Data <?= $subjudul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
              apakah anda ingin menghapus data <b><?= $value['judul']?></b>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <a href="<?= base_url('Produk/DeleteData/'.$value['id_produk']) ?>" type="submit" class="btn btn-danger btn-flat">Delete</a>
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>