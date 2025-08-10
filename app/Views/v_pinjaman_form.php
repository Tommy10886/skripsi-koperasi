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
                                        <label for="validationCustom04" class="form-label">Tanggal Pinjaman</label>
                                        <input type="date" class="form-control" name="tgl_pinjaman" value="<?=$tgl_pinjaman?>"  >
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Jenis Pinjaman</label>
                                        <select name="jenis_pinjaman" class="form-control">
                                            <option value="RUTIN" <?=($jenis_pinjaman=="RUTIN"?'selected':'')?>>RUTIN</option>
                                            <option value="INSIDENTIL" <?=($jenis_pinjaman=="INSIDENTIL"?'selected':'')?>>INSIDENTIL</option>
                                            <option value="MODAL KERJA" <?=($jenis_pinjaman=="MODAL KERJA"?'selected':'')?>>MODAL KERJA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Jangka Waktu</label>
                                        <input type="text" class="form-control" name="jangka_waktu" value="<?=$jangka_waktu?>" placeholder="Example : 5 Bulan"  >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Nilai Pinjaman</label>
                                        <input type="text" class="form-control number" name="pinjaman" value="<?=number_format($pinjaman)?>"  >
                                    </div>
                                </div>
                                
                            </div>
                            <p>Tanda Tangan Pemohon</p>
                            <img src="<?=base_url()?>/assets/images/ttd/<?=$ttd_pemohon?>" width="100"alt=""><br>
                            <canvas id="ttd1" class="signature-pad"></canvas>
                            <input type="hidden" name="ttd1" id="input-ttd1">
                            <button type="button" onclick="clearCanvas(ttdPad1)">Clear TTD 1</button>

                            <hr>

                            <p>Nama dan Tanda Tangan Suami/Istri Pemohon <input type="text" name="nama2" value="<?=$nama_pasangan?>" required></p>
                            <img src="<?=base_url()?>/assets/images/ttd/<?=$ttd_pasangan?>" width="100"alt=""><br>
                            <canvas id="ttd2" class="signature-pad"></canvas>
                            <input type="hidden" name="ttd2" id="input-ttd2">
                            <button type="button" onclick="clearCanvas(ttdPad2)">Clear TTD 2</button>

                            <br><br>
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

        const canvas2 = document.getElementById('ttd2');
        const ttdPad2 = new SignaturePad(canvas2);

        function clearCanvas(pad) {
            pad.clear();
        }

        function prepareSubmit() {
            document.getElementById('input-ttd1').value = ttdPad1.toDataURL();
            document.getElementById('input-ttd2').value = ttdPad2.toDataURL();
        }
    </script>
<?= $this->endSection() ?>

