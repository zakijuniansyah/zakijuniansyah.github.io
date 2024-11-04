<?php
// Alamat email Anda
$receiving_email_address = 'zakyjuniansyah@gmail.com';

// Cek apakah permintaan adalah POST dan email di-set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Sanitasi dan validasi email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $subject = 'Masukan dari Pengunjung';
        $message = "Anda menerima masukan dari: $email";
        
        // Menggunakan no-reply email atau alamat yang valid
        $headers = "From: no-reply@yourdomain.com\r\n"; // Ganti dengan domain yang valid
        $headers .= "Reply-To: $email\r\n";

        // Kirim email dan periksa hasilnya
        if (mail($receiving_email_address, $subject, $message, $headers)) {
            echo 'Terima kasih atas masukan Anda!';
        } else {
            echo 'Terjadi kesalahan saat mengirim email. Silakan coba lagi.';
        }
    } else {
        echo 'Alamat email tidak valid.';
    }
} else {
    echo 'Permintaan tidak valid.';
}
?>
