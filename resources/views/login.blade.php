<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-custom {
            background-color: #667eea;
            color: white;
        }

        .btn-custom:hover {
            background-color: #5a67d8;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="col-md-4">
        <div class="card login-card p-4">
            <h3 class="text-center mb-4">🔐 Login</h3>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-custom btn-block">
                    Login
                </button>
            </form>

            <hr>

            <div class="text-center">
                <small>Belum punya akun? <a href="/register">Daftar</a></small>
            </div>
        </div>
    </div>

</body>
</html>