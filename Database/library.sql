-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 06:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`, `biography`, `is_deleted`) VALUES
(1, 'Jo', 'Nesbo', 'Jo Nesbo is one of the worlds bestselling crime writers, with The Leopard, Phantom, Police, The Son, The Thirst, Macbeth and Knife all topping the Sunday Times bestseller charts. Hes an international number one bestseller and his books are published in 50 languages, selling over 55 million copies around the world. When commissioned by a publisher to write a memoir about life on the road with his band, he instead came up with the plot for his first Harry Hole crime novel, The Bat.', 0),
(2, 'Stephen', 'King', 'Stephen King was born on September 21, 1947, in Portland, Maine. He graduated from the University of Maine and later worked as a teacher while establishing himself as a writer. Having also published work under the pseudonym Richard Bachman, Kings first horror novel, Carrie, was a huge success. Over the years, King has become known for titles that are both commercially successful and sometimes critically acclaimed. His books have sold more than 350 million copies worldwide and been adapted into numerous successful films.', 0),
(3, 'Agatha', 'Christie', 'Dubbed the “Queen of Mystery,” Agatha Christie was an author and playwright known for books such as Murder on the Orient Express and Death on the Nile, as well as characters like Hercule Poirot and Miss Jane Marple. Christie published her first novel, The Mysterious Affair at Styles, in 1920 and went on to become one of the most famous writers in history with 83 books to her name (and her pseudonym, Mary Westmacott). She also became a noted playwright with The Mousetrap, which is still running today on London’s West End. Christie died in January 1976 at age 85 and remains one of the top-selling authors ever, with her combined works selling more than 2 billion copies worldwide.', 0),
(4, 'Fyodor', 'Dostoevsky', 'Fyodor Dostoyevsky also spelled Dostoevsky, is one of the most influential western novelists of the nineteenth century. Most famous for the novels Crime and Punishment and The Brothers Karamazov, Dostoyevsky was a prolific writer who composed novellas, short stories and edited magazines. His other famous writings include Poor Folk, Notes from Underground, and The Idiot. He is famous for literary portrayals of psychological drama, redemption through suffering, the tension between faith and unbelief, and tragic-comic realism. During the late 1840s through the late 1870s, Dostoyevsky existed in a time when Russia was moving from a heavy European influence, with a liberal, romantic ideal, to reimagining a national identity, with a utilitarian, nihilist perspective, a perspective Dostoyevsky firmly rejected. Dostoyevsky gained popularity during his lifetime, and a grand public funeral was held upon his death in 1889.', 0),
(5, 'Colleen', 'Hoover', 'Colleen Hoover (born Margaret Colleen Fennell; December 11, 1979) is an American author who primarily writes novels in the romance and young adult fiction genres. She is best known for her 2016 romance novel It Ends with Us. Many of her works were self-published before being picked up by a publishing house. As of October 2022, Hoover has sold approximately 20 million books. She was named one of the 100 most influential people in the world by Time magazine in 2023.', 0),
(6, 'Chris', 'Carter', 'Born in Brazil of Italian origin, Chris Carter studied psychology and criminal behaviour at the University of Michigan. As a member of the Michigan State District Attorney\'s Criminal Psychology team, he interviewed and studied many criminals, including serial and multiple homicide offenders with life imprisonment convictions. He now lives in London. Visit his website www.chriscarterbooks.com and find him on Facebook.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `publication_year` int(4) DEFAULT NULL,
  `number_of_pages` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author_id`, `publication_year`, `number_of_pages`, `image`, `category_id`) VALUES
(1, 'The Bat', 1, 1997, 432, 'https://m.media-amazon.com/images/I/91hoLgwHfrL._SY466_.jpg', 1),
(2, 'Cockroaches', 1, 1998, 400, 'https://m.media-amazon.com/images/I/41e4Nf-9urL._SY445_SX342_.jpg', 2),
(3, 'The Redbreast', 1, 2000, 544, 'https://m.media-amazon.com/images/I/91rbef6uQ4L._SY522_.jpg', 1),
(4, 'Nemesis', 1, 2002, 474, 'https://m.media-amazon.com/images/I/91-5Es5FB7L._SY522_.jpg', 1),
(5, 'The Devils Star', 1, 2003, 448, 'https://cdn.waterstones.com/bookjackets/large/9781/7847/9781784702298.jpg', 2),
(6, 'The Redeemer', 1, 2005, 571, 'https://m.media-amazon.com/images/I/51-ERmxSaDL._SY445_SX342_.jpg', 1),
(7, 'The Snowman', 1, 2007, 512, 'https://m.media-amazon.com/images/I/71Q3dgEmPRL._SY522_.jpg', 2),
(8, 'The Leopard', 1, 2009, 624, 'https://m.media-amazon.com/images/I/8106K5FjwoL._SY522_.jpg', 2),
(9, 'Phantom', 1, 2011, 611, 'https://m.media-amazon.com/images/I/91SwrjTMePL._SY522_.jpg', 1),
(10, 'Police', 1, 2013, 640, 'https://m.media-amazon.com/images/I/41RufBm-w1L._SY445_SX342_.jpg', 1),
(11, 'The Thirst', 1, 2017, 480, 'https://cdn.waterstones.com/bookjackets/large/9781/7847/9781784705091.jpg', 2),
(12, 'Knife', 1, 2019, 531, 'https://m.media-amazon.com/images/I/41lvdOxJHQL._SY445_SX342_.jpg', 2),
(13, 'Killing Moon', 1, 2022, 496, 'https://m.media-amazon.com/images/I/81gBQwLBatL._SY522_.jpg', 1),
(14, 'The Body in the Library', 3, 1942, 224, 'https://upload.wikimedia.org/wikipedia/en/f/f5/The_Body_in_the_Library_US_First_Edition_Cover_1942.jpg', 4),
(15, 'The Mysterious Affair at Styles', 3, 1920, 288, 'https://m.media-amazon.com/images/I/51ArvUXZijL._SY522_.jpg', 4),
(16, 'Death on the Nile', 3, 1937, 352, 'https://m.media-amazon.com/images/I/71LsDB3cSnL._SY522_.jpg', 4),
(17, 'Murder on the Orient Express', 3, 1934, 256, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1486131451i/853510.jpg', 4),
(18, 'Evil Under the Sun', 3, 1941, 320, 'https://m.media-amazon.com/images/I/51hLe1vYEUL._SY445_SX342_.jpg', 4),
(19, 'It', 2, 1986, 1168, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982127794/it-9781982127794_lg.jpg', 5),
(20, 'Carrie', 2, 1974, 208, 'https://m.media-amazon.com/images/I/51gCu6zMgzL._SY445_SX342_.jpg', 5),
(21, 'The Shining', 2, 1977, 505, 'https://m.media-amazon.com/images/I/41WEUNPhdKL._SY445_SX342_.jpg', 5),
(22, 'If It Bleeds', 2, 2020, 448, 'https://cdn.waterstones.com/bookjackets/large/9781/5293/9781529391572.jpg', 5),
(23, 'Misery', 2, 1987, 370, 'https://m.media-amazon.com/images/I/41hlIL5K3tL._SY445_SX342_.jpg', 5),
(24, 'Crime and Punishment', 4, 1866, 720, 'https://marissasbooks.com/cdn/shop/files/marissasbooksandgifts-9781774021897-crime-punishment-paper-mill-classics-38105402605767.webp?v=1696895342&width=1100', 1),
(25, 'The Idiot', 4, 1869, 658, 'https://images1.penguinrandomhouse.com/cover/9780451531520', 6),
(26, 'Demons', 4, 1872, 769, 'https://images2.penguinrandomhouse.com/cover/9780375411229', 6),
(27, 'The Brothers Karamazov', 4, 1880, 796, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781625583826/brothers-karamazov-9781625583826_lg.jpg', 6),
(29, 'It Ends With Us', 5, 2016, 384, 'https://m.media-amazon.com/images/I/813aV273-rL._SL1500_.jpg', 3),
(30, 'Verity', 5, 2018, 336, 'https://m.media-amazon.com/images/I/51gjPdeh3hL._SY445_SX342_.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bookcomments`
--

CREATE TABLE `bookcomments` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','disapproved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookcomments`
--

INSERT INTO `bookcomments` (`id`, `book_id`, `user_id`, `comment`, `status`) VALUES
(2, 3, 4, 'Very nice book!', 'approved'),
(3, 3, 3, 'Very bad book!!', 'disapproved'),
(4, 3, 5, 'lol', 'disapproved'),
(5, 3, 2, 'Amazing! I totally recommend this book!', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `is_deleted`) VALUES
(1, 'crime', 0),
(2, 'thriller', 0),
(3, 'romance', 0),
(4, 'mistery', 0),
(5, 'horror', 0),
(6, 'classic', 0),
(7, 'fantasy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `book_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `book_id`, `content`) VALUES
(1, 2, 3, 'noteee1'),
(2, 2, 3, 'notee2'),
(4, 3, 3, 'Stopped at page 32'),
(6, 2, 9, 'notee2'),
(7, 2, 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, totam?\n'),
(12, 2, 1, 'some note'),
(13, 2, 1, 'some note2'),
(18, 6, 1, 'read it again!!!!!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(1, 'ane.dukadinoska123@gmail.com', 'Alex', '$2y$10$Lpyx0C/cXvvQEdJ9EOi.5e6DV/gHb9D6bbe3wLm.va770NnQ0H7qW', 'administrator'),
(2, 'marija@gmail.com', 'Marija', '$2y$10$fBZ.447XlNPiULaukcLJbuLMpD7ypuWaLCtT6/iKca0yDqLbBGWrm', 'user'),
(3, 'stefan@gmail.com', 'Stefan', '$2y$10$fzAeaJVYzKg4uq0jlBQ.EO.k/aoTICTsRIBluBgZkXTfgow7HhX1a', 'user'),
(4, 'dijana@gmail.com', 'Dijana', '$2y$10$cAxEmNFkY4FrtTPmyHkpxuPjut6bgmnTf.7bun8WSZ820PEFTiuh2', 'user'),
(5, 'daniela@gmail.com', 'Daniela', '$2y$10$fQAMgv14iZ2iZETBcJstluHxYk8FaoSbosZdLIzMTM8ur7s/j3X4S', 'user'),
(6, 'aleksandra@gmail.com', 'Aleksandra', '$2y$10$dypLK4U1vefgkVbZyyGJzOx2FXnZXufo34YH1vwvDNz3sfImK4OFy', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_fk` (`author_id`),
  ADD KEY `category_fk` (`category_id`);

--
-- Indexes for table `bookcomments`
--
ALTER TABLE `bookcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookID_fk` (`book_id`),
  ADD KEY `userID_fk` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookNote_fk` (`book_id`),
  ADD KEY `userNote_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bookcomments`
--
ALTER TABLE `bookcomments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `author_fk` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `bookcomments`
--
ALTER TABLE `bookcomments`
  ADD CONSTRAINT `bookID_fk` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `bookNote_fk` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userNote_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
