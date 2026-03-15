<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <a href="/demo/www/articles/<?= $article->getId() ?>/edit">Редактировать статью</a>
<?php include __DIR__ . '/../footer.php'; ?>