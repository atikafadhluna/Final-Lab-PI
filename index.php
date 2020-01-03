<?php
$command = escapeshellcmd('python3 code/Query.py ' . $_POST['jumlah'] . ' ' . $_POST['kata']);
$hasil = shell_exec($command);

$data = json_decode($hasil, true);
for ($x = 0; $x < count($data); $x++) {
    $isi = shell_exec('cat data/crawling/' . $data[$x]['doc']);
    $kalimat = explode("\n", $isi);
    $data[$x]['title'] = $kalimat[0];
    $data[$x]['content'] = '';
    for ($y = 1; $y < count($kalimat); $y++) {
        $data[$x]['content'] .= $kalimat[$y];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Uas Lab PI</title>

    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container2">
        <nav class="navbar navbar-light bg-danger">
            <form class="form-inline" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Jumlah Berita" aria-label="Search" name="jumlah">
                <input class="form-control mr-sm-2" type="search" placeholder="kata" aria-label="Search" name="kata">
                <button class="btn btn btn-danger my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

    </div>
    <div class="isi">
        <?php foreach ($data as $dt) : ?>
            <a href="
            <?= $dt['url'] ?>">
                <?= $dt['title'] ?>
            </a>
            <br>
            <?= $dt['content'] ?>
            <br>
            <br>
        <?php endforeach; ?>
    </div>
    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>