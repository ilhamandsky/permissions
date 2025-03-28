<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>
</head>

<body>
    <h2>Login Admin</h2>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email Admin" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>
