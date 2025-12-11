-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2025 at 04:21 AM
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
-- Database: `dbcv_nena`
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('draft','published') DEFAULT 'draft',
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `created_at`, `updated_at`, `status`, `image_path`) VALUES
(5, '💤 Tidur Cukup, Hidup Lebih Produktif', '---\r\nTidur sering dianggap hal sepele, padahal dampaknya sangat besar bagi kesehatan dan produktivitas. Saat kita tidur, tubuh melakukan banyak hal penting seperti memperbaiki jaringan, memperkuat sistem imun, dan mengatur kembali energi. Kurang tidur dapat membuat otak sulit fokus, emosi jadi tidak stabil, dan tubuh cepat lelah. Karena itu, tidur bukan sekadar istirahat, melainkan kebutuhan dasar untuk menjaga keseimbangan hidup.\r\n\r\nBanyak orang rela begadang demi tugas, pekerjaan, atau hiburan, tanpa sadar mengorbankan kesehatannya. Kurang tidur tidak hanya menurunkan semangat belajar atau bekerja, tapi juga meningkatkan risiko penyakit seperti stres kronis, obesitas, bahkan gangguan jantung. Tidur yang berkualitas selama 7–8 jam per malam sudah cukup untuk membuat tubuh dan pikiran kembali segar di pagi hari.\r\n\r\nJadi, jika ingin hidup lebih produktif dan bahagia, mulailah dengan menghargai waktu tidurmu. Atur jadwal istirahat, hindari penggunaan gadget sebelum tidur, dan ciptakan suasana kamar yang nyaman. Dengan tidur cukup, kamu akan merasa lebih bertenaga, fokus, dan siap menghadapi hari dengan semangat baru setiap harinya.\r\n\r\n\r\n--- ', 'Nena Fernanda', '2025-11-04 04:02:45', '2025-11-04 04:02:50', 'published', NULL),
(6, '💻 Teknologi dan Anak Muda', '---\r\n\r\nGenerasi muda saat ini tumbuh di tengah perkembangan teknologi yang begitu pesat. Hampir setiap aktivitas sehari-hari, mulai dari belajar, bekerja, hingga hiburan, kini bergantung pada perangkat digital. Internet dan media sosial membuka pintu bagi anak muda untuk belajar hal baru, berkreasi, dan berkomunikasi tanpa batas jarak dan waktu. Dengan teknologi, mereka bisa mengakses informasi dunia hanya dalam hitungan detik.\r\n\r\nNamun, di balik kemudahan itu, teknologi juga membawa tantangan besar. Banyak anak muda yang terlalu lama bermain gadget hingga melupakan dunia nyata. Kecanduan media sosial, perbandingan hidup dengan orang lain, dan informasi palsu menjadi risiko nyata yang bisa mengganggu kesehatan mental maupun produktivitas. Penggunaan teknologi yang tidak bijak justru bisa membuat seseorang terjebak dalam kebiasaan yang tidak sehat.\r\n\r\nKarena itu, penting bagi generasi muda untuk menggunakan teknologi secara cerdas dan seimbang. Gunakan internet untuk hal-hal positif seperti belajar, menambah wawasan, atau mengembangkan keterampilan. Batasi waktu bermain media sosial dan tetap jaga interaksi di dunia nyata. Dengan bijak memanfaatkan teknologi, anak muda bisa menjadi generasi yang kreatif, cerdas, dan siap menghadapi tantangan masa depan.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-04 04:52:08', '2025-11-04 04:52:12', 'published', NULL),
(7, '🌍 Traveling: Cara Terbaik Mengenal Dunia', '---\r\n\r\nBepergian atau traveling bukan hanya soal jalan-jalan dan bersenang-senang, tapi juga cara terbaik untuk belajar dan mengenal dunia lebih luas. Saat kita mengunjungi tempat baru, kita melihat langsung keindahan alam, budaya, dan kebiasaan hidup yang berbeda dari daerah kita sendiri. Dari perjalanan itu, kita belajar menghargai keberagaman serta menyadari betapa luasnya dunia ini dan betapa kecilnya kita di dalamnya.\r\n\r\nSelain membuka wawasan, traveling juga memberi banyak pengalaman berharga. Kita belajar beradaptasi di tempat asing, mengatasi masalah di luar zona nyaman, dan menemukan hal-hal baru yang tak akan kita dapatkan di ruang kelas atau buku. Setiap perjalanan membawa pelajaran — mulai dari cara bersyukur atas kenyamanan rumah, hingga pentingnya menghargai waktu dan orang lain.\r\n\r\nLebih dari sekadar hiburan, traveling adalah investasi untuk diri sendiri. Tidak harus jauh atau mahal, bahkan perjalanan singkat ke alam sekitar pun bisa menyegarkan pikiran. Dengan menjelajah, kita tidak hanya mengenal tempat baru, tapi juga mengenal diri sendiri lebih dalam. Karena sejatinya, setiap langkah dalam perjalanan membawa kita pada versi diri yang lebih matang dan bijak.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-04 04:54:50', '2025-11-04 04:54:53', 'published', NULL),
(8, '👨‍💻 Belajar Coding, Kunci Masa Depan Digital', '---\r\nDi era serba digital seperti sekarang, kemampuan coding atau menulis kode komputer menjadi salah satu keterampilan paling berharga. Dengan coding, seseorang bisa membuat aplikasi, website, atau bahkan game yang berguna bagi banyak orang. Tak hanya untuk mereka yang ingin jadi programmer, belajar coding juga melatih cara berpikir logis, kreatif, dan terstruktur — kemampuan penting yang dibutuhkan di hampir semua bidang kerja modern.\r\n\r\nBanyak orang menganggap coding itu sulit dan hanya bisa dilakukan oleh “orang jenius”. Padahal, semua orang bisa belajar dari dasar dengan cara yang menyenangkan. Ada banyak platform online gratis seperti W3Schools, Codecademy, atau FreeCodeCamp yang bisa membantu pemula memahami bahasa pemrograman seperti HTML, CSS, dan Python. Yang paling penting adalah konsisten mencoba dan tidak takut melakukan kesalahan, karena dari kesalahanlah kita belajar.\r\n\r\nBelajar coding bukan hanya tentang menulis baris-baris kode, tapi tentang menciptakan solusi. Dengan keterampilan ini, anak muda bisa berinovasi — mulai dari membuat aplikasi sekolah, website bisnis kecil, hingga sistem pintar untuk membantu masyarakat. Dunia terus bergerak ke arah digital, dan mereka yang bisa coding akan memiliki peluang besar untuk menjadi pencipta masa depan, bukan sekadar penggunanya.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-04 04:56:44', '2025-11-04 04:56:47', 'published', NULL),
(9, '🌟 Bersyukur Setiap Hari', '---\r\nRasa syukur adalah kunci untuk menjalani hidup dengan lebih damai dan bahagia. Ketika kita membiasakan diri untuk melihat hal-hal kecil yang patut dihargai, pikiran menjadi lebih positif dan hati terasa lebih ringan. Tidak perlu menunggu hal besar terjadi—bangun dengan tubuh sehat, punya keluarga yang mendukung, atau sekadar bisa menikmati udara pagi pun sudah cukup menjadi alasan untuk bersyukur.\r\n\r\nSayangnya, banyak orang terlalu fokus pada apa yang belum dimiliki sehingga lupa menghargai apa yang sudah ada. Sikap seperti ini sering membuat seseorang merasa hidupnya kurang, padahal kenyataannya mereka memiliki banyak hal yang layak dibanggakan. Dengan bersyukur, kita belajar menerima keadaan, menghargai proses, dan tidak mudah iri terhadap pencapaian orang lain.\r\n\r\nMembiasakan bersyukur setiap hari bisa membawa perubahan besar dalam hidup. Cobalah mencatat tiga hal yang kamu syukuri setiap malam sebelum tidur — se-simple apa pun. Lama-kelamaan, kamu akan lebih mudah melihat sisi baik dalam setiap situasi, bahkan ketika menghadapi masalah. Hidup mungkin tidak selalu sempurna, tetapi dengan bersyukur, kita bisa menjalaninya dengan hati yang lebih tenang dan penuh kebahagiaan.\r\n\r\n---', 'Nena Fernanda', '2025-11-19 00:55:47', '2025-11-19 00:55:55', 'published', NULL),
(10, '💡 Belajar dari Kegagalan', '---\r\n\r\nKegagalan adalah bagian alami dari kehidupan yang pasti dialami semua orang. Tidak peduli seberapa pintar atau berbakat seseorang, mereka tetap akan mengalami momen ketika rencana tidak berjalan sesuai harapan. Namun, kegagalan bukan akhir dari segalanya — justru sering kali menjadi titik awal dari perubahan besar. Dengan memahami bahwa gagal itu wajar, kita bisa menjalani hidup dengan lebih tenang dan tidak takut mencoba.\r\n\r\nBanyak orang berhenti di tengah jalan karena merasa jatuh sekali berarti tidak mampu. Padahal, dari kegagalanlah kita belajar apa yang perlu diperbaiki dan bagaimana langkah selanjutnya harus diambil. Orang-orang sukses di dunia pun tidak lepas dari kegagalan; mereka bangkit, mengevaluasi diri, lalu mencoba lagi dengan strategi yang lebih baik. Kegagalan memberikan kita pengalaman dan kekuatan mental yang tidak bisa dibeli.\r\n\r\nOleh karena itu, penting untuk melihat kegagalan sebagai guru, bukan musuh. Setiap kali gagal, ambil waktu untuk merenung dan menyadari pelajaran apa yang bisa dipetik. Terus melangkah, meskipun perlahan, adalah cara terbaik untuk tumbuh. Jika kita berani bangkit setelah jatuh, itu sudah menunjukkan bahwa kita lebih kuat dari sebelumnya. Ingat, kegagalan bukan tanda berhenti, tetapi undangan untuk menjadi lebih baik.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-19 00:57:41', '2025-11-19 00:57:45', 'published', NULL),
(11, '🧠 Kesehatan Mental Sama Pentingnya dengan Fisik', '---\r\n\r\nDi tengah kesibukan sekolah, pekerjaan, dan aktivitas harian, banyak orang lupa bahwa kesehatan mental sama pentingnya dengan kesehatan fisik. Padahal, pikiran yang tenang dan emosional yang stabil sangat berpengaruh pada cara kita beraktivitas dan mengambil keputusan. Tanpa mental yang sehat, fokus menurun, semangat berkurang, dan tubuh pun bisa ikut merasakan dampaknya. Itulah sebabnya menjaga kesehatan mental seharusnya menjadi prioritas, bukan pilihan.\r\n\r\nTekanan dari lingkungan, tuntutan tugas, serta perbandingan di media sosial sering membuat seseorang merasa tidak cukup baik. Jika dibiarkan, hal ini bisa memicu stres, cemas, atau bahkan depresi. Karena itu, penting untuk mengenali batas diri sendiri dan tidak memaksakan hal-hal yang berada di luar kemampuan. Meluangkan waktu untuk melakukan hobi, beristirahat, atau sekadar berbicara dengan orang yang dipercaya dapat membantu menjaga emosi tetap stabil.\r\n\r\nMenjaga kesehatan mental bukan berarti kita harus selalu bahagia, tetapi bagaimana cara kita mengelola perasaan. Belajar menerima diri, memberi ruang untuk istirahat, dan meminta bantuan saat dibutuhkan adalah langkah yang sangat berarti. Dengan mental yang kuat, kita bisa menghadapi tantangan hidup dengan lebih bijak dan tenang. Ingatlah—merawat pikiran sama pentingnya dengan merawat tubuh, karena keduanya saling berkaitan dalam membentuk hidup yang lebih seimbang.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-19 00:59:52', '2025-11-19 00:59:55', 'published', NULL),
(12, '⏳ Rahasia Sukses Mengatur Waktu untuk Pelajar', '---\r\n\r\nMengatur waktu adalah keterampilan penting yang harus dimiliki setiap pelajar. Dengan manajemen waktu yang baik, tugas sekolah, aktivitas rumah, dan waktu istirahat bisa berjalan seimbang. Banyak pelajar merasa kewalahan bukan karena tugas terlalu banyak, tetapi karena mereka tidak membuat rencana yang jelas. Mulai dari hal sederhana seperti mencatat jadwal harian dapat membantu membuat hari lebih teratur.\r\n\r\nSalah satu strategi paling populer adalah metode Pomodoro, yaitu belajar fokus selama 25 menit dan istirahat 5 menit. Cara ini membantu otak tetap segar dan mencegah rasa bosan atau kelelahan. Selain itu, membuat to-do list setiap pagi atau malam hari bisa memberi gambaran apa saja yang harus dikerjakan. Dengan begitu, pelajar tahu mana tugas yang harus diprioritaskan dan mana yang bisa dilakukan nanti.\r\n\r\nMengatur waktu juga berarti mampu menahan diri dari gangguan, terutama dari gadget dan media sosial. Pelajar perlu menentukan waktu khusus untuk belajar tanpa terdistraksi, misalnya dengan menonaktifkan notifikasi selama sesi belajar. Jika dilakukan secara konsisten, kebiasaan ini akan membuat pelajar lebih produktif dan tidak mudah stres. Ingat, kunci dari manajemen waktu adalah disiplin dan komitmen untuk menjalankan rencana yang sudah dibuat.\r\n\r\n\r\n---', 'Nena Fernanda', '2025-11-19 01:02:43', '2025-11-19 01:02:49', 'published', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cv_data`
--

CREATE TABLE `cv_data` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `order_position` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv_data`
--

INSERT INTO `cv_data` (`id`, `section`, `title`, `content`, `order_position`, `created_at`) VALUES
(1, 'personal', 'Nama', 'Nena Fernanda', 1, '2025-10-29 04:38:56'),
(2, 'personal', 'Tempat, Tanggal Lahir', 'Banjarnegara, 09-02-2009', 2, '2025-10-29 04:38:56'),
(3, 'personal', 'Alamat', 'Karangkemiri RT 01/ RW 03, Wanadadi, Banjarnegara', 3, '2025-10-29 04:38:56'),
(4, 'personal', 'Jenis Kelamin', 'Perempuan', 4, '2025-10-29 04:38:56'),
(5, 'personal', 'Agama', 'Islam', 5, '2025-10-29 04:38:56'),
(6, 'personal', 'No. HP', '0882007549057', 6, '2025-10-29 04:38:56'),
(7, 'personal', 'Email', 'nenaf2700@gmail.com', 7, '2025-10-29 04:38:56'),
(8, 'education', '2015 – 2021', 'SD Negeri 2 Karangkemiri', 1, '2025-10-29 04:38:56'),
(9, 'education', '2021 – 2024', 'SMP Negeri 1 Wanadadi', 2, '2025-10-29 04:38:56'),
(10, 'education', '2024 – Sekarang', 'SMK Negeri 1 Bawang', 3, '2025-10-29 04:38:56'),
(11, 'skills', 'Coding & Pemrograman', 'HTML, CSS, JavaScript (dasar pembuatan website)', 1, '2025-10-29 04:38:56'),
(12, 'skills', 'Coding & Pemrograman', 'PHP & MySQL (membuat aplikasi berbasis web dan database)', 2, '2025-10-29 04:38:56'),
(14, 'skills', 'Desain Web', 'Bootstrap / Tailwind CSS', 4, '2025-10-29 04:38:56'),
(15, 'skills', 'Database Management', 'MySQL', 5, '2025-10-29 04:38:56'),
(16, 'skills', 'Office Tools', 'Microsoft Word, Excel, PowerPoint', 6, '2025-10-29 04:38:56'),
(17, 'projects', 'Pengalaman / Proyek', 'Membuat website sederhana untuk pemesanan makanan online', 1, '2025-10-29 04:38:56'),
(18, 'projects', 'Pengalaman / Proyek', 'Membuat sistem login & register berbasis PHP dan MySQL', 2, '2025-10-29 04:38:56'),
(19, 'projects', 'Pengalaman / Proyek', 'Desain landing page sekolah dengan HTML & CSS', 3, '2025-10-29 04:38:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_data`
--
ALTER TABLE `cv_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cv_data`
--
ALTER TABLE `cv_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
