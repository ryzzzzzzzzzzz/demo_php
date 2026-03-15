<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() ?></h1>
<p><?= $article->getText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<a href="/www/demo/articles/<?= $article->getId() ?>/edit">Редактировать статью</a>
<hr>
<h2>Комментарии</h2>
<?php foreach (\MyProject\Models\Comments\Comment::findAllByColumn('article_id', $article->getId()) as $comment): ?>
    <div id="comment<?= $comment->getId() ?>">
        <p><b><?= $comment->getAuthor()->getNickname() ?>:</b> <?= $comment->getText() ?></p>
        <?php if ($user && $user->getId() === $comment->getAuthor()->getId()): ?>
            <a href="/demo/www/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php if ($user): ?>
    <hr>
    <h3>Добавить комментарий</h3>
    <form method="post" action="/demo/www/articles/<?= $article->getId() ?>/comments">
        <textarea name="text" rows="4" cols="50"></textarea><br>
        <button type="submit">Отправить</button>
    </form>
<?php else: ?>
    <p>Чтобы оставить комментарий, <a href="/www/demo/users/login">войдите</a> в систему.</p>
<?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>