<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

    /**
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    public static function findByIdSeason(int $idSeason): Season
    {
        $LaSeason = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name,posterId,seasonNumber,tvShowId
            FROM season
            WHERE id = ? 
            SQL
        );

        #execute le sql
        $LaSeason->execute([$idSeason]);
        $LaSeason->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Season::class);
        $info = $LaSeason->fetch();

        if ($info === false) {
            throw new EntityNotFoundException("Artist with id $idSeason not found");
        }
        return $info;
    }
}