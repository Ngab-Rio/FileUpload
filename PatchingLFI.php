<?php
// Fungsi untuk mendapatkan ekstensi file
function get_file_extension($file_name) {
    return pathinfo($file_name, PATHINFO_EXTENSION);
}

if (isset($_POST['submit'])) {
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $uploadOk = true;
    $imageFileType = strtolower(get_file_extension($target_file));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        die("File yang diunggah bukan gambar.");
    }

    // Periksa ukuran file
    if ($_FILES['image']['size'] > 500000) { // Sesuaikan ukuran maksimum sesuai kebutuhan
        die("Maaf, file terlalu besar. Harus kurang dari 500KB.");
    }

    // Periksa ekstensi file yang diizinkan
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowed_extensions)) {
        die("Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.");
    }

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        die("Maaf, file sudah ada.");
    }

    // Coba unggah file
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Upload gagal.");
    }

    // Jika unggahan berhasil
    echo "<p>Upload berhasil:</p>";
    echo "<img src='{$target_file}' alt='Uploaded Image'>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Gambar</title>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <p>Masukkan gambar:</p>
        <input type="file" name="image" accept="image/*" required>
        <br><br>
        <input type="submit" name="submit" value="Unggah">
    </form>

</body>

</html>
