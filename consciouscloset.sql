-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 06:08 AM
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
-- Database: `consciouscloset`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` varchar(2500) NOT NULL,
  `image_path` varchar(512) NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `image_path`, `date_posted`) VALUES
(1, 'Fashion Activism: How Consumers and Influencers are Driving Change Towards Sustainability', 'In recent years, fashion activism has emerged as a powerful force for change within the industry. From grassroots movements to social media campaigns, consumers and influencers are using their voices to advocate for more sustainable and ethical practices in fashion.\r\n\r\nThe Power of Consumer Activism\r\n\r\nConsumer activism plays a crucial role in holding brands accountable for their environmental and social impact. Through boycotts, petitions, and social media campaigns, consumers can pressure brands to adopt more sustainable practices and prioritize ethical considerations. By voting with their wallets, consumers have the power to drive positive change within the fashion industry.\r\n\r\nInfluencers as Agents of Change\r\n\r\nSocial media influencers have become key players in the fashion industry, wielding significant influence over consumer behavior and brand perception. Many influencers are using their platforms to raise awareness about sustainability issues and promote ethical fashion brands. By partnering with influencers who align with their values, brands can reach new audiences and amplify their sustainability efforts.\r\n\r\nGrassroots Movements and Collective Action\r\n\r\nGrassroots movements such as Fashion Revolution and Extinction Rebellion are mobilizing activists around the world to demand greater transparency and accountability from the fashion industry. Through protests, events, and educational campaigns, these movements are raising awareness about the environmental and social impact of fashion and advocating for systemic change.\r\n\r\nFashion activism is a powerful catalyst for change, empowering consumers and influencers to demand greater accountability and transparency from the fashion industry. By working together, we can create a more sustainable and ethical fashion ecosystem that respects people, animals, and the planet. Through activism, education, and conscious consumption, we can build a fashion industry that is both stylish and sustainable.\r\n\r\n', 'uploads\\london fashion week protest.jpg', '2024-04-11 08:15:30'),
(2, 'The Rise of Circular Fashion: How Brands are Embracing Sustainability', 'In recent years, the fashion industry has faced mounting scrutiny over its environmental footprint and contribution to global waste. In response, a growing number of brands are embracing circular fashion principles as a means to mitigate their impact on the planet. Circular fashion represents a paradigm shift in the way garments are designed, produced, and consumed, with a focus on minimizing waste and maximizing resource efficiency.\r\n\r\nExploring Circular Fashion\r\n\r\nCircular fashion is rooted in the principles of reduce, reuse, recycle, and repair. Brands are adopting innovative strategies to extend the lifespan of garments and minimize their end-of-life impact. This includes implementing recycling programs, creating clothing rental services, and designing products with longevity in mind. By closing the loop on the fashion supply chain, brands can reduce waste and create a more sustainable industry.\r\n\r\nCase Studies\r\n\r\nSeveral forward-thinking brands have emerged as leaders in the circular fashion movement. For example, Patagonia has implemented a robust repair program that allows customers to mend and extend the life of their garments. Similarly, H&M launched its \"Take Care\" initiative, which offers repair services and recycling bins in stores. These initiatives not only reduce waste but also foster a sense of brand loyalty among consumers.\r\n\r\nChallenges and Opportunities\r\n\r\nWhile circular fashion holds promise for reducing the fashion industry\'s environmental impact, there are challenges to overcome. These include technological limitations, consumer behavior, and systemic barriers within the industry. However, the momentum behind circular fashion continues to grow, with stakeholders across the supply chain recognizing the need for change.\r\n\r\nThe rise of circular fashion represents a significant step towards a more sustainable and responsible fashion industry. By embracing circular principles, brands can minimize waste, conserve resources, and meet the evolving demands of conscious consumers. As awareness continues to spread, we can expect to see further innovation and collaboration within the fashion industry to create a more circular economy.\r\n\r\n\r\n', 'uploads\\clothing shopping rack.jpg', '2024-04-11 09:01:00'),
(5, 'Fashion\'s Carbon Footprint: How Sustainable Practices are Mitigating Environmental Impact', '\r\nThe fashion industry is one of the largest contributors to global carbon emissions, with its production and supply chain processes consuming vast amounts of energy and resources. As awareness of climate change grows, there is increasing pressure on fashion brands to adopt more sustainable practices to mitigate their environmental impact and reduce their carbon footprint.\r\n\r\nUnderstanding Fashion\'s Environmental Impact\r\n\r\nFashion\'s carbon footprint extends beyond just carbon emissions. The industry is also responsible for significant water usage, chemical pollution, and waste generation. From the cultivation of raw materials to the production, transportation, and disposal of garments, each stage of the fashion supply chain contributes to environmental degradation. By addressing these issues holistically, brands can work towards reducing their overall environmental impact.\r\n\r\nSustainable Materials and Manufacturing Techniques\r\n\r\nSustainable fashion encompasses a range of strategies aimed at minimizing environmental harm throughout the production process. This includes using organic and recycled materials, implementing energy-efficient manufacturing practices, and prioritizing local sourcing and production. By investing in sustainable materials and manufacturing techniques, brands can reduce their carbon footprint while also appealing to eco-conscious consumers.\r\n\r\nThe Role of Consumer Awareness\r\n\r\nConsumer awareness plays a crucial role in driving demand for sustainable fashion and holding brands accountable for their environmental practices. As consumers become more educated about the environmental impact of their clothing choices, they are increasingly seeking out brands that prioritize sustainability and transparency. By voting with their wallets, consumers can incentivize brands to adopt more sustainable practices and contribute to positive change within the industry.\r\n\r\nFashion\'s carbon footprint is a complex and multifaceted issue that requires collaboration and commitment from all stakeholders. By embracing sustainable practices, brands can reduce their environmental impact and contribute to a more sustainable future for the fashion industry. Through innovation, education, and consumer activism, we can work together to create a fashion ecosystem that is both stylish and sustainable.', 'uploads\\clothing factory cambodia.jpg', '2024-04-11 10:39:38'),
(7, 'Fashion Revolution: Driving Change in the Fashion Industry', '\r\nFashion Revolution is not just a movement; it\'s a call to action. With a mission to transform the fashion industry into a force for good, this global activist group is spearheading initiatives to promote transparency, sustainability, and ethical practices throughout the supply chain. In this article, we\'ll delve into the origins of Fashion Revolution, explore its core principles, and highlight upcoming events in line with the Winnipeg Charter.\r\n\r\nOrigins of Fashion Revolution\r\n\r\nFashion Revolution was born out of the tragedy of the Rana Plaza collapse in Bangladesh in 2013, which claimed the lives of over 1,100 garment workers. In response to this devastating event, activists and industry insiders came together to demand greater transparency and accountability from fashion brands. Thus, Fashion Revolution was founded, with a vision of creating a fashion industry that values people, the planet, and creativity in equal measure.\r\n\r\nCore Principles\r\n\r\nAt the heart of Fashion Revolution are its five core principles: transparency, traceability, sustainability, ethics, and inclusivity. These principles guide the organization\'s advocacy efforts, campaigns, and events, ensuring that all stakeholders in the fashion industry are held accountable for their actions. By promoting transparency and traceability, Fashion Revolution aims to empower consumers to make informed choices and drive positive change through their purchasing power.\r\n\r\nThe Winnipeg Charter\r\n\r\nThe Winnipeg Charter, adopted by Fashion Revolution in 2022, outlines a set of guiding principles and commitments for the fashion industry to adhere to. These include respecting human rights, protecting the environment, promoting diversity and inclusion, and fostering innovation and collaboration. In line with the Winnipeg Charter, Fashion Revolution chapters around the world organize events and campaigns to raise awareness and mobilize action towards a more sustainable and equitable fashion industry.\r\n\r\nUpcoming Events\r\n\r\nIn Winnipeg, Fashion Revolution activists are gearing up for a series of events aimed at raising awareness about the importance of sustainable fashion. From panel discussions and workshops to clothing swaps and upcycling tutorials, these events provide opportunities for community engagement and education. By bringing together like-minded individuals and organizations, Fashion Revolution Winnipeg aims to catalyze positive change and drive momentum towards a more ethical and sustainable fashio', 'uploads\\fashion revolution activism group.jpg', '2024-04-11 11:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(150) NOT NULL,
  `brand_description` varchar(1200) NOT NULL,
  `website` varchar(150) NOT NULL,
  `image_path` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_description`, `website`, `image_path`) VALUES
(1, 'Patagonia', 'Patagonia is an outdoor clothing and gear company known for its commitment to environmental and social responsibility. Founded by Yvon Chouinard in 1973, Patagonia is dedicated to producing high-quality products while minimizing its impact on the planet. From sustainable materials to fair labor practices, Patagonia strives to lead by example in corporate sustainability.', 'https://www.patagonia.ca/home/', 'uploads\\patagonia hiking jacket.jpg'),
(2, 'Helly Hansen', 'Established in 1877, is a distinguished brand renowned for its outdoor apparel and gear. In recent years, they\'ve made significant strides towards sustainability by incorporating eco-friendly materials like recycled polyester and organic cotton into their products. Moreover, they\'ve implemented ethical manufacturing processes, ensuring fair labor practices and reducing their environmental footprint. This commitment to sustainability underscores their dedication to both quality and responsibility in the outdoor industry.', 'https://www.hellyhansen.com/en_ca/', 'uploads\\helly hansen womens yellow coat.jpg'),
(3, 'MUD Jeans', 'MUD Jeans, established in 2012, stands as a trailblazer in sustainable fashion. Focused on denim craftsmanship, the brand leads with a commitment to environmental and social responsibility. Central to their ethos is the concept of a circular economy, wherein they prioritize waste reduction and recycling. Their innovative lease-a-jeans initiative allows customers to lease jeans and return them for recycling or upcycling, promoting a closed-loop system. Embracing eco-friendly materials such as organic cotton and recycled polyester, MUD Jeans minimizes ecological impact while delivering stylish denim wear. Moreover, the brand upholds ethical production standards, ensuring fair wages and safe working conditions for all involved. MUD Jeans epitomizes the fusion of style and sustainability, offering eco-conscious denim choices for discerning consumers.', 'https://mudjeans.eu/', 'uploads\\mud jeans denim apparel.jpg'),
(4, 'Veja', 'Veja, a French footwear brand founded in 2005, redefines the sneaker industry with its unwavering commitment to sustainability and ethical practices. From sourcing materials to production and distribution, Veja prioritizes transparency and environmental responsibility. Their sneakers feature innovative materials such as organic cotton, wild rubber from the Amazon rainforest, and vegetable-tanned leather sourced from local Brazilian farms. By partnering directly with small-scale producers and cooperatives, Veja ensures fair wages and dignified working conditions for all workers involved in their supply chain. Additionally, the brand emphasizes ecological processes, including low-impact dyes and reduced water consumption. Veja\'s dedication to sustainability extends beyond product design, as they actively engage in social initiatives and environmental projects, contributing to positive change globally. ', 'https://www.veja-store.com/en_eu/', 'uploads\\veja waterproof sneakers.jpeg'),
(5, 'Kotn', 'Kotn, a Canadian clothing brand established in 2015, champions sustainability and social impact through its commitment to ethical sourcing and transparent manufacturing processes. Specializing in high-quality essentials made from authentic Egyptian cotton, Kotn emphasizes fair trade practices and traceability throughout its supply chain. By partnering directly with Egyptian cotton farmers, Kotn ensures fair wages and empowers local communities, contributing to economic development and social stability. Moreover, Kotn prioritizes environmental sustainability by utilizing natural farming methods that minimize water usage and avoid harmful chemicals', 'https://kotn.com/', 'uploads\\kotn burnt orange womens suit.jpg'),
(6, 'Everlane', 'Everlane, renowned for its commitment to sustainability, offers a diverse range of fashion essentials crafted with eco-conscious practices. Their dedication to sustainability is evident in every aspect of their brand:\r\nFounded on the principles of transparency, Everlane provides customers with detailed insights into their pricing structure, fostering trust and accountability. Each garment is ethically manufactured in factories worldwide that adhere to stringent ethical standards, ensuring fair wages, safe working conditions, and dignified treatment of workers. With a focus on sustainable materials like organic cotton, recycled polyester, and responsibly sourced leather, Everlane minimizes its environmental footprint while delivering high-quality products.', 'https://www.everlane.com/', 'uploads\\everlane clothing.png');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `website` varchar(150) NOT NULL,
  `image_path` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `name`, `description`, `website`, `image_path`) VALUES
(1, 'Global Organic Textile Standard', 'The Global Organic Textile Standard (GOTS) is a comprehensive certification that ensures the organic status of textiles from raw materials to manufacturing processes. It guarantees the use of organic fibers and sets strict criteria for processing methods and labor conditions. GOTS certification assures consumers that products have been produced in an environmentally and socially responsible manner, with a focus on sustainability throughout the supply chain.', 'https://global-standard.org/', 'uploads\\global organic textile standard logo.jpg'),
(2, 'Fairtrade', 'Fairtrade changes the way trade works through better prices, decent working conditions and a fairer deal for farmers and workers in developing countries.\r\nFairtrade supports and challenges businesses and governments and connects farmers and workers with the people who buy their products.\r\nA product with the FAIRTRADE Mark means producers and businesses have met internationally agreed standards which have been independently certified.\r\n', 'https://www.fairtrade.net/', 'uploads\\Fairtrade logo.jpg'),
(3, 'Bluesign', 'Bluesign is an organization dedicated to promoting sustainable and responsible practices in the textile industry. Their comprehensive approach involves assessing and certifying products and processes at every stage of the textile supply chain, from raw material sourcing to finished product. By partnering with brands, manufacturers, and chemical suppliers, Bluesign aims to eliminate harmful substances, reduce environmental impact, and improve resource efficiency throughout the textile manufacturing process. Their certification provides assurance to consumers that products bearing the Bluesign label have been produced in a way that prioritizes sustainability, environmental protection, and worker safety.', 'https://www.bluesign.com/en/', 'uploads\\bluesign logo clothing tag.webp'),
(4, 'Better Cotton Initiative', '\r\nThe Better Cotton Initiative (BCI) is a global non-profit organization that aims to make cotton production more sustainable by promoting better environmental practices, minimizing the use of harmful chemicals, and improving working conditions for farmers. BCI works with farmers worldwide to train them in more efficient and eco-friendly farming techniques, focusing on reducing water usage, pesticide application, and promoting fair labor practices. By partnering with stakeholders across the cotton supply chain, BCI seeks to create a more sustainable future for cotton production.\r\n\r\n\r\n\r\n\r\n\r\n', 'https://bettercotton.org/', 'uploads\\better cotton iniative logo.png'),
(5, 'OEKO-TEX Standard 100', 'The OEKO-TEX Standard 100 is a globally recognized certification system that ensures textiles and related products meet stringent human-ecological requirements. It primarily focuses on verifying that textiles are free from harmful substances and chemicals that could pose risks to human health. OEKO-TEX Standard 100 certification is awarded to products that have been tested and verified to meet strict criteria for harmful substances, including substances that are prohibited by law or regulated by authorities. This certification provides consumers with confidence that the textiles they purchase have undergone thorough testing and comply with high safety standards.\r\n\r\n\r\n\r\n\r\n\r\n', 'https://www.oeko-tex.com/en/', 'uploads\\Oeko-tex_standard 100 logo.jpg'),
(6, 'SA8000 Standard', 'The SA8000 standard is a globally recognized certification developed by Social Accountability International (SAI). It is based on the principles of international human rights norms, including the International Labor Organization (ILO) conventions, the Universal Declaration of Human Rights, and the United Nations Convention on the Rights of the Child. SA8000 certification focuses on ensuring ethical treatment and fair working conditions for workers across various industries.\r\nCompanies that adhere to the SA8000 standard commit to upholding fundamental human rights in the workplace, including the right to fair compensation, safe working conditions, and freedom from discrimination and harassment. SA8000 certification involves independent audits conducted by accredited certification bodies to verify compliance with the standard\'s ', 'https://sa-intl.org/programs/sa8000/', 'uploads\\SA8000 Official Logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `size` varchar(10) NOT NULL,
  `description` varchar(240) NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `isSold` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `size`, `description`, `date_posted`, `isSold`, `category`, `price`, `image_path`) VALUES
(1, 'Beige-Orange Bomber Jacket', 'M', 'Stay stylish and cozy with modern classic. Crafted with a sleek nylon shell and soft cotton lining, this jacket offers both durability and comfort. Perfect for everyday wear, its beige-orange hue adds a soft pop of color to any outfit. ', '2024-04-23', 0, 'Men', 48, 'uploads\\mens pale orange bomber jacket.jpg'),
(2, 'Rose Pink Sequined Crop Top', 'S', 'A night out favorite and can be styled with anything from sharp black pants to jeans. Prepare for the satisfying swoosh sound that comes with wearing sequins on the dancefloor. This top is in like new condition!', '2024-04-23', 0, 'Women', 20, 'uploads\\pink sequin bra top.jpg'),
(3, 'Black Canvas Converse Chuck Taylor High Tops', '8', 'Converse Chuck Taylor High Tops, like new! Classic style and comfort await you. Don\'t miss this chance to snag them at a great price!', '2024-04-23', 0, 'Women', 38, 'uploads\\womens black converse shoes.jpg'),
(4, 'Khaki Suede Mechanical Watch', 'One Size', 'Vintage and classic, this khaki suede watch is crafted with durable stainless steel, offering both style and durability.', '2024-04-23', 0, 'Men', 82, 'uploads\\mens vintage brown suede watch.jpg'),
(5, 'Vintage Burgundy Snake Skin Purse ', 'One Size', 'Exuding sophistication and charm, the Vintage Burgundy Snake Skin Purse showcases exquisite gold hardware, elevating its timeless design with a touch of luxury.', '2024-04-23', 0, 'Women', 48, 'uploads\\burgundy snake skin purse.jpg'),
(6, 'Tan Suede Oxford Brogue Dress Shoes', '10', 'What makes a shoe a brogue? The key identifier for a brogue shoe is the perforated detailing that appears around the lacing panel, heel, and toe box. Oxford brogue shoes are perfect for both formal as well as casual occasions.', '2024-04-23', 0, 'Men', 112, 'uploads\\tan suede oxford brogue shoes.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
