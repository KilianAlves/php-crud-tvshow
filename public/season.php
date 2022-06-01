<?php


declare(strict_types=1);

use Entity\Collection\EpisodeCollection;
use Entity\Episode;
use Entity\Season;
use Entity\TvShow;
use Html\AppWebPage;

if (!isset($_GET["seasonId"]) || !ctype_digit($_GET["seasonId"])) {
    header('Location: /');
    exit();
}

$seasonId = $_GET["seasonId"];
$seasonId = intval($seasonId);

$season = Episode::findByIdEpisode($seasonId);
$serie = Season::findByIdSeason($season->getSeasonId());
$show = TvShow::findById($serie->getTvShowId());

$webPage = new AppWebPage("Série Tv : {$show->getName()} {$serie->getName()}"); #crée page web avec titre en nom

$listeEpisode = EpisodeCollection::findBySeasonId($seasonId);

#la saison a mettre ici


#Les episode de la season
foreach ($listeEpisode as $Episode) {
    $numEpisode = $webPage::escapeString("{$Episode->getEpisodeNumber()}");
    $titreEpisode =$webPage::escapeString("{$Episode->getName()}");
    $descEpisode =$webPage::escapeString("{$Episode->getOverview()}");

    $webPage->appendContent("<div class='episode'>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<h3>{$numEpisode}</h3> - <h3>{$titreEpisode}</h3>");
    $webPage->appendContent("</div>");
    $webPage->appendContent("<div><p>{$descEpisode}</p></div>");

    $webPage->appendContent("</div></div>");
}



echo $webPage->toHTMl();
