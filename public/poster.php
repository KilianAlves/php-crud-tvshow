<?php

declare(strict_types=1);

use Entity\Poster;


if (!isset($_GET['coverId']) || !ctype_digit($_GET['coverId'])) {
    throw new ParameterException();
}

$cover = Poster::findById((int)$_GET['coverId']);

header("Content-Type: image/jpeg");

echo $cover->getJpeg();
