<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Models\Users\User;

use MyProject\Models\Articles\Article;

class Comment extends ActiveRecordEntity
{
    protected $articleId;

    protected $authorId;

    protected $text;

    protected $createdAt;

    public function __construct()

    {

        $this->createdAt = date('Y-m-d H:i:s');

    }

    public function getAuthor(): User

    {

        return User::getById($this->authorId);

    }

    public function getArticle(): Article

    {

        return Article::getById($this->articleId);

    }

    public function setAuthor(User $user): void

    {

        $this->authorId = $user->getId();

    }

    public function setArticle(Article $article): void

    {

        $this->articleId = $article->getId();

    }

    public function setText(string $text): void

    {

        $this->text = $text;

    }

    public function getText(): string

    {

        return $this->text;

    }

    protected static function getTableName(): string

    {

        return 'comments';
        
    }
}