-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 12:25 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `created_at`, `image_url`, `status`, `category_id`, `updated_at`, `views`) VALUES
(6, 'Boeung Ket FC rope in first ASEAN COTA player into squad', '<p>Boeung Ket FC signed 24-year-old left-back Scott Woods from the Philippines on Thursday, making him the first ASEAN COTA player in the club.</p>\r\n<p>Woods joined the four-time CPL winners Boeung Ket FC after fulfilling his duty with the Philippines National Football Team in the ASEAN Mitsubishi Electric Cup 2024. Woods played a key role in guiding his side to the tournament&rsquo;s semifinals. However, Thailand defeated them bringing their tournament journey to an end.</p>\r\n<p>Before joining Boeung Ket FC, Woods played for Muangthong United in Thailand&rsquo;s first professional football league.</p>\r\n<p>The CPL altered their regulations for foreign player registration ahead of the season 2023-2024, with each club in the league allowed to register six foreign players, one of whom must be from Asia and another from inside ASEAN.</p>\r\n<p>The CPL hoped to improve league quality and support ASEAN players in doing so, which has hitherto never been done.</p>', 'Admin', '2025-01-07 06:55:31', 'uploads/677ccfe30809a.jpg', 1, 1, NULL, 0),
(7, 'Cambodia marks ASEAN Sports Day 2024 in Phnom Penh', '<p>Cambodia marked on Saturday the ASEAN Sports Day 2024 at the National Olympic Stadium in Phnom Penh to strengthen and promote sports in all ASEAN countries.</p>\r\n<p>The annual event is also aimed to raise people&rsquo;s awareness of the ASEAN and promote a healthy and harmonious lifestyle under the motto of &ldquo;One Vision, One Identity and One Community,&rdquo; said Vath Chamroeun, Secretary of State at the Ministry of Education, Youth and Sports.</p>\r\n<p>Moreover, he continued, the celebration is to inspire the Cambodian people, as well as those of the entire ASEAN community to participate in all kinds of sports to enhance their health, strengthen friendship, solidarity, and communication, and boost the ASEAN sports sector.</p>\r\n<p>According to Vath Chamroeun, on the same day, Indonesia also celebrated the event and invited Cambodian martial artists to participate and perform Bokator, a traditional sport unique to Cambodia.</p>', 'Admin', '2025-01-07 06:56:40', 'uploads/677cd0284c041.jpg', 1, 1, NULL, 0),
(8, 'FIFA ranks Cambodia 8th in ASEAN football standings', '<p>The Cambodian National Men&rsquo;s football team is ranked in eighth place out of eleven ASEAN football teams, with Thailand on top based on FIFA football rankings, which were updated on February 15.</p>\r\n<p>In eighth place Cambodian men&rsquo;s football team has made little progress and remains ranked among the bottom half of ASEAN football teams.</p>\r\n<p>The <a href=\"https://en.wikipedia.org/wiki/Cambodia_national_football_team\" target=\"_blank\" rel=\"noopener\">Cambodian men&rsquo;s football team</a>, also known as &ldquo;<em><strong>Kouprey</strong></em>&rdquo; &ndash; also nicknamed the &ldquo;forest ox&rdquo; and &ldquo;gray ox&rdquo; &ndash; currently has 931. 47 points in FIFA&rsquo;s ranking system, placing it in 8th position in ASEAN, and 179th overall in world rankings.</p>\r\n<p>The lack of improvement stems from poor performances by both senior and junior football teams in big events last year.</p>\r\n<p>The 32nd Southeast Asian Games in May in Cambodia were the first major disappointment.</p>\r\n<p>Despite great hopes of earning a medal, the Cambodia U22 national football team failed to reach the tournament&rsquo;s semi-final stage. Cambodia won only one of its three group-stage qualification matches.</p>', 'Admin', '2025-01-07 06:57:17', 'uploads/677cd04d30c37.jpg', 1, 1, '2025-02-06 07:43:25', 0),
(10, 'Sixteen kids selected to join Bati National Football School', '<p>Following three days of try-outs, sixteen talented young footballers under fifteen from across Cambodia were selected to attend the Bati National Football and Academy Centre in Takeo province.</p>\r\n<p>Bati National Football School, supported by the Football Federation of Cambodia (FFC), held a recruitment session from January 16 to 18 to find new young players for training.</p>\r\n<p>Ouk Rina head of administration at the Bati National Football School told Khmer Times yesterday that 50 young athletes from across the kingdom took part in the try-outs.</p>\r\n<p>The FFC announced the final results on Tuesday, awarding scholarships to sixteen youngsters from eleven provinces and cities. He added that students from Mondulkiri and Pailin represented the majority of all the potential footballers who were selected.</p>', 'Admin', '2025-01-07 06:59:27', 'uploads/677cd0cfe4acb.jpg', 1, 1, NULL, 0),
(11, 'Women’s football team ready to kick off', '<p style=\"text-align: justify;\">The Cambodia National Women&rsquo;s Football Team has spent the last several months training in China in preparation for their second appearance at the upcoming 32nd SEA Games.</p>\r\n<p style=\"text-align: justify;\">The football team, along with other sports teams, was sent to train in China last September, and they will return to Cambodia in late April to compete at the games.</p>\r\n<p style=\"text-align: justify;\">Keo Sarath, secretary-general of the Football Federation of Cambodia (FFC), said the Cambodian women players have been training with Chinese professional football coaches.</p>\r\n<p style=\"text-align: justify;\">He added that they have had regular friendly matches with professional and other football teams.</p>\r\n<p style=\"text-align: justify;\">&ldquo;This can be the best help to push them to grow technically and build more confidence on the pitch,&rdquo; he said.</p>\r\n<p style=\"text-align: justify;\">&ldquo;China has provided mutual technical assistance to help many Cambodian athletes, not just the football team, to prepare for the SEA Games. They (China) have provided training venues, arranged friendly matches, and covered all the basic needs. And that is why we sent them there,&rdquo; said Sarath.</p>', 'Admin', '2025-01-07 07:00:09', 'uploads/677cd0f9bcb8b.jpg', 1, 1, NULL, 0),
(12, 'GTA 6, Nintendo\'s new console and what else to watch out for in 2025 gaming', '<p class=\"sc-eb7bd5f6-0 fYAfXe\">Even if you were lucky enough to get a new console or games this Christmas, you\'ve probably got your eye on some upcoming releases.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">And 2025 is shaping up to be a big one.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">Most agree that 2024 was a painful year for the games industry, with tens of thousands of layoffs and worldwide studio closures.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">There\'s a hope that things will bounce back - at least in part - next year.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">And two huge releases in particular are likely to cut through in a big way.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">Developer Rockstar hasn\'t revealed a huge amount about the new game beyond its dual protagonists and scenes from its fictional, Florida-inspired setting Leonida.</p>\r\n<p class=\"sc-eb7bd5f6-0 fYAfXe\">The big question on most fans\' minds is whether the release date will slip, as has happened for previous big releases from Rockstar.</p>', 'Admin', '2025-01-07 07:03:04', 'uploads/677cd1a82b0e1.jpg', 1, 4, NULL, 0),
(14, 'Diallo seals 2-2 draw for ManU against Liverpool', '<p>LIVERPOOL &ndash; Amad Diallo came back to haunt Liverpool with a late equalizer that secured a 2-2 draw for Manchester United against Premier League leader Liverpool on Sunday.</p>\r\n<p>The forward turned home Alejandro Garnacho&rsquo;s cross in the 80th minute at Anfield after Mohamed Salah&rsquo;s penalty had looking like giving Liverpool the win.</p>\r\n<p>Diallo struck at the end of extra time as United beat Liverpool 4-3 in a dramatic FA Cup clash last season and hit a 90th-minute winner against Manchester City last month.</p>\r\n<p>His goal on Sunday was only worth a point on this occasion, but it halted United&rsquo;s four-game losing run and prevented fierce rival Liverpool from opening up an eight-point lead at the top of the standings.</p>\r\n<p>United head coach Ruben Amorim, however, was still unhappy.</p>\r\n<p>&ldquo;It&rsquo;s a point, a deserved point, but it&rsquo;s just one point, and we should get mad. Today we should be really disappointed,&rdquo; he said.</p>', 'Admin', '2025-01-07 07:44:36', 'uploads/677cdb640e7c8.jpg', 1, 1, '2025-01-21 15:05:38', 0),
(22, 'Trump is waging war against his own government', '<p class=\"body-graf\">The president&rsquo;s words and actions amount to a full-scale effort to demoralize and intimidate the workforce, say some of the federal employees who spoke to NBC News.</p>\r\n<p class=\"body-graf\">Trump has empowered billionaire Elon Musk, the volunteer head of the Department of Government Efficiency, and his allies to&nbsp;<a href=\"https://www.nbcnews.com/politics/white-house/trump-administration-offer-federal-workers-buyouts-resign-rcna189661\" target=\"_blank\" rel=\"noopener\">offer &ldquo;buyouts&rdquo;</a>&nbsp;that would pay federal civil servants through September in exchange for their resignations. Workers have received nearly daily communications about the &ldquo;deferred resignation&rdquo; option directly from OPM and from agency personnel chiefs at the behest of OPM.&nbsp;</p>\r\n<p class=\"body-graf\">On Wednesday, Environmental Protection Agency employees&nbsp; were reminded in an email that they can be fired at any time if they have worked for the government for less than a year.</p>', 'Admin', '2025-02-02 11:51:05', 'uploads/679f5c293f805.png', 1, 6, NULL, 0),
(23, 'Senior FBI official forcefully resisted Trump administration firings', '<p class=\"body-graf\">Acting FBI Director Brian Driscoll on Friday refused a Justice Department order that he assist in the firing of agents involved in Jan. 6 riot cases, pushing back so forcefully that some FBI officials feared he would be dismissed, multiple current and former FBI officials told NBC News.</p>\r\n<p class=\"body-graf\">The Justice Department ultimately did not dismiss Driscoll, the head of the bureau&rsquo;s Newark field office who is temporarily serving as its acting director.</p>\r\n<div id=\"taboolaReadMoreBelow\"></div>\r\n<p class=\"body-graf\">Kash Patel, President Trump\'s pick for FBI director and a critic of the bureau\'s investigations of Trump and Jan. 6th rioters, will take over if he is confirmed by the Senate. During his confirmation hearing on Thursday, Patel testified under oath that no FBI officials would be retaliated against.</p>', 'Admin', '2025-02-02 11:52:28', 'uploads/679f5ca54e075.png', 1, 6, '2025-02-02 11:53:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Sport', 'sport', '2025-01-06 10:10:06'),
(4, 'Gaming', 'gaming', '2025-01-06 12:54:01'),
(6, 'Trending', 'trending', '2025-01-21 14:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `sponsored_articles`
--

CREATE TABLE `sponsored_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sponsored_articles`
--

INSERT INTO `sponsored_articles` (`id`, `title`, `image`, `link`, `created_at`) VALUES
(1, 'Former FBI Agent Advises: \"Negotiate as if your life depends on it\"', 'Screenshot 2025-02-06 124427.png', 'https://www.blinkist.com/magazine/posts/apple-recommends-blinkist-onboarding/?utm_source=taboola&utm_medium=paid&utm_campaign=20241104_TB_PRO_NeverSplitTheDifferenceTTS-EN_DW_Universal_MaxConversion-Onboarding&utm_term=nbcnews&utm_content=4065751538&taboo', '2025-02-06 06:02:42'),
(2, 'How The 5AM Club Went Viral And Became The Most Talked About Book Online', '5amclubmain.jpg', 'https://www.blinkist.com/magazine/posts/5-am-club-viral-onboarding/?utm_source=taboola&utm_medium=paid&utm_campaign=20250103_TB_PRO_The5AMClubViral_DW_Universal_MaxConversion-Onboarding&utm_term=nbcnews&utm_content=4082976050&taboola_click_id=GiCMycomE4R4', '2025-02-06 06:10:28'),
(3, 'Why You Should Get An Unsold Camper Van', '5718154400595081292.jpg', 'https://techtome.net/article/the-rise-of-unsold-camper-vans-trends-and-solutions?utm_term=unsold%20camper%20vans,camper%20vans%20for%20sale%20near%20me,used%20camper%20vans%20for%20sale%20near%20me,rv%20vans%20for%20sale%20near%20me,travel%20vans%20for%20', '2025-02-06 06:12:56'),
(4, 'Optical Measurement Equipment for Manufacturing in Luxembourg', 'Screenshot 2025-02-06 131417.png', 'https://knownow.co.in/article/optical-measurement-equipment-for-manufacturing-in-luxembourg?channel_id=4536493183&style_id=9424525041&uid=cd3da87955c30c806cacff8b79d0149e&theme_id=article-blue&tclkid=GiCMycomE4R4dJU_R5pyg1Ysnx2mGmkGw2ZpINdc0-Qg5CDEimIo6oz', '2025-02-06 06:14:25'),
(5, 'Ready in No Time Prefabricated Homes Built to Last', 'Screenshot 2025-02-06 131603.png', 'https://tinyprefabhouses.today/direct/EXO1mN03bpr6jg2Z?src=t&site=nbcnews&title=Ready%20in%20No%20Time%20Prefabricated%20Homes%20Built%20to%20Last&clickid=GiCMycomE4R4dJU_R5pyg1Ysnx2mGmkGw2ZpINdc0-Qg5CCn9Wsolo-g_LWJsNnYATC82D0&tg1=23%20Sorochenko%20Prefab', '2025-02-06 06:16:33'),
(6, 'Phum 4: Best Dentists For Seniors Close To You. Take A Look', 'Screenshot 2025-02-06 131729.png', 'https://affordableseniorsdentistry.today/direct/EXWzeD1pB7GNBq0k?src=t&site=nbcnews&title=Phum%204%3A%20Best%20Dentists%20For%20Seniors%20Close%20To%20You.%20Take%20A%20Look&clickid=GiCMycomE4R4dJU_R5pyg1Ysnx2mGmkGw2ZpINdc0-Qg5CCpgm0ooozrn-vt1KP0ATC82D0&t', '2025-02-06 06:17:35'),
(7, 'The Sims at 25: How a virtual dollhouse took over the world', '51706810-e210-11ef-a319-fb4e7360c4ec.png', 'https://www.bbc.com/news/articles/cj021e0y1zqo', '2025-02-06 06:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `is_admin`, `status`) VALUES
(8, 'Admin', 'admin@admin.com', '$2y$10$a5impxZX8gJdYb5YAU41H.pwytitWTK.UMsbF7B6g.OLyCpgs0gl6', '2025-01-21 01:36:01', 1, 1),
(18, 'John Does', 'john.doe@example.com', '$2y$10$V7kZJSMWCAQVELEBZi1cuO1o69dldaM5gjSVdILIrPygst/OZaNIW', '2025-01-21 13:05:34', 0, 1),
(19, 'Lyudommuny', 'lyudomuny@gmail.com', '$2y$10$oYjA9IyF68tKZIIDyqlCLOlm4SdgS8UA3gqyp3ZyyfLuM4o8RO1.6', '2025-01-21 13:53:59', 0, 1),
(20, 'borim', 'borim@gmail.com', '$2y$10$Qk6jw7XUbxKrfclWYTpw4eUlf1fq5L0hxoAQjUJicmZisiwVoPGZm', '2025-02-03 14:37:39', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsored_articles`
--
ALTER TABLE `sponsored_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sponsored_articles`
--
ALTER TABLE `sponsored_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
