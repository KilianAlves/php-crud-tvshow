<?php
declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm extends TvShow
{
    private ?TvShow $tvShow;

    /**
     * @param TvShow|null $tvShow
     */
    public function __construct(?TvShow $tvShow)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * @return TvShow|null
     */
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    public function getHtmlForm(string $url): string
    {
        $htmlName = ($this->tvShow == null) ? "" : StringEscaper::escapeString($this->tvShow->getName());
        $htmlOriginalName = ($this->tvShow == null) ? "" : StringEscaper::escapeString($this->tvShow->getOriginalName());
        $htmlHomepage = ($this->tvShow == null) ? "" : StringEscaper::escapeString($this->tvShow->getHomepage());
        $htmlOverview = ($this->tvShow == null) ? "" : StringEscaper::escapeString($this->tvShow->getOverview());
        $htmlId = ($this->tvShow == null) ? "" : $this->tvShow->getId();

        return <<<HTML
        <form action="{$url}" method="post">
            <label for="name">Nom</label>
            <input name="name" type="text" value="{$htmlName}" required>
            <label for="originalName">Nom original</label>
            <input name="originalName" type="text" value="{$htmlOriginalName}" required>
            <label for="homepage">Homepage</label>
            <input name="homepage" type="text" value="{$htmlHomepage}" required>
            <label for="overview">Résumé</label>
            <input name="overview" type="text" value="{$htmlOverview}" required>
            <input name="id" type="hidden" value="{$htmlId}">
            <input type="submit" value="Enregistrer">
        </form>
        HTML;
    }

    public function setEntityFromQueryString()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $originalName = $_POST['originalName'];
        $homepage = $_POST['homepage'];
        $overview = $_POST['overview'];

        if (empty($name) || empty($originalName) || empty($homepage) || empty($overview)) {
            throw new ParameterException();
        }

        $name = StringEscaper::stripTagsAndTrim($name);
        $originalName = StringEscaper::stripTagsAndTrim($originalName);
        $homepage = StringEscaper::stripTagsAndTrim($homepage);
        $overview = StringEscaper::stripTagsAndTrim($overview);

        if (isset($id) && ctype_alnum($id)) {
            $this->artist = TvShow::create($name, $originalName, $homepage, $overview, (int)$id);
        } else {
            $this->artist = TvShow::create($name, $originalName, $homepage, $overview, null);
        }
    }
}