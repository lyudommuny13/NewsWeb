<?php
// Include the database connection file
require_once 'config/db_connect.php';
require_once 'config/functions.php';

// Fetch breaking news (latest 5 articles)
$breaking_sql = "SELECT title, id FROM articles ORDER BY views DESC LIMIT 8";
$breaking_stmt = $pdo->query($breaking_sql);
$breaking_news = $breaking_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <!-- Google Fonts for Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;700&family=Hanuman:wght@400;700&family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Roboto', 'Open Sans', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }
    .khmer-text {
            font-family: 'Hanuman', sans-serif;
    }
    .marquee-container {
        width: 100%;
        overflow: hidden;
        background: #f8f9fa;
        padding: 10px 0;
        position: relative;
        white-space: nowrap;
    }       
    .marquee-content {
        display: flex;
        width: 100%;
    }       
    .marquee-content ul {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        min-width: 100%;
        gap: 20px; /* Adds spacing between items */
    }       
    .marquee-content li {
        display: flex;
        align-items: center;
    }       
    .marquee-content a {
        color: red;
        text-decoration: none;
        font-weight: bold;
    }     
    .marquee-content a:hover {
        color: blue;
        text-decoration: underline;
        font-weight: bold;
        text-decoration:none;
    }  
    /* Logo Styling */
    .marquee-logo {
        height: 20px;
        margin-right: 5px;
    }
    .brand-text {
        font-weight: bold;
        color: #f8c102 !important;
    }
</style>
<body>
<section class="marquee-container">
        <div class="marquee-content">
            <ul id="marquee-list">
  

                <!-- PHP Loop for News Items -->
                <?php foreach ($breaking_news as $news): ?>
                    <li>
                        <a href="article.php?id=<?php echo $news['id']; ?>" 
                           class="<?= containsKhmer($news['title']) ? 'khmer-text' : ''; ?>">
                            <?php echo htmlspecialchars($news['title']); ?>
                        </a>
                    </li>
                    <li>
                        <img src="includes/ad_images/logo.png" alt="Kali News Logo" class="marquee-logo">
                        <span class="brand-text">KALI NEWS</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const marquee = document.querySelector(".marquee-content ul");
            let clone = marquee.innerHTML; // Clone the content
            marquee.innerHTML += clone; // Duplicate content for smooth looping

            let speed = 1; // Adjust speed
            let position = 0;

            function moveMarquee() {
                position -= speed;
                if (position <= -marquee.scrollWidth / 2) {
                    position = 0; // Reset position when half is scrolled
                }
                marquee.style.transform = `translateX(${position}px)`;
                requestAnimationFrame(moveMarquee);
            }
        
            moveMarquee();
        
            // Pause on hover
            marquee.parentElement.addEventListener("mouseenter", () => speed = 0);
            marquee.parentElement.addEventListener("mouseleave", () => speed = 1);
        });

     </script>
</body>