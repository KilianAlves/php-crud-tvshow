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


}