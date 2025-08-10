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
                      <div class="card-header">
                          <div class="row">
                              
                              <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Anggota</label>
                                    <select id="id_anggota" class="form-control select2">
                                      <?php foreach ($list_anggota as $key => $value) { ?>
                                        <option value="<?=$value['id']?>" <?=($value['id'] == $id_anggota?'selected':'')?>><?=$value['nama']?></option>
                                      <?php } ?>
                                    </select>

                                </div>
                              </div>
                              <div class="col-lg-3">
                                <button class="btn btn-primary" style="margin-top:30px" onclick="cari()">Cari</button>
                              </div>
                              
                          </div>
                      </div>
                      <div class="card-body">

                          <h4 class="card-title">
                            <a href="/laporan_rincian_anggota/<?=$id_anggota?>" class="btn btn-outline-danger" target="_blank">Download Laporan</a>
                          </h4>
                          <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                              <thead>
                              <tr class="text-center">
                                <th width="50px">No.</th>
                                <th>Tanggal</th>
                                <th>Uang Masuk</th>
                                <th>Uang Keluar</th>
                                <th>Sisa Saldo</th>
                              </tr>
                              </thead>


                              <tbody>
                                <?php
                                  $nomor=1;
                                  $total=0;
                                  foreach ($list_rincian_anggota as $key => $value) {
                                    if($value->kode == 0){
                                      $total += $value->nilai;

                                    }else{
                                      $total -= $value->nilai;

                                    }
                                ?>
                                <tr class="text-center">
                                  <td><?=$nomor++?></td>
                                  <td><?=date('d F Y', strtotime($value->tgl))?></td>
                                  <td><?=($value->kode == 0 ?number_format($value->nilai):0)?></td>
                                  <td><?=($value->kode == 1 ?number_format($value->nilai):0)?></td>
                                  <td><?=number_format($total)?></td>
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
<script>
  function cari() {
    const id_anggota = document.getElementById('id_anggota').value;
    location.href="/rincian_anggota/"+id_anggota;
  }
</script>
<?= $this->endSection() ?>

