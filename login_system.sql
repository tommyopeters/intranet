-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 04:51 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_posts`
--

CREATE TABLE `department_posts` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_description` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_posts`
--

INSERT INTO `department_posts` (`id`, `post_title`, `post_description`, `post_content`, `department`, `post_date`) VALUES
(1, '', '', '', '', '2019-11-26 16:32:31'),
(2, 'CWT Email', 'When sending an email, CWT travel counselors that...', 'When sending an email, CWT travel counselors that makes use of OS ticket should be careful and ensure that they respond directly to the right person and not a random person', 'sales & marketing', '2019-11-26 17:04:28'),
(3, 'Fraudulent Practices and Work Place Processes.', 'We are going to have zero tolerance to dishonesty...', 'We are going to have zero tolerance to dishonesty as it is better to be honest in all our dealings. Indiscipline and laziness will not be tolerated. ', 'accounts', '2019-11-26 17:04:28'),
(4, 'Cash due for collection', 'Migrate Palladium IHP to POS, a mail should...', 'Migrate Palladium IHP to POS, a mail should be sent to their MD and MD (Miss Lola Adefope) should be in copy. ', 'accounts', '2019-11-26 17:04:28'),
(5, 'New Platform (BTM Circle)', 'The platform, BTM Circle is the official intranet website...', 'The platform, BTM Circle is the official intranet website for BTM. Ensure proper training is completed for all BTM staff', 'it', '2019-11-27 14:28:18'),
(6, 'Ways to Prevent Cyber Attacks', 'Train employees in cyber security principles...', 'Train employees in cyber security principles.\r\n\r\nInstall, use and regularly update antivirus and antispyware software on every computer used in your business.\r\n\r\nUse a firewall for your Internet connection.\r\n\r\nDownload and install software updates for your operating systems and applications as they become available.\r\n\r\nMake backup copies of important business data and information.\r\n\r\nControl physical access to your computers and network components.\r\nSecure your Wi-Fi networks. \r\n\r\nIf you have a Wi-Fi network for your workplace make sure it is secure and hidden.\r\n\r\nRequire individual user accounts for each employee.\r\n\r\nLimit employee access to data and information and limit authority to install software.\r\n\r\nRegularly change passwords.', 'it', '2019-11-27 14:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_description` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_description`, `post_content`, `post_user_id`, `post_date`) VALUES
(2, 'Seems Legit: 5 Ways to Avoid Fraud This Holiday Season', 'We’ve all seen the posts on social media: “Click this link for a chance...', 'We’ve all seen the posts on social media: “Click this link for a chance to win $1,000!” Every day, it seems like there’s a new pitfall to avoid. Unfortunately, consumers lose more than $1 billion each year to scams.\r\n\r\nFraud is especially prevalent during the holidays, when people are more likely to shop online or answer their phones. With that in mind, here are some best practices to keep you and your loved ones secure this season. Share them with your parents, grandparents or that *one* friend who always shares sketchy offers on social media:\r\n\r\nDon’t trust caller ID or email names. Fraudsters often prey on people’s trust in loved ones and familiar brands. Scammers can spoof their phone numbers and email addresses to convince victims of their legitimacy.\r\nDon’t give out personal information. Some scams mimic a bank or other reputable entity and ask people to verify personal information to unlock an account or receive a payment. Call an official phone number or visit the company’s website to confirm information provided over the phone.\r\nBe suspicious of quick money-making schemes. Many scams ask victims to make an advance payment in promise of a big return, such as an inheritance or prize. Scammers often request payment via money transfers and gift cards.\r\nProtect digital information. Be wary of “too good to be true” offers; these may come from fraudulent websites trying to obtain payment information or other personal identifying information. A dodgy site might try to use the Walmart logo without permission; check the website’s legitimacy by looking for the secure “https” tag and verifying the URL is spelled correctly. Consumers should also change passwords often and use a secured wireless connection for online shopping.\r\nKeep up-to-date on common scams and tactics. Fraudsters often use fear and intimidation to create a sense of urgency. They may insist the victim owes money to the government or pose as a loved one in trouble. Consumers should know that no legitimate government entity, including the IRS, Treasury Department, FBI or local police department, will accept any form of gift cards as payment. Also, other businesses do not accept payments in the form of Walmart Gift Cards. For example, you will never be legitimately asked to pay your utility bills, bail money, debt collection and hospital bills with Walmart Gift Cards. Staying informed can help you know the signs and recognize a potential scam. Check the Federal Trade Commission and Walmart’s fraud alerts for more information.\r\nWalmart wants to help protect our customers from becoming victims of fraud. This year, we are a proud supporter of International Fraud Awareness Week. From training store and club associates to spot signs of fraud to protecting customer data 24/7, keeping customers safe from fraud is part of our culture of integrity.\r\n\r\nLearn more about how you can protect yourself from fraudulent activity and keep things merry and bright this holiday season.', 1, '0000-00-00 00:00:00'),
(3, 'Calling All DIY-ers! Walmart Has Hammered Out a New Tool Line to Make Home Improvement Projects Easier Than Ever', 'Whether working hard or playing hard, our customers trust Walmart for quality...', 'Whether working hard or playing hard, our customers trust Walmart for quality products that deliver what they need at the right price. Today, we’re excited to do just that with the launch of a new, exclusive tool line called HART™, available only at Walmart.\r\n\r\nFrom our customers who have never swung a hammer to those who are DIY enthusiasts or even full-time fixers, it’s all about having the right system of tools to get the job done. We drilled down to better address our customers’ needs and provide them with the products and experiences they want in our stores and online. With HART as the newest member of tool brands offered at Walmart, we are continuing our commitment to help busy families save time and live better – all for a great value at our everyday low prices.\r\n\r\nWhen it comes to tools they’ll use, our customers are looking for durable, high-performing and affordable products that stand the test of time. They’re looking to invest in products that can measure up to a variety of activities over the years. Whether our customers are completing a home improvement project inspired by YouTube or engaging in one of my favorite activities – a camping trip with the family – these tools will work hard for them.\r\n\r\nThe complete line of HART products is easy to use, versatile for any project homeowners find themselves having to tackle, and – best of all – available at an excellent value and amazing quality.\r\n\r\nThe HART line features power tools, hand tools, lawn & garden tools, automotive tools and several other accessories and lifestyle products. It also offers a variety of storage solutions, such as my personal favorite item: the 36” 5-drawer mobile work bench. I can’t wait to give this item to my family as a gift this Christmas – it’s awesome! Seriously, there’s pretty much nothing HART can’t handle.\r\n\r\nMaking life easier for busy families, HART tools allow you to do away with cords, gas, and piles of dead batteries! HART battery-powered products conveniently use a single interchangeable battery system for all the 20V and 40V power tools. This makes it simple for our customers to keep their equipment charged and complete their projects more efficiently. Anything that makes life simple is important to me.\r\n\r\nThis December, we’ll introduce a selection of products in stores and on Walmart.com for customers with home improvement gurus and DIY enthusiasts on their holiday gifting lists, including:\r\n\r\n20V 4 Tool Combo Kit with 200 PC. Accessory Kit, $178\r\n20V 2 PC. ½” Drill & Impact Driver Kit, $94\r\n20V Hybrid 12” String Trimmer/Edger & Blower Kit, $148\r\nThe complete line of over 340 items will be available in stores and on Walmart.com in February 2020, just in time for springtime home and garden projects as well as Mother’s Day and Father’s Day gifting.\r\n\r\nAt Walmart, we are so proud to unveil the HART system of tools and accessories, which are designed to power people’s lives. We hope that whatever customers need to get done, they do it with HART.\r\n\r\nLearn more about HART’s full line of more than 60 power tools, 40 outdoor tools, 170 hand tools and storage solutions and 70 power tool accessories below.', 1, '0000-00-00 00:00:00'),
(4, 'Walmart Announces up to $1.5 Million in Matching Grants Available for El Paso Non-profits', 'Walmart today announced it will award up to $1.5 million in matching grants to eligible El Paso non-profits...', 'Walmart today announced it will award up to $1.5 million in matching grants to eligible El Paso non-profits through two local initiatives. The first component of the company’s commitment is a match up to $1 million for funds raised during the El Paso Giving campaign launching Nov. 7 and culminating on El Paso Giving Day, a one-day fundraising event hosted on Nov. 14 by Paso del Norte Community Foundation to benefit verified 501(c)(3) charitable nonprofits that are headquartered or provide services in El Paso. The matching grant is the largest ever donation commitment to the El Paso Giving Day initiative.\r\n\r\n“We remain deeply moved by the resiliency and continued outpouring of compassion and generosity of the El Paso community,” said Todd Peterson, Walmart vice president and regional general manager. “As we continue to find ways to help the community heal, we want to honor the community’s passion for giving and service by committing up to $1.5 million for donations of money and time made to local charities through the El Paso Giving Day and El Paso Giving Time initiatives.”\r\n\r\nApproximately 180 nonprofits have registered for El Paso Giving Day, making it easy for anyone interested in supporting local charities serving the El Paso community to donate securely to their favorite cause via the El Paso Giving Day online portal. Donations made between 12:01 a.m. MT on Nov. 7 and 11:59 p.m. MT on Nov. 14 will be matched by Walmart up to a total maximum of $1 million.\r\n\r\nIn addition to helping El Paso nonprofits raise much needed funds by matching up to $1 million the monetary contributions made through the El Paso Giving campaign, Walmart is celebrating the El Paso community’s spirit of volunteerism by awarding up to $500,000 in grants through an El Paso Giving Time initiative, created in collaboration with the Paso del Norte Community Foundation.*\r\n\r\n“We are grateful for Walmart’s commitment to El Paso and for the generous financial support they have pledged to local non-profits through the Giving Day and Giving Time initiatives,” said Tracy Yellen, chief executive officer, Paso del Norte Community Foundation. Non-profit organizations do so much for our community. This is a fun and exciting way for us to support their essential programs and services. We are excited about the opportunity to meet Walmart’s $1.5 million challenge.”\r\n\r\nEl Paso Giving Time launches Nov. 15, 2019 and runs through Dec. 31, 2019. During this six-week period, El Paso County residents can choose from dozens of eligible volunteer opportunities available on the El Paso Giving Time website. Community volunteers will work with the hosting nonprofit to enter and confirm their volunteer hours and Walmart will recommend awards of $5 per eligible volunteer hour up to a total of $500,000 maximum for the program.*\r\n\r\n* Walmart will make a grant through GivePulse matching eligible volunteer hours by associates equal to $10/volunteer hour and equal to $5/volunteer hour for community members. Community members or associates must have a GivePulse account and have recorded eligible volunteer time through GivePulse between November 14 and December 31. To receive a matching grant, the nonprofit will be required to confirm the hours volunteered and certify that the volunteer time met the guidelines below. Please see guidelines posted on the El Paso Giving Time website for details on organizations and activities that qualify and the process for submitting hours. If the $500,000 maximum matching amount is reached before December 31, no additional matching grants will be made.\r\n\r\nAbout Walmart\r\nWalmart Inc. (NYSE: WMT) helps people around the world save money and live better - anytime and anywhere - in retail stores, online, and through their mobile devices. Each week, over 275 million customers and members visit our more than 11,300 stores under 58 banners in 27 countries and eCommerce websites. With fiscal year 2019 revenue of $514.4 billion, Walmart employs over 2.2 million associates worldwide. Walmart continues to be a leader in sustainability, corporate philanthropy and employment opportunity. Additional information about Walmart can be found by visiting http://corporate.walmart.com, on Facebook at http://facebook.com/walmart and on Twitter at http://twitter.com/walmart.\r\n\r\nAbout Philanthropy at Walmart\r\nWalmart.org represents the philanthropic efforts of Walmart and the Walmart Foundation. By leaning in where our business has unique strengths, we work to tackle key social issues and collaborate with others to spark long-lasting systemic change. Walmart has stores in 27 countries, employing more than 2 million associates and doing business with thousands of suppliers who, in turn, employ millions of people. Walmart.org is helping people live better by supporting programs that work to accelerate upward job mobility for frontline workers, address hunger and make healthier, more sustainably-grown food a reality, and build strong communities where Walmart operates. To learn more, visit www.walmart.org or find us on Twitter @walmartorg.\r\n\r\nAbout the Paso del Norte Community Foundation\r\nThe Paso del Norte Community Foundation was founded in 2013 to support the philanthropic goals of the El Paso community, including individuals, corporations, foundations and non-profits. With 100 donor-advised funds, designated funds and supporting organizations, the Paso del Norte Community Foundation manages assets and funds grants that support a wide range of projects aimed at improving the health, education, social services, economic development and quality of life in the El Paso region, Southern New Mexico and Ciudad Juárez. The Paso del Norte Community Foundation leads philanthropy in our region through the establishment of some of the region’s largest funds supporting health, the arts, children, environment, economic development and more including the EPISD Education Foundation, El Paso Pro-Musica Foundation and Boys & Girls Club of El Paso Foundation.', 1, '0000-00-00 00:00:00'),
(5, 'To Better Showcase Our Quality Produce, We’re Refreshing Our Shopping Experience', 'Food We know how important fresh, high-quality produce is to our customers.That’s why, a few years...', 'We know how important fresh, high-quality produce is to our customers.\r\n\r\nThat’s why, a few years ago, we committed to a relentless focus on quality improvement and giving our customers the best fresh produce possible. We added more organic and locally grown foods. We deepened our relationships with farmers – and by taking days out of the supply chain, we’ve been able to provide fresh produce that lasts longer at home.\r\n\r\nThen, we had to make sure customers understood they could trust the quality of produce in our stores. So, we redesigned the department with more light, better signing and specially angled fixtures to make shopping easier. We expanded our Fresh Guarantee and our department managers’ responsibilities to include all of service deli, bakery, meat and produce.\r\n\r\nWe’ve been focused on getting it right, and our customers are noticing. But with all the work we’ve done to increase quality in our produce department, we saw an opportunity to change up our in-store look and feel to even further emphasize the quality of the food we sell.\r\n\r\nHere’s a look at the changes we’re starting to roll out in our stores:\r\n\r\nOpen Market Feel: We’re adding low-profile displays in our fresh departments. These new bins allow customers to see everything available in the department right when they walk into the store. We’re using colorful, abundantly filled displays to highlight freshness and the quality of our items – for example, large bins of ripe red tomatoes and sizeable displays of seasonal items like squash and pumpkins.\r\n\r\nMore Space for Shopping: We’re making the aisles wider, and our new low-profile bins will enable customers to shop from multiple sides, making it faster and easier for customers to shop the department.\r\n\r\nAn Organic Shop: We’re moving all organic items into one area of the department, so customers who want organic items can enjoy one-stop shopping.\r\n\r\nNew Signage Throughout: We’re proud of our prices, and we want our customers to know they’re getting a great value at our stores. So, we’re adding more signs that are large and bright, so the low prices really stand out.\r\n\r\nIn addition to improving the shopping experience for customers, these changes make it easier for our associates to work in the department. Our new format simplifies workloads, making it easier for our associates to stock produce. This way, they can re-focus their time on serving customers.\r\n\r\nWe are just beginning to renovate the departments with plans to update the majority of stores by next summer. Many others will be renovated as part of remodels.\r\n\r\nThe changes we’re making to our produce department will be great for our customers and associates, and we’re excited to bring them to stores all around the country.', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `upload_user_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `upload_user_id`, `department`, `date`) VALUES
(1, 'RDUK_rewrite.docx', 2, 'accounts', '2019-11-27 14:06:18'),
(2, 'Spare_laptop_report.docx', 1, 'it', '2019-11-27 14:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `username`, `email`, `department`, `password`) VALUES
(1, 'firstuser', 'firstuser@gmail.com', 'it', 'Firstuser1'),
(2, 'seconduser', 'seconduser@gmail.com', 'accounts', 'Seconduser2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_posts`
--
ALTER TABLE `department_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_id` (`post_user_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upload_user_id` (`upload_user_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_posts`
--
ALTER TABLE `department_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_user_id`) REFERENCES `workers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`upload_user_id`) REFERENCES `workers` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
