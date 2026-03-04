<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #87CEFA, #B0E0E6); /* sky blue */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            max-width: 400px;
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        h3 {
            color: #1E3A8A;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #B0C4DE;
            padding: 15px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 8px rgba(30,144,255,0.3);
        }

        .btn-custom {
            background-color: #1E90FF;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 12px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background-color: #1C86EE;
            transform: translateY(-2px);
        }

        .login-card a {
            color: #1E90FF;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-card a:hover {
            color: #1C86EE;
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }

            .btn-custom {
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="login-card card">
        <h3 class="text-center">🔐 Login</h3>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-custom btn-block">
                Login
            </button>
        </form>

        <hr>
    </div>

</body>
</html>