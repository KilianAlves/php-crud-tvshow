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
    private ?int $posterId;

    private function __construct()
    {
    }

    /**
     * @return int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * @return int
     */
    public function getId(): ?int
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

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $originalName
     */
    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * @param string $overview
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @param int $posterId
     */
    public function setPosterId(?int $posterId): void
    {
        $this->posterId = $posterId;
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
        $stmt->execute([$this->id]);
        $this->id = null;
        return $this;
    }

    public static function create(string $name, string $originalName, string $homepage, string $overview, int $posterId = null, ?int $id = null): TvShow
    {
        $show = new TvShow();
        $show->setName($name);
        $show->setOriginalName($originalName);
        $show->setOverview($overview);
        $show->setPosterId($posterId);
        $show->setId($id);
        return $show;
    }

    public function insert()
    {
        $inser = MyPdo::getInstance()->prepare(
            <<<SQL
            INSERT INTO tvshow (name,originalName,homepage,overview,posterId)
            VALUES (:name, :originalName, :homepage, :overview, :posterId)
            SQL
        );
        $inser->execute([":name" => $this->name, "originalName" => $this->originalName,
            "homepage" => $this->homepage, "overview" => $this->overview,
            "posterId" => $this->posterId]);
    }
    public function update() : TvShow {

        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            UPDATE artist
            SET name = :name, originalName = :originalName, homepage = :homepage, overview = :overview, posterId = :posterId 
            WHERE id = :id
            SQL
        );

        $stmt->execute([":id" => $this->id,
            ":name" => $this->name, "originalName" => $this->originalName,
            "homepage" => $this->homepage, "overview" => $this->overview,
            "posterId" => $this->posterId]);
        return $this;
    }

    public function save(): TvShow
    {
        if ($this->id == null) {
            $this->insert();
            $this->id = MyPdo::getInstance()->lastInsertId();
        } else {
            $this->update();
        }

        return $this;
    }
}