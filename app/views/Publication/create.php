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
        <h1>Create Publication</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="/User/login" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="/Profile/index" class="nav-link">My Profile</a></li>
                <li class="nav-item"><a href="/Publication/create" class="nav-link">Create Publication</a></li>
                <li class="nav-item"><a href="/Publication/index" class="nav-link">My Publication/s</a></li>
            </ul>
        </nav>
        <form action="/Publication/create" method="post">
            <div>
                <label for="publication_title">Title:</label>
                <input type="text" id="publication_title" name="publication_title" required>
            </div>
            <div>
                <label for="publication_text">Text:</label>
                <textarea id="publication_text" name="publication_text" rows="3" style="width: 70%;" required></textarea>
            </div>
            <div>
                <label for="publication_status">Status:</label>
                <select id="publication_status" name="publication_status">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
            <button type="submit">Create Publication</button>
        </form>
    </div>
</body>
</html>