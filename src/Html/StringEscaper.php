<?php
declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * @param string $chaine
     * @return string retourne la chaine de charactere de la base de donnees proteger
     */
    public static function escapeString(?string $chaine): string
    {
        if ($chaine == null) {
            return "";
        } else {
            return htmlspecialchars($chaine, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        }
    }

    /**
     * @param string|null $chaine Chaîne de caractères de l'utilisateur à protéger
     * @return string Chaîne de caractère sécurisée
     */
    public static function stripTagsAndTrim(?string $chaine): string
    {
        if ($chaine==null) {
            return "";
        } else {
            $var = trim(strip_tags($chaine));
            $var = ltrim($var, " ");
            return rtrim($var, " ");
        }
    }
}