<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Belajar Bootstrap</title>
  <!-- Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
   body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;   
        }
        .content-wrapper {
            flex: 1;
            display: flex;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
         .content {
            flex: 1;
            padding: 30px;
        }

   .sidebar {
            width: 250px;
            background-color: #3e6790ff;
            color: #fff;
            padding: 20px; 
        }
        .sidebar h5 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .sidebar .list-group-item {
            background-color: transparent;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar .list-group-item:hover {
            background-color: #495057;
            transform: translateX(5px);
        }
        .sidebar .list-group-item a {
            color: inherit;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar .list-group-item i {
            margin-right: 10px;
        }

   footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
</style>
</head>
<body>
    <!-- Top / header-->
    <?php 
    ob_start();
    session_start();
    include "./header.php"
    ?> 

    <!-- Navigasi -->
    <?php include "./nav.php" ?> 

    <!-- Sidebar + Konten -->
    <div class="content-wrapper">
        <?php include "./sidebar.php" ?> 
       
        <?php   
        if (isset($_GET['aksi'])) {
            switch($_GET['aksi']) {
                case 'kategori':
                    include './control/ckategori.php';
                    break;
                case 'barang':
                    include './control/cbarang.php';
                    break;
                default:
                    include './main.php';
                    break;
                case 'pembelian':
                    include './control/cpembelian.php';
                    break;
                case 'penjualan':
                    include './control/cjual.php';
                    break;
                case 'laporanbeli':
                    include './control/claporanbeli.php';
                    break;
                case 'laporanjual':
                    include './control/claporanjual.php';
                    break;
                case 'pengaturan':
                    include './control/cpengaturan.php';
                    break;
                case 'tentang':
                    include './control/ctentang.php';
                    break;
                case 'kontak':
                    include './control/ckontak.php';
                    break;
            }
            } else {
            include './main.php';
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include "./footer.php"?> 

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>