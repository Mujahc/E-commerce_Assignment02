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
        <h1>Publication View Index Page</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="/User/login" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="/Profile/index" class="nav-link">My Profile</a></li>
                <li class="nav-item"><a href="/Publication/create" class="nav-link">Create Publication</a></li>
                <li class="nav-item"><a href="/Publication/index" class="nav-link">My Publication/s</a></li>
                <li class="nav-item"><a href="/Publication/public" class="nav-link">PUBLIC Publication/s</a></li>
                <li class="nav-item"><a href="/User/logout" class="nav-link">Logout</a></li>
            </ul>
        </nav>
        <div class="mt-4">
            <form method="get" action="/Publication/index">
                <input type="text" name="search" placeholder="Search publications by title..." />
                <button type="submit">Search</button>
            </form>
            <?php foreach ($publications as $publication): ?>
                <div class="mb-3">
                    <h3>
                        <!-- Link to the publication detail view -->
                        <a href="/Publication/view/<?= $publication->publication_id ?>">
                            <?= htmlspecialchars($publication->publication_title) ?>
                        </a>
                    </h3>
                    <p><?= nl2br(htmlspecialchars($publication->publication_text)) ?></p>
                    <small>Published: <?= $publication->timestamp ?> | Status: <?= ucfirst($publication->publication_status) ?></small>
                    <?php if ($publication->profile_id == $_SESSION['profile_id']): ?>
                        <div>
                            <a href="/Publication/modify/<?= $publication->publication_id ?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="/Publication/delete/<?= $publication->publication_id ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>