

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Covoiturage</title>
    <!-- Thème clair Bootstrap Cosmo -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/cosmo/bootstrap.min.css" rel="stylesheet">
    <!-- Icônes Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        .input-group .btn {
            border-radius: 0 .375rem .375rem 0;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4">Se connecter</h3>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <form method="post" action="../Controller/ControlLogin.php">
                    <div class="mb-3">
                        <label for="login" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="login" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="pass" name="password" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Connexion</button>
                </form>

                <div class="text-center mt-3 text-muted">
                    Vous n’avez pas de compte ? <a href="register.php">Créer un compte</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour afficher/masquer le mot de passe -->
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#pass");
    const eyeIcon = document.querySelector("#eyeIcon");

    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        eyeIcon.classList.toggle("bi-eye");
        eyeIcon.classList.toggle("bi-eye-slash");
    });
</script>

</body>
</html>
