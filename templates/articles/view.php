<?php include __DIR__ . '/../header.php'; ?>
<h1><?= htmlspecialchars($article->name) ?></h1>
<p><?= htmlspecialchars($article->text) ?></p>
<p><strong>Автор:</strong> <?= htmlspecialchars($authorNickname) ?></p>
<?php include __DIR__ . '/../footer.php'; ?>