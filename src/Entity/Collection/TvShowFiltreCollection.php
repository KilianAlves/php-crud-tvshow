<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use Entity\TvShow;
use PDO;

class TvShowFiltreCollection
{
    public static function findAllByIdGenre(int $genreid): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name,originalName,homepage,overview,posterId
            FROM tvshow
            WHERE id IN (SELECT tvShowId
                        FROM tvshow_genre
                        WHERE genreId = ?)
            ORDER BY name ;
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, TvShow::class);
        $stmt->execute([$genreid]);

        return $stmt->fetchAll();
    }
}