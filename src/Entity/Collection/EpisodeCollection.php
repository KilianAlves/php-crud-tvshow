<?php
declare(strict_types=1);

namespace Entity\Collection;

use PDO;
use Database\MyPdo;
use Entity\Episode;

class EpisodeCollection
{
    /**
     * La methode cree un tableau avec tout de episode
     *
     * @return episode[]
     */
    public static function findBySeasonId(int $seasonId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT name, overview, episodeNumber, id
            FROM episode
            WHERE seasonId=:seasonId
            ORDER BY episodeNumber;
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Episode::class);
        $stmt->execute(['seasonId' => $seasonId]);

        return $stmt->fetchAll();
    }
}