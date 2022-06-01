<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\TvShowCollection;

$webPage = new AppWebPage("Série TV");

foreach (TvShowCollection::findAll() as $serie) {
    $textname = $webPage::escapeString($serie->getName()); #Titre serie
    $resume = $webPage::escapeString($serie->getOverview()); #Description serie
    $photo = $webPage::escapeString("{$serie->getPosterId()}");
    $lienSerie = $webPage::escapeString("{$serie->getId()}");
    $webPage->appendContent("<div class='serie'>");#Div deb
    $webPage->appendContent("<div><img src='poster.php?id={$photo}'></div>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<h3> <a href='serie.php?serieId={$lienSerie}'>$textname</a></h3>\n");
    $webPage->appendContent("<p>{$resume}</p>");
    $webPage->appendContent("</div>");
    $webPage->appendContent("</div>"); #fin div deb
}
echo $webPage->toHTMl();