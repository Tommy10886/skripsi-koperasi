<?= $this->extend('layout/template') ?>
 
<?= $this->section('content') ?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
          <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                      <h4 class="mb-sm-0 font-size-18">
                      <?=$sub_judul_page?> <?=$judul_page?> 
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
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?=$action?>" method="POST" class=" needs-validation " novalidate>
                            <input type="hidden" name="id" value="<?=$id?>"/>
                            <div class="row">
                                
                                <div class="col-lg-12">
                                  <div class="mb-3">
                                      <label class="form-label">Pilih Anggota</label>
                                      <select name="id_anggota" class="form-control select2">
                                        <?php foreach ($list_anggota as $key => $value) { ?>
                                          <option value="<?=$value['id']?>" <?=($value['id'] == $id_anggota?'selected':'')?>><?=$value['nama']?></option>
                                        <?php } ?>
                                      </select>

                                  </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Tanggal Simpanan</label>
                                        <input type="date" class="form-control" name="tgl_simpanan" value="<?=$tgl_simpanan?>"  >
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Nilai Simpanan</label>
                                        <input type="text" class="form-control number" name="simpanan" value="<?=number_format($simpanan)?>"  >
                                    </div>
                                </div>
                                
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="<?=$back?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->

        </div>

    </div> <!-- container-fluid -->
</div>
<?= $this->endSection() ?>

