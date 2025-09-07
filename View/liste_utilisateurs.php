<?php
include '../Connexion/connexion.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e0eafc);
            min-height: 100vh;
        }
        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h2 {
            color: #343a40;
        }
    </style>
</head>
<body>

<?php include 'conducteur/menu_conducteur.php'; ?>

<div class="container table-container">
    <h2 class="mb-4 text-center">👤 Liste des utilisateurs</h2>
    <table class="table table-bordered table-hover table-striped align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Adresse mail</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer tous les utilisateurs
            $stmt = $pdo->query("SELECT * FROM users");
            $users = $stmt->fetchAll();

            foreach ($users as $user) {
                $role = match($user['role']) {
                    0 => 'Passager',
                    1 => 'Conducteur',
                    2 => 'Admin',
                    default => 'Inconnu',
                };

                echo "<tr>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($user['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($user['telephone']) . "</td>";
                echo "<td>" . $role . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
