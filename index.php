<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Login</h2>

                        <?php
                        session_start();

                        // Verifica se o formulário foi submetido
                        if(isset($_POST['login'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            // Verifica se o nome de usuário e a senha estão corretos
                            if(validateUser($username, $password)) {
                                $_SESSION['username'] = $username;
                                header('Location: /pages/home.php');
                                exit;
                            } else {
                                echo '<div class="alert alert-danger">Nome de usuário ou senha incorretos.</div>';
                            }
                        }

                        function validateUser($username, $password) {
                            // Lê os dados de login do arquivo JSON
                            $loginData = file_get_contents('./modulos/logins.json');
                            $logins = json_decode($loginData, true);

                            // Verifica se o nome de usuário existe e a senha está correta
                            if(isset($logins[$username]) && $logins[$username] === $password) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                        ?>

                        <form method="POST" action="/index.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">User name</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" name="login" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>
