<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;

    /**
     * Get the cover id
     * @return int cover id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the jpeg data
     * @return string a string that is jpeg data
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Read from database using id to find corresponding line throws Entity\Exception\EntityNotFoundException if no data can be found.
     * @param int $id The cover id
     * @return Cover The cover found
     */
    public static function findById(int $id): Cover
    {
        $sqlStatementCover = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, jpeg
            FROM cover
            WHERE id = :id
            SQL
        );

        $sqlStatementCover->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Cover::class);
        $sqlStatementCover->execute([":id" => $id]);

        $coverFound = $sqlStatementCover->fetch();

        if (!$coverFound) {
            throw new EntityNotFoundException();
        }

        return $coverFound;
    }
}
