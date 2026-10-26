<?php 	 
include('function/fkategori.php'); 
$fkategori = new fkategori();   


 $status=$_GET['status'];



 if($status=='1') 
 { 
      $dataku = $fkategori->tampil_data();
      include "./view/vkategori.php";   
 }
  else if($status=='2') 
 { 
      include "./view/kategori_tambah.php";   
 }
else if ($status == '3') {
    // Proses simpan data
    // echo $_POST['nama_kategori'];
    // exit;

    if (isset($_POST['simpan']))
           {  
                $nama_kategori = $_POST['nama_kategori']; 
                $keterangan    = $_POST['keterangan'];    

                $result = $fkategori->input_data($nama_kategori, $keterangan);

                if ($result) {
                   echo "Berhasil menyimpan data kategori.";

                } else {
                  echo "Gagal menyimpan data kategori.";
                }

                // Refresh kembali ke halaman data kategori
                echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=kategori&status=1'>";
   }
}  
else if ($status == '4') {
            $id=$_GET['id'];
            $dataku = $fkategori->cari_data($id);
            include "./view/kategori_ubah.php";   
     
 }

else if ($status == '5') {  // update data kategori
    if (isset($_POST['update'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $keterangan = $_POST['keterangan'];

    // Panggil function ubah_data di class Kategori
    $result = $fkategori->ubah_data($id_kategori, $nama_kategori, $keterangan);

    if ($result) {
        echo '<div class="alert alert-success">Data kategori berhasil diubah.</div>';
    } else {
        echo '<div class="alert alert-danger">Data kategori gagal diubah.</div>';
    }

    // Refresh halaman daftar kategori setelah 1 detik
    echo '<meta http-equiv="refresh" content="1;url=?aksi=kategori&status=1">';
}

}
else if($status=='6') 
{ 
        $id=$_GET['id'];  
        $result=$fkategori->hapus_data($id);  
        if($result)
        {  
             $_SESSION['alert'] = $result ;
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil dihapus'];
        }
        else
        {
           $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal dihapus'];
        }
           //  echo '<meta http-equiv="refresh" content="1;url=?aksi=kategori&status=1">';
            header('Location: ./index.php?aksi=kategori&status=1');
            exit;
            
}

else if($status=='7') 
{ 
      $dataku = $fkategori->print_kategori();
      include "./view/vkategori_print.php";   
}



// if(isset($_GET['xaksi']))
// { 
//   $status=$_GET['yaksi']; 

// 	if($status=='1') 
// 	{ 

//       $dataku = $fguru->tampil_data();
//       include "./view/vguru.php";   
// 	}

//   if($status=='2') 
//   {  
//       include "./view/vguru_add.php";   
//   }
  
//   if($status=='3')   // simpan tambah data slide
//       {  
//           if (isset($_POST['simpan']))
//            {  
//                 $nama_guru=$_POST['nama_guru']; 
//                 $email=$_POST['email'];   
//                 $alamat=$_POST['alamat'];   
//                 $telepon=$_POST['telepon'];    

//               // exit;
//                  //poses upload gambar
//                   $target_dir = "../images/guru/";
//                   $gambar = $_FILES['gambar']['name'];
//                   $temp_name = $_FILES['gambar']['tmp_name'];
//                   $imageFileType = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));



//                   // Membuat nama unik untuk file gambar yang akan disimpan
//                   $newFileName = uniqid() . '.' . $imageFileType;
//                   $target_file = $target_dir . $newFileName;

//               // Validasi tipe file yang diperbolehkan
//                   $allowed_file_types = ['jpg', 'jpeg', 'png'];
//                   if (!in_array($imageFileType, $allowed_file_types)) {
//                       echo '<div class="alert alert-danger">Hanya file JPG, JPEG, dan PNG yang diperbolehkan.</div>';
//                   } else {
//                       // Cek apakah file sudah terupload
//                       if (move_uploaded_file($temp_name, $target_file)) {
  
//                           // Simpan data ke database, dengan nama file gambar yang baru
//                           $result = $fguru->input_data($nama_guru, $email,$alamat, $telepon, $newFileName);

//                           if ($result) {
//                               echo '<div class="alert alert-success">Data berhasil ditambah</div>';
//                           } else {
//                               echo '<div class="alert alert-danger">Data gagal ditambah</div>';
//                           }

//                           // Refresh halaman setelah 1 detik
//                           echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';
//                       } else {
//                           echo '<div class="alert alert-danger">Gagal mengupload gambar.</div>';
//                       }
//                   }
//               }
 
//       }
 
   
//      if($status=='4') 
//       	{ 
//                 $id=$_GET['id'];
//                 $result=$fguru->hapus_data($id);  
//                       if($result)
//                         {  
//                             echo'<div class="alert alert-success">Data Berhasil dihapus</div>';
//                         }
//                         else
//                         {
//                           echo'<div class="alert alert-danger">Data gagal dihapus</div>';  
//                          }
//                           echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';  
       
//       	}
 

//         if($status=='5') 
//         { 
//             $id=$_GET['id'];
//             $dataku = $fguru->cari_data($id);
//             include "./view/vguru_ubah.php";   
//         }


//      if($status=='6')  // ubah data SPP
//           {   

//             if (isset($_POST['update'])) {
//                 $id = $_POST['id'];
//                 $nama_guru=$_POST['nama_guru']; 
//                 $email=$_POST['email'];   
//                 $alamat=$_POST['alamat'];   
//                 $telepon=$_POST['telepon'];    
//                 $gambar_lama = $_POST['gambar_lama']; // File gambar lama dari database
         

//                 // Cek jika ada gambar baru yang diupload
//                 if ($_FILES['gambar']['name']) {
//                     $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/profile/images/guru/";
//                     $gambar_baru = $_FILES['gambar']['name'];
//                     $temp_name = $_FILES['gambar']['tmp_name'];
//                     $imageFileType = strtolower(pathinfo($gambar_baru, PATHINFO_EXTENSION));

//                     // Membuat nama unik untuk file gambar baru
//                     $newFileName = uniqid() . '.' . $imageFileType;
//                     $target_file = $target_dir . $newFileName;

//                     // Validasi tipe file yang diperbolehkan
//                     $allowed_file_types = ['jpg', 'jpeg', 'png'];
//                     if (!in_array($imageFileType, $allowed_file_types)) {
//                         echo '<div class="alert alert-danger">Hanya file JPG, JPEG, dan PNG yang diperbolehkan.</div>';
//                     } else {
//                         // Cek apakah file sudah terupload
//                         if (move_uploaded_file($temp_name, $target_file)) {
//                             // Hapus gambar lama dari folder jika ada
//                             $filePathLama = $target_dir . $gambar_lama;
//                             if (file_exists($filePathLama)) {
//                                 unlink($filePathLama);
//                             }

//                             // Update data di tabel, termasuk nama gambar baru
//                             $result = $fguru->ubah_data($id, $nama_guru, $email, $alamat, $telepon, $newFileName);
                           
//                             if ($result) {
//                                 echo '<div class="alert alert-success">Data berhasil diubah.</div>';
//                             } else {
//                                 echo '<div class="alert alert-danger">Data gagal diubah.</div>';
//                             }
//                         } else {
//                             echo '<div class="alert alert-danger">Gagal mengupload gambar baru.</div>';
//                         }
//                     }
//                 } else {
//                     // Jika tidak ada gambar baru yang diupload, gunakan gambar lama
//                     $result = $fguru->ubah_data($id, $nama_guru, $email, $alamat, $telepon, $gambar_lama);
//                     if ($result) {
//                         echo '<div class="alert alert-success">Data berhasil diubah.</div>';
//                     } else {
//                         echo '<div class="alert alert-danger">Data gagal diubah.</div>';
//                     }
//                 }

//                 // Refresh halaman setelah 1 detik
//                 echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';
//             }

//           }
//} 
