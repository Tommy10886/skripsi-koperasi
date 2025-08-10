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
                                <th width="30px">No.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jangka Waktu</th>
                                <th>Pinjaman (Rp)</th>
                                <th>Status</th>
                                <th>Disetujui (Rp)</th>
                                <th width="100px">#</th>
                              </tr>
                              </thead>


                              <tbody>
                                <?php
                                  $nomor=1;
                                  foreach ($list_pinjaman as $key => $value) {
                                    if($value['status'] == 'Bendahara'){
                                      $status = "Menunggu Persetujuan Bendahara";
                                    }else if($value['status'] == 'Sekretaris'){
                                      $status = "Menunggu Persetujuan Sekretaris";
                                    }else if($value['status'] == 'Ketua'){
                                      $status = "Menunggu Persetujuan Ketua";
                                    }else if($value['status'] == 'Disetujui'){
                                      $status = "Pinjaman Disetujui";
                                    }else {
                                      $status = "Pinjaman Ditolak";
                                    }
                                ?>
                                <tr class="text-center">
                                  <td><?=$nomor++?></td>
                                  <td><?=date('d F Y', strtotime($value['tgl_pinjaman']))?></td>
                                  <td><?=$value['nama']?></td>
                                  <td><?=$value['jenis_pinjaman']?></td>
                                  <td><?=$value['jangka_waktu']?></td>
                                  <td><?=number_format($value['pinjaman'])?></td>
                                  <td><?=$status?></td>
                                  <td><?=number_format($value['pinjaman_disetujui'])?></td>
                                  <td>
                                    <?php 
                                      if($value['status'] == 'Bendahara'){
                                    ?>
                                      <a href="<?=$update?>/<?=$value['id']?>" class="btn btn-outline-secondary btn-sm edit" title="Ubah">
                                          <i class="fas fa-pencil-alt"></i>
                                      </a>
                                      <a id="<?=$value['id']?>" class="btn btn-outline-danger btn-sm delete" title="Hapus">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                    <?php 
                                      }else{
                                    ?>
                                      <a href="/cetak_simpanan/<?=$value['id']?>" target="_blank" class="btn btn-outline-danger btn-sm edit" title="Ubah">
                                          <i class="fas fa-file-pdf"></i>
                                      </a>
                                    
                                    <?php
                                      }
                                    ?>
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

