<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$database = "kalender_progweb";
$conn = new mysqli($servername, $username, $password, $database);

// Get the date from the URL parameter
if (isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    // Default date if not provided
    $date = '2023-06-19';
}

// Array to store the schedule
$scheduleArray = array();
$cookieValue = isset($_COOKIE['username']) ? urlencode($_COOKIE['username']) : '';

for ($i = 0; $i < 24; $i++) {

    $time = $i . ":00:00";
    $time1 =  $i . ":00";
    $query = "SELECT nama_kegiatan FROM kegiatan WHERE tanggal_kegiatan = '$date' AND waktu_kegiatan = '$time' AND username= '$cookieValue'";
    // Execute your query and fetch the result
    $result = $conn->query($query);

    // Generate the HTML rows dynamically
    echo '<tr>';
    echo '<td rowspan="2" class="cock">' . $time1 . '</td>';
    if ($row = $result->fetch_assoc()) {
        //echo '<td>' . $row['nama_kegiatan'] . '</td>';
    } else {
        //echo '<td></td>';
    }
    echo '</tr>';

    echo '<tr>';
    if ($row) {
        echo '<td rowspan="2" class="act" >' . $row['nama_kegiatan'] . '</td>';
        echo '<td rowspan="2" class="filler"></td>';
        echo '<td rowspan="2" class="button"><a href="Detail/Detail Acara/edit_detail.php?date='.$date.'&hour='.$time.'&cookie='.urlencode(isset($_COOKIE['username']) ? $_COOKIE['username'] : '').'">EDIT/DETAIL</a></td>';
    } else {
        echo '<td rowspan="2" class="act">-</td>';
        echo '<td rowspan="2" class="filler"></td>';
       
        echo '<td rowspan="2" class="button"><a href="Detail/Detail Acara/tambah_detail.php?date='.$date.'&hour='.$time.'">TAMBAH</a></td>';
    // ?cookie=' . $cookieValue . '
    }
    echo '</tr>';
}   
echo '<td rowspan="2" class="cock">' . '24:00' . '</td>';


// Convert the array to JSON
$scheduleJson = json_encode($scheduleArray);

// Pass the JSON to JavaScript
echo "<script> var scheduleArray = " . $scheduleJson . "; </script>";
?>
