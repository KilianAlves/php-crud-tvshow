<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Collection\TvShowCollection;

$webPage = new AppWebPage("Série TV");

foreach (TvShowCollection::findAll() as $serie) {
    $textname = $webPage::escapeString($serie->getName()); #Titre serie
    $resume = $webPage::escapeString($serie->getOverview()); #Description serie
    $webPage->appendContent("<div class='serie'>");#Div deb
    $webPage->appendContent("<img src='.poster.php?id={$serie->getPosterId()}'>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<p> <a href='artist.php?artistId={$serie->getId()}'>$textname</a></p>\n");
    $webPage->appendContent("<p>{$resume}</p>");
    $webPage->appendContent("</div>");
    $webPage->appendContent("</div>"); #fin div deb
}
echo $webPage->toHTMl();