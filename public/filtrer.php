<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvShowFiltreCollection;
use Html\AppWebPage;

if (!isset($_GET["filtreId"]) || !ctype_digit($_GET["filtreId"])) {
    header('Location: /');
    exit();
}
if ($_GET["filtreId"] == "0") {
    header('Location: /');
    exit();
}

$filtreId = $_GET["filtreId"];
$filtreId = (int)$filtreId;

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
#Listes des films
foreach (TvShowFiltreCollection::findAllByIdGenre($filtreId) as $serie) {
    #EscapeString
    $textname = $webPage::escapeString($serie->getName()); #Titre serie
    $resume = $webPage::escapeString($serie->getOverview()); #Description serie
    $photo = $webPage::escapeString("{$serie->getPosterId()}");
    $lienSerie = $webPage::escapeString("{$serie->getId()}");
    #AppendContent
    $webPage->appendContent("<div class='serie'>");#Div deb
    $webPage->appendContent("<div><img src='poster.php?id={$photo}'></div>");
    $webPage->appendContent("<div>");
    $webPage->appendContent("<h3> <a href='serie.php?serieId={$lienSerie}'>$textname</a></h3>\n");
    $webPage->appendContent("<p>{$resume}</p></div></div>");#fin div deb
}
echo $webPage->toHTMl();