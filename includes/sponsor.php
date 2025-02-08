<?php
// Include config file
require_once 'config/functions.php';

// Fetch sponsored articles (example query, adjust based on your database structure)
// Fetch sponsored articles in random order
$sponsored_query = "SELECT * FROM sponsored_articles ORDER BY RAND() LIMIT 7";
$sponsored_stmt = $pdo->prepare($sponsored_query);
$sponsored_stmt->execute();
$sponsored_articles = $sponsored_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .sponsored-articles .sponsored-card {
            margin-bottom: 15px;
            text-align: center;
        }
        .sponsored-articles .sponsored-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .sponsored-articles .sponsored-card-title {
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            display: block;
            color:rgb(0, 0, 0);
            text-decoration: none;
        }
        .sponsored-articles .sponsored-card-title:hover {
            text-decoration: underline;
        }

        /* Adjust column spacing */
        .sponsored-articles .col-md-4, .sponsored-articles .col-md-6 {
            padding-left: 3px;
            padding-right: 3px;
        }
        .sponsored-text {
            font-size: 12px;
            font-weight: normal;
            text-align: left;
            margin: 0 0 0;
            padding-left: 0;
            padding-top: 0;
            color: #777;
        }
</style>
</head>
<body>
    <!-- Sponsored Articles Section -->
    <div class="row sponsored-articles mt-5">
            <!-- First row: 2 columns -->
            <div class="col-md-6">
                <?php if (!empty($sponsored_articles[0])): ?>
                    <div class="sponsored-card">
                        <a href="<?php echo htmlspecialchars($sponsored_articles[0]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[0]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[0]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[0]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if (!empty($sponsored_articles[1])): ?>
                    <div class="sponsored-card">
                        <a href="<?php echo htmlspecialchars($sponsored_articles[1]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[1]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[1]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[1]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Second row: 3 columns -->
            <div class="col-md-4">
                <?php if (!empty($sponsored_articles[2])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[2]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[2]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[2]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[2]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if (!empty($sponsored_articles[3])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[3]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[3]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[3]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[3]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if (!empty($sponsored_articles[4])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[4]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[4]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[4]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[4]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- advertisement -->
            <div class="col-md-12">  
                <div class="sponsored-card"> 
                    <a href="https://www.ocic.com.kh/noreacity" target="_blank">    
                    <img src="includes/ad_images/norea.jpeg" class="d-block w-100" alt="Product Image 2">
                    </a>
                </div>
            </div>

            <!-- Third row: 2 columns -->
            <div class="col-md-6">
                <?php if (!empty($sponsored_articles[5])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[5]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[5]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[5]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[5]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if (!empty($sponsored_articles[6])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[6]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[6]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[6]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[6]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Fourth row: 3 columns -->
            <div class="col-md-4">
                <?php if (!empty($sponsored_articles[7])): ?>
                    <div class="sponsored-card">
                    <a href="<?php echo htmlspecialchars($sponsored_articles[7]['link']); ?>" target="_blank" style="text-decoration: none;">
                        <img src="admin/uploads/<?php echo htmlspecialchars($sponsored_articles[7]['image']); ?>" alt="Sponsored article image">
                        <h6 class="sponsored-text">SPONSORED</h6>
                        </a>
                        <a href="<?php echo htmlspecialchars($sponsored_articles[7]['link']); ?>" class="sponsored-card-title" target="_blank">
                            <?php echo htmlspecialchars($sponsored_articles[7]['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>