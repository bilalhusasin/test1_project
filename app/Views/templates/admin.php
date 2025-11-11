<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->renderSection('page_title') ?></title>

        <!-- Custom fonts for this template -->
        <link href="/adminAssets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/adminAssets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="/adminAssets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Include Select2 CSS en JS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Content
                </div>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('pages'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Pagina's</span>
                    </a>
                </li>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('products'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Producten</span>
                    </a>
                </li>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('productsSub'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Producten per merk</span>
                    </a>
                </li>
                
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('adminBlog'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Blog</span>
                    </a>
                </li>
                
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Account
                </div>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('logout'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Uitloggen</span>
                    </a>
                </li>

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 mt-4 text-gray-800"><?= $this->renderSection('page_name') ?></h1>

                        <?= $this->renderSection('content') ?>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Bootstrap core JavaScript-->
        <script src="/adminAssets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/adminAssets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/adminAssets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="/adminAssets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/adminAssets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/adminAssets/js/demo/datatables-demo.js"></script>
        
        <script type="text/javascript" src="/adminAssets/fancybox/jquery.fancybox.pack.js"></script>
        
        <link rel="stylesheet" href="/adminAssets/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script>              
            $( document ).ready(function() {   
                
            });
            
            $('#dataTable').dataTable( {
                "pageLength": 50,
                "order": [[ 0, "desc" ]]
            });
        </script>
        
        <?= $this->renderSection('jsscript') ?>
    </body>

</html>
