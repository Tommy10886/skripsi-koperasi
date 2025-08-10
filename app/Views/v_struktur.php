<?= $this->extend('layout/template') ?>
 
<?= $this->section('content') ?>

<div class="page-content">
      <div class="container-fluid">

          <!-- start page title -->
          <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                      <h4 class="mb-sm-0 font-size-18">
                        <?=$judul_page?> 
                      </h4>

                      <div class="page-title-right">
                          <ol class="breadcrumb m-0">
                              <li class="breadcrumb-item"><?=$sub_judul_page?></li>
                              <li class="breadcrumb-item active"><?=$judul_page?></li>
                          </ol>
                      </div>

                  </div>
              </div>
          </div>
          <!-- end page title -->

          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">

                          <h4 class="card-title">
                            <a href="<?=$create?>" class="btn btn-outline-primary">Tambah</a>
                          </h4>
                          <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                              <thead>
                              <tr class="text-center">
                                <th width="50px">No.</th>
                                <th>Nama Struktur</th>
                                <th width="150px">#</th>
                              </tr>
                              </thead>


                              <tbody>
                                <?php
                                  $nomor=1;
                                  foreach ($list_struktur as $key => $value) {
                                ?>
                                <tr class="text-center">
                                  <td><?=$nomor++?></td>
                                  <td><?=$value['struktur_name']?></td>
                                  <td>
                                      <a href="<?=$update?>/<?=$value['id']?>" class="btn btn-outline-secondary btn-sm edit" title="Ubah">
                                          <i class="fas fa-pencil-alt"></i>
                                      </a>
                                      <a id="<?=$value['id']?>" class="btn btn-outline-danger btn-sm delete" title="Hapus">
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
              </div> <!-- end col -->
          </div> <!-- end row -->
      </div> <!-- container-fluid -->
  </div>
<?= $this->endSection() ?>

