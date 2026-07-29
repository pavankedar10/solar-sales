<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="register.css">
    <script src="https://kit.fontawesome.com/97ebdf5864.js" crossorigin="anonymous"></script>
    <style>
        .password-container {
            position: relative;
        }
        .password-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="video-background">
    <video autoplay loop muted>
        <source src="bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<div class="container">
    <h2>Login</h2>

    <form action="function.php" method="post">
        <div class="form-group">
            <input type="email" name="email" required>
            <label for="">Email</label>
            <i class="fa-solid fa-envelope"></i>
        </div>

        <div class="form-group password-container">
            <input type="password" name="userpassword" id="password" required>
            <label for="">Password</label>
            <!-- <i class="fa-solid fa-lock"></i> -->
            <i class="fa-solid fa-eye" id="togglePassword"></i>
        </div>

        <p><input type="checkbox">Remember Me <a href="forgetpass.php">Forget Password</a></p>

        <input id="btn" type="submit" value="Login">

        <p>Don't have an account? <a href="register.php">Ragister</a></p>
    </form>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
