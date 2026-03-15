<?php include __DIR__ . '/../header.php'; ?>
<h1>Редактирование статьи</h1>
<form method="post">
    <p>
        Название статьи:<br>
        <input name="name" value="<?= $article->getName() ?>">
    </p>
    <p>
        Текст статьи:<br>
        <textarea name="text"><?= $article->getText() ?></textarea>
    </p>
    <button type="submit">Сохранить</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>