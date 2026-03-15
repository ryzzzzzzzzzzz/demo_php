<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;

use MyProject\Models\Articles\Article;

use MyProject\Models\Users\User;

use MyProject\Models\Comments\Comment;

class ArticlesController extends AbstractController

{

    public function __construct()

    {

        parent::__construct();

    }

    public function view(int $articleId): void

    {

        $article = Article::getById($articleId);

        if ($article === null) {

            throw new NotFoundException();

        }

        $this->view->renderHtml('articles/view.php', ['article' => $article]);

    }

     public function edit(int $articleId): void

    {

        $article = Article::getById($articleId);

 

        if ($article === null) {

            throw new NotFoundException();

        }

        if (!empty($_POST)) {

            $article->setName($_POST['name']);

            $article->setText($_POST['text']);

            $article->save();

            header('Location: /demo/www/articles/' . $article->getId());

            exit();
        }

        $this->view->renderHtml('articles/edit.php', [

            'article' => $article

        ]);

    }

    public function add(): void

    {

        $author = User::getById(1);

        $article = new Article();

        $article->setAuthor($author);

        $article->setName('Новое название статьи');

        $article->setText('Новый текст статьи');

        $article->save();

        var_dump($article);

    }

    public function addComment(int $articleId): void

    {

        $article = Article::getById($articleId);

        if ($article === null) {

            throw new NotFoundException();
        }

        if ($this->user === null) {

            header('Location: /demo/www/users/login');

            exit();
        }

        if (!empty($_POST['text'])) {

            $comment = new Comment();

            $comment->setArticle($article);

            $comment->setAuthor($this->user);

            $comment->setText($_POST['text']);

            $comment->save();

            header('Location: /demo/www/articles/' . $article->getId() . '#comment' . $comment->getId());

            exit();
        }

        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }

    public function editComment(int $commentId): void

    {

        $comment = Comment::getById($commentId);


        if ($comment === null) {

            throw new NotFoundException();

        }

        if ($this->user === null || $this->user->getId() !== $comment->getAuthor()->getId()) {

            throw new \Exception('Нет прав для редактирования комментария');
        }

        if (!empty($_POST['text'])) {

            $comment->setText($_POST['text']);

            $comment->save();

            header('Location: /demo/www/articles/' . $comment->getArticle()->getId() . '#comment' . $comment->getId());

            exit();

        }

        $this->view->renderHtml('comments/edit.php', ['comment' => $comment]);
    }

}