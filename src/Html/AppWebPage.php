<?php

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        parent::appendToHead(
            <<<HTML
            <link href="/css/style.css" rel="stylesheet">
HTML
        );
    }
    public function toHTMl(): string
    {
        $head=parent::getHead();
        $title=parent::getTitle();
        $body=parent::getBody();
        $lastdate=self::getLastModification();
        return <<<HTML
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {$head}
        <title>{$title}</title>
    </head>
    <body>
        <header class="header">
            <h1>$title</h1>
        </header>
        <div class="content">
           <div class="list">
         
                    {$body}
            
            </div>
        </div>
       <footer class="footer">
       
             
            Derniere modification :{$lastdate}
   
       </footer>
        
    </body>
</html>

HTML;

    }
}
