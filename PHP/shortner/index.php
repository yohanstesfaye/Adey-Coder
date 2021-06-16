<?php
require_once('./shorten.php');

$s = new shorten;
$link = 'htts://example.com/?je877q';

//add to DB
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    if ($s->add($url)) {
        $link = $s->get_shorten();
    } else {
        $link = $s->get_error();
    }
}

//redirect
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL shortner</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../res/fontawesome/css/all.css">
</head>

<body>
    <div class="title">
        PHP URL Shortener
    </div>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="url" name="url" id="" placeholder="Enter URL Address" required>
        <input type="submit" value="Generate">
    </form>

    <?php if (!empty($link)) { ?>
        <div class="generated">
            <?= $link ?>
            <button><i class="far fa-copy"></i></button>
        </div>
    <?php } ?>
</body>

</html>