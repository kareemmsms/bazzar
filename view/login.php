<?php


if (isset($_SESSION['error'])) {
    echo '<div style="color:red; margin-bottom:10px;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="error-box" id="errorBox">
        <span class="error-icon">&#9888;</span>
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazaar - Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fbeedc 0%, #f8e6b5 100%);
            min-height: 100vh;
            margin: 0;
        }
        .nav {
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            padding: 16px 24px;
        }
        .nav a {
            text-decoration: none;
            color: #333;
            margin-right: 24px;
            font-weight: 500;
            font-size: 1.04rem;
        }
        .nav a:last-child { margin-right: 0; }
        .login-container {
            background: #fffefb;
            border-radius: 18px;
            box-shadow: 0 4px 24px #cdb89233;
            padding: 36px 40px 30px 40px;
            max-width: 420px;
            width: 100%;
            margin: 60px auto 0 auto;
            border: 1px solid #f2e2be;
        }
        .login-container h2 {
            margin-top: 0;
            margin-bottom: 24px;
            font-size: 2.1rem;
            color: #6a4a1b;
            text-align: center;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #5b4a2b;
            font-size: 1rem;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 9px 12px;
            border-radius: 7px;
            border: 1px solid #e2cfa2;
            background: #fff8e6;
            font-size: 1rem;
            font-family: inherit;
            transition: border 0.2s;
        }
        .form-group input:focus {
            border: 1.5px solid #c19a6b;
            outline: none;
            background: #fffbe7;
        }
        .show-password {
            display: flex;
            align-items: center;
            margin-top: 6px;
            font-size: 0.95rem;
        }
        .show-password input { width: auto; margin-right: 6px; }
        .login-btn {
            width: 100%;
            padding: 12px 0;
            background: #f2c66d;
            color: #fff;
            font-size: 1.08rem;
            font-weight: bold;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 2px 8px #e9c97a33;
            /* transition: background 0.2s, box-shadow 0.2s; */
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-btn:hover, .login-btn:focus {
            background: #e2b04a;
            box-shadow: 0 4px 16px #e9c97a55;
        }
        .login-links {
            text-align: center;
            margin-top: 18px;
        }
        .login-links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 8px;
            font-size: 0.98rem;
        }
        .login-links a:hover { text-decoration: underline; }
        @media (max-width: 600px) {
            .login-container {
                padding: 18px 6vw 16px 6vw;
                max-width: 98vw;
            }
            .login-container h2 {
                font-size: 1.3rem;
            }
        }
        .error-box {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffeaea;
    color: #b70000;
    border: 2px solid #ffb3b3;
    border-radius: 8px;
    padding: 13px 18px;
    margin-bottom: 18px;
    font-size: 1.08rem;
    font-weight: 500;
    box-shadow: 0 2px 12px #ffb3b344;
    animation: fadeIn 0.7s;
    position: relative;
}
.error-icon {
    font-size: 1.5em;
    margin-right: 10px;
    color: #ff7b7b;
    flex-shrink: 0;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px);}
    to { opacity: 1; transform: translateY(0);}
}
.shake {
    animation: shake 0.35s;
}
@keyframes shake {
    0% { transform: translateX(0);}
    25% { transform: translateX(-7px);}
    50% { transform: translateX(7px);}
    75% { transform: translateX(-7px);}
    100% { transform: translateX(0);}
}
.input-error {
    border-color: #ff5c5c !important;
    background: #fff0f0 !important;
}
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php">Back</a>
    </div>
    <div class="login-container">
        <h2>Login to Bazaar</h2>
        <form id="loginForm" autocomplete="on" action="../controller/login-con.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                <div class="show-password">
                    <input type="checkbox" id="togglePassword">
                    <label for="togglePassword">Show Password</label>
                </div>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="login-links">
            <a href="forgot-password.html">Forgot Password?</a> |
            <a href="./create-account.php">Create Account</a>
        </div>
    </div>
    <script>
     
      document.addEventListener("DOMContentLoaded", function() 
  {
    const errorBox = document.getElementById('errorBox');
    if (errorBox) {
        // Shake the login container
        const loginContainer = document.querySelector('.login-container');
        loginContainer.classList.add('shake');
        setTimeout(() => {
            loginContainer.classList.remove('shake');
        }, 400);

        // Highlight input fields
        document.getElementById('email').classList.add('input-error');
        document.getElementById('password').classList.add('input-error');
    }
   });
</script>
       
</body>
</html>
