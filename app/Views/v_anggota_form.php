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

        <?php 
            $was_validated = "";
            if($validation->hasError('nomor_anggota')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('nama')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('hp')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('jenis_usaha')) {
              $was_validated = "was-validated";
            }
          ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?=$action?>" method="POST" class=" needs-validation <?=$was_validated?>" novalidate>
                            <input type="hidden" name="id" value="<?=$id?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Nomor Anggota</label>
                                        <input type="text" class="form-control" name="nomor_anggota" value="<?=$nomor_anggota?>"  id="validationCustom04"
                                            placeholder="Nomor Anggota" <?=($validation->hasError('nomor_anggota')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('nomor_anggota')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('nomor_anggota')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Nama Anggota</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$nama?>"  id="validationCustom04"
                                            placeholder="Nama Anggota" <?=($validation->hasError('nama')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('nama')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('nama')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Hp</label>
                                        <input type="text" class="form-control" name="hp" value="<?=$hp?>"  id="validationCustom04"
                                            placeholder="Nomor HP Anggota" <?=($validation->hasError('hp')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('hp')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('hp')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Jenis Usaha</label>
                                        <input type="text" class="form-control" name="jenis_usaha" value="<?=$jenis_usaha?>"  id="validationCustom04"
                                            placeholder="Jenis Usaha Anggota" <?=($validation->hasError('jenis_usaha')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('jenis_usaha')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('jenis_usaha')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                  <div class="mb-3">
                                      <label class="form-label">Pilih Struktur</label>
                                      <select name="id_struktur" class="form-control select2">
                                        <?php foreach ($list_struktur as $key => $value) { ?>
                                          <option value="<?=$value['id']?>" <?=($value['id'] == $id_struktur?'selected':'')?>><?=$value['struktur_name']?></option>
                                        <?php } ?>
                                      </select>

                                  </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Saldo</label>
                                        <input type="text" class="form-control number" name="saldo" value="<?=number_format($saldo)?>"  id="validationCustom04"
                                            placeholder="Saldo Anggota" <?=($validation->hasError('saldo')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('saldo')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('saldo')?>
                                          </div>
                                        <?php }?>
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

