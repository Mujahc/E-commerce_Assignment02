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
        <h1>Delete Publication</h1>
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
        <h1>Are you sure you want to delete this publication?</h1>
        <form action="/Publication/delete/<?= $publication_id ?>" method="post">
            <input type="hidden" name="publication_id" value="<?= $publication_id ?>">
            <button type="submit">Yes, delete it</button>
            <a href="/Publication/index">No, take me back</a>
        </form>
    </div>
</body>
</html>