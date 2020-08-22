<?php

require_once("./upload.php");

if (isset($_FILES["upload"])) {
    $f = $_FILES['upload'];

    $file = new file;

    $file->set($f)
        ->max_size(20);

    if ($file->upload()) {
        //upload success
        echo json_encode([
            'status' => 'success',
            'message' => "Upload is succesfull"
        ]);
    } else {
        //upload success
        echo json_encode([
            'status' => 'failed',
            'message' => $file->report()
        ]);
    }
}
