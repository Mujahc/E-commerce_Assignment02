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
        <h1>Publication View.php</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="/User/login" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="/Profile/index" class="nav-link">My Profile</a></li>
                <li class="nav-item"><a href="/Publication/create" class="nav-link">Create Publication</a></li>
                <li class="nav-item"><a href="/Publication/index" class="nav-link">My Publication/s</a></li>
            </ul>
        </nav>
        <h1><?= htmlspecialchars($publication->publication_title) ?></h1>
        <p><?= nl2br(htmlspecialchars($publication->publication_text)) ?></p>
        <small>Published: <?= $publication->timestamp ?></small>

        <?php if (isset($_SESSION['profile_id'])): ?>
            <!-- Comment Submission Form -->
            <div class="mt-5">
                <h3>Add a Comment</h3>
                <form action="/PublicationComment/add" method="post">
                    <input type="hidden" name="publication_id" value="<?= $publication->publication_id ?>">
                    <textarea name="comment_text" class="form-control" rows="3" style="width: 70%;" required></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Comments Section -->
        <div class="mt-5">
            <h3>Comments</h3>
            <?php foreach ($comments as $comment): ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <?= htmlspecialchars($comment->comment_text) ?>
                        <!-- Only show edit and delete buttons if the comment belongs to the logged-in user -->
                        <?php if ($comment->profile_id == $_SESSION['profile_id']): ?>
                            <div>
                                <a href="/PublicationComment/modify/<?= $comment->publication_comment_id ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="/PublicationComment/delete/<?= $comment->publication_comment_id ?>" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>