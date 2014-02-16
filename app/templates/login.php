<!DOCTYPE HTML>
<html lang='en'>
<head>
    <title>Log In</title>
    <meta charset="UTF-8"/>
</head>
<body>
<div id="login">
    <form method="post" action="/login">
        <input type="hidden" name="_method" value="POST">
        <input type="text" placeholder="user" name="user" id="user"/>
        <input type="password" placeholder="password" name="password" id="password"/>
        <input type="submit" value="Log in"/>
    </form>
</div>
<form action="/" method="GET">
    <input type="submit" class="submit" value="Index"/>
</form>
</body>
</html>