<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="acara.css">
    <style>
        [data-tooltip]::before {
			content: attr(data-tooltip);
			position: absolute;
			top: -25px;
			left: 50%;
			transform: translateX(-50%);
			padding: 5px;
			background-color: black;
			color: white;
			border-radius: 5px;
			opacity: 0;
			transition: opacity 0.3s;
		}
		/* Menampilkan teks melayang ketika kursor di atas elemen */
		[data-tooltip]:hover::before {
			opacity: 1;
		}

        a {
        color: inherit;
        }
      h3{
        margin-top : 50px;
        margin-left : 50px;
      }
    </style>
    <?php
    if (isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        // echo $username;
        // Gunakan nilai cookie "username" sesuai kebutuhan
    
    } else {
        // Cookie "username" tidak ditemukan
        echo "Cookie username tidak ditemukan";
    }
    ?>
</head>
<body>
    <header>
        <div>
        Scheduler
        </div>
        
    </header>
    <main>
        <div class ="container">
            <table class ="kalender">
                <thead>
                <th colspan="7" class = "Judul">
                <?php $date = isset($_GET['date']) ? $_GET['date'] : '';?>
                    <h3><?php echo $date?> </h3>
                </thead>
                </th>
                    <div class="schedule">
                    <tbody>
                    <?php include 'GetKegiatan.php'; ?>
                    <tr>
                        <td class="blank"></td>
                        <td class="blank"></td>
                    </tr>
                </tbody>
                </div>
                    
            </table>
        </div>
        <div class="go-back">
            <a href="../Kalender.php">Go Back</a>
        </div>
     
    </main>
    
    <footer>
  
        71210730 - 71210775 - 71210816
        <br>
        Our Hard Work
    </footer>
</body>
</html>