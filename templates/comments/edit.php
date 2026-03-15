<?php include __DIR__ . '/../header.php'; ?>
<h1>Редактировать комментарий</h1>
<form method="post">
    <textarea name="text" rows="4" cols="50"><?= htmlspecialchars($comment->getText()) ?></textarea><br>
    <button type="submit">Сохранить</button>
</form>
<?php include __DIR__ . '/../footer.php'; ?>