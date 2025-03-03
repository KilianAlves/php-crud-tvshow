<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    public static function findAllGenre(): array
    {

        #recupere les nom des artistes
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name 
            FROM genre
            ORDER BY name
            SQL
        );
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Genre::class);

        return $stmt->fetchAll();
    }
}