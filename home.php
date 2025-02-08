<?php
session_start();
require_once 'config/db_connect.php';
require_once 'config/functions.php';

// Define articles per page
$articlesPerPage = 15;

// Get the current page number from the URL, default is 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $articlesPerPage;

// Fetch total articles count
$totalArticlesQuery = $pdo->query("SELECT COUNT(*) FROM articles WHERE status = 1");
$totalArticles = $totalArticlesQuery->fetchColumn();

// Calculate total pages
$totalPages = ceil($totalArticles / $articlesPerPage);

// Fetch paginated articles
$stmtAll = $pdo->prepare("SELECT articles.*, categories.name as category_name 
                        FROM articles 
                        LEFT JOIN categories ON articles.category_id = categories.id 
                        WHERE articles.status = 1 
                        ORDER BY created_at ASC 
                        LIMIT :limit OFFSET :offset");

// Fetch latest articles for the right side (e.g., last 5 articles)
$stmtLatest = $pdo->query("SELECT articles.id, articles.title, articles.created_at 
                           FROM articles 
                           WHERE articles.status = 1 
                           ORDER BY created_at DESC 
                           LIMIT 5");
$latestArticles = $stmtLatest->fetchAll();


$stmtAll->bindValue(':limit', $articlesPerPage, PDO::PARAM_INT);
$stmtAll->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtAll->execute();
$allArticles = $stmtAll->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>KALI NEWS</title>
    <link rel="icon" href="includes/ad_images/logo.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts for Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&family=Hanuman:wght@400;700&family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Hide horizontal scrollbar */
            font-family: 'Roboto', 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .khmer-text {
            font-family: 'Hanuman', sans-serif;
        }
        .article-item {
            border-bottom: 1px dashed #ccc;
            padding: 20px 0;
        }
        .article-item:last-child {
            border-bottom: none;
        }
        .article-image {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }
        .article-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .article-title a {
            color: inherit;
            text-decoration: none;
        }
        .article-title a:hover {
            text-decoration: underline;
        }
        .article-meta {
            color: blue;
            font-size: 0.8rem;
            margin-bottom: 5px;
        }
        .article-summary {
            font-size: 1rem;
            color: #333;
        }
        .latest-news-item {
            margin-bottom: 10px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
        }
        .latest-news-title {
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .latest-news-title a {
            color: inherit;
            text-decoration: none;
        }
        .latest-news-title a:hover {
            text-decoration: underline;
        }
        .latest-news-meta {
            color: blue;
            font-size: 0.7rem;
            margin-bottom: 3px;
        }
        .dot {
            color: blue;
            font-size: 1rem;
            margin-right: 5px;
        }
        .more-news-header, .latest-news-header {
            border-bottom: 1px dashed #ccc;
            padding-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.5rem; 
        }
        .about-section {
            padding: 20px;
            border-bottom: 1px dashed #ccc;
            background-color: #f9f9f9;
        }
        .about-section h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .about-section p {
            font-size: 1rem;
            color: #333;
        }
        .social-icon-square {
            width: 40px;
            height: 40px;
            border-radius: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .advertisement-section {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding-top:1px;
            padding-bottom:15px;
        }
        .ad-text {
            font-size: 10px;
            color: #777;
            text-align: center;
            font-weight: normal;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0;
        }
        .ad-banner {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }        
    </style>
</head>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/marquee.php'; ?>
<body>

    <!-- Advertisement Section -->
    <div class="row advertisement-section mt-4 mb-4">
        <div class="col-12 text-center">
            <p class="ad-text">ADVERTISEMENT</p>
            <a href="https://www.bbc.com/storyworks/specials/rewriting-cancer/?utm_source=House&utm_medium=House-Billboard-Traffic-Driver&utm_campaign=Healthier-Together&utm_content=Hub " target="_blank">
                <img src="admin/uploads/ad2.jpg" alt="Advertisement" class="img-fluid ad-banner">
            </a>
        </div>
    </div>

    <!-- About Section -->
    <div class="container mt-4">
        <div class="about-section">
            <h2>About Our Publication</h2>
            <p>
                Welcome to our publication! We are dedicated to bringing you the latest and most relevant news from various fields. Our team of expert writers and editors work around the clock to ensure our content is informative, engaging, and up-to-date.
                Whether you're looking for breaking news, feature articles, or insightful commentary, you will find it all here. Stay tuned as we continue to provide you with top-quality content that matters to you.
            </p>
        </div>
    </div>

    <!-- News Section -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h2 class="more-news-header">More News</h2>
            <?php foreach ($allArticles as $article): ?>
                <div class="article-item">
                    <div class="row">
                        <?php if ($article['image_url']): ?>
                            <div class="col-md-4">
                                <a href="article.php?id=<?= $article['id']; ?>">
                                    <img src="<?= htmlspecialchars($article['image_url']); ?>" 
                                         class="article-image" alt="Article image">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="<?= $article['image_url'] ? 'col-md-8' : 'col-md-12'; ?>">
                            <div class="article-meta">
                                <span class="<?= containsKhmer($article['author']) ? 'khmer-text' : ''; ?>" style="color: red;">
                                    <?= htmlspecialchars($article['author']); ?>
                                </span> | 
                                <?= timeAgo($article['created_at']); ?> | 
                                <a href="category.php?slug=<?= htmlspecialchars($article['category_name']); ?>" 
                                   class="<?= containsKhmer($article['category_name']) ? 'khmer-text' : ''; ?>" style="text-decoration: none;">
                                    <?= htmlspecialchars($article['category_name']); ?>
                                </a>
                            </div>
                            <h2 class="article-title">
                                <a href="article.php?id=<?= $article['id']; ?>" 
                                   class="<?= containsKhmer($article['title']) ? 'khmer-text' : ''; ?>">
                                    <?= htmlspecialchars($article['title']); ?>
                                </a>
                            </h2>
                            <p class="article-summary <?= containsKhmer($article['content']) ? 'khmer-text' : ''; ?>">
                                <?= htmlspecialchars(mb_substr(strip_tags($article['content']), 0, 150)) . '...'; ?>
                            </p>                            

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= ($page - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Prev</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= ($page + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <!-- Right Side: RECENT POSTS -->
        <div class="col-md-4">
            <h2 class="latest-news-header">RECENT POSTS</h2>
            <?php foreach ($latestArticles as $article): ?>
                <div class="latest-news-item">
                    <div class="latest-news-meta">
                        <span class="dot">&bull;</span>
                        <?= timeAgo($article['created_at']); ?>
                    </div>
                    <h3 class="latest-news-title">
                        <a href="article.php?id=<?= $article['id']; ?>" 
                           class="<?= containsKhmer($article['title']) ? 'khmer-text' : ''; ?>">
                            <?= htmlspecialchars($article['title']); ?>
                        </a>
                    </h3>
                </div>
            <?php endforeach; ?>
            <?php include 'includes/ads.php'; ?>
        </div>
    </div>
</div>

    <?php include 'includes/footer.php'; ?>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
