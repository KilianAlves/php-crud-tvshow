<?php

declare(strict_types=1);

use Entity\Poster;




$poster = Poster::findById((int)$_GET['id']);

header("Content-Type: image/jpeg");

echo $poster->getJpeg();
