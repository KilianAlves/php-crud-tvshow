<?php

declare(strict_types=1);

namespace Html;

/**
 *
 */
class WebPage
{
    use StringEscaper;
    /**
     * @var string
     */
    private string $head = "";
    /**
     * @var string
     */
    private string $title = "";
    /**
     * @var string
     */
    private string $body = "";

    /**
     * @param string $head
     * @param string $body
     * @param string $title
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
    }

    /**
     * @return string retourne la derniere modification de la page web
     */
    public static function getLastModification(): string
    {
        return date(" d/m/Y à H:i:s", getlastmod());
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $content ajoute au header le contenue passer en parametre
     */
    public function appendToHead(string $content): void
    {
        $this->head = $this->head . $content;
    }

    /**
     * @param string $css ajoute au header le css passer en parametre sans avoir besoin d'ecrire <style></style>
     */
    public function appendCss(string $css): void
    {
        $content = "<style>" . $css . "</style>";
        $this->head .= $content;
    }

    /**
     * @param string $url ajoute la balise de lien du fichier css dans le header a l'aide de son url
     */
    public function appendCssUrl(string $url): void
    {
        $cssUrl = "<link href='" . $url . "'rel='stylesheet'>";
        $this->head .= $cssUrl;
    }

    /**
     * @param string $js ajoute la balise script contenant le js passer en parametre au header
     */
    public function appendJs(string $js): void
    {
        $content = "<script>" . $js . "</script>";
        $this->head .= $content;
    }

    /**
     * @param string $url ajoute la balise de lien du fichier js dans le header juste a l'aide de l'url
     */
    public function appendJsUrl(string $url): void
    {
        $jsUrl = "<script type='text/javascript' src='" . $url . "' ></script>";
        $this->head .= $jsUrl;
    }

    /**
     * @param string $content ajoute le parametre a l'interieur du conteneur body
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * @return string retourne la page web generer a partir de son instance de classe
     */
    public function toHTMl(): string
    {
        $lastdate=self::getLastModification();
        return <<<HTML
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {$this->head}
        <title>{$this->title}</title>
    </head>
    <body>
    
        {$this->body}
        
       {$lastdate}
        
    </body>
</html>

HTML;
    }
}
