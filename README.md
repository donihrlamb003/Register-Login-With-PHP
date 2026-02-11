# Register-Login-With-PHP
Simple Form Function With PHP

Berikut adalah isi file README.md yang lengkap dan terstruktur untuk proyek Anda. File ini mencakup deskripsi proyek, struktur basis data, cara instalasi, hingga fitur keamanan yang telah Anda terapkan.
🔐 Simple Login & Registration System (PHP Native)

Sistem login dan registrasi sederhana ini dirancang menggunakan PHP Native dan MySQL. Aplikasi ini membedakan hak akses pengguna antara Admin dan User menggunakan session.
📂 Struktur Proyek

    koneksi.php: Berisi konfigurasi koneksi ke basis data MySQL menggunakan mysqli_connect.

    registrasi.php: Formulir pendaftaran pengguna baru dengan validasi ketersediaan email dan enkripsi kata sandi.

    login.php: Proses autentikasi pengguna menggunakan Prepared Statements untuk keamanan.

    admin.php: Halaman dasbor khusus untuk pengguna dengan hak akses Admin.

    user.php: Halaman dasbor khusus untuk pengguna dengan hak akses User.

    logout.php: Menghapus seluruh data session dan mengarahkan kembali ke halaman login.

    style.css: Pengaturan tampilan antarmuka (UI) menggunakan CSS modern dengan efek blur dan glassmorphism.

🛠️ Persiapan Database

Gunakan kode SQL berikut untuk membuat struktur tabel yang sesuai dengan aplikasi ini:
SQL

-- Membuat Database
CREATE DATABASE IF NOT EXISTS simplelog;
USE simplelog;

-- Membuat Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tipe_user ENUM('Admin', 'User') NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

🚀 Instalasi & Cara Pakai

    Clone atau Copy File: Pindahkan semua file ke folder server lokal Anda (contoh: C:/xampp/htdocs/simplelog/).

    Siapkan Aset Gambar: Buat folder bernama img di dalam direktori proyek Anda dan siapkan dua gambar:

        img/background.jpg (untuk halaman login/registrasi).

        img/forest.jpg (untuk halaman dasbor admin/user).

    Konfigurasi Database: Pastikan pengaturan di koneksi.php sudah sesuai dengan kredensial MySQL Anda (host, user, pass, db).

    Registrasi Akun: Akses registrasi.php melalui browser, masukkan data diri, dan pilih peran (Admin/User).

    Login: Masuk menggunakan email dan password yang telah didaftarkan melalui login.php.

🔒 Fitur Keamanan

    Prepared Statements: Mencegah serangan SQL Injection pada proses login dan registrasi.

    Password Hashing: Menggunakan algoritma PASSWORD_DEFAULT sehingga kata sandi disimpan dengan aman (tidak dalam bentuk teks biasa).

    Session Management: Memastikan akses halaman user.php hanya bisa dilakukan oleh pengguna yang sudah login dengan benar.

    XSS Protection: Menggunakan htmlspecialchars() untuk menampilkan nama pengguna guna mencegah serangan Cross-Site Scripting.
