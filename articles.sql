-- Add articles table to existing database
USE dbcv_nena;

-- Table structure for articles
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('draft', 'published') DEFAULT 'draft'
);

-- Insert sample articles
INSERT INTO articles (title, content, author, status) VALUES
('Getting Started with Web Development', 'Web development is an exciting field that combines creativity and technical skills. In this article, we explore the basics of HTML, CSS, and JavaScript to help beginners get started on their web development journey.', 'Nena Fernanda', 'published'),
('Understanding PHP and MySQL', 'PHP and MySQL form a powerful combination for creating dynamic websites. This article covers the fundamentals of server-side scripting with PHP and database management with MySQL.', 'Nena Fernanda', 'published'),
('Tips for Learning Programming', 'Learning programming can be challenging but rewarding. This article provides practical tips and strategies for beginners to effectively learn programming languages.', 'Nena Fernanda', 'published');