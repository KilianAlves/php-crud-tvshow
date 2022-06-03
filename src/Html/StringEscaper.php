<?php
declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * @param string $chaine
     * @return string retourne la chaine de charactere proteger
     */
    public static function escapeString(?string $chaine): string
    {
        if ($chaine == null) {
            return "";
        } else {
            return htmlspecialchars($chaine, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        }
    }
}