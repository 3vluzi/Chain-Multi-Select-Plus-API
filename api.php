<?php
// ┌──────────────────────────────────────────────────────────────────────────────┐
// │ REST API untuk Chain Select                                                  │
// │ https://izulthea.com                                                         │
// │                                                                              │
// └──────────────────────────────────────────────────────────────────────────────┘
/* ------------------------------- enable cors ------------------------------ */
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day
/* -------------------------------- pengaman -------------------------------- */
function hanyahuruf($string)
{
    return preg_replace('/[^a-z]/i', '', $string);
}
function hanyaangka($string)
{
    return preg_replace('/[^0-9]/', '', $string);
}
/* ------------------------------ start command ----------------------------- */
$cmd = trim(addslashes(hanyahuruf($_GET['cmd'])));
$pass = "CHANGE_PASSWORD_DB";
$user = "CHANGE_USERNAME_DB";
$dsn = 'mysql:host=localhost;dbname=CHANGE_DB_NAME;charset=utf8';
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
global $pdo;
/* ----------------------------- koneksi selesai ---------------------------- */

/* ------------------------------ function api ------------------------------ */
function get_provinsi()
{
    global $pdo;
    $sql = "SELECT * FROM provinsi";
    return $pdo->query($sql)->fetchAll();
}
function get_kabupaten($idprov)
{
    global $pdo;
    $sql = "SELECT * FROM kabupaten WHERE id_prov = '$idprov'";
    return $pdo->query($sql);
}
function get_kecamatan($idkab)
{
    global $pdo;
    $sql = "SELECT * FROM kecamatan WHERE id_kab = '$idkab'";
    return $pdo->query($sql);
}
function get_kelurahan($idkec)
{
    global $pdo;
    $sql = "SELECT * FROM kelurahan WHERE id_kec = '$idkec' ";
    return $pdo->query($sql);
}
/* ----------------------------- mulai eksekusi ----------------------------- */
switch ($cmd) {
    default:
        echo 'forbidden';
        break;
        /* -------------------------------- provinsi -------------------------------- */
    case 'prov':
        $data = get_provinsi();
        echo '<option value="">--PILIH PROVINSI--</option>';
        foreach ($data as $d) {
            //      echo $d['id_prov'];
?>
            <option value="<?php echo $d["id_prov"]; ?>"><?php echo $d["nama"]; ?></option>
        <?php
        }
        break;
        /* ---------------------------------- kota ---------------------------------- */
    case 'kota':
        $idprov = $_GET['id'];
        $data =   get_kabupaten($idprov);
        echo '<option value="">--PILIH KOTA/KABUPATEN--</option>';
        foreach ($data as $d) {
        ?>
            <option value="<?php echo $d["id_kab"]; ?>"><?php echo $d["nama"]; ?></option>
        <?php
        }
        break;
        /* -------------------------------- kecamatan ------------------------------- */
    case 'kec':
        $idkab = $_GET['id'];
        $data =   get_kecamatan($idkab);
        echo '<option value="">--PILIH KECAMATAN--</option>';
        foreach ($data as $d) {
        ?>
            <option value="<?php echo $d["id_kec"]; ?>"><?php echo $d["nama"]; ?></option>
        <?php
        }
        break;
        /* -------------------------------- kelurahan ------------------------------- */
    case 'kel':
        $idkec = $_GET['id'];
        $data =   get_kelurahan($idkec);
        echo '<option value="">--PILIH KELURAHAN/DESA--</option>';
        foreach ($data as $d) {
        ?>
            <option value="<?php echo $d["id_kel"]; ?>"><?php echo $d["nama"]; ?></option>
<?php
        }
        break;
}
?>