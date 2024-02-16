<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangun</title>
    <link rel="stylesheet" href="../Detail.css">
</head>

<body>
    <header>
        <div>
            Scheduler
        </div>
    </header>
    <main>
        <div class="container">
            <?php
            $tanggal_kegiatan = isset($_GET['date']) ? $_GET['date'] : '';
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="kegiatan">
                    <tr>
                        <th colspan="7" class="tgl-bulan-tahun">
                            <h3 id='jam'>Tanggal Kegiatan</h3>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>
                    <tr class="hari-hari">
                        <th colspan="7"><label for="prioritas">Nama Kegiatan</label>
                            <input type="text" id="kegiatanInput" name ="kegiatanInput" placeholder="Masukkan kegiatan">
                        </th>
                    </tr>
                    <tr class="your-image">
                        <td>Gambar </td>
                        <?php include 'getgambar.php'; ?>
                        <td> <img id = 'gambar' src="<?php echo $imageSource; ?>" width="261px" height="261px"></td>
                    </tr>
                    <td><label for="prioritas"></label></td>
                    <td>
                        <input type="file" id="gambarInput" name ="gambarInput" accept="image/*">

                    </td>
                    <tr class="prioritas">
                        <td><label for="prioritas">Prioritas</label> </td>
                        <td>
                            <select id="prioritas" name ="prioritas">
                                <option value="" disabled selected>Pilih Prioritas</option>
                                <option value="1">Urgent</option>
                                <option value="2">Important</option>
                                <option value="3">Non-Important</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="message">Message:</label></td>
                        <td> <textarea id="message" name="message" rows="1" cols="5"
                                style="width: 253px; height: 23px;"></textarea></td>
                    </tr>

                    <tr>
                        <td><label for="lokasi">Lokasi</label></td>
                        <td> <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan"></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="go-back">
                            <?php
                            $tanggal_kegiatan = isset($_GET['date']) ? $_GET['date'] : '';
                            ?>
                        <button type="submit" name="submit" style="color:white; border: none; background-color: transparent; text-decoration: underline; cursor: pointer;">Save</button>
                        <button type="submit" name="delete" style="color:white; border: none; background-color: transparent; text-decoration: underline; cursor: pointer;">Delete</button>

                        </td>

                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                </table>
            </form>
            <?php include 'detail_query.php'; ?>

        </div>
    </main>
    <footer>
        71210730 - 71210775 - 71210816
        <br>
        Our Hard Work
    </footer>

</body>

</html>