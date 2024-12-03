<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "form"; // Nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Query untuk menyimpan data
$sql = "INSERT INTO form_data (name, email, subject, message) VALUES (?, ?, ?, ?)";

// Persiapkan statement dan bind parameter
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Eksekusi query dan tampilkan hasil
if ($stmt->execute()) {
    // Jika berhasil, tampilkan alert sukses
    echo "<script>
            alert('Pesan berhasil dikirim!');
            window.location.href = 'index.html'; // Ganti dengan halaman tujuan setelah sukses
          </script>";
} else {
    // Jika gagal, tampilkan alert error
    echo "<script>
            alert('Terjadi kesalahan: " . $stmt->error . "');
            window.location.href = 'index.html'; // Ganti dengan halaman tujuan setelah error
          </script>";
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
