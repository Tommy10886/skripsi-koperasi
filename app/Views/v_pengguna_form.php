<?= $this->extend('layout/template') ?>
 
<?= $this->section('content') ?>

<style>
        .signature-pad {
            border: 1px solid #000;
            width: 400px;
            height: 200px;
        }
    </style>
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
            if($validation->hasError('nama')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('user_name')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('password')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('repassword')) {
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
                                        <label for="validationCustom04" class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$nama?>"  id="validationCustom04"
                                            placeholder="Nama Pengguna" <?=($validation->hasError('nama')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('nama')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('nama')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="user_name" value="<?=$user_name?>"  id="validationCustom04"
                                            placeholder="Username" <?=($validation->hasError('user_name')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('user_name')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('user_name')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" value="<?=$password?>" id="validationCustom04"
                                            placeholder="Masukan Password" <?=($validation->hasError('password')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('password')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('password')?>
                                          </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Ulangi Password</label>
                                        <input type="password" class="form-control" name="repassword" value="<?=($validation->hasError('repassword')?'':$password)?>" id="validationCustom04"
                                            placeholder="Masukan Ulang Password" <?=($validation->hasError('repassword')?'required':'')?>>
                                        
                                        <?php if($validation->hasError('repassword')) {?>
                                          <div class="invalid-feedback">
                                            <?= $validation->getError('repassword')?>
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
                              <p>Tanda Tangan Pengguna</p>
                            <img src="<?=base_url()?>/assets/images/ttd/<?=$ttd?>" width="100"alt=""><br>
                            <canvas id="ttd1" class="signature-pad"></canvas>
                            <input type="hidden" name="ttd1" id="input-ttd1">
                            <button type="button" onclick="clearCanvas(ttdPad1)">Clear TTD 1</button>

                            <hr>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="prepareSubmit()" type="submit">Simpan</button>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas1 = document.getElementById('ttd1');
        const ttdPad1 = new SignaturePad(canvas1);


        function clearCanvas(pad) {
            pad.clear();
        }

        function prepareSubmit() {
            document.getElementById('input-ttd1').value = ttdPad1.toDataURL();
        }
    </script>
<?= $this->endSection() ?>

