<?php

declare(strict_types=1);

use Entity\Collection\SeasonCollection;
use Html\AppWebPage;
use Entity\TvShow;

if (!isset($_GET["serieId"]) || !ctype_digit($_GET["serieId"])) {
    header('Location: /');
    exit();
}

$serieId = $_GET["serieId"];
$serieId = intval($serieId);

$serie = TvShow::findById($serieId);
$listeSeason = SeasonCollection::findByTvShowId($serieId);

$webPage = new AppWebPage("Série Tv : {$serie->getName()}"); #crée page web avec titre en nom

#EscapeString des info de la serie
$photo = $webPage::escapeString("{$serie->getPosterId()}");
$name = $webPage::escapeString("{$serie->getName()}");
$originalName = $webPage::escapeString("{$serie->getOriginalName()}");
$overview = $webPage::escapeString("{$serie->getOverview()}");
#Les info de la serie
$webPage->appendContent("<div class='season'>");
$webPage->appendContent("<div><img src='poster.php?id={$photo}'></div>");
$webPage->appendContent("<div>");
$webPage->appendContent("<h2>{$name}</h2><h3>{$originalName}</h3>");
$webPage->appendContent("<p>{$overview}</p>");
$webPage->appendContent("</div></div>");

#les saisons de la serie
foreach ($listeSeason as $Season) {
    $photoSeason = $webPage::escapeString("{$Season->getPosterId()}");
    $nameSeason = $webPage::escapeString("{$Season->getName()}");
    $lienEpisode = $webPage::escapeString("{$Season->getId()}");
    $webPage->appendContent("<div class='season'>");
    $webPage->appendContent("<div><img src='poster.php?id={$photoSeason}'></div>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<h2><a href='season.php?seasonId={$lienEpisode}'>{$nameSeason}</a></h2>");
    $webPage->appendContent("</div></div>");
}

echo $webPage->toHTMl();