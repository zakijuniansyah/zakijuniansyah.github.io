<?php
  // Alamat email tujuan
  $receiving_email_address = 'zakyjuniansyah@gmail.com';

  // Periksa keberadaan file library
  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  // Inisialisasi objek PHP_Email_Form
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;

  // Validasi dan set data dari form
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  if (!filter_var($contact->from_email, FILTER_VALIDATE_EMAIL)) {
      die('Alamat email tidak valid.');
  }
  $contact->subject = $_POST['subject'];

  // Pengaturan SMTP jika diinginkan
  /*
  $contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_email@example.com',
    'password' => 'your_password',
    'port' => '587'
  );
  */

  // Tambahkan pesan
  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  // Cek pengiriman email
  if ($contact->send()) {
      echo 'Pesan berhasil dikirim!';
  } else {
      echo 'Pesan gagal dikirim. Silakan coba lagi.';
  }
?>
