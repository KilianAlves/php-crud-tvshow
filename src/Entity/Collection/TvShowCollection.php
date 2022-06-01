<?php

namespace Entity\Collection;

use PDO;
use Database\MyPdo;
use Entity\TvShow;

class TvShowCollection
{
    /**
     * La methode cree un tableau avec tout du tvShow
     *
     * @return TvShow[]
     */
    public static function findAll(): array
    {

        #recupere les nom des artistes
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            ORDER BY name
            SQL
        );
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, TvShow::class);

        return $stmt->fetchAll();
    }
}