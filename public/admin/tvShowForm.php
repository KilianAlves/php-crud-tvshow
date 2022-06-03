<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Html\Form\TvShowForm;

$webpage = new AppWebPage("Admin: Artist");

try {
    if (isset($_GET['tvShowId'])) {
        if (!ctype_digit($_GET['tvShowId'])) {
            throw new ParameterException("Erreur de paramètre");
        } else {
            $artistId = (int)$_GET['tvShowId'];
            $tvShow = TvShow::findById($artistId);
        }
    }
    $tvShowForm = new TvShowForm($tvShow);
    $webpage->appendContent($tvShowForm->getHtmlForm("tvShow-save.php"));
    echo $webpage->toHTML();

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
