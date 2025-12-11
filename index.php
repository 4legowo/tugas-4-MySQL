<?php
session_start();
include 'koneksi.php';

$errors = [];
$success_message = '';

// Proses form jika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil data menggunakan $_POST
    $nama_user = $_POST['nama_user'] ?? '';
    $email_user = $_POST['email_user'] ?? '';
    $lapangan_id = $_POST['lapangan'] ?? '';
    $tanggal_booking = $_POST['tanggal'] ?? '';
    $jam_mulai = $_POST['jam_mulai'] ?? '';
    $jam_selesai = $_POST['jam_selesai'] ?? '';

    // 2. Validasi Input Sisi Server
    if (empty($nama_user)) {
        $errors[] = "Nama user tidak boleh kosong.";
    }
    if (empty($email_user)) {
        $errors[] = "Email tidak boleh kosong.";
    } elseif (!filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    if (empty($lapangan_id)) {
        $errors[] = "Pilihan lapangan tidak boleh kosong.";
    }
    if (empty($tanggal_booking)) {
        $errors[] = "Tanggal booking tidak boleh kosong.";
    }
    if (empty($jam_mulai)) {
        $errors[] = "Jam mulai tidak boleh kosong.";
    }
    if (empty($jam_selesai)) {
        $errors[] = "Jam selesai tidak boleh kosong.";
    }

    // Jika validasi berhasil, simpan ke database
    if (empty($errors)) {
        // Gunakan prepared statements untuk keamanan
        $stmt = $conn->prepare("INSERT INTO bookings (nama_user, email_user, lapangan_id, tanggal_booking, jam_mulai, jam_selesai) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $nama_user, $email_user, $lapangan_id, $tanggal_booking, $jam_mulai, $jam_selesai);

        if ($stmt->execute()) {
            // 3. Gunakan session untuk notifikasi
            $_SESSION['success_message'] = "Booking berhasil! Menunggu konfirmasi.";
            // Redirect untuk mencegah form resubmission
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
