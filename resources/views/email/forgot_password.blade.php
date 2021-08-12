<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
</head>

<body>
    <h1>Lupa Password</h1>

    <p>Nama : {{$user_name}}</p>
    <p>Email : {{$user_email}}</p>
    <p>Role : {{$user_role}}</p>

    <a href="{{route('change_password', [$user_email, $token['token']])}}">Klik disini untuk buat password baru</a>
</body>

</html>