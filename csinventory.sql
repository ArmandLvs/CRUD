CREATE DATABASE IF NOT EXISTS CSinventory;

USE CSinventory;

CREATE TABLE IF NOT EXISTS inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    AcquisitionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO inventory (name, quantity, price)
VALUES
('AK-47 | Redline', 10, 25.99),
('AWP | Asiimov', 5, 120.00),
('M4A1-S | Hyper Beast', 15, 35.49),
('Desert Eagle | Blaze', 8, 200.00),
('USP-S | Orion', 12, 45.00);
