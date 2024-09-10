<?php include("inc_header.php")?>
<?php
if(isset($_SESSION['members_email']) != ''){ //sudah dalam keadaan login
    header("location:index.php");
    exit();
}
?>
<h3>Pendaftaran</h3>
<?php
$email            = "";
$nama_lengkap     = "";
$id_karyawan      = "";
$err              = "";
$sukses           = "";

if(isset($_POST['simpan'])){
    $email                   = $_POST['email'];
    $nama_lengkap            = $_POST['nama_lengkap'];
    $id_karyawan             = $_POST['id_karyawan'];
    $password                = $_POST['password'];
    $konfirmasi_password     = $_POST['konfirmasi_password'];

    if($email == '' or $nama_lengkap == '' or $konfirmasi_password == '' or $password ==''){
        $err .= "<li>Silakan masukkan semua isian.</li>";
    }

    //cek di bagian db, apakah email sudah ada atau belum
    if($email != ''){
        $sql1  = "select email from members where email = '$email'";
        $q1    = mysqli_query($koneksi,$sql1);
        $n1    = mysqli_num_rows($q1);
        if($n1 > 0){
            $err ="<li>Email yang anda masukkan sudah terdaftar.</li>";
        }

        //validasi email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $err .= "<li>Email yang anda masukkan tidak valid.</li>";
        }
    }

    //cek kesesuaian password & konfirmasi password
    if($password != $konfirmasi_password){
        $err .= "<li>Password dan Konfirmasi Password tidak sesuai.</li>";
    }
    if(strlen($password) < 6){
        $err .="<li>Panjang karakter yang diizinkan untuk password paling tidak 6 karakter.</li>";
    }

    if(empty($err)){
        $status          = md5(rand(0,1000));
        $judul_email     = "Halaman Konfirmasi Pendaftaran";
        $isi_email       = "Akun yang anda miliki dengan email <b>$email</b> telah siap digunakan.<br/>";
        $isi_email       .= "Sebelumnya silakan melakukan aktivasi email di link di bawah ini:<br/>";
        $isi_email       .= url_dasar()."/verifikasi.php?email=$email&kode=$status";

        kirim_email($email,$nama_lengkap,$judul_email,$isi_email);

        $sql1     = "insert into members(email,nama_lengkap,id_karyawan,password,status) values ('$email','$nama_lengkap',$id_karyawan,md5($password),'$status')";
        $q1       = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "Proses Berhasil. Silakan cek email anda untuk verifikasi.";
        }
        
    }

}
?>
<?php if($err) {echo "<div class='error'><ul>$err</ul></div>";} ?>
<?php if($sukses) {echo "<div class='sukses'>$sukses</div>";} ?>

<form action="" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td>
                <input type="text" name="email" class="input" value="<?php echo $email?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>
                <input type="text" name="nama_lengkap" class="input" value="<?php echo $nama_lengkap?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">ID Karyawan</td>
            <td>
                <input type="text" name="id_karyawan" class="input" value="<?php echo $id_karyawan?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Password</td>
            <td>
                <input type="password" name="password" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Konfirmasi Password</td>
            <td>
                <input type="password" name="konfirmasi_password" class="input" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="simpan" value="Simpan" class="tbl-biru"/>
                <br/>
                Sudah punya akun? Silakan <a href='<?php echo url_dasar()?>/login.php'>login</a>
            </td>
        </tr>
    </table>
</form>

<?php include("inc_footer.php")?>