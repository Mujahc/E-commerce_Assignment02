<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-4">
        <h1><?= htmlspecialchars($publication->publication_title) ?></h1>
        <p><em>Published on: <?= $publication->timestamp ?></em></p>
        <div>
            <?= nl2br(htmlspecialchars($publication->publication_text)) ?>
        </div>
        
        <h2>Comments</h2>
        <?php if (!empty($comments)): ?>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <strong><?= htmlspecialchars($comment->author) ?>:</strong>
                        <?= htmlspecialchars($comment->text) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No comments yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>