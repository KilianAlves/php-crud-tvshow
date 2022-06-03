<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Html\Form\TvShowForm;

$webpage = new AppWebPage("Admin: TvShow");

try {
    if (!isset($_GET['tvShowId']) or !ctype_digit($_GET['tvShowId'])) {
        throw new ParameterException("Erreur de paramètre");
    }

    $tvShowId = (int)$_GET['tvShowId'];
    $tvshow = TvShow::findById($tvShowId);
    $tvshow->delete();

    header("Location: /index.php");
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}