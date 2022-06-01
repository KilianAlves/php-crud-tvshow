<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Episode
{
    private int $id;
    private int $seasonId;
    private string $name;
    private string $overview;
    private int $episodeNumber;

    /**
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
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

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    public static function findByIdEpisode(int $id): Episode {
        $AlbumEtDate = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name,overview,episodeNumber,seasonId
            FROM episode
            WHERE id = ? 
            SQL
        );

        #execute le sql
        $AlbumEtDate->execute([$id]);
        $AlbumEtDate->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Episode::class);
        $artist = $AlbumEtDate->fetch();

        if ($artist === false) {
            throw new EntityNotFoundException("Artist with id $id not found");
        }
        return $artist;
}
}