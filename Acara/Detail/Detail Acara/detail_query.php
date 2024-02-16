<?php
// Your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "kalender_progweb";
$tanggal_kegiatan = isset($_GET['date']) ? $_GET['date'] : '';
$jam = isset($_GET['hour']) ? $_GET['hour'] : '';
$cookieValue = isset($_COOKIE['username']) ? urlencode($_COOKIE['username']) : '';

$user = $cookieValue;
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database based on the given query
$query = "SELECT *
        FROM `kegiatan`
        WHERE tanggal_kegiatan = '$tanggal_kegiatan' AND username = '$user' AND waktu_kegiatan = '$jam'
        ORDER BY priositas_kegiatan DESC";


$result = mysqli_query($conn, $query);
$timeComponents = explode(":", $jam);

$hour = $timeComponents[0];    // Hour
$minute = $timeComponents[1];  // Minute

$time = $hour .':'.$minute;
$targetpath='';
// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $targetpath=$row['foto_kegiatan'];
  
    ?>
    <script>
        // Set the form values based on the fetched data
        document.getElementById('kegiatanInput').value = "<?php echo $row['nama_kegiatan']; ?>";
        document.getElementById('prioritas').value = "<?php echo $row['priositas_kegiatan']; ?>";
        document.getElementById('message').value = "<?php echo $row['deskripsi_kegiatan']; ?>";
        document.getElementById('kegiatanInput').value = "<?php echo $row['nama_kegiatan']; ?>";
        document.getElementById('lokasi').value = "<?php echo $row['lokasi']; ?>";

        document.getElementById('jam').innerHTML  = "<?php echo $time; ?>";
     
    </script>
    <?php
    $targetpath=$row['foto_kegiatan'];
}


if (isset($_POST['submit'])) {
    // Get the submitted form values

    $nama_kegiatan = $_POST['kegiatanInput'];
    $priositas_kegiatan = $_POST['prioritas'];
    $deskripsi_kegiatan = $_POST['message'];
    $lokasi_kegiatan = $_POST['lokasi'];
    
    if (empty($nama_kegiatan) || empty($priositas_kegiatan)) {
        // Handle the exception, show an error message, or redirect the user
        echo "Error: Required fields are empty.";
        exit;
    }
    $file = $_FILES['gambarInput'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    if (!empty($fileName)) {
        // Check if a file was uploaded without any errors
        if ($fileError === 0) {
            // Specify the directory where you want to save the uploaded file
            $targetDirectory = '../Image Umum/';
    
            // Generate a unique file name
            $newFileName = uniqid() . '_' . $fileName;
    
            // Move the uploaded file to the target directory
            $targetPath = $targetDirectory . $newFileName;
            echo $targetpath;

            if (move_uploaded_file($fileTmpName, $targetPath)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        }
    }else {
        // No new file selected, use the previous image path as default
        $targetPath = $targetpath;
    }

    // Perform the update query to save the form values
    $updateQuery = "UPDATE `kegiatan`
                    SET nama_kegiatan = '$nama_kegiatan',
                        priositas_kegiatan = '$priositas_kegiatan',
                        deskripsi_kegiatan = '$deskripsi_kegiatan',
                        foto_kegiatan = '$targetPath',
                        lokasi = '$lokasi_kegiatan'
                    WHERE tanggal_kegiatan = '$tanggal_kegiatan' AND username = '$user' AND waktu_kegiatan = '$jam'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Record updated successfully";
        header('Location:../../Acara.php?date='.$tanggal_kegiatan);
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}if (isset($_POST['delete'])) {
    // Perform the delete query
    $deleteQuery = "DELETE FROM `kegiatan`
                    WHERE tanggal_kegiatan = '$tanggal_kegiatan' AND username = '$user' AND waktu_kegiatan = '$jam'";

    if (mysqli_query($conn, $deleteQuery)) {

        header('Location: ../../Acara.php?date=' . $tanggal_kegiatan);
        echo "Record deleted successfully";
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Rest of your code ...
// Close the database connection
mysqli_close($conn);
?>
<script>
    document.getElementById('gambar').src = "<?php echo $row['foto_kegiatan']; ?>";
</script>