<?php
session_start();
require_once '../config/db_connect.php';
require_once '../admin_check.php';
checkAdmin();

// Pagination settings
$articlesPerPage = 10; // Number of articles per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articlesPerPage;

// Get the selected category from the filter
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Handle article status toggle (published/draft)
if (isset($_POST['toggle_status'])) {
    $article_id = $_POST['article_id'];
    $new_status = $_POST['new_status'];
    try {
        $stmt = $pdo->prepare("UPDATE articles SET status = ? WHERE id = ?");
        if ($stmt->execute([$new_status, $article_id])) {
            $_SESSION['success_message'] = "Article status updated successfully!";
        }
    } catch(PDOException $e) {
        $_SESSION['error_message'] = "Error updating article status: " . $e->getMessage();
    }
    header("Location: manage_articles.php?page=$page&category=$selectedCategory");
    exit();
}

// Delete article
if (isset($_POST['delete_article'])) {
    $article_id = $_POST['article_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        if ($stmt->execute([$article_id])) {
            $_SESSION['success_message'] = "Article deleted successfully!";
        }
    } catch(PDOException $e) {
        $_SESSION['error_message'] = "Error deleting article: " . $e->getMessage();
    }
    header("Location: manage_articles.php?page=$page&category=$selectedCategory");
    exit();
}

// Fetch total number of articles based on the selected category
$sqlCount = "SELECT COUNT(*) FROM articles 
             LEFT JOIN categories ON articles.category_id = categories.id 
             WHERE (:category = '' OR categories.name = :category)";
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->bindValue(':category', $selectedCategory, PDO::PARAM_STR);
$stmtCount->execute();
$totalArticles = $stmtCount->fetchColumn();
$totalPages = ceil($totalArticles / $articlesPerPage);

// Fetch articles with category information for the current page and selected category
$sql = "SELECT articles.*, categories.name as category_name 
        FROM articles 
        LEFT JOIN categories ON articles.category_id = categories.id 
        WHERE (:category = '' OR categories.name = :category)
        ORDER BY articles.created_at DESC 
        LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':category', $selectedCategory, PDO::PARAM_STR);
$stmt->bindValue(':limit', $articlesPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll();

// Fetch categories for dropdown
$categories_stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $categories_stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../includes/ad_images/logo.ico" type="image/x-icon">
    <title>Manage Articles - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .article-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .article-title {
            max-width: 200px; /* Adjust this value as needed */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.85em;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .filters {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h4 class="text-center mb-4">Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="manage_articles.php">
                            <i class="fas fa-newspaper mr-2"></i>Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">
                            <i class="fas fa-users mr-2"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../home.php">
                            <i class="fas fa-home mr-2"></i>View Site
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <nav class="navbar navbar-light bg-white mb-4 shadow-sm">
                    <span class="navbar-brand mb-0 h1">Manage Articles</span>
                    <div>
                        <a href="add_sponsored.php" class="btn btn-info mr-2">
                            <i class="fas fa-folder-plus mr-2"></i>Add Sponsored Article
                        </a>
                        <a href="manage_categories.php" class="btn btn-info mr-2">
                            <i class="fas fa-folder-plus mr-2"></i>Add/Manage Categories
                        </a>
                        <a href="create_article.php" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-2"></i>Create New Article
                        </a>
                    </div>
                </nav>

                <!-- Category Filter -->
                <div class="filters">
                    <div class="form-group">
                        <select class="form-control" id="categoryFilter" onchange="filterByCategory(this.value)">
                            <option value="">All Categories</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category['name']); ?>" 
                                    <?php echo $selectedCategory === $category['name'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="table-container">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($articles as $article): ?>
                            <tr data-category="<?php echo htmlspecialchars($article['category_name'] ?? ''); ?>">
                                <td>
                                    <?php if($article['image_url']): ?>
                                        <img src="../<?php echo htmlspecialchars($article['image_url']); ?>" 
                                             class="article-image" alt="Article image">
                                    <?php else: ?>
                                        <div class="text-muted">No image</div>
                                    <?php endif; ?>
                                </td>
                                <td class="article-title"><?php echo htmlspecialchars($article['title']); ?></td>
                                <td>
                                    <?php if($article['category_name']): ?>
                                        <span class="badge badge-info">
                                            <?php echo htmlspecialchars($article['category_name']); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Uncategorized</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($article['author']); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $article['status'] ? 'success' : 'warning'; ?>">
                                        <?php echo $article['status'] ? 'Published' : 'Draft'; ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($article['created_at'])); ?></td>
                                <td>
                                    <a href="edit_article.php?id=<?php echo $article['id']; ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="delete_article.php?id=<?php echo $article['id']; ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this article?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="manage_articles.php?page=<?php echo $page - 1; ?>&category=<?php echo $selectedCategory; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="manage_articles.php?page=<?php echo $i; ?>&category=<?php echo $selectedCategory; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="manage_articles.php?page=<?php echo $page + 1; ?>&category=<?php echo $selectedCategory; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    function filterByCategory(category) {
        window.location.href = `manage_articles.php?category=${category}`;
    }
    </script>
</body>
</html>