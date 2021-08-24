<?php

// ┌──────────────────────────────────────────────────────────────────────────────┐
// │ Select Chain data wilayah menggunakan ajax dan REST API                      │
// │ 1. siapkan database baru, upload sql                                         │
// │ 2. upload file api.php, koneksikan dengan db tadi.                           │
// │ 3. pada start point,  sesuaikan endpoint ke api tadi                         │
// │                                                                              │
// │ salam https://github.com/3vluzi                                              │
// │                                                                              │
// └──────────────────────────────────────────────────────────────────────────────┘
$endpoint = 'https://izulthea.com/api/'; //working
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Chained SELECT Wilayah Plus API</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
<link rel="stylesheet" href="css/loading-bar.css">
</head>

<body>
    <div class="container p-3">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- ---------------------------- konten utama 2021-08-24 jam  13:25:10.000-05:00 ----------------------------- -->
                    <div class="row">
                        <div class="col-12">
                            <h2 align="center" style="margin: 60px 10px 10px 10px;">Chained SELECT Wilayah Plus API</h2>
                            <div class="alert alert-info">
                                Jika tidak jalan, coba buang poper.js atau naikkan jquery ke posisi atas.
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi">
                                    <option value=""> Pilih Provinsi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select class="form-control" name="kabupaten" id="kabupaten">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelurahan/Desa</label>
                                <select class="form-control" name="kelurahan" id="kelurahan">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- ---------------------------- konten utama  2021-08-24 jam 13:25:10.000-05:00----------------------------- -->
<div class="alert alert-info">
    CREDIT<br>
    <ul>
        <li><a href="https://github.com/ichadhr/db-wilayah-indonesia">SQL Data Wilaha by ichadr</a></li>
        <li><a href="https://getbootstrap.com/">Bootstrap</a></li>
        <li><a href="https://codebyzach.github.io/pace/">PACEJS</a></li>
        <li><a href="https://jquery.com/">JQUERY</a></li>
    </ul>
</div>
                </div><!-- card selesai -->
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    type: 'GET',
                    url: "<?php echo $endpoint; ?>api.php?cmd=prov",
                    cache: false,
                    success: function(msg) {
                        $("#provinsi").html(msg);
                    }
                });
                $("#provinsi").change(function() {
                    var id = $("#provinsi").val();
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo $endpoint; ?>api.php?cmd=kota",
                        data: {
                            id: id
                        },
                        cache: false,
                        success: function(msg) {
                            $("#kabupaten").html(msg);
                        }
                    });
                });
                $("#kabupaten").change(function() {
                    var id = $("#kabupaten").val();
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo $endpoint; ?>api.php?cmd=kec",
                        data: {
                            id: id
                        },
                        cache: false,
                        success: function(msg) {
                            $("#kecamatan").html(msg);
                        }
                    });
                });
                $("#kecamatan").change(function() {
                    var id = $("#kecamatan").val();
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo $endpoint; ?>api.php?cmd=kel",
                        data: {
                            id: id
                        },
                        cache: false,
                        success: function(msg) {
                            $("#kelurahan").html(msg);
                        }
                    });
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>