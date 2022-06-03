<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class TvShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;

    /**
     * @param int|null $id
     * @param string $name
     * @param string $originalName
     * @param string $homepage
     * @param string $overview
     * @param int $posterId
     */
    public function __construct(?int $id = null, string $name, string $originalName, string $homepage, string $overview, int $posterId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->homepage = $homepage;
        $this->overview = $overview;
        $this->posterId = $posterId;
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

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    public static function findById(int $id): TvShow
    {
        $AlbumEtDate = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name,originalName,overview,homepage,posterId
            FROM tvshow
            WHERE id = ? 
            SQL
        );

        #execute le sql
        $AlbumEtDate->execute([$id]);
        $AlbumEtDate->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, TvShow::class);
        $artist = $AlbumEtDate->fetch();

        if ($artist === false) {
            throw new EntityNotFoundException("Artist with id $id not found");
        }
        return $artist;
    }
    public function delete()
    {
        #Supprime le Show
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            DELETE 
            FROM tvshow
            WHERE id = ?
            SQL
        );
        $stmt->execute($this->id);
        $this->id = null;
        return $this;
    }
    public static function create(string $name, string $originalName, string $homepage, string $overview, int $posterId, ?int $id = null): TvShow
    {
        return new TvShow($name,$originalName,$overview, (string)$posterId, (string)$id);
    }
}