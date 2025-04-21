<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .diagonal-bg {
            position: relative;
            width: 100%;
            height: 100vh;
            background-color: #cc4343;
            overflow: hidden;
        }
        
        .diagonal-bg::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 50%;
            background-color: #fff;
            bottom: 0;
            left: 0;
            transform: skewY(-5deg);
            transform-origin: bottom left;
        }
        
        .card {
            border-radius: 0;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 100;
            font-weight: bold;
            font-size: 24px;
            color: #1a1a1a;
        }
        
        .form-control {
            border-radius: 0;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
        }
        
        .btn-dark {
            background-color: #1a1a1a;
            border: none;
            border-radius: 0;
            padding: 0.75rem;
            width: 100%;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 500;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .login-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .login-header p {
            color: #888;
            font-size: 14px;
            margin-bottom: 0;
        }
        
        .form-check-label {
            font-size: 14px;
            color: #555;
        }
        
        .forgot-password {
            text-align: right;
            font-size: 14px;
        }
        
        .forgot-password a {
            color: #888;
            text-decoration: none;
        }
        
        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #888;
            font-size: 12px;
            z-index: 100;
        }
    </style>
</head>
<body>
    <div class="diagonal-bg">
        <div class="logo">COMOT</div>
        
        <div class="login-container">
            <div class="card">
                <div class="login-header">
                    <h2>Log In to Comot</h2>
                    <p>Quick & Simple way to Activate your account</p>
                </div>
                
                <form method="POST" action="{{ route('login.process') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               name="username" value="{{ old('username') }}" required autofocus
                               placeholder="USERNAME">
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required placeholder="PASSWORD">
                        
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <div class="forgot-password">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-0">
                        <button type="submit" class="btn btn-dark">
                            PROCEED
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="footer">
            © 2021 - 2025 All Rights Reserved. Comot
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Alert untuk success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Alert untuk error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });
    </script>
</body>
</html>