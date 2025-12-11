-- Database: dbcv_nena
CREATE DATABASE IF NOT EXISTS dbcv_nena;
USE dbcv_nena;

-- Table structure for cv_data
CREATE TABLE cv_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data for personal information
INSERT INTO cv_data (section, title, content, order_position) VALUES
('personal', 'Nama', 'Nena Fernanda', 1),
('personal', 'Tempat, Tanggal Lahir', 'Banjarnegara, 09-02-2009', 2),
('personal', 'Alamat', 'Karangkemiri RT 01/ RW 03, Wanadadi, Banjarnegara', 3),
('personal', 'Jenis Kelamin', 'Perempuan', 4),
('personal', 'Agama', 'Islam', 5),
('personal', 'No. HP', '088670054976', 6),
('personal', 'Email', 'nenaf2700@gmail.com', 7);

-- Insert data for education history
INSERT INTO cv_data (section, title, content, order_position) VALUES
('education', '2015 – 2021', 'SD Negeri 2 Karangkemiri', 1),
('education', '2021 – 2024', 'SMP Negeri 1 Wanadadi', 2),
('education', '2024 – Sekarang', 'SMK Negeri 1 Bawang', 3);

-- Insert data for skills
INSERT INTO cv_data (section, title, content, order_position) VALUES
('skills', 'Coding & Pemrograman', 'HTML, CSS, JavaScript (dasar pembuatan website)', 1),
('skills', 'Coding & Pemrograman', 'PHP & MySQL (membuat aplikasi berbasis web dan database)', 2),
('skills', 'Coding & Pemrograman', 'Python (dasar pemrograman)', 3),
('skills', 'Desain Web', 'Bootstrap / Tailwind CSS', 4),
('skills', 'Database Management', 'MySQL', 5),
('skills', 'Office Tools', 'Microsoft Word, Excel, PowerPoint', 6);

-- Insert data for projects/experiences
INSERT INTO cv_data (section, title, content, order_position) VALUES
('projects', 'Pengalaman / Proyek', 'Membuat website sederhana untuk pemesanan makanan online', 1),
('projects', 'Pengalaman / Proyek', 'Membuat sistem login & register berbasis PHP dan MySQL', 2),
('projects', 'Pengalaman / Proyek', 'Desain landing page sekolah dengan HTML & CSS', 3);

-- Table structure for articles
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('draft', 'published') DEFAULT 'draft'
);

-- Insert sample articles
INSERT INTO articles (title, content, author, status) VALUES
('Getting Started with Web Development', 'Web development is an exciting field that combines creativity and technical skills. In this article, we explore the basics of HTML, CSS, and JavaScript to help beginners get started on their web development journey.', 'Nena Fernanda', 'published'),
('Understanding PHP and MySQL', 'PHP and MySQL form a powerful combination for creating dynamic websites. This article covers the fundamentals of server-side scripting with PHP and database management with MySQL.', 'Nena Fernanda', 'published'),
('Tips for Learning Programming', 'Learning programming can be challenging but rewarding. This article provides practical tips and strategies for beginners to effectively learn programming languages.', 'Nena Fernanda', 'published');