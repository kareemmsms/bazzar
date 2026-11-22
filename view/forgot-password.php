<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Bazaar</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%); min-height: 100vh; margin: 0; }
        .nav { background: #fff; border-bottom: 1px solid #eee; display: flex; align-items: center; padding: 16px 24px; }
        .nav a { text-decoration: none; color: #333; margin-right: 24px; font-weight: 500; font-size: 1.04rem; }
        .nav a:last-child { margin-right: 0; }
        .forgot-container { background: #fffefb; border-radius: 18px; box-shadow: 0 4px 24px #cdb89233; padding: 36px 40px 30px 40px; max-width: 420px; width: 100%; margin: 60px auto 0 auto; border: 1px solid #f2e2be; }
        .forgot-container h2 { margin-top: 0; margin-bottom: 24px; font-size: 2.1rem; color: #6a4a1b; text-align: center; font-weight: 700; letter-spacing: 0.5px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #5b4a2b; font-size: 1rem; font-weight: 600; }
        .form-group input { width: 100%; padding: 9px 12px; border-radius: 7px; border: 1px solid #e2cfa2; background: #fff8e6; font-size: 1rem; font-family: inherit; transition: border 0.2s; }
        .form-group input:focus { border: 1.5px solid #c19a6b; outline: none; background: #fffbe7; }
        .forgot-btn { width: 100%; padding: 12px 0; background: #f2c66d; color: #fff; font-size: 1.08rem; font-weight: bold; border: none; border-radius: 7px; cursor: pointer; margin-top: 8px; box-shadow: 0 2px 8px #e9c97a33; transition: background 0.2s, box-shadow 0.2s; text-align: center; display: flex; align-items: center; justify-content: center; }
        .forgot-btn:hover, .forgot-btn:focus { background: #e2b04a; box-shadow: 0 4px 16px #e9c97a55; }
        .back-link { text-align: center; margin-top: 18px; }
        .back-link a { color: #007bff; text-decoration: none; font-size: 0.98rem; }
        .back-link a:hover { text-decoration: underline; }
        @media (max-width: 600px) { .forgot-container { padding: 18px 6vw 16px 6vw; max-width: 98vw; } .forgot-container h2 { font-size: 1.3rem; } }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php">Back</a>
    </div>
    <div class="forgot-container">
        <h2>Forgot Password</h2>
        <form id="forgotForm">
            <div class="form-group">
                <label for="forgotEmail">Enter your email address</label>
                <input type="email" id="forgotEmail" name="email" required placeholder="Email">
            </div>
            <button type="submit" class="forgot-btn">Send Reset Link</button>
        </form>
        <div class="back-link">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
    <script>
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('If this email exists, a password reset link will be sent.');
        });
    </script>
</body>
</html>
