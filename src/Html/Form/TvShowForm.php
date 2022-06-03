<?php
declare(strict_types=1);

namespace Html\Form;

use Entity\TvShow;

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
        $htmlName = ($this->tvShow == null) ? "" : $this->tvShow->getName();
        $htmlId = ($this->tvShow == null) ? "" : $this->tvShow->getId();

        return <<<HTML
        <form action="{$url}" method="post">
            <label for="name">Nom</label>
            <input name="name" type="text" value="{$htmlName}" required>
            <input name="id" type="hidden" value="{$htmlId}">
            <input type="submit" value="Enregistrer">
        </form>
        HTML;
    }
}