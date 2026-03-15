<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController

{

    public function __construct()

    {
        
        parent::__construct();

    }

    public function main()

    {

        $articles = Article::findAll();

        $this->view->renderHtml('main/main.php', ['articles' => $articles]);

    }

}