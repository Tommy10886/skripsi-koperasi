<?php

$this->session = \Config\Services::session();
$this->session->start();
?>
<!doctype html>
<html lang="en">

<head>
        
        <meta charset="utf-8" />
        <title>KOPPAS JATINEGARA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/assets/images/logo.png">

        <!-- DataTables -->
        <link href="<?=base_url()?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

        <!-- Bootstrap Css -->
        <link href="<?=base_url()?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url()?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index-2.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?=base_url()?>/assets/images/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg"><img src="<?=base_url()?>/assets/images/logo.png" alt="" height="32">
                                  <b style="color:white;font-size:15px">KOPPAS JATINEGARA</b>
                                </span>
                            </a>

                            <a href="index-2.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url()?>/assets/images/logo.png" alt="" height="22">
                                </span>
                                <span class="logo-lg"><img src="<?=base_url()?>/assets/images/logo.png" alt="" height="32">
                                  <b style="color:white;font-size:15px">KOPPAS JATINEGARA</b>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars" style="color:white"></i>
                        </button>
                    </div>

                    <div class="d-flex">


                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?=base_url()?>/assets/images/logo.png"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry" style="color:white"><?=$this->session->get("nama")?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <!-- <a class="dropdown-item" href="/profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="/logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>


                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Simpan Pinjam</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php 
                                      if($this->session->get("id_struktur") == 1 || $this->session->get("id_struktur") == 2 || $this->session->get("id_struktur") == 3){
                                    ?>
                                    <li class=<?=($url=='persetujuan'?'mm-active':'')?>><a href="/persetujuan" key="t-default">Persetujuan Pinjaman</a></li>
                                    <?php 
                                      }
                                    ?>
                                    <li class=<?=($url=='simpanan'?'mm-active':'')?>><a href="/simpanan" key="t-default">Simpanan</a></li>
                                    <li class=<?=($url=='pinjaman'?'mm-active':'')?>><a href="/pinjaman" key="t-default">Pinjaman</a></li>
                                    <li class=<?=($url=='pembayaran'?'mm-active':'')?>><a href="/pembayaran" key="t-default">Pembayaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Data Anggota</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class=<?=($url=='anggota'?'mm-active':'')?>><a href="/anggota" key="t-default">Anggota</a></li>
                                    <li class=<?=($url=='rincian_anggota'?'mm-active':'')?>><a href="/rincian_anggota/1" key="t-default">Data Rincian Anggota</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Pengaturan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class=<?=($url=='pengguna'?'mm-active':'')?>><a href="/pengguna" key="t-default">Pengguna</a></li>
                                    <li class=<?=($url=='struktur'?'mm-active':'')?>><a href="/struktur" key="t-default">Struktur</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

            
            <?= $this->renderSection('content') ?>
              <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © KOPPAS JATINEGARA.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                KOPPAS JATINEGARA
                            </div>
                        </div>
                    </div>
                </div>
              </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="<?=base_url()?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="<?=base_url()?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/jszip/jszip.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="<?=base_url()?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?=base_url()?>/assets/js/pages/datatables.init.js"></script>  
        <script src="<?=base_url()?>/assets/js/pages/form-validation.init.js"></script>  
        <script src="<?=base_url()?>/assets/libs/select2/js/select2.min.js"></script>
        <!-- form advanced init -->
        <script src="<?=base_url()?>/assets/js/pages/form-advanced.init.js"></script>

        <script src="<?=base_url()?>/assets/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>

</html>

<script>
  $(function () {
    
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
    $(".delete").click(function(){
      var id = $(this).attr('id');
      swal({
      title: "Kamu Yakin?",
      text: "Data akan dihapus",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          location.href="<?=(isset($delete)?$delete:'')?>/"+id;
        } 
        
      });
    });

    $('#gambar').change(function(){
      bacaGambar(this);
      })
    $(document).ready(function () {
      bacaGambar(this);
    });
    function bacaGambar(input)
    {
      if(input.files && input.files[0])
      {
        var reader = new FileReader();

        reader.onload = function (e){
          $('#gambar_edit').attr('src',e.target.result);
          console.log(e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
      
    }
    
    $('.number').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
            });
        });
</script>
