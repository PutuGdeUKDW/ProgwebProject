<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "kalender_progweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$date = $_REQUEST['date'];
//echo $date.'/';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$cookieValue = isset($_COOKIE['username']) ? urlencode($_COOKIE['username']) : '';

$user = $cookieValue;
$query = "SELECT priositas_kegiatan,nama_kegiatan FROM `kegiatan` WHERE tanggal_kegiatan = '$date' AND username = '$user' ORDER BY priositas_kegiatan DESC LIMIT 1";
$result = mysqli_query($conn, $query);
// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    // Fetch the data as an associative array
    $row = mysqli_fetch_assoc($result);
    //echo $row['priositas_kegiatan'];
    // Convert the data to JSON format and return it
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // Handle the case when the query fails
    echo '';
}

mysqli_close($conn);
?>

