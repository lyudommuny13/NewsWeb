<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "config/db_connect.php";
require_once 'config/functions.php';

// Fetch categories for the dropdown
try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error fetching categories: " . $e->getMessage();
    header("Location: home.php");
    exit();
}

// Default category name
$current_category_name = isset($_SESSION['current_category_name']) ? $_SESSION['current_category_name'] : 'Categories';

// Handle category selection from URL
if (isset($_GET['slug'])) {
    $category_slug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING);

    // Corrected query: Make sure slug is the correct column name
    $category_query = "SELECT * FROM categories WHERE slug = ?";
    $stmt = $pdo->prepare($category_query);
    $stmt->execute([$category_slug]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        $_SESSION['current_category_name'] = $category['name'];

        // Fetch articles for this category
        $articles_query = "SELECT * FROM articles WHERE category_id = ? ORDER BY created_at DESC";
        $stmt = $pdo->prepare($articles_query);
        $stmt->execute([$category['id']]);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $_SESSION['error_message'] = "Category not found!";
        header("Location: home.php");
        exit();
    }
} else {
    $articles = [];
}

$current_category_name = $_SESSION['current_category_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="includes/ad_images/logo.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($current_category_name); ?> - News</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <!-- Google Fonts for Khmer -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&family=Hanuman:wght@400;700&family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', 'Open Sans', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
    .khmer-text {
            font-family: 'Hanuman', sans-serif;
    }
    /* Article Card with a fixed 16:9 aspect ratio */
    .article-card {
      position: relative;
      overflow: hidden;
      background-color: #f8f9fa;
    }
    .article-card::before {
      content: "";
      display: block;
      padding-top: 56.25%; /* 16:9 aspect ratio */
    }
    .article-card-content {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
    }
    /* Gradient overlay */
    .mask-gradient-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;

    }
    /* Article info styles */
    .article-info {
        position: absolute;
        bottom: 5px;
        left: 5px;
        z-index: 2;
        color: #fff;
    }
    .article-info .title {
      font-size: 1.25rem;
      font-weight: bold;
      padding: 4px 8px;
      margin-top: 5px;
      display: -webkit-box; /* For multi-line ellipsis */
      -webkit-line-clamp: 2; /* Limit the text to 2 lines (adjust this number as needed) */
      -webkit-box-orient: vertical; /* Ensure it behaves like a block for line clamping */
      overflow: hidden; /* Hide any overflowing text */
      text-overflow: ellipsis; /* Display ellipsis when text overflows */
    }
    .article-info .title:hover {
        color:rgb(0, 191, 255);
    }

    /* Smaller title text for small cards */
    .article-info.small .title{
      font-size: 1rem;
    }
    .heading h1, .heading-more h1 {
        margin: 0;
        padding: 0;
        font-size: 30px;
        line-height: 36px;
        font-weight: bold;
        border-bottom: 3px solid #FC880D;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
  </style>
</head>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/marquee.php'; ?>
<body>


  <div class="container my-4">
    <div class="heading">
        <h1 class="<?= containsKhmer($current_category_name) ? 'khmer-text' : ''; ?>">
            <span style="text-transform: uppercase;"><?php echo htmlspecialchars($current_category_name); ?></span>
        </h1>
    </div>

    <?php if (empty($articles)): ?>
        <p class="text-muted">No articles found in this category.</p>
    <?php else: ?>
        <!-- Main Featured Section -->
        <div class="row g-3">
            <!-- Featured Article: full width on mobile, larger on desktop -->
            <div class="col-12 col-lg-8">
                <?php $featured = $articles[0]; ?>
                <a href="article.php?id=<?php echo $featured['id']; ?>" class="text-decoration-none">
                    <div class="article-card">
                        <div class="article-card-content" style="background-image: url('<?php echo htmlspecialchars($featured['image_url'] ?? 'default-image.jpg'); ?>');">
                            <div class="mask-gradient-bg"></div>
                            <div class="article-info">
                                <div class="title <?= containsKhmer($featured['title']) ? 'khmer-text' : ''; ?>">
                                    <?php echo htmlspecialchars($featured['title']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Secondary Articles in a grid -->
            <div class="col-12 col-lg-4">
                <div class="row g-3">
                    <?php for ($i = 1; $i < min(5, count($articles)); $i++): ?>
                        <?php $article = $articles[$i]; ?>
                        <div class="col-6">
                            <a href="article.php?id=<?php echo $article['id']; ?>" class="text-decoration-none">
                                <div class="article-card">
                                    <div class="article-card-content" style="background-image: url('<?php echo htmlspecialchars($article['image_url'] ?? 'default-image.jpg'); ?>');">
                                        <div class="mask-gradient-bg"></div>
                                        <div class="article-info small">
                                            <div class="title <?= containsKhmer($article['title']) ? 'khmer-text' : ''; ?>">
                                                <?php echo htmlspecialchars($article['title']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Section 2: Gift Section with GIF -->
                <div class="col-12 mx-auto mt-4">
                    <div class="text-center">
                        <a href="https://www.facebook.com/p/Story-of-a-Cow-Restaurant-100094848502858?_rdc=1&_rdr#" target="_blank">
                            <img src="includes/ad_images/storycow.jpg" class="img-fluid">
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Additional Articles (if any) in a responsive grid -->
        <?php if (count($articles) > 5): ?>
            <div class="row g-3 mt-4">
                <div class="heading-more">
                    <h1 class="<?= containsKhmer($current_category_name) ? 'khmer-text' : ''; ?>">
                        <span style="text-transform: uppercase;">more about <?php echo htmlspecialchars($current_category_name); ?></span>
                    </h1>
                </div>

                <?php for ($i = 5; $i < count($articles); $i++): ?>
                    <?php $article = $articles[$i]; ?>
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="article.php?id=<?php echo $article['id']; ?>" class="text-decoration-none">
                            <div class="article-card">
                                <div class="article-card-content" style="background-image: url('<?php echo htmlspecialchars($article['image_url'] ?? 'default-image.jpg'); ?>');">
                                    <div class="mask-gradient-bg"></div>
                                    <div class="article-info small">
                                        <div class="title <?= containsKhmer($article['title']) ? 'khmer-text' : ''; ?>">
                                            <?php echo htmlspecialchars($article['title']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>


  <?php include 'includes/footer.php'; ?>

  <!-- Bootstrap 5 Bundle JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
