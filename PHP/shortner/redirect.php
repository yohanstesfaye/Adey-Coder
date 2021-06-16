<?php
$key = $_GET['token'] ?? null;

if (!is_null($key)) {
    echo "not";
} else {
    echo "null";
}
