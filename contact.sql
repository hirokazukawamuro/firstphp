CREATE TABLE staffs (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO staffs
(first_name,last_name)
VALUES
("太郎","田中"),
("花子","山田"),
("明美","鈴木"),
("一郎","佐藤");

CREATE TABLE contacts (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    name VARCHAR(50) NOT NULL,
    mailaddress VARCHAR(50) NOT NULL,
    content VARCHAR(255) NOT NULL,
    staff_id int(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX staffs(staff_id),
    FOREIGN KEY staffs(staff_id) REFERENCES staffs(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
