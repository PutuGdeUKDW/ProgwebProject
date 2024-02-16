<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Gunakan nilai $username sesuai kebutuhan Anda
} else {
    // Pengguna belum login, lakukan tindakan yang sesuai
}

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];

    // Gunakan nilai $username sesuai kebutuhan Anda
} else {
    // Cookie username tidak ada, lakukan tindakan yang sesuai
    echo "Cookie username tidak ditemukan";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <link rel="stylesheet" href="style.css">
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

        .container .month-year {
            display: flex;
            justify-content: right;
            transform: translateX(-12%);
            justify-content: 50%;
            align-items: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container .month-year h3 {
            margin: 0;
            margin-bottom: 30px;

        }

        .container .month-year .button {
            display: flex;
            align-items: center;
        }

        .container .month-year .button .prev,
        .container .month-year .button .next {
            width: 30px;
            height: 30px;
            background: #262626;
            margin: 0 10px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        .container .month-year .button .prev{
            margin-left: 110px;
        }
        .container .month-year .button .next{
            margin-right: 110px;
        }
        /* Menampilkan teks melayang ketika kursor di atas elemen */
        [data-tooltip]:hover::before {
            opacity: 1;
        }

        a {
            color:inherit;
        }

        .login-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #262626;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }

        .login-logo {
            position: absolute;
            top: 14px;
            left: 60px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .login-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #262626;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

        .login-button a {
            color: white;
            font-size: 20px;
    }
            .login-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #262626;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: width 0.3s;
        }

        .login-button:hover {
        width: 75px;
        height: 75px;
        }

        .user-icon {
        color: white;
        font-size: 20px;
        display: flex;
        align-items: center;
        }

        .user-info {
        display: none;
        position: absolute;
        top: 40px;
        left: 0;
        width: 200px;
        height: 75px;
        background-color: #262626;
        color: white;
        padding: 20px;
        font-family: Arial, sans-serif;
        }

        .login-button:hover .user-info {
        display: flex;
        flex-direction: column;
        }

        .username {
        margin-top: 0;
        margin-bottom: 20px;
        }

        .logout-button {
        background-color: #262626;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        }

        .logout-button:hover {
        background-color: #333333;
        }

        div div p.username {
            text-align: center;
            font-size: 20px;
        }
    a#urgent {
    color: red; /* Ganti dengan warna yang Anda inginkan */
}
a#important {
    color: blue; /* Ganti dengan warna yang Anda inginkan */
}
a#not-important {
    color: green; /* Ganti dengan warna yang Anda inginkan */
}
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>


<body>
    <header>
        <div>
         Scheduler
        </div>
        <div class="container">
            <div class="login-button" id="userButton">
                <a href="#" class="user-icon"><i class="fas fa-user"></i></a>
                <div class="user-info">
                <p class="username">
                    <?php
                    echo $username
                    ?>
                </p>
                <a href="Login/logout.php" class="logout-button" style="font-size: 12px; text-align: center;">Logout</a>

                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="month-year">
                <div class="button">
                    <span class="prev">&#8249;</span>
                </div>
                <h3 id="currentDate"></h3>
                <div class="button">
                    <span class="next">&#8250;</span>
                </div>
            </div>
            <table class="kalender">
                <tr class="days">
                    <th>Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>

                </tr>
                <tr>
                    <td class="not-month">26<br>
                    </td>
                    <td class="not-month">27</td>
                    <td class="not-month">28</td>
                    <td class="not-month">29</td>
                    <td class="not-month">30</td>
                    <td class="not-month">31</td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html " target="">1</a></td>
                </tr>
                <tr>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">2</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">3</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">4</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">5</a><br>
                    </td>
                    <td>
                        <div><a title="Tidak ada acara" href="Acara/Acara.html" target="">6</a></div>
                    </td>
                    <td>
                        <a title="Tidak ada acara" href="Acara/Acara.html" target="">
                            7
                        </a>
                    </td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">8</a></td>
                </tr>
                <tr>
                    <td>
                        <a title="Tidak ada acara" href="Acara/Acara.html" target="">9</a>
                    </td>
                    </td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">10</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">11</a><br>
                    </td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">12</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">13</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">14</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">15</a></td>
                </tr>
                <tr>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">16</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">17</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">18</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">19</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">20</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">21</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">22</a></td>
                </tr>
                <tr>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">23</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">24</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">25</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">26</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">27</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">28</a></td>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">29</a></td>
                </tr>
                <tr>
                    <td><a title="Tidak ada acara" href="Acara/Acara.html" target="">30</a></td>
                    <td class="not-month">1</td>
                    <td class="not-month">2</td>
                    <td class="not-month">3</td>
                    <td class="not-month">4</td>
                    <td class="not-month">5</td>
                    <td class="not-month">6</td>
                </tr>
            </table>
            <div class="wrapper">
                <div class="priorities">
                    <div class="block urgent"></div>
                    <Div class="spasi"> </Div>
                    <div> Penting</div>
                    <div class="block"></div>
                    <div class="block important"> </div>
                    <Div class="spasi"> </Div>
                    <div> Sedang</div>
                    <div class="block"></div>
                    <div class="block not-important"> </div>
                    <Div class="spasi"> </Div>
                    <div> Biasa</div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // Fungsi untuk mengirimkan cookie ke halaman acara.php
        function sendCookie(date) {
            // Mengirimkan cookie melalui parameter URL
            window.location.href = 'acara.php?date=' + date;
        }

        // Mengambil semua elemen tanggal
        var dates = document.querySelectorAll('.kalender a');

        // Menambahkan event listener untuk setiap tanggal
        dates.forEach(function(date) {
            date.addEventListener('click', function() {
                var clickedDate = this.innerHTML;
                sendCookie(clickedDate);
            });
        });
    </script>
    <footer>
        71210730 - 71210775 - 71210816
        <br>
        Our Hard Work
    </footer>
    <script src="script.js"></script>
    <script>
        const userButton = document.getElementById('userButton');
        userButton.addEventListener('mouseleave', function() {
        this.style.width = '40px';
        });
    </script>
</body>

</html>