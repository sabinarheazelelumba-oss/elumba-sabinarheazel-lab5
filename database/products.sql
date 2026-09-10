CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (product_name, description, price, quantity)
SELECT 'Lomi', 'Batangas-style noodle soup with pork, egg, and vegetables.', 95.00, 20
WHERE NOT EXISTS (SELECT 1 FROM products WHERE product_name = 'Lomi');

INSERT INTO products (product_name, description, price, quantity)
SELECT 'Sisig', 'Crispy pork sisig served with calamansi and chili.', 120.00, 15
WHERE NOT EXISTS (SELECT 1 FROM products WHERE product_name = 'Sisig');

INSERT INTO products (product_name, description, price, quantity)
SELECT 'Chicken Inasal', 'Grilled marinated chicken with rice and special sauce.', 135.00, 12
WHERE NOT EXISTS (SELECT 1 FROM products WHERE product_name = 'Chicken Inasal');