<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Poster
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Poster
    {
        $sqlStatementCover = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, jpeg
            FROM poster
            WHERE id = :id
            SQL
        );

        $sqlStatementCover->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Poster::class);
        $sqlStatementCover->execute([":id" => $id]);

        $coverFound = $sqlStatementCover->fetch();


        return $coverFound;
    }
}