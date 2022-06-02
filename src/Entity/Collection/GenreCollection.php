<?php

namespace Entity\Collection;

use Database\MyPdo;

class GenreCollection
{
    public static function findAllGenre(): array
    {

        #recupere les nom des artistes
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id,genre
            FROM genre
            ORDER BY name
            SQL
        );
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, TvShow::class);

        return $stmt->fetchAll();
    }
}