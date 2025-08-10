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
            if($validation->hasError('struktur_name')) {
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
                                        <label for="validationCustom04" class="form-label">Nama Struktur</label>
                                        <input type="text" class="form-control" name="struktur_name" value="<?=$struktur_name?>"  id="validationCustom04"
                                            placeholder="Nama Struktur" <?=($validation->hasError('struktur_name')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('struktur_name')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('struktur_name')?>
                                          </div>
                                        <?php }?>
                                    </div>
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

