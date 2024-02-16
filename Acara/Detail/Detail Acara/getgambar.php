<?php
// Your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "kalender_progweb";
$tanggal_kegiatan = isset($_GET['date']) ? $_GET['date'] : '';
$jam = isset($_GET['hour']) ? $_GET['hour'] : '';
$user = 'putu';
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT *
        FROM `kegiatan`
        WHERE lokasi = '$tanggal_kegiatan' AND username = '$user' AND waktu_kegiatan = '$jam'
        ORDER BY priositas_kegiatan DESC";


$result = mysqli_query($conn, $query);
$imageSource = '';

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imageSource=$row['foto_kegiatan'];
}
if($imageSource == null){
    $imageSource = "../Image Umum/tandaTanya.png";
}

mysqli_close($conn);
?>