-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 05:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_image` (IN `src` VARCHAR(100), IN `idCompany` INT)   BEGIN
    IF NOT EXISTS (SELECT src_img FROM image_company WHERE idCompany = idCompany AND src_img = src) THEN 
        INSERT INTO image_company (src_img, idCompany) VALUES (src, idCompany);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `province`, `district`) VALUES
(1, 'Thành phố Hồ Chí Minh', 'Quận 7'),
(2, 'Thành phố Hồ Chí Minh', 'Quận 8'),
(3, 'Thành phố Hồ Chí Minh', 'Quận 1'),
(4, 'Thành phố Hồ Chí Minh', 'Quận Tân Bình'),
(5, 'Hà Nội', 'Quận Hà Đông'),
(6, 'Bà Rịa - Vũng Tàu', 'Thành phố Vũng Tàu');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idJobSeeker` int(11) NOT NULL,
  `dateApply` date NOT NULL,
  `idcv` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `idJobPosition` int(11) NOT NULL,
  `reasonAccept` varchar(50) NOT NULL,
  `dateAccept` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `idPost`, `idJobSeeker`, `dateApply`, `idcv`, `status`, `idJobPosition`, `reasonAccept`, `dateAccept`) VALUES
(18, 45, 38, '2023-04-21', 32, -1, 9, '', '2023-04-21'),
(19, 45, 39, '2023-04-21', 33, -1, 8, '', '2023-04-21'),
(20, 45, 39, '2023-04-21', 34, -1, 9, '', '2023-04-21'),
(21, 40, 39, '2023-04-21', 35, 0, 5, '', '2023-04-21'),
(22, 42, 39, '2023-04-21', 36, 1, 6, '', '2023-04-21'),
(23, 42, 44, '2023-04-21', 37, 0, 6, '', NULL),
(24, 47, 44, '2023-04-21', 38, 1, 12, '', '2023-04-21'),
(25, 44, 44, '2023-04-21', 39, 1, 7, '', '2023-04-21'),
(26, 45, 38, '2023-04-22', 40, 1, 8, '', '2023-04-22'),
(27, 59, 45, '2023-04-22', 41, 0, 24, '', NULL),
(28, 66, 45, '2023-04-22', 42, 1, 31, '', '2023-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `idCompany` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` int(11) NOT NULL,
  `website` varchar(100) NOT NULL,
  `idService` int(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `quality` float NOT NULL,
  `detail_address` varchar(100) NOT NULL,
  `emailEmployer` varchar(30) NOT NULL,
  `intro` text NOT NULL,
  `image_intro` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`idCompany`, `name`, `address`, `website`, `idService`, `logo`, `quality`, `detail_address`, `emailEmployer`, `intro`, `image_intro`) VALUES
(0, 'No Company', 0, 'No website', 0, 'No logo', 5, '30 Dunster Street, Cambridge, MA 02138', 'No email', 'no intro', ''),
(1, 'Google', 1, 'google.com', 1, './assets/images/Logo_Company/Google.png', 0, 'Mountain View, California, Hoa Kỳ', 'nguyenhuutin124@gmail.com', 'Google là một công ty công nghệ đa quốc gia có trụ sở chính tại Mountain View, California, Hoa Kỳ. Công ty được thành lập vào năm 1998 bởi Larry Page và Sergey Brin khi họ còn là sinh viên tại Đại học Stanford. Google nổi tiếng với công cụ tìm kiếm web của mình, đã trở thành công cụ tìm kiếm phổ biến nhất trên thế giới. Ngoài ra, Google còn cung cấp các dịch vụ trực tuyến như Gmail, Google Drive, Google Maps, YouTube và nhiều dịch vụ khác. Google là một trong những công ty công nghệ lớn nhất và có giá trị thị trường cao nhất trên thế giới, với nguồn lực về nghiên cứu phát triển và đầu tư mạnh mẽ vào trí tuệ nhân tạo, đám mây, tương tác giọng nói và nhiều công nghệ tiên tiến khác.', ''),
(4, 'facebook', 4, 'facebook.com', 1, './assets/images/Logo_Company/Facebook.jpg', 0, 'Menlo Park, California, Hoa Kỳ', 'tranleduy@gmail.com', 'Facebook là một trong những công ty công nghệ lớn nhất thế giới, được thành lập vào năm 2004 tại Mỹ. Với hơn 2,9 tỷ người dùng toàn cầu, Facebook đã trở thành một nền tảng quan trọng cho các doanh nghiệp quảng cáo trực tuyến và tạo ra nhiều cơ hội kinh doanh. Doanh nghiệp có thể sử dụng Facebook để tạo trang cá nhân và trang doanh nghiệp của mình trên nền tảng này, để kết nối và tương tác với khách hàng của mình. Facebook cung cấp các công cụ quảng cáo kỹ thuật số để giúp các doanh nghiệp tiếp cận đối tượng khách hàng mục tiêu một cách nhanh chóng và hiệu quả. Các công cụ quảng cáo của Facebook bao gồm các quảng cáo hiển thị, quảng cáo trên video, quảng cáo trong tin nhắn và quảng cáo trên các đối tượng tương tác. Facebook còn cung cấp các tính năng quản lý quảng cáo để giúp các doanh nghiệp theo dõi và đánh giá hiệu quả của chiến dịch quảng cáo của mình. Ngoài ra, Facebook cũng cung cấp các dịch vụ thương mại điện tử cho các doanh nghiệp, bao gồm tính năng mua sắm trực tuyến và các công cụ quản lý đơn hàng. Các doanh nghiệp cũng có thể sử dụng Facebook để tạo các sự kiện trực tuyến và quảng bá sản phẩm, dịch vụ của mình.', './assets/images/Image_company/harvard-university.jpg'),
(5, 'Havard University', 4, 'havard.edu', 4, './assets/images/Logo_Company/Harvard_University.png', 0, '30 Dunster Street, Cambridge, MA 02138', 'nguyenlequoctrung@gmail.com', 'Viện Đại học Harvard (tiếng Anh: Harvard University), còn gọi là Đại học Harvard, là một viện đại học nghiên cứu tư thục, thành viên của Liên đoàn Ivy nằm ở Cambridge, Massachusetts, Hoa Kỳ. Với lịch sử, tầm ảnh hưởng và tài sản của mình, Harvard là một trong những viện đại học danh tiếng nhất thế giới.[8][9][10][11][12]\r\n\r\nĐược thành lập vào năm 1636 bởi Cơ quan Lập pháp Thuộc địa Vịnh Massachusetts và không lâu sau đó đặt theo tên của John Harvard - người đã hiến tặng của cải cho trường, Harvard là cơ sở học tập bậc cao lâu đời nhất Hoa Kỳ.[13] Mặc dù chưa bao giờ có mối quan hệ chính thức với bất kỳ giáo phái nào, Trường Đại học Harvard (Harvard College, sau này là trường giáo dục bậc đại học của Viện Đại học Harvard) trong thời kỳ đầu chủ yếu đào tạo các mục sư Kháng Cách thuộc hệ phái Tự trị Giáo đoàn. Chương trình học và thành phần sinh viên của trường dần dần trở nên có tính chất thế tục trong thế kỷ XVIII, và đến thế kỷ XIX thì Harvard đã nổi lên như một cơ sở văn hóa chủ chốt của giới tinh hoa vùng Boston.[14][15] Sau Nội chiến Hoa Kỳ, Charles W. Eliot trong nhiệm kỳ viện trưởng kéo dài nhiều năm của mình (từ 1869 đến 1909) đã chuyển đổi trường đại học này và các trường chuyên nghiệp liên kết với nó thành một viện đại học nghiên cứu hiện đại. Harvard là thành viên sáng lập Hiệp hội Viện Đại học Bắc Mỹ vào năm 1900.[16] James Bryant Conant lãnh đạo viện đại học này trong suốt thời kỳ Đại suy thoái và Chiến tranh thế giới thứ hai, sau chiến tranh bắt đầu cải cách chương trình học và mở rộng việc tuyển sinh. Trường Đại học Harvard trở thành cơ sở giáo dục dành cho cả nam lẫn nữ vào năm 1977 khi nó sáp nhập với Trường Đại học Radcliffe.\r\n\r\nViện Đại học Harvard được tổ chức thành 11 đơn vị học thuật - 10 phân khoa đại học và Viện Nghiên cứu Cao cấp Radcliffe - với các khuôn viên nằm rải rác khắp vùng đô thị Boston:[17] khuôn viên chính rộng 209 mẫu Anh (85 ha) nằm ở thành phố Cambridge, cách Boston chừng 3 dặm (4,8 km) về phía tây bắc; Trường Kinh doanh và các cơ sở thể thao, bao gồm Sân vận động Harvard, nằm bên kia sông Charles ở khu Allston của Boston; còn Trường Y khoa, Trường Nha khoa và Trường Y tế Công cộng thì nằm ở Khu Y khoa Longwood.[7] Trong số các tổng thống Hoa Kỳ, có tám người là cựu sinh viên Harvard; chừng 150 người được trao giải Nobel là sinh viên, giảng viên, hay nhân viên của viện đại học này. Ngoài ra, có 62 tỉ phú hiện đang còn sống và 335 Học giả Rhodes, hầu hết sống ở Hoa Kỳ, là cựu sinh viên Harvard.[18][19] Thư viện Viện Đại học Harvard cũng là thư viện đại học lớn nhất ở Hoa Kỳ.[20] Tính đến tháng 6 năm 2013, tổng số tiền hiến tặng mà Harvard có được là 32,3 tỷ đô-la, lớn hơn ở bất cứ cơ sở học thuật nào trên thế giới.[3]', './assets/images/Image_company/background_singin.png'),
(6, 'Audi', 5, 'audi.vn', 2, './assets/images/Logo_Company/Audi.png', 5, '', 'nguyenan@gmail.com', 'Audi là một trong những thương hiệu xe hơi danh tiếng trên toàn thế giới, có mặt tại Việt Nam từ năm 2008. Tại Việt Nam, Audi được phân phối bởi công ty TNHH Audi Vietnam thuộc tập đoàn Volkswagen Group. Hiện tại, Audi Vietnam đã có mặt tại các thành phố lớn như Hà Nội, Hồ Chí Minh và Đà Nẵng. Công ty cung cấp các dòng xe hơi cao cấp như Audi A3, A4, A5, A6, A7, A8, Q2, Q3, Q5, Q7, Q8, TT và R8. Các dòng xe này được nhập khẩu từ Đức và được đảm bảo chất lượng và an toàn. Ngoài việc phân phối xe hơi, Audi Vietnam còn cung cấp các dịch vụ hậu mãi chất lượng cao cho khách hàng. Công ty có mạng lưới dịch vụ rộng khắp Việt Nam và các kỹ thuật viên được đào tạo chuyên nghiệp để đảm bảo sự hài lòng của khách hàng.', './assets/images/Image_company/img_intro_levent.jpg'),
(8, 'CB/I Digital', 1, 'cbidigital.com', 1, './assets/images/Logo_Company/cbidigital.jpg', 5, 'Vietnam Office: ROBOT TOWER, Lầu 6, 308 - 308C Điện Biên Phủ, Phường 04, Quận 3, Thành phố Hồ Chí Mi', 'lethixuanngan@gmail.com', 'Faster growth. Stronger results. Proven. CBI Digital là một công ty công nghệ và tiếp thị kỹ thuật số với các văn phòng tại New York, Hoa Kỳ và Thành phố Hồ Chí Minh, Việt Nam. Chúng tôi phát triển các nền tảng và ứng dụng di động quy mô lớn dựa trên đám mây cho các công ty khởi nghiệp công nghệ VC-backend và khách hàng doanh nghiệp. Các dự án của khách hàng của chúng tôi bao gồm xây dựng một nền tảng đám mây liên lạc y tế và tham gia bệnh nhân sử dụng kiến trúc microservice cho một nhóm bệnh viện lớn tại Việt Nam với hơn 4 triệu bệnh nhân, một nền tảng SaaS phân tích dữ liệu cho tồn kho và tối ưu hóa tiếp thị bán lẻ sử dụng các giải pháp đám mây back-end và front-end độc quyền của CBI, và một thị trường cho cộng đồng bền vững với hơn 600 thương hiệu. Chúng tôi có một nền văn hóa tham vọng nhằm đạt được những mục tiêu rất cao cho thành công của khách hàng, đòi hỏi tốt nhất của chúng tôi và tôn vinh tính chính trực và tận tâm. Chúng tôi là Đối tác Giải pháp Adobe, Đối tác Premier của Google và Đối tác Kinh doanh của Facebook. Chúng tôi đang tìm kiếm một nhà phát triển back-end Nodejs có năng lực để tham gia vào đội ngũ của chúng tôi để xây dựng các ứng dụng đám mây thú vị cho khách hàng của chúng tôi tại Mỹ và Việt Nam', './assets/images/Image_company/cbidigital.jpg'),
(9, 'FPTU', 1, 'daihoc.fpt.edu.vn', 1, './assets/images/Logo_Company/FPTU.jpg', 5, 'Lô E2a-7, Đường D1, Đ. D1, Long Thạnh Mỹ, Thành Phố Thủ Đức, Thành phố Hồ Chí Minh 700000', 'trung@gmail.com', 'Chính thức thành lập ngày 8/9/2006 theo Quyết định của Thủ tướng Chính phủ, Trường Đại học FPT trở thành trường đại học đầu tiên của Việt Nam do một doanh nghiệp đứng ra thành lập với 100% vốn đầu tư từ Tập đoàn FPT. Sự khác biệt của Trường Đại học FPT so với các trường đại học khác là đào tạo theo hình thức liên kết chặt chẽ với các doanh nghiệp, gắn đào tạo với thực tiễn, với nghiên cứu – triển khai và các công nghệ hiện đại nhất. Triết lý và phương pháp giáo dục hiện đại; Đào tạo con người toàn diện, hài hòa; Chương trình luôn được cập nhật và tuân thủ các chuẩn công nghệ quốc tế; Đặc biệt chú trọng kỹ năng ngoại ngữ; Tăng cường đào tạo quy trình tổ chức sản xuất, kỹ năng làm việc theo nhóm và các kỹ năng cá nhân khác là những điểm sẽ đảm bảo cho sinh viên tốt nghiệp có những cơ hội việc làm tốt nhất sau khi ra trường. Trường hiện đang đào tạo các nhóm ngành CNTT, Kinh tế, Ngôn ngữ, Mỹ thuật ứng dụng.', './assets/images/Image_company/FPTU.jpg'),
(10, 'HUST', 1, 'hust.edu.vn', 4, './assets/images/Logo_Company/HUST.jpg', 5, '1 Đại Cồ Việt, Bách Khoa, Hai Bà Trưng, Hà Nội', 'lethithao@gmail.com', 'Hanoi University of Science and Technology (HUST) là một trong những trường đại học hàng đầu tại Việt Nam, có trụ sở chính tại Hà Nội. Trường được thành lập từ năm 1956 và trở thành một trong những trường đại học công nghệ hàng đầu ở khu vực Đông Nam Á. HUST cung cấp nhiều ngành học khác nhau, bao gồm các chuyên ngành kỹ thuật, khoa học, công nghệ thông tin, kinh tế, quản lý và ngoại ngữ. Trong đó, các ngành kỹ thuật như Cơ khí, Điện tử, Viễn thông, Công nghệ thông tin, Vật lý kỹ thuật và Hóa học được đánh giá là mạnh nhất và được đào tạo bởi những giảng viên có trình độ cao, có kinh nghiệm và nhiệt huyết. HUST cũng được biết đến với nhiều hoạt động nghiên cứu và phát triển công nghệ. Trường có nhiều phòng thí nghiệm hiện đại và được trang bị các thiết bị và công nghệ tiên tiến để thúc đẩy hoạt động nghiên cứu. HUST cũng có nhiều chương trình hợp tác với các trường đại học và viện nghiên cứu hàng đầu trên thế giới.', ''),
(12, 'NLU', 1, 'hcmuaf.edu.vn', 4, './assets/images/Logo_Company/NLU.jpg', 4, 'VQCR+GP6, Khu Phố 6, Thủ Đức, Thành phố Hồ Chí Minh', 'phamngochieu@gmail.com', 'rường Đại học Nông Lâm TPHCM (HUAF) là một trong những trường đại học uy tín hàng đầu tại Việt Nam về đào tạo và nghiên cứu trong lĩnh vực nông nghiệp và lâm nghiệp. Trường được thành lập vào năm 1955 với tên gọi trường Sư phạm Nông Lâm Sài Gòn, và sau đó được đổi tên thành Đại học Nông Lâm TPHCM vào năm 2005. Trường có nhiều khoa chuyên ngành về nông nghiệp, lâm nghiệp, ngư nghiệp, kinh tế, kỹ thuật công trình, công nghệ thực phẩm, khoa học máy tính và nhiều lĩnh vực khác. HUAF tự hào là trường đại học đầu tiên tại Việt Nam có chương trình đào tạo Cử nhân Quốc tế về Nông nghiệp và Môi trường, với nhiều sinh viên đến từ các nước trên thế giới. Trường Đại học Nông Lâm TPHCM cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ trong lĩnh vực nông nghiệp và lâm nghiệp. Các phòng thí nghiệm trang bị hiện đại và đội ngũ giảng viên giàu kinh nghiệm giúp sinh viên có cơ hội tiếp cận với các công nghệ mới nhất và có thể thực hiện các dự án nghiên cứu độc lập.', ''),
(13, 'OU', 1, 'ou.edu.vn', 4, './assets/images/Logo_Company/OU.png', 4, 'B101 P. Nguyễn Hiền, Bách Khoa, Hai Bà Trưng, Hà Nội 100000', 'myuyen@gmail.com', 'Trường Đại học Mở Hà Nội (Hanoi Open University - HOU) là một trong những trường đại học lớn và uy tín tại Việt Nam, được thành lập vào năm 1993. Trường cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học về nhiều lĩnh vực, bao gồm kinh tế, quản trị kinh doanh, luật, giáo dục, ngoại ngữ, công nghệ thông tin và nhiều lĩnh vực khác. Mô hình giáo dục của HOU là học tập linh hoạt và đa phương tiện, cho phép sinh viên học tập trực tuyến và offline với các giảng viên giàu kinh nghiệm và chuyên môn. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ trong lĩnh vực giáo dục và đào tạo, giúp sinh viên có cơ hội nâng cao kiến thức và kỹ năng của mình. HOU cũng có nhiều hoạt động đổi mới và phát triển giáo dục, bao gồm đưa ra các chương trình đào tạo ngắn hạn cho sinh viên và người lao động, giúp họ nâng cao kỹ năng và cập nhật kiến thức mới nhất. Trường cũng tổ chức các hoạt động ngoại khóa, thể thao và văn hóa cho sinh viên, giúp họ phát triển kỹ năng mềm và giao lưu với nhau.', './assets/images/Image_company/OU.png'),
(14, 'PTIT', 1, 'ptit.edu.vn', 4, './assets/images/Logo_Company/PTIT.jpg', 5, '122 Hoàng Quốc Việt, Cổ Nhuế, Cầu Giấy, Hà Nội', 'namthy@gmail.com', 'Học viện Bưu chính Viễn thông Hà Nội (PTIT) là một trong những trường đại học hàng đầu về lĩnh vực công nghệ thông tin và truyền thông tại Việt Nam. Trường được thành lập vào năm 1960, với tên gọi là Trường Đại học Bưu chính Viễn thông, và sau đó đổi tên thành Học viện Bưu chính Viễn thông Hà Nội vào năm 2006. PTIT cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học, bao gồm kỹ thuật viễn thông, kỹ thuật máy tính, kỹ thuật điện tử, quản trị kinh doanh, ngôn ngữ Anh và nhiều lĩnh vực khác. Trường cũng có các chương trình đào tạo liên kết với các trường đại học hàng đầu trên thế giới, giúp sinh viên có cơ hội học tập và làm việc trên tầm quốc tế. PTIT có một đội ngũ giảng viên giàu kinh nghiệm và chuyên môn trong lĩnh vực công nghệ thông tin và truyền thông, được trang bị các phòng thí nghiệm và trang thiết bị hiện đại. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ, giúp sinh viên có cơ hội nghiên cứu và thực hành các dự án công nghệ mới nhất.', ''),
(15, 'TDTU', 1, 'tdtu.edu.vn', 4, './assets/images/Logo_Company/TDTU.jpg', 5, '19 Đ. Nguyễn Hữu Thọ, Tân Hưng, Quận 7, Thành phố Hồ Chí Minh', 'phuongvy@gmail.com', 'Trường Đại học Tôn Đức Thắng (Ton Duc Thang University - TDTU) là một trong những trường đại học hàng đầu tại Việt Nam, được thành lập vào năm 1997 và đặt tên theo danh nhân Tôn Đức Thắng - người đã từng là Tổng thống Việt Nam từ 1969 đến 1976. TDTU cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học, bao gồm kỹ thuật, kinh tế, quản trị kinh doanh, luật, tâm lý học, ngôn ngữ, và nhiều lĩnh vực khác. Trường cũng có các chương trình đào tạo liên kết với các trường đại học hàng đầu trên thế giới, giúp sinh viên có cơ hội học tập và làm việc trên tầm quốc tế. TDTU có một đội ngũ giảng viên giàu kinh nghiệm và chuyên môn trong lĩnh vực của mình, được trang bị các phòng thí nghiệm và trang thiết bị hiện đại. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ, giúp sinh viên có cơ hội nghiên cứu và thực hành các dự án công nghệ mới nhất. Ngoài ra, TDTU cũng có nhiều hoạt động văn hóa, thể thao và tình nguyện cho sinh viên, giúp họ phát triển kỹ năng mềm và giao lưu với nhau. Trường cũng tổ chức các hoạt động hội thảo, seminar và cuộc thi, giúp sinh viên có cơ hội trình bày và chia sẻ kiến thức của mình với cộng đồng. TDTU cũng đang phát triển các chương trình đào tạo tiên tiến và đáp ứng nhu cầu của thị trường lao động trong tương lai. Năm 2021, Trường đạt được danh hiệu 5 sao do tổ chức giáo dục và đào tạo Quacquarelli Symonds (QS) (QS Stars).', './assets/images/Image_company/TDTU.jpg'),
(16, 'UEH', 1, 'ueh.edu.vn', 4, './assets/images/Logo_Company/UEH.jpg', 5, '59C Nguyễn Đình Chiểu, Phường 6, Quận 3, Thành phố Hồ Chí Minh', 'baongan@gmail.com', 'Trường Đại học Kinh tế Thành phố Hồ Chí Minh (UEH) là một trong những trường đại học hàng đầu về lĩnh vực kinh tế tại Việt Nam. Trường được thành lập vào năm 1976 và có truyền thống lâu đời trong giảng dạy và nghiên cứu kinh tế. UEH cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học, bao gồm kinh tế, quản trị kinh doanh, tài chính, ngân hàng, kế toán, marketing và nhiều lĩnh vực khác. Trường cũng có các chương trình đào tạo liên kết với các trường đại học hàng đầu trên thế giới, giúp sinh viên có cơ hội học tập và làm việc trên tầm quốc tế. UEH có một đội ngũ giảng viên giàu kinh nghiệm và chuyên môn trong lĩnh vực kinh tế, được trang bị các phòng thí nghiệm và trang thiết bị hiện đại. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ, giúp sinh viên có cơ hội nghiên cứu và thực hành các dự án kinh tế mới nhất.', ''),
(17, 'UFM', 1, 'ufm.edu.vn', 4, '.assets/images/Logo_Company/UFM.jpg', 4, '778 Nguyễn Kiệm, P. 4, Phú Nhuận, Thành phố Hồ Chí Minh', 'thuytrang@gmail.com', 'Trường Đại học Tài Chính Marketing (UFM) là một trong những trường đại học hàng đầu tại Việt Nam về đào tạo ngành kinh tế, tài chính và marketing. Trường được thành lập vào năm 2007 và có trụ sở chính tại thành phố Hồ Chí Minh. UFM cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học, bao gồm kinh tế, quản trị kinh doanh, tài chính, ngân hàng, kế toán, marketing và nhiều lĩnh vực khác. Trường cũng có các chương trình đào tạo liên kết với các trường đại học hàng đầu trên thế giới, giúp sinh viên có cơ hội học tập và làm việc trên tầm quốc tế. UFM có một đội ngũ giảng viên giàu kinh nghiệm và chuyên môn trong lĩnh vực kinh tế, được trang bị các phòng thí nghiệm và trang thiết bị hiện đại. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ, giúp sinh viên có cơ hội nghiên cứu và thực hành các dự án kinh tế mới nhất.', ''),
(18, 'HCMUS', 1, 'hcmus.edu.vn', 4, './assets/images/Logo_Company/VNU.png', 5, '227 Đ. Nguyễn Văn Cừ, Phường 4, Quận 5, Thành phố Hồ Chí Minh', 'ngochuynh@gmail.com', 'Trường Đại học Khoa học Tự nhiên (HCMUS) là một trong những trường đại học hàng đầu tại Việt Nam về đào tạo và nghiên cứu các lĩnh vực khoa học tự nhiên, kỹ thuật và công nghệ. Trường được thành lập vào năm 1955 và có trụ sở chính tại thành phố Hồ Chí Minh. HCMUS cung cấp các chương trình đào tạo đa dạng từ đại học đến sau đại học, bao gồm các ngành như toán học, vật lý, hóa học, sinh học, khoa học máy tính, kỹ thuật điện tử, kỹ thuật vật liệu và nhiều lĩnh vực khác. Trường cũng có các chương trình đào tạo liên kết với các trường đại học hàng đầu trên thế giới, giúp sinh viên có cơ hội học tập và làm việc trên tầm quốc tế. HCMUS có một đội ngũ giảng viên giàu kinh nghiệm và chuyên môn trong các lĩnh vực khoa học tự nhiên, được trang bị các phòng thí nghiệm và trang thiết bị hiện đại. Trường cũng có nhiều hoạt động nghiên cứu và phát triển công nghệ, giúp sinh viên có cơ hội nghiên cứu và thực hành các dự án khoa học mới nhất.', './assets/images/Image_company/'),
(19, 'Google', 6, 'https://google.com', 1, './assets/images/Logo_Company/Google.png', 5, '1600 Amphitheatre Parkway, Mountain View, California, U.S.', 'nguyenhuutin12345@gmail.com', 'Google LLC (/ˈɡuːɡəl/ (listen)) is an American multinational technology company focusing on online advertising, search engine technology, cloud computing, computer software, quantum computing, e-commerce, artificial intelligence,[9] and consumer electronics. It has been referred to as \"the most powerful company in the world\"[10] and one of the world\'s most valuable brands due to its market dominance, data collection, and technological advantages in the area of artificial intelligence.[11][12][13] Its parent company Alphabet is considered one of the Big Five American information technology companies, alongside Amazon, Apple, Meta, and Microsoft.\r\n\r\nGoogle was founded on September 4, 1998, by computer scientists Larry Page and Sergey Brin while they were PhD students at Stanford University in California. Together they own about 14% of its publicly listed shares and control 56% of its stockholder voting power through super-voting stock. The company went public via an initial public offering (IPO) in 2004. In 2015, Google was reorganized as a wholly owned subsidiary of Alphabet Inc. Google is Alphabet\'s largest subsidiary and is a holding company for Alphabet\'s internet properties and interests. Sundar Pichai was appointed CEO of Google on October 24, 2015, replacing Larry Page, who became the CEO of Alphabet. On December 3, 2019, Pichai also became the CEO of Alphabet.[14]\r\n\r\nThe company has since rapidly grown to offer a multitude of products and services beyond Google Search, many of which hold dominant market positions. These products address a wide range of use cases, including email (Gmail), navigation (Waze & Maps), cloud computing (Cloud), web browsing (Chrome), video sharing (YouTube), productivity (Workspace), operating systems (Android), cloud storage (Drive), language translation (Translate), photo storage (Photos), video calling (Meet), smart home (Nest), smartphones (Pixel), wearable technology (Pixel Watch & Fitbit), music streaming (YouTube Music), video on demand (YouTube TV), artificial intelligence (Google Assistant), machine learning APIs (TensorFlow), AI chips (TPU), and more. Discontinued Google products include gaming (Stadia), Glass, Google+, Reader, Play Music, Nexus, Hangouts, and Inbox by Gmail.[15][16]\r\n\r\nGoogle\'s other ventures outside of Internet services and consumer electronics include quantum computing (Sycamore), self-driving cars (Waymo, formerly the Google Self-Driving Car Project), smart cities (Sidewalk Labs), and transformer models (Google Brain).[17]\r\n\r\nGoogle and YouTube are the two most visited websites worldwide followed by Facebook and Twitter. Google is also the largest search engine, mapping and navigation application, email provider, office suite, video sharing platform, photo and cloud storage provider, mobile operating system, web browser, ML framework, and AI virtual assistant provider in the world as measured by market share. On the list of most valuable brands, Google is ranked second by Forbes[18] and fourth by Interbrand.[19] It has received significant criticism involving issues such as privacy concerns, tax avoidance, censorship, search neutrality, antitrust and abuse of its monopoly position.', './assets/images/Image_company/Google.png');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `idJobSeeker` int(11) NOT NULL,
  `image_cv` varchar(100) NOT NULL,
  `status` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `idPost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `idJobSeeker`, `image_cv`, `status`, `name`, `description`, `idPost`) VALUES
(32, 38, './assets/images/img_cv/nguyenhuutin124@gmail.comGoogle.png', -1, 'Nguyễn Hữu Tín', '', 45),
(33, 38, './assets/images/img_cv/nguyenhuutin124@gmail.comimg_cv_nguyen_van_nam.jpg', -1, 'Nguyễn Hữu Tín', '', 45),
(34, 39, './assets/images/img_cv/nguyenlequoctrung@gmail.comSamsung.jpg', -1, 'Nguyễn Lê Quốc Trung', '', 45),
(35, 39, './assets/images/img_cv/nguyenlequoctrung@gmail.comnguyenhuutin124@gmail.comimg_cv_nguyen_van_nam.jpg', -1, 'Nguyễn Lê Quốc Trung', '', 45),
(36, 39, './assets/images/img_cv/nguyenlequoctrung@gmail.comGoogle.png', 2, 'Nguyễn Lê Quốc Trung', '', 42),
(37, 44, './assets/images/img_cv/thuan01022003@gmail.comimg_intro_levent.jpg', 2, 'vo minh thuan', 'kỹ sư', 47),
(38, 44, './assets/images/img_cv/thuan01022003@gmail.combasic_background1.webp', 2, 'vo minh thuan', 'kỹ sư', 47),
(39, 44, './assets/images/img_cv/thuan01022003@gmail.comnguyenhuutin124@gmail.comGoogle.png', 2, 'vo minh thuan', '', 44),
(40, 38, './assets/images/img_cv/nguyenhuutin124@gmail.comimg_cv_nguyen_ha.jpg', 2, 'Cv của Google', '', 45),
(41, 45, './assets/images/img_cv/nguyenhuutin1234@gmail.comimg_cv_nguyen_van_nam.jpg', 2, 'CV của Nguyễn Hữu Tí', 'Đây là cv của Tín', 66),
(42, 45, './assets/images/img_cv/nguyenhuutin1234@gmail.comimg_cv_nguyen_ha.jpg', 2, 'CV của Tín', 'Đây là Cv Của Tín nộp cho Google', 66);

-- --------------------------------------------------------

--
-- Table structure for table `detail_notification`
--

CREATE TABLE `detail_notification` (
  `id_notification` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `idCompany` int(11) NOT NULL,
  `postDate` date NOT NULL,
  `status` bit(1) NOT NULL,
  `typeNotification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_notification`
--

INSERT INTO `detail_notification` (`id_notification`, `email`, `title`, `content`, `idCompany`, `postDate`, `status`, `typeNotification`) VALUES
(14, 'nguyenlequoctrung@gmail.com', 'Annoucement about changed password', 'Dear [User],\r\n\r\n            We are writing to inform you that your password has been successfully changed. This is a confirmation email to let you know that your account is now secure with your new password.\r\n            \r\n            If you did not request a password change, please contact our customer support team immediately to report any unauthorized activity.\r\n            \r\n            To ensure the security of your account, we recommend that you keep your password confidential and avoid sharing it with anyone. Additionally, it is a good practice to update your password regularly to prevent any unauthorized access to your account.\r\n            \r\n            Thank you for your cooperation in maintaining the security of your account.\r\n            \r\n            Best regards.', 0, '2023-04-21', b'1', 0),
(15, 'nguyenlequoctrung@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 4, '2023-04-21', b'1', 0),
(16, 'admin@gmail.com', 'Annoucement about changed password', 'Dear [User],\r\n\r\n            We are writing to inform you that your password has been successfully changed. This is a confirmation email to let you know that your account is now secure with your new password.\r\n            \r\n            If you did not request a password change, please contact our customer support team immediately to report any unauthorized activity.\r\n            \r\n            To ensure the security of your account, we recommend that you keep your password confidential and avoid sharing it with anyone. Additionally, it is a good practice to update your password regularly to prevent any unauthorized access to your account.\r\n            \r\n            Thank you for your cooperation in maintaining the security of your account.\r\n            \r\n            Best regards.', 0, '2023-04-21', b'1', 0),
(17, 'thuan01022003@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 7, '2023-04-21', b'1', 0),
(18, 'thuan01022003@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 7, '2023-04-21', b'1', 0),
(19, 'thuan01022003@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 4, '2023-04-21', b'0', 0),
(20, 'nguyenhuutin124@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 5, '2023-04-22', b'0', 0),
(21, 'nguyenhuutin124@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 5, '2023-04-22', b'0', 0),
(22, 'nguyenhuutin124@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 5, '2023-04-22', b'0', 0),
(23, 'nguyenhuutin124@gmail.com', 'Annoucement about accepting CV', 'We are pleased to announce that we are currently accepting resumes/CVs for open positions in our organization. We welcome candidates from diverse backgrounds and encourage all interested and qualified individuals to apply.\r\n            \r\n            To submit your application, please follow the instructions provided in the job posting or on our website. Make sure to include a well-written resume/CV that highlights your skills, experience, and qualifications relevant to the position you are applying for.\r\n            \r\n            Our team will carefully review all applications and select candidates who best match the requirements of the position. If you are selected for an interview, we will contact you directly to schedule a time and date.\r\n            \r\n            We value diversity and inclusivity in our workplace and are committed to providing equal employment opportunities to all individuals regardless of their race, gender, age, religion, sexual orientation, or any other characteristic protected by law.\r\n            \r\n            Thank you for your interest in joining our team. We look forward to reviewing your application.', 5, '2023-04-22', b'0', 0),
(24, 'nguyenhuutin1234@gmail.com', 'Thông báo chấp nhận hồ sơ ứng tuyển', 'Chúng tôi rất vui mừng thông báo rằng hiện tại chúng tôi đang tiếp nhận hồ sơ ứng tuyển cho các vị trí tuyển dụng trong tổ chức của chúng tôi. Chúng tôi chào đón ứng viên đến từ nhiều nền tảng khác nhau và khuyến khích tất cả các cá nhân quan tâm và đủ điều kiện nộp đơn.\r\n            Để nộp đơn của bạn, vui lòng làm theo hướng dẫn được cung cấp trong thông tin công việc hoặc trên trang web của chúng tôi. Hãy đảm bảo bao gồm một bản sơ yếu lý lịch/CV tập trung vào các kỹ năng, kinh nghiệm và trình độ chuyên môn liên quan đến vị trí bạn đang ứng tuyển.\r\n\r\n            Đội ngũ của chúng tôi sẽ cẩn thận xem xét tất cả các đơn ứng tuyển và chọn ra các ứng viên phù hợp nhất với yêu cầu của vị trí. Nếu bạn được chọn để phỏng vấn, chúng tôi sẽ liên hệ trực tiếp với bạn để lên lịch.\r\n\r\n            Chúng tôi coi trọng tính đa dạng và tính bao dung trong môi trường làm việc của chúng tôi và cam kết cung cấp cơ hội việc làm bình đẳng cho tất cả các cá nhân, bất kể chủng tộc, giới tính, tuổi tác, tôn giáo, địa chỉ, hoặc bất kỳ đặc điểm nào khác được bảo vệ bởi pháp luật.\r\n\r\n            Cảm ơn bạn đã quan tâm đến việc tham gia cùng đội ngũ của chúng tôi. Chúng tôi mong đợi để xem xét đơn của bạn.', 19, '2023-04-22', b'1', 0),
(25, 'nguyenhuutin1234@gmail.com', 'Thông báo chấp nhận hồ sơ ứng tuyển', 'Chúng tôi rất vui mừng thông báo rằng hiện tại chúng tôi đang tiếp nhận hồ sơ ứng tuyển cho các vị trí tuyển dụng trong tổ chức của chúng tôi. Chúng tôi chào đón ứng viên đến từ nhiều nền tảng khác nhau và khuyến khích tất cả các cá nhân quan tâm và đủ điều kiện nộp đơn.\r\n            Để nộp đơn của bạn, vui lòng làm theo hướng dẫn được cung cấp trong thông tin công việc hoặc trên trang web của chúng tôi. Hãy đảm bảo bao gồm một bản sơ yếu lý lịch/CV tập trung vào các kỹ năng, kinh nghiệm và trình độ chuyên môn liên quan đến vị trí bạn đang ứng tuyển.\r\n\r\n            Đội ngũ của chúng tôi sẽ cẩn thận xem xét tất cả các đơn ứng tuyển và chọn ra các ứng viên phù hợp nhất với yêu cầu của vị trí. Nếu bạn được chọn để phỏng vấn, chúng tôi sẽ liên hệ trực tiếp với bạn để lên lịch.\r\n\r\n            Chúng tôi coi trọng tính đa dạng và tính bao dung trong môi trường làm việc của chúng tôi và cam kết cung cấp cơ hội việc làm bình đẳng cho tất cả các cá nhân, bất kể chủng tộc, giới tính, tuổi tác, tôn giáo, địa chỉ, hoặc bất kỳ đặc điểm nào khác được bảo vệ bởi pháp luật.\r\n\r\n            Cảm ơn bạn đã quan tâm đến việc tham gia cùng đội ngũ của chúng tôi. Chúng tôi mong đợi để xem xét đơn của bạn.', 19, '2023-04-22', b'1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `number_phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `idCompany` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `name`, `password`, `number_phone`, `email`, `idCompany`) VALUES
(7, 'Nguyễn Hữu Tín', '', '091234567891', 'nguyenhuutin124@gmail.com', 1),
(8, 'Trần Lê Duy', '', '1234567892', 'tranleduy@gmail.com', 2),
(9, 'Nguyễn Lê Quốc Trung', 'Abcd12345@', '01234567893', 'nguyenlequoctrung@gmail.com', 3),
(10, 'Nguyễn An', 'Abcd1234@', '01234567894', 'nguyenan@gmail.com', 4),
(11, 'vo minh thuan', '123456789', '0382184351', 'thuan01022003@gmail.com', 0),
(12, 'Lê Thị Xuân Ngân', 'ngan1234@', '0432567543', 'lethixuanngan@gmail.com', 8),
(13, 'Trần Quang Trung', 'trung2934@', '0758746352', 'trung@gmail.com', 9),
(14, 'Lê Thị Thảo', 'ltt12345@', '0857748627', 'lethithao@gmail.com', 10),
(15, 'Nguyễn Quốc Tuấn', 'tuanit@123', '0536748576', 'tuan96@gmail.com', 11),
(16, 'Phạm Ngọc Hiếu', 'hiun123@', '0857363274', 'phamngochieu@gmail.com', 12),
(17, 'Phạm Ngọc Mỹ Uyên', 'pnmuyen555@', '0867546354', 'myuyen@gmail.com', 13),
(18, 'Nguyễn Nam Thy', 'nmthy123@', '0869857631', 'namthy@gmail.com', 14),
(19, 'Nguyễn Lê Phương Vy', '91003@', '0986546638', 'phuongvy@gmail.com', 15),
(20, 'Trương Bảo Ngân', 'bn170203@', '0954637381', 'baongan@gmail.com', 16),
(21, 'Phạm Thị Thùy Trang', '12332156', '0374856063', 'thuytrang@gmail.com', 17),
(22, 'Nguyễn Huỳnh Ngọc Thành', 'ngochuynh87@', '0982393492', 'ngochuynh@gmail.com', 18),
(23, 'Nguyễn Hữu Tín', 'Abc123@', '0967671065', 'nguyenhuutin12345@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `following_company`
--

CREATE TABLE `following_company` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `following_company`
--

INSERT INTO `following_company` (`id`, `idUser`, `idCompany`) VALUES
(2, 38, 1),
(3, 39, 1),
(4, 39, 4),
(5, 38, 4),
(6, 38, 5),
(7, 44, 4),
(8, 44, 4),
(9, 44, 4),
(10, 44, 4),
(11, 44, 4),
(12, 44, 4),
(13, 44, 4),
(14, 44, 4),
(15, 44, 4),
(16, 38, 7),
(17, 45, 8);

-- --------------------------------------------------------

--
-- Table structure for table `image_company`
--

CREATE TABLE `image_company` (
  `id` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `src_img` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_company`
--

INSERT INTO `image_company` (`id`, `idCompany`, `src_img`) VALUES
(3, 5, './assets/images/Image_company/img_intro_levent.jpg'),
(4, 5, './assets/images/Image_company/background_singin.png'),
(5, 18, './assets/images/Image_company/'),
(6, 9, './assets/images/Image_company/FPTU.jpg'),
(7, 13, './assets/images/Image_company/OU.png'),
(8, 15, './assets/images/Image_company/TDTU.jpg'),
(9, 8, './assets/images/Image_company/cbidigital.jpg'),
(10, 19, './assets/images/Image_company/Google.png');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `idService` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `idService`, `name`) VALUES
(0, 0, 'No job'),
(3, 1, 'lập trình viên'),
(4, 1, 'coder'),
(6, 4, 'giảng viên IT'),
(7, 2, 'quản lí '),
(8, 2, ''),
(9, 4, ''),
(10, 1, ''),
(11, 1, 'giảng viên Công nghệ thông tin'),
(12, 4, 'giảng viên Công nghệ thông tin'),
(13, 4, 'lập trình viên'),
(14, 4, 'nhân viên kinh doanh');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `id` int(20) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `accountStatus` varchar(20) NOT NULL,
  `avatar` varchar(75) NOT NULL,
  `sector` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`id`, `name`, `email`, `password`, `phone`, `address`, `accountStatus`, `avatar`, `sector`, `birthday`, `experience`) VALUES
(38, 'Nguyễn Hữu Tín', 'nguyenhuutin124@gmail.com', 'Abcd1234@', '', '', '', '/assets/images/img_avatar_job_seeker/Samsung.jpg', 1, '2003-12-24', 1),
(39, 'Nguyễn Lê Quốc Trung', 'nguyenlequoctrung@gmail.com', 'Abcd1234@', '', '', '', './assets/images/img_avatar_job_seeker/img_intro_levent.jpg', 1, '1970-01-01', 5),
(40, 'Lê Thị Xuân Ngân', 'lethixuanngan@gmail.com', 'Abcd1234@', '', '', '', './assets/images/img_avatar_job_seeker/OU.png', 0, '1970-01-01', 0),
(43, 'minh', 'admin@gmail.com', '1234567', '', '', '', '', 0, NULL, 0),
(44, 'vo minh thuan', 'thuan01022003@gmail.com', 'Abcd1234@', '', '', '', './assets/images/img_avatar_job_seeker/harvard-university.jpg', 1, '1970-01-01', 25),
(45, 'Nguyễn Hữu Tín', 'nguyenhuutin1234@gmail.com', 'Abc123@', '', '', '', './assets/images/img_avatar_job_seeker/img_intro_levent.jpg', 1, '1970-01-01', 7);

-- --------------------------------------------------------

--
-- Table structure for table `job_position`
--

CREATE TABLE `job_position` (
  `id` int(11) NOT NULL,
  `idJob` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `minSalary` int(11) NOT NULL,
  `maxSalary` int(11) NOT NULL,
  `numberCandidate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_position`
--

INSERT INTO `job_position` (`id`, `idJob`, `idPost`, `name`, `minSalary`, `maxSalary`, `numberCandidate`) VALUES
(2, 3, 36, 'Trưởng bộ phận lập trình', 20000000, 40000000, 2),
(5, 3, 40, 'Front-end developer', 20000000, 40000000, 2),
(6, 4, 42, 'Back-end Developer', 24000000, 30000000, 50),
(7, 4, 44, 'Front-end developer', 18000000, 25000000, 14),
(8, 6, 45, 'Trợ giảng công nghệ thông tin', 27000000, 30000000, 28),
(9, 6, 45, 'Giảng viên chuyên ngành kĩ thuật phần mềm', 20000000, 30000000, 7),
(10, 7, 46, 'Trưởng ban quản lí', 25000000, 35000000, 2),
(11, 7, 46, 'Quản lí nhân sự', 19000000, 25000000, 6),
(12, 8, 47, 'Kỹ sư cơ khí', 18000000, 35000000, 14),
(13, 3, 48, 'Kiến trúc sư phần mềm', 20000000, 40000000, 2),
(14, 6, 49, 'Giảng viên khoa Công nghệ thông tin', 15000000, 30000000, 2),
(15, 6, 50, 'Giảng viên khoa Công nghệ thông tin', 15000000, 40000000, 2),
(16, 6, 51, 'Giảng viên khoa Công nghệ thông tin', 10000000, 20000000, 2),
(17, 3, 52, 'Trưởng dự án phần mềm', 20000000, 40000000, 2),
(18, 6, 53, 'Giảng viên chuyên ngành Khoa học máy tính', 15000000, 30000000, 2),
(19, 6, 54, 'Giảng viên chuyên ngành Mạng máy tính', 20000000, 30000000, 2),
(20, 6, 55, 'Giảng viên khoa Công nghệ thông tin', 20000000, 50000000, 2),
(21, 6, 56, 'Giảng viên chuyên ngành Khoa học máy tính', 20000000, 30000000, 2),
(22, 9, 57, 'Software Architect', 1, 2, 2),
(23, 10, 58, 'Software Architect', 20000000, 30000000, 2),
(24, 11, 59, 'Giảng viên ngành Khoa học máy tính', 20000000, 40000000, 2),
(25, 12, 60, 'Giảng viên ngành Mạng máy tính', 20000000, 30000000, 2),
(26, 12, 61, 'Giảng viên ngành Khoa học máy tính', 20000000, 50000000, 2),
(27, 12, 62, 'Giảng viên ngành Mạng máy tính', 20000000, 30000000, 2),
(28, 12, 63, 'Giảng viên ngành Mạng máy tính', 15000000, 0, 2),
(29, 9, 64, 'Giảng viên ngành Kỹ thuật phần mềm', 15000000, 30000000, 2),
(30, 12, 65, 'Giảng viên ngành Kỹ thuật phần mềm', 20000000, 50000000, 2),
(31, 3, 66, 'Front-end developer', 25000000, 34000000, 15),
(32, 13, 69, 'Back-end Developer', 36000000, 50000000, 23),
(33, 14, 70, 'Nhân viên kinh doanh', 25000000, 45000000, 7),
(34, 14, 71, 'Nhân viên kinh doanh', 900000, 15000000, 10),
(35, 9, 72, '', 0, 0, 0),
(36, 9, 73, 'Nhân viên bán hàng', 27000000, 37000000, 38),
(37, 9, 74, 'Marketing', 30000000, 34000000, 24);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `title` varchar(59) NOT NULL,
  `postDate` date NOT NULL,
  `numberCandidate` int(11) NOT NULL,
  `idJob` int(11) NOT NULL,
  `description_job` text NOT NULL,
  `requirement_job` text NOT NULL,
  `benefit_job` text NOT NULL,
  `others_requirement` text NOT NULL,
  `view` int(11) NOT NULL,
  `accepted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `idCompany`, `title`, `postDate`, `numberCandidate`, `idJob`, `description_job`, `requirement_job`, `benefit_job`, `others_requirement`, `view`, `accepted`) VALUES
(0, 0, 'No title', '2023-04-20', 0, 0, 'No description', 'No requirement job', 'no benefit job', 'No others requirement', 0, 0),
(44, 4, 'Facebook - Tuyển dụng nhân viên công nghệ', '2023-04-20', 0, 4, '- Ghi nhận các số liệu phát sinh vật tư tại kho, nhập số liệu nhập- xuất vào hệ thống phần mềm nội bộ\r\n- Theo dõi chi phí phát sinh tại kho\r\n- Tập hợp chứng từ/phiếu nhập/phiếu xuất… để cung cấp khi cần đối chứng với Nhà sản xuất nội bộ\r\n- Giám sát thực hiện kiểm kê, đối chiếu các số liệu trên phần mềm, sổ sách và hàng tồn thực tế\r\n- Báo cáo kiểm kê hàng hóa, số liệu hàng ngày, tuần, tháng cho trưởng phụ trách.\\r\\n', '- Kinh nghiệm: không yêu cầu hoặc có kinh nghiệm về thủ kho 1 năm \r\n- Tốt nghiệp các ngành trung cấp các ngành kinh tế xây dựng trở lên \r\n- Sử dụng thành thạo Excel sẽ được hướng dẫn trong lúc làm việc \r\n- Kiểm tra vận chuyển vật tư đến dự án khi cần \r\n- Trung thực, cẩn thận, tỉ mỉ, chịu khó \r\n- Có tinh thần trách nhiệm, chủ động trong công việc', '- Lương: 7-10 triệu tùy năng lực \r\n- Review lương định kỳ, lương thưởng tháng 13 ít nhất 2 tháng lương \r\n- Tham gia BHXH, BHYT, 12 ngày phép/năm theo chính sách của nhà nước \r\n- Hỗ trợ chỗ ở tại nơi làm việc \r\n- Lễ tết nghỉ theo quy định của nhà nước. \r\n- Thời gian làm việc: \r\n- Từ thứ 2- thứ 7: 8h00- 17h30 (Trưa nghỉ 1,5 tiếng: 12h00 -13h30)', '', 5, 1),
(45, 5, 'Havard - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-20', 0, 6, '- Ghi nhận các số liệu phát sinh vật tư tại kho, nhập số liệu nhập- xuất vào hệ thống phần mềm nội bộ\\r\\n- Theo dõi chi phí phát sinh tại kho\\r\\n- Tập hợp chứng từ/phiếu nhập/phiếu xuất… để cung cấp khi cần đối chứng với Nhà sản xuất/ nội bộ\\r\\n- Giám sát thực hiện kiểm kê, đối chiếu các số liệu trên phần mềm, sổ sách và hàng tồn thực tế\\r\\n- Báo cáo kiểm kê hàng hóa, số liệu hàng ngày, tuần, tháng cho trưởng phụ trách.\\r\\n', '- Kinh nghiệm: không yêu cầu hoặc có kinh nghiệm về thủ kho 1 năm - Tốt nghiệp các ngành trung cấp các ngành kinh tế xây dựng trở lên - Sử dụng thành thạo Excel sẽ được hướng dẫn trong lúc làm việc - Kiểm tra vận chuyển vật tư đến dự án khi cần - Trung thực, cẩn thận, tỉ mỉ, chịu khó - Có tinh thần trách nhiệm, chủ động trong công việc', '- Lương: 7-10 triệu tùy năng lực - Review lương định kỳ, lương thưởng tháng 13 ít nhất 2 tháng lương - Tham gia BHXH, BHYT, 12 ngày phép/năm theo chính sách của nhà nước - Hỗ trợ chỗ ở tại nơi làm việc - Lễ tết nghỉ theo quy định của nhà nước. - Thời gian làm việc: - Từ thứ 2- thứ 7: 8h00- 17h30 (Trưa nghỉ 1,5 tiếng: 12h00 -13h30)', '', 8, 1),
(49, 9, 'FPTU - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 2, 14, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 4, 1),
(58, 8, 'CB/I Digital - Tuyển nhân sự mảng Công nghệ thông tin tại V', '2023-04-22', 0, 10, 'Thiết kế và giám sát phát triển các hệ thống và ứng dụng phần mềm. Hợp tác với các nhóm chức năng khác nhau, bao gồm quản lý dự án, nhà phát triển và nhân viên đảm bảo chất lượng, để phát triển các giải pháp phần mềm. Tạo và duy trì các nguyên tắc, tiêu chuẩn và mẫu thiết kế kiến trúc. Xác định và giảm thiểu các rủi ro và vấn đề kỹ thuật. Tham gia lập kế hoạch dự án và cung cấp hướng dẫn kỹ thuật và chuyên môn cho quản lý dự án và các thành viên trong nhóm.', 'Biết về các công cụ và bộ công cụ phát triển phần mềm mới nhất và phổ biến nhất. Có kinh nghiệm trong thiết kế hệ thống với Service Mesh. Có kinh nghiệm trong bảo mật đám mây và bảo mật API. Có kinh nghiệm về mô hình dữ liệu và tối ưu hóa cơ sở dữ liệu.', 'Học các kỹ thuật mã hóa nâng cao từ các chuyên gia hàng đầu trong ngành. Có được kinh nghiệm và kỹ năng mã hóa phong phú từ nhiều dự án và nền tảng khác nhau. Làm việc trong một môi trường năng động, minh bạch và chuyên nghiệp. Nâng cao kỹ năng tiếng Anh và giao tiếp.', '', 1, 1),
(59, 9, 'FPTU - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 11, '                                                                                                                                        Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.                                                                                                                                ', '                                                                                                                                        Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu                                                                                                                                ', '                                                                                                                                        Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.                                                                                                                                ', '                                                                                                                                                                                                                                                                        ', 1, 1),
(60, 16, 'UEH - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 12, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(61, 10, 'HUST - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 12, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(62, 12, 'NLU - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 12, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(63, 15, 'TDTU - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 12, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(64, 13, 'OU - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 9, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(65, 14, 'PTIT - Tuyển giảng viên Công nghệ thông tin tại Việt Nam', '2023-04-22', 0, 12, 'Dẫn dắt việc phát triển các chương trình đào tạo bao gồm các hướng dẫn người dùng, các hướng dẫn tham khảo, bảng tổng hợp, phòng thí nghiệm học tập, hướng dẫn trực tuyến, bài kiểm tra, thông tin đào tạo và chứng nhận. Phối hợp logictics và tiến hành các buổi đào tạo trong cả môi trường đào tạo trực tuyến và lớp học. Hợp tác với các quản lý dự án CNTT để xác định mục tiêu đào tạo và phương pháp giảng dạy.', 'Tốt nghiệp Đại học trở lên khối ngành Công nghệ thông tin các trường đại học sư phạm kỹ thuật, ĐH Bách Khoa, HV Bưu chính - viễn thông, ĐH Công nghệ, ĐH FPT, ĐH Công nghiệp, ĐH Giao thông vận tải... Có kỹ năng sư phạm, kiến thức chuyên môn tốt. Có thể giảng dạy/có kinh nghiệm của một hoặc một vài môn sau: Lập trình các ngôn ngữ C, Java, C Sharp, HTML/CSS/Javascript, PHP, Android., Python. Các nền tảng NodeJS, ReactJS, Angular, Laravel, Unity 2D, Spring MVC, Spring Boot, .NetCore, ReactJS, Angular ... Hiểu biết về cơ sở dữ liệu', 'Môi trường làm việc năng động, chuyên nghiệp, gắn kết giữa đào tạo, nghiên cứu và chuyển giao công nghệ, có cơ hội thăng tiến. Được tạo điều kiện ra nước ngoài hợp tác giảng dạy, nghiên cứu, trao đổi học thuật, học tập bồi dưỡng nâng cao trình độ chuyên môn, nghiệp vụ, phát huy tối đa năng lực của bản thân và phát triển nghệ nghiệp. Được hưởng thu nhập theo vị trí việc làm, tương xứng với năng lực và kết quả công tác; được hưởng đầy đủ các chế độ về BHXH, BHYT theo quy định của Nhà nước.', '', 0, 1),
(66, 19, 'Google-tuyển dụng nhân viên thiết kế ', '2023-04-22', 0, 3, '                                                                    - Ghi nhận các số liệu phát sinh vật tư tại kho, nhập số liệu nhập- xuất vào hệ thống phần mềm nội bộ\r\n- Theo dõi chi phí phát sinh tại kho\r\n- Tập hợp chứng từ/phiếu nhập/phiếu xuất… để cung cấp khi cần đối chứng với Nhà sản xuất nội bộ\r\n- Giám sát thực hiện kiểm kê, đối chiếu các số liệu trên phần mềm, sổ sách và hàng tồn thực tế\r\n- Báo cáo kiểm kê hàng hóa, số liệu hàng ngày, tuần, tháng cho trưởng phụ trách.                                                                ', '                                                                    - Kinh nghiệm: không yêu cầu hoặc có kinh nghiệm về thủ kho 1 năm \r\n- Tốt nghiệp các ngành trung cấp các ngành kinh tế xây dựng trở lên \r\n- Sử dụng thành thạo Excel sẽ được hướng dẫn trong lúc làm việc \r\n- Kiểm tra vận chuyển vật tư đến dự án khi cần \r\n- Trung thực, cẩn thận, tỉ mỉ, chịu khó \r\n- Có tinh thần trách nhiệm, chủ động trong công việc                                                                ', '                                                                    - Lương: 20-35 triệu tùy năng lực \r\n- Review lương định kỳ, lương thưởng tháng 13 ít nhất 2 tháng lương \r\n- Tham gia BHXH, BHYT, 12 ngày phép/năm theo chính sách của nhà nước \r\n- Hỗ trợ chỗ ở tại nơi làm việc \r\n- Lễ tết nghỉ theo quy định của nhà nước. \r\n- Thời gian làm việc: \r\n- Từ thứ 2- thứ 7: 8h00- 17h30 (Trưa nghỉ 1,5 tiếng: 12h00 -13h30)                                                                ', '                                                                                                                                    ', 1, 1),
(68, 4, 'Tuyển nhân viên IT tại Hồ Chí Minh', '2023-04-22', 0, 1, '- Phát triển và bảo trì phần mềm của công ty Tham gia thiết kế và phát triển các tính năng mới cho phần mềm Cải thiện hiệu suất và độ ổn định của hệ thống Phân tích và xử lý các sự cố liên quan đến phần mềm Hỗ trợ khách hàng sử dụng sản phẩm của công ty\r\n', '- Có kiến thức về lập trình web, các ngôn ngữ lập trình như PHP, HTML, CSS, Javascript, SQL Có kinh nghiệm làm việc với một số framework như Laravel, CodeIgniter, ReactJS, AngularJS Sử dụng thành thạo các công cụ hỗ trợ phát triển phần mềm như Git, Jira, Bitbucket Có khả năng làm việc độc lập hoặc nhóm Năng động, nhiệt tình và sáng tạo trong công việc', '- Thu nhập: Thỏa thuận (tùy vào năng lực) ', 'Senior', 1, 0),
(69, 13, 'OU - Tuyển dụng kỹ sư phần mềm', '2023-04-22', 0, 13, 'Ghi nhận các số liệu phát sinh vật tư tại kho, nhập số liệu nhập- xuất vào hệ thống phần mềm nội bộ- Theo dõi chi phí phát sinh tại kho\\r\\n- Tập hợp chứng từ/phiếu nhập/phiếu xuất… để cung cấp khi cần đối chứng với Nhà sản xuất/ nội bộ\\r\\n- Giám sát thực hiện kiểm kê, đối chiếu các số liệu trên phần mềm, sổ sách và hàng tồn thực tế\\r\\n- Báo cáo kiểm kê hàng hóa, số liệu hàng ngày, tuần, tháng cho trưởng phụ trách.\\r\\n\', \'', '- Kinh nghiệm: không yêu cầu hoặc có kinh nghiệm về thủ kho 1 năm\\r\\n- Tốt nghiệp các ngành trung cấp các ngành kinh tế xây dựng trở lên\\r\\n- Sử dụng thành thạo Excel sẽ được hướng dẫn trong lúc làm việc\\r\\n- Kiểm tra vận chuyển vật tư đến dự án khi cần\\r\\n- Trung thực, cẩn thận, tỉ mỉ, chịu khó\\r\\n- Có tinh thần trách nhiệm, chủ động trong công việc', '- Kinh nghiệm: không yêu cầu hoặc có kinh nghiệm về thủ kho 1 năm\\r\\n- Tốt nghiệp các ngành trung cấp các ngành kinh tế xây dựng trở lên\\r\\n- Sử dụng thành thạo Excel sẽ được hướng dẫn trong lúc làm việc\\r\\n- Kiểm tra vận chuyển vật tư đến dự án khi cần\\r\\n- Trung thực, cẩn thận, tỉ mỉ, chịu khó\\r\\n- Có tinh thần trách nhiệm, chủ động trong công việc', '', 0, 1),
(70, 13, 'OU - Tuyển nhân viên kinh doanh', '2023-04-22', 0, 14, '- Tìm kiếm khách hàng mới, đề xuất các sản phẩm phù hợp với nhu cầu của khách hàng\\n- Xây dựng mối quan hệ khách hàng, duy trì và phát triển khách hàng cũ\\n- Đưa ra các giải pháp kinh doanh và đàm phán hợp đồng với khách hàng\\n- Thực hiện các công việc được phân công từ cấp trên', '- Có kinh nghiệm trong lĩnh vực kinh doanh, bán hàng từ 1 năm trở lên\\n- Tốt nghiệp đại học chuyên ngành kinh tế, quản trị kinh doanh, marketing hoặc các ngành liên quan\\n- Có khả năng giao tiếp tốt, kỹ năng thuyết phục và đàm phán tốt\\n- Năng động, sáng tạo, chủ động và có trách nhiệm trong công việc', '- Lương cạnh tranh\r\n- Cơ hội thăng tiến trong công ty\r\n- Được đào tạo và hỗ trợ trong quá trình làm việc\\n- Thưởng doanh số, thưởng năng suất\r\n- Bảo hiểm đầy đủ\r\n- Có kinh nghiệm trong lĩnh vực kinh doanh là một lợi thế', '', 0, 1),
(71, 12, 'NLU - Tuyển nhân viên kinh doanh tại Hà Nội', '2023-04-22', 0, 14, '- Phát triển mạng lưới khách hàng mới cho công ty\r\n    Chăm sóc khách hàng hiện tại của công ty\r\n    Giới thiệu và tư vấn sản phẩm cho khách hàng\r\n    Thực hiện các kế hoạch kinh doanh được giao\r\n    Báo cáo kết quả công việc hàng tháng cho cấp trên', '- Tốt nghiệp các ngành kinh tế, marketing hoặc có kinh nghiệm trong lĩnh vực kinh doanh\r\n    Có khả năng giao tiếp tốt, thuyết phục khách hàng\r\n    Năng động, nhiệt tình, chủ động trong công việc\r\n    Có khả năng làm việc độc lập hoặc nhóm\r\n    Có kinh nghiệm về lĩnh vực tài chính - bảo hiểm là một lợi thế', '- Lương cạnh tranh\\n- Cơ hội thăng tiến trong công ty\\n- Được đào tạo và hỗ trợ trong quá trình làm việc\\n- Thưởng doanh số, thưởng năng suất\\n- Bảo hiểm đầy đủ\\n\',\'Có kinh nghiệm trong lĩnh vực kinh doanh là một lợi thế', '', 0, 0),
(72, 12, 'NLU-Tuyển nhân viên IT tại Hồ Chí Minh', '2023-04-22', 0, 9, '- Phát triển và bảo trì phần mềm của công ty Tham gia thiết kế và phát triển các tính năng mới cho phần mềm Cải thiện hiệu suất và độ ổn định của hệ thống Phân tích và xử lý các sự cố liên quan đến phần mềm Hỗ trợ khách hàng sử dụng sản phẩm của công ty', '- Có kiến thức về lập trình web, các ngôn ngữ lập trình như PHP, HTML, CSS, Javascript, SQL Có kinh nghiệm làm việc với một số framework như Laravel, CodeIgniter, ReactJS, AngularJS Sử dụng thành thạo các công cụ hỗ trợ phát triển phần mềm như Git, Jira, Bitbucket Có khả năng làm việc độc lập hoặc nhóm Năng động, nhiệt tình và sáng tạo trong công việc', '- Thu nhập: Thỏa thuận (tùy vào năng lực) ', '', 0, 1),
(73, 10, 'HUST-Tuyển nhân viên kinh doanh tại Hà Nội', '2023-04-22', 0, 9, '- Tìm kiếm khách hàng tiềm năng và chăm sóc khách hàng hiện tại.\r\nGiới thiệu sản phẩm và dịch vụ của công ty đến khách hàng.\r\nTư vấn giải pháp tài chính cho khách hàng.\r\nLên kế hoạch và thực hiện các hoạt động kinh doanh để đạt được doanh số và lợi nhuận của công ty.\r\nTheo dõi và đánh giá tình hình kinh doanh của đối thủ cạnh tranh.\r\nTham gia các hoạt động marketing của công ty.', '- Có kinh nghiệm trong lĩnh vực kinh doanh ít nhất 1 năm\r\nTốt nghiệp Đại học các chuyên ngành liên quan đến kinh tế, kinh doanh.\r\nCó khả năng giao tiếp và thuyết phục khách hàng.\r\nCó kỹ năng làm việc độc lập và làm việc nhóm.\r\nNăng động, sáng tạo và có tinh thần trách nhiệm với công việc.', '- Lương cơ bản + hoa hồng.\r\nĐược đào tạo và hướng dẫn về sản phẩm, kỹ năng bán hàng.\r\nCơ hội thăng tiến và phát triển nghề nghiệp.\r\nMôi trường làm việc năng động, trẻ trung.', '', 0, 0),
(74, 10, 'HUST-Tuyển nhân viên kinh doanh tại Hồ Chí Minh', '2023-04-22', 0, 9, '- Tìm kiếm khách hàng mới, giới thiệu sản phẩm cho khách hàng và tư vấn giải pháp phù hợp nhất cho khách hàng.\r\n\r\n    Chăm sóc và phát triển mối quan hệ với khách hàng hiện có.\r\n    Lên kế hoạch bán hàng, thực hiện các kế hoạch marketing, triển khai', '- Có ít nhất 3 năm kinh nghiệm làm kế toán trưởng\r\nCó bằng cấp liên quan đến kế toán, tài chính\r\nHiểu rõ về quy trình kế toán, thuế và luật doanh nghiệp\r\nKỹ năng lãnh đạo, quản lý và giải quyết vấn đề tốt\r\nSử dụng thành thạo các phần mềm kế toán (vd: Fast, Misa, Excel)\r\nTính cẩn thận, tỉ mỉ, trung thực, có trách nhiệm với công việc.\r\nƯu tiên ứng viên có thể làm việc ngay.', '- Mức lương hấp dẫn, tùy theo năng lực và kinh nghiệm của ứng viên.\r\nĐược tham gia các chế độ bảo hiểm đầy đủ theo quy định của nhà nước.\r\nĐược đào tạo, hướng dẫn và có cơ hội thăng tiến trong công ty.', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`) VALUES
(0, 'No Service'),
(1, 'Công nghệ thông tin'),
(2, 'Kĩ thuật cơ khí'),
(3, 'Y học'),
(4, 'Giáo dục'),
(5, 'Mĩ thuật Công nghiệp'),
(6, 'Điện-Điện tử'),
(7, 'Ngoại ngữ'),
(8, 'Quản trị kinh doanh'),
(9, 'Khoa học dữ liệu'),
(10, 'Kiến trúc'),
(11, 'Luật học');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPost` (`idPost`,`idJobSeeker`,`idcv`),
  ADD KEY `idJobSeeker` (`idJobSeeker`),
  ADD KEY `idcv` (`idcv`),
  ADD KEY `idJobPosition` (`idJobPosition`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`idCompany`),
  ADD KEY `idCompany` (`idCompany`,`name`,`address`,`website`,`idService`,`logo`,`quality`),
  ADD KEY `address` (`address`),
  ADD KEY `idService` (`idService`),
  ADD KEY `website` (`website`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idJobSeeker` (`idJobSeeker`,`idPost`),
  ADD KEY `cv_post` (`idPost`);

--
-- Indexes for table `detail_notification`
--
ALTER TABLE `detail_notification`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_notification` (`id_notification`,`idCompany`),
  ADD KEY `idcompany` (`idCompany`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comapny` (`idCompany`);

--
-- Indexes for table `following_company`
--
ALTER TABLE `following_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`idUser`,`idCompany`),
  ADD KEY `idCompany` (`idCompany`),
  ADD KEY `fk_fol_jobseeker` (`idUser`);

--
-- Indexes for table `image_company`
--
ALTER TABLE `image_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCompany` (`idCompany`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`idService`,`name`),
  ADD KEY `idService` (`idService`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`address`),
  ADD KEY `idService` (`sector`);

--
-- Indexes for table `job_position`
--
ALTER TABLE `job_position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`idJob`,`idPost`),
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idJob` (`idJob`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`idCompany`,`idJob`),
  ADD KEY `idCompany` (`idCompany`),
  ADD KEY `idJob` (`idJob`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `idCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `detail_notification`
--
ALTER TABLE `detail_notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `following_company`
--
ALTER TABLE `following_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `image_company`
--
ALTER TABLE `image_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobseeker`
--
ALTER TABLE `jobseeker`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `job_position`
--
ALTER TABLE `job_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
