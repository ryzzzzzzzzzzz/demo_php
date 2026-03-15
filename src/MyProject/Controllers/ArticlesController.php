<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;

use MyProject\View\View;

class ArticlesController

{

    /** @var View */

    private $view;

    /** @var Db */

    private $db;

    public function __construct()

    {

        $this->view = new View(__DIR__ . '/../../../templates');

        $this->db = new Db();

    }

    public function view(int $articleId)

    {

        $result = $this->db->query(

            'SELECT * FROM `articles` WHERE id = :id;',

            [':id' => $articleId]

        );

        if ($result === []) {

            $this->view->renderHtml('errors/404.php', [], 404);

            return;

        }

        $article = $result[0];

        // Получаем автора статьи
        $authorResult = $this->db->query(

            'SELECT nickname FROM `users` WHERE id = :id',

            [':id' => $article->author_id]

        );

        $authorNickname = $authorResult ? $authorResult[0]->nickname : 'Неопознанная капибара';

        // Передаём статью и nickname автора в шаблон
        $this->view->renderHtml('articles/view.php', [

            'article' => $article,

            'authorNickname' => $authorNickname

        ]);

    }

}