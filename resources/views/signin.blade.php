<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    {{ $status }}

    <form action="" method="POST">
        @csrf
        <input type="text"     name="login"><br>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>
</body>
</html>
