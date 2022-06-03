<?php

declare(strict_types=1);

use Entity\Poster;
use Entity\Exception;

try {
    $poster = Poster::findById((int)$_GET['id']);

header("Content-Type: image/jpeg");

echo $poster->getJpeg();

} catch (EntityNotFoundException) {
    header("Location: /image/default.png");
}

