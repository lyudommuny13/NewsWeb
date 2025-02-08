<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/db_connect.php';
require_once 'config/functions.php';
require_once 'config/functions.php';

// Get the article ID from the URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_to_get_view = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "UPDATE `articles` SET `views` = views + 1 WHERE `id` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_to_get_view]);

if ($article_id > 0) {
    // Fetch the article along with its category name
    $query = "SELECT articles.*, categories.name as category_name 
              FROM articles 
              LEFT JOIN categories ON articles.category_id = categories.id 
              WHERE articles.id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        // Set the current category name from the fetched article
        $current_category_name = $article['category_name'];

        // Fetch related articles from the same category (excluding the current article)
        $related_query = "SELECT * FROM articles WHERE category_id = ? AND id != ? ORDER BY RAND() DESC LIMIT 5";
        $related_stmt = $pdo->prepare($related_query);
        $related_stmt->execute([$article['category_id'], $article_id]);
        $related_articles = $related_stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!$article) {
    echo "<h1>Article not found</h1>";
    exit;
}


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
    <link rel="icon" href="includes/ad_images/logo.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts for Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&family=Hanuman:wght@400;700&family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        html{
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Hide horizontal scrollbar */
        }
        body {
            font-family: 'Roboto', 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
/* Use Khmer font when Khmer text is detected */
        .khmer-text {
            font-family: 'Hanuman', sans-serif;
        }

        .article-title {
            font-size: 36px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 20px;
            color:rgb(8, 8, 8);
        }
        .article-info {
            font-size: 16px;
            color: blue;
        }
        .category-name {
            color: red;
        }       
        .author , .created-at {
            color: blue;
        }                    
        .created-at i {
            font-size: 12px; /* Adjust size of the clock icon */
            margin-right: 2px; /* Space between the clock icon and text */
        }
        .article-content {
            font-size: 18px;
            line-height: 1.6;
            margin-top: 30px;
        }
        .img-fluid {
            width: 100%; /* Ensures the image scales responsively */
            height: 300px; /* Set a fixed height for consistency */
            object-fit: cover; /* Ensures images are cropped instead of stretched */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .related-articles h5 {
            font-size: 30px;
            font-weight: bold;
            color:rgb(3, 37, 255);
            margin-top: 10px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
        }
        .related-card {
            border-bottom: 1px dashed #ccc;
            margin-bottom: 15px;
            text-align: center;
        }
        .related-card:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .related-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .related-card-title {
            font-size: 16px;
            font-weight: 600;
            margin-top: 8px;
            text-decoration: none;
            color:rgb(3, 37, 255);
            display: block;
        }
        .related-card-title:hover {
            text-decoration: underline;
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
    <title><?php echo htmlspecialchars($article['title']); ?></title>
</head>
<?php include('includes/navbar.php'); ?>
<body>

    <!-- Advertisement Section -->
    <div class="row advertisement-section mt-4 mb-4">
        <div class="col-12 text-center">
            <p class="ad-text">ADVERTISEMENT</p>
            <a href="https://www.bbc.com/storyworks/specials/beyond-the-code/ " target="_blank">
                <img src="admin/uploads/ad1.jpg" alt="Advertisement" class="img-fluid ad-banner">
            </a>
        </div>
    </div>

    <?php include('includes/marquee.php'); ?>

    <div class="container">
        <div class="row">
            <!-- Left Column - Article Details -->
            <div class="col-md-8">
                <h1 class="article-title <?php echo containsKhmer($article['title']) ? 'khmer-text' : ''; ?>">
                    <?php echo htmlspecialchars($article['title']); ?>
                </h1>
                <p class="article-info">
                    <a href="category.php?slug=<?= htmlspecialchars($article['category_name']); ?>" style="text-decoration: none;">                                  
                        <span class="category-name <?= containsKhmer($article['category_name']) ? 'khmer-text' : ''; ?>">
                            <?= htmlspecialchars($article['category_name']); ?>
                        </span> 
                    </a>
                    <span class="author"> / Reporter: <?php echo htmlspecialchars($article['author']); ?></span> / 
                    <span class="created-at">
                        <i class="fas fa-clock"></i> <?php echo timeAgo($article['created_at']); ?>
                    </span>
                </p>
                
                <?php if (!empty($article['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($article['image_url']); ?>" class="img-fluid" alt="Article image">
                <?php endif; ?>

                <div class="article-content <?php echo containsKhmer($article['content']) ? 'khmer-text' : ''; ?>">
                    <?php echo htmlspecialchars_decode($article['content'], ENT_QUOTES); ?>
                </div>

                <div id="carouselExampleFade2" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="https://www.ababank.com/" target="_blank">
                            <img src="includes/ad_images/ABA.gif" class="d-block w-100" alt="Product Image 1">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Related Articles -->
            <div class="col-md-4">
                <div class="p-3 related-articles">
                    <h5>Related Articles</h5>
                    <?php if (!empty($related_articles)): ?>
                        <?php foreach ($related_articles as $related): ?>
                            <div class="related-card">
                                <?php if (!empty($related['image_url'])): ?>
                                    <a href="article.php?id=<?php echo $related['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($related['image_url']); ?>" alt="Related article image">
                                    </a>
                                <?php endif; ?>
                                <a href="article.php?id=<?php echo $related['id']; ?>" 
                                   class="related-card-title <?php echo containsKhmer($related['title']) ? 'khmer-text' : ''; ?>">
                                    <?php echo htmlspecialchars($related['title']); ?>
                                </a>                          
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No related articles found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php include('includes/sponsor.php'); ?>
    </div>
    <?php include('includes/footer.php'); ?>
    <!-- Bootstrap 5 JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
</body>
</html>
