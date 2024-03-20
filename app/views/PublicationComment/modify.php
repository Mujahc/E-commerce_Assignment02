<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?> view</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Edit Comment</h1>
        <form action="/PublicationComment/modify/<?= $comment->publication_comment_id ?>" method="post">
            <div class="form-group">
                <label for="comment_text">Comment:</label>
                <textarea name="comment_text" class="form-control" rows="3" required><?= htmlspecialchars($comment->comment_text) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
            <a href="/Publication/view/<?= $comment->publication_id ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>