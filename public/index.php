<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Html\AppWebPage;
use Entity\Collection\TvShowCollection;

$webPage = new AppWebPage("Série TV");

#Formulaire
$webPage->appendContent('<form action="filtrer.php" method="GET">');
$webPage->appendContent('<select name="filtreId" id="filtreId">');
$webPage->appendContent('<option value="0">Pas de filtre</option>');
#Les autres options
foreach (GenreCollection::findAllGenre() as $genre) {
    $webPage->appendContent("<option value={$genre->getId()}>{$genre->getName()}</option>");
}
$webPage->appendContent("</select>");
$webPage->appendContent('<input type="submit"></input>');
$webPage->appendContent("</form>");
#Fin formulaire
#Listes des series
foreach (TvShowCollection::findAll() as $serie) {
    $textname = $webPage::escapeString($serie->getName()); #Titre serie
    $resume = $webPage::escapeString($serie->getOverview()); #Description serie
    $photo = $webPage::escapeString("{$serie->getPosterId()}");
    $lienSerie = $webPage::escapeString("{$serie->getId()}");
    $webPage->appendContent("<a href='serie.php?serieId={$lienSerie}'><div class='serie'>");#Div deb
    $webPage->appendContent("<div><img src='poster.php?id={$photo}'></div>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<h3>$textname</h3>\n");
    $webPage->appendContent("<p>{$resume}</p>");
    $webPage->appendContent("</div>");
    $webPage->appendContent("</div></a>"); #fin div deb
}
echo $webPage->toHTMl();