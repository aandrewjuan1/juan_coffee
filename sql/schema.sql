-- Create the Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create the Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Store hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    created_by INT,  -- New column to track creator
    updated_by INT,  -- New column to track last updater
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- New column to track creation time
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- New column to track update time
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (created_by) REFERENCES users(id),  -- Foreign key to link creator
    FOREIGN KEY (updated_by) REFERENCES users(id)   -- Foreign key to link last updater
);

-- Insert Categories
INSERT INTO categories (name) VALUES 
    ('Coffee'),
    ('Pastry'),
    ('Equipment');

-- Insert Users
INSERT INTO users (email, password) VALUES 
    ('user1@example.com', 'hashed_password_1'),
    ('user2@example.com', 'hashed_password_2'),
    ('user3@example.com', 'hashed_password_3');

-- Insert Products
INSERT INTO products (name, description, price, category_id, created_by, updated_by) VALUES 
    ('Espresso', 'Rich and strong coffee shot.', 2.50, 1, 1, 1),
    ('Cappuccino', 'Espresso with steamed milk and foam.', 3.00, 1, 2, 3),
    ('Latte', 'Espresso with steamed milk.', 3.50, 1, 1, 2),
    ('Mocha', 'Chocolate-flavored latte.', 4.00, 1, 2, 2),
    ('Croissant', 'Flaky buttery pastry.', 2.00, 2, 3, 1),
    ('Pain au Chocolat', 'Chocolate-filled croissant.', 2.50, 2, 2, 3),
    ('Muffin', 'Soft and fluffy muffin.', 2.20, 2, 1, 1),
    ('Danish Pastry', 'Layers of pastry with filling.', 2.80, 2, 3, 1),
    ('Espresso Machine', 'Machine for brewing espresso.', 120.00, 3, 1, 3),
    ('Coffee Grinder', 'Grinds coffee beans.', 50.00, 3, 2, 2),
    ('French Press', 'Brews coffee with steeping method.', 25.00, 3, 3, 1),
    ('Milk Frother', 'Creates milk foam for coffee.', 15.00, 3, 1, 2),
    ('Caramel Macchiato', 'Espresso with caramel syrup.', 4.20, 1, 3, 1),
    ('Cinnamon Roll', 'Sweet roll with cinnamon.', 2.60, 2, 2, 1),
    ('Affogato', 'Espresso poured over ice cream.', 3.80, 1, 3, 3),
    ('Scone', 'Biscuit-like pastry with flavors.', 2.10, 2, 1, 2),
    ('Thermometer', 'Digital thermometer for coffee.', 10.00, 3, 2, 1),
    ('Iced Coffee', 'Cold brewed coffee.', 3.00, 1, 3, 2),
    ('Bagel', 'Round bread with toppings.', 1.80, 2, 3, 1),
    ('Espresso Tamper', 'Tool to compress coffee grounds.', 15.00, 3, 2, 2);





