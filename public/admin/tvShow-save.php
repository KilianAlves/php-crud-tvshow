<?php
declare(strict_types=1);

use Entity\Exception\ParameterException;
use Html\AppWebPage;
use Entity\TvShow;
use Html\Form\TvShowForm;

$webPage = new AppWebPage("Admin: TvShow");

try {
    if (isset($_GET['tvShowId'])) {
        if (!ctype_digit($_GET['tvShowId'])) {
            throw new ParameterException("Erreur de parametre");
        } else {
            $tvShowId = (int)$_GET['tvShowId'];
            $tvShow = TvShow::findById($tvShowId);
        }
    }
    $tvShowForm = new TvShowForm($tvShow);
    $tvShowForm->setEntityFromQueryString();
    $tvShowForm->getTvShow()->save();

    header("Location: /index.php");

} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}