<?php

declare(strict_types=1);

use Html\AppWebPage;


if (!isset($_GET["serieId"]) || !ctype_digit($_GET["serieId"])) {
    header('Location: /');
    exit();
}

$serieId = $_GET["serieId"];

$serieId = intval($serieId);

$webPage = new AppWebPage("Série Tv :"); #crée page web avec titre en nom