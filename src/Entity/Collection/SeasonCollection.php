<?php
declare(strict_types=1);

namespace Entity\Collection;

use PDO;
use Database\MyPdo;
use Entity\season;

class SeasonCollection
{
    /**
     * La methode cree un tableau avec tout de tvShow
     *
     * @return season[]
     */
    public static function findByTvShowId(int $tvShowId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT name, seasonNumber, posterId, id
            FROM season s
            WHERE tvShowId=:tvShowId
            ORDER BY seasonNumber;
            SQL
            );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, season::class);
        $stmt->execute(['tvShowId' => $tvShowId]);

        return $stmt->fetchAll();
    }
}