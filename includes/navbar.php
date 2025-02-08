<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection (assumed to be included)
require_once "config/db_connect.php";
require_once "config/functions.php";

// Fetch categories from the database
try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error fetching categories: " . $e->getMessage();
    header("Location: home.php");
    exit();
}

// Get the current category name from session (default: 'Categories')
$current_category_name = $_SESSION['current_category_name'] ?? 'Categories';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* Navbar Styling */
        .navbar {
            transition: all 0.3s ease-in-out;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
            color: #f8c102 !important;
        }
        
        .navbar-logo {
           height: 50px; /* Adjust the height to fit in the navbar */
           width: auto; /* Maintain the aspect ratio */
           max-width: 150px; /* Prevent it from being too wide */
           object-fit: contain; /* Ensures proper fit without cropping */
        }

        .navbar-nav .nav-link {
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #f8c102 !important;
        }
        .dropdown-menu {
            border-radius: 10px;
        }
        .dropdown-item:hover {
            background-color: #f8c102;
            color: #000 !important;
        }
        .dropdown-item.active {
            background-color: #f8c102;
            color: #000 !important;
        }
        
        /* Admin Dashboard Button Hover Text Color */
        .nav-link.btn-warning:hover {
            color: black !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="home.php">
        <img src="includes/ad_images/logo.png" alt="Kali News Logo" class="navbar-logo me-2">
        <span class="brand-text">KALI NEWS</span>
    </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ($_SERVER['PHP_SELF'] == '/home.php') ? 'active' : ''; ?>" href="home.php">Home</a>
                </li>

                <!-- Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarCategories" role="button" data-bs-toggle="dropdown">
                        <?= htmlspecialchars($current_category_name); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($categories as $category): ?>
                            <li>
                            <a class="dropdown-item <?= 
                                isset($_GET['slug']) && $_GET['slug'] === $category['slug'] ? 'active' : ''; 
                                ?> <?= containsKhmer($category['name']) ? 'khmer-text' : ''; ?>" 
                                href="category.php?slug=<?= urlencode($category['slug']); ?>">
                                <?= htmlspecialchars($category['name']); ?>
                            </a>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($_SERVER['PHP_SELF'] == '/contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                </li>
            </ul>

            <!-- User Account Section -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning btn-sm me-2" href="admin/dashboard.php">Admin Dashboard</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <?= htmlspecialchars($_SESSION['user_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light me-2" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
