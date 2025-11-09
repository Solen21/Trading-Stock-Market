<?php

$step = $_REQUEST['step'] ?? 1;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step == 1 && isset($_POST['db_host'])) {
        $db_host = $_POST['db_host']; // This block will now only run when db_host is posted
        $db_user = $_POST['db_user'];
        $db_pass = $_POST['db_pass'];
        $db_name = $_POST['db_name'];

        // Create connection
        $conn = new mysqli($db_host, $db_user, $db_pass);

        // Check connection
        if ($conn->connect_error) {
            $message = "Connection failed: " . $conn->connect_error;
        } else {
            // Create database
            $sql_create_db = "CREATE DATABASE IF NOT EXISTS `$db_name`";
            if ($conn->query($sql_create_db) === TRUE) {
                $conn->select_db($db_name);

        // Full SQL schema
        $sql = <<<SQL
SET FOREIGN_KEY_CHECKS=0;

-- roles
CREATE TABLE IF NOT EXISTS roles (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- users
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    full_name TEXT NOT NULL,
    role_id INTEGER NOT NULL,
    store_id INTEGER,
    email TEXT,
    phone TEXT,
    status VARCHAR(20) NOT NULL DEFAULT 'Active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- stores
CREATE TABLE IF NOT EXISTS stores (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    location TEXT,
    capacity INTEGER DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- companies
CREATE TABLE IF NOT EXISTS companies (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    contact_person VARCHAR(255),
    country VARCHAR(100),
    email VARCHAR(255),
    phone VARCHAR(50),
    address TEXT,
    info TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- product_suppliers
CREATE TABLE IF NOT EXISTS product_suppliers (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    code VARCHAR(255) NOT NULL UNIQUE,
    type TEXT DEFAULT 'Company',
    contact_info TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


-- Units 
CREATE TABLE IF NOT EXISTS units (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unit_name VARCHAR(50) NOT NULL UNIQUE,
    category ENUM('count', 'weight', 'volume', 'length', 'area', 'custom') DEFAULT 'count',
    base_value DECIMAL(10,4) DEFAULT 1,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT IGNORE INTO units (unit_name, category, base_value, description) VALUES
('piece', 'count', 1.0000, 'Default single item'),
('dozen', 'count', 12.0000, '1 dozen = 12 pieces'),
('half dozen', 'count', 6.0000, '1/2 dozen = 6 pieces'),
('kg', 'weight', 1.0000, 'Kilogram'),
('gram', 'weight', 0.0010, 'Gram'),
('liter', 'volume', 1.0000, 'Liter'),
('ml', 'volume', 0.0010, 'Milliliter'),
('meter', 'length', 1.0000, 'Meter'),
('cm', 'length', 0.0100, 'Centimeter'),
('pack', 'custom', 1.0000, 'Custom packaging or fabrication unit');

-- Product Categories
CREATE TABLE IF NOT EXISTS product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample categories
INSERT IGNORE INTO product_categories (category_name, description) VALUES
('Ceramic', 'Tiles, sanitary ware, clay, etc.'),
('Chemical', 'Glue, paint, cleaner, polish, etc.'),
('Tool', 'Cutters, brushes, equipment, etc.'),
('Fabrication', 'Custom builds or crafted items'),
('General', 'Other general products');

-- Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT,
    supplier_id INT,
    purchase_price DECIMAL(12,2) NOT NULL,
    transport_fee DECIMAL(12,2) DEFAULT 0,
    loading_fee DECIMAL(12,2) DEFAULT 0,
    unloading_fee DECIMAL(12,2) DEFAULT 0,
    other_expenses DECIMAL(12,2) DEFAULT 0,
    total_cost DECIMAL(12,2) GENERATED ALWAYS AS (purchase_price + transport_fee + loading_fee + unloading_fee + other_expenses) STORED,
    sell_price DECIMAL(12,2) NOT NULL,
    unit_id INT,
    quantity_per_unit DECIMAL(10,2) DEFAULT 1,
    size_details VARCHAR(255),
    status ENUM('Active','Inactive','Unteach') DEFAULT 'Active',
    unteach_start_date DATETIME NULL,
    unteach_duration INT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES product_categories(id),
    FOREIGN KEY (unit_id) REFERENCES units(id),
    FOREIGN KEY (supplier_id) REFERENCES product_suppliers(id)
);

-- Product Sizes 
CREATE TABLE IF NOT EXISTS product_sizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    height DECIMAL(10,2) DEFAULT NULL,
    width DECIMAL(10,2) DEFAULT NULL,
    thickness DECIMAL(10,2) DEFAULT NULL,
    radius DECIMAL(10,2) DEFAULT NULL,
    unit VARCHAR(20) DEFAULT 'cm',
    note TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Fabrication 
CREATE TABLE IF NOT EXISTS fabrication_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    material_type VARCHAR(100),
    labor_cost DECIMAL(12,2) DEFAULT 0,
    fabrication_method TEXT,
    production_time INT COMMENT 'Estimated time in hours',
    custom_note TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);


-- stock
CREATE TABLE IF NOT EXISTS stock (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    store_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER DEFAULT 0,
    broken INTEGER DEFAULT 0,
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    UNIQUE (store_id, product_id)
);

-- purchases
CREATE TABLE IF NOT EXISTS purchases (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INTEGER NOT NULL,
    store_id INTEGER NOT NULL,
    supplier_id INTEGER,
    quantity INTEGER NOT NULL,
    transport_fee REAL DEFAULT 0,
    loading_fee REAL DEFAULT 0,
    unloading_fee REAL DEFAULT 0,
    other_expenses REAL DEFAULT 0,
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    worker_id INTEGER,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (supplier_id) REFERENCES product_suppliers(id),
    FOREIGN KEY (worker_id) REFERENCES users(id)
);

-- sales
CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INTEGER NOT NULL,
    store_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    sell_price REAL NOT NULL,
    loading_fee REAL DEFAULT 0,
    unloading_fee REAL DEFAULT 0,
    customer_name TEXT,
    sale_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    worker_id INTEGER,
    mini_manager_id INTEGER,
    manager_id INTEGER,
    approved_by_admin INTEGER DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (worker_id) REFERENCES users(id),
    FOREIGN KEY (mini_manager_id) REFERENCES users(id),
    FOREIGN KEY (manager_id) REFERENCES users(id)
);

-- returns
CREATE TABLE IF NOT EXISTS returns (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    sale_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    reason TEXT,
    return_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    approved_by_admin INTEGER DEFAULT 0,
    refund_amount REAL DEFAULT 0,
    FOREIGN KEY (sale_id) REFERENCES sales(id)
);

-- broken_items
CREATE TABLE IF NOT EXISTS broken_items (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INTEGER NOT NULL,
    store_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    reason TEXT,
    reported_by INTEGER,
    report_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (reported_by) REFERENCES users(id)
);

-- expenses
CREATE TABLE IF NOT EXISTS expenses (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    store_id INTEGER,
    product_id INTEGER,
    amount REAL NOT NULL,
    category TEXT,
    description TEXT,
    created_by INTEGER,
    expense_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- alerts
CREATE TABLE IF NOT EXISTS alerts (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INTEGER NOT NULL,
    store_id INTEGER NOT NULL,
    alert_type TEXT NOT NULL,
    message TEXT,
    is_read INTEGER DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (store_id) REFERENCES stores(id)
);

-- messages
CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    message_text TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read INTEGER DEFAULT 0,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);

-- group_chats
CREATE TABLE IF NOT EXISTS group_chats (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    store_id INTEGER,
    created_by INTEGER,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- group_messages
CREATE TABLE IF NOT EXISTS group_messages (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    group_id INTEGER NOT NULL,
    sender_id INTEGER NOT NULL,
    message_text TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read INTEGER DEFAULT 0,
    FOREIGN KEY (group_id) REFERENCES group_chats(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
);

-- group_members
CREATE TABLE IF NOT EXISTS group_members (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    group_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES group_chats(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (group_id, user_id)
);

-- audit_log
CREATE TABLE IF NOT EXISTS audit_log (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    action TEXT NOT NULL,
    table_name TEXT,
    record_id INTEGER,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- transportation
CREATE TABLE IF NOT EXISTS transportation (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INTEGER NOT NULL,
    store_id INTEGER NOT NULL,
    transport_type TEXT NOT NULL,
    fee REAL NOT NULL,
    worker_id INTEGER,
    transport_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (worker_id) REFERENCES users(id)
);

-- general_settings
CREATE TABLE IF NOT EXISTS general_settings (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(255) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- graph_data
CREATE TABLE IF NOT EXISTS graph_data (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    graph_type TEXT NOT NULL,
    data TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- user_settings
CREATE TABLE IF NOT EXISTS user_settings (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    setting_key VARCHAR(255) NOT NULL,
    setting_value TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (user_id, setting_key)
);

SET FOREIGN_KEY_CHECKS=1;
SQL;

                if ($conn->multi_query($sql)) {
                    do {
                        if ($result = $conn->store_result()) {
                            $result->free();
                        }
                    } while ($conn->more_results() && $conn->next_result());
                    $message = "Database and tables created successfully!";

                    // Create config file
                    $config_dir = __DIR__ . '/../config';
                    if (!is_dir($config_dir)) {
                        mkdir($config_dir, 0755, true);
                    }

                    $config_content = "<?php\n\n";
                    $config_content .= "define('DB_HOST', '" . addslashes($db_host) . "');\n";
                    $config_content .= "define('DB_USER', '" . addslashes($db_user) . "');\n";
                    $config_content .= "define('DB_PASS', '" . addslashes($db_pass) . "');\n";
                    $config_content .= "define('DB_NAME', '" . addslashes($db_name) . "');\n";

                    $config_file = $config_dir . '/database.php';

                    if (file_put_contents($config_file, $config_content)) {
                        $message .= "\nConfiguration file created successfully.";
                    } else {
                        $message .= "\nWarning: Could not create configuration file. Please check permissions.";
                    }

                    $step = 2;
                } else {
                    $message = "Error creating tables: " . $conn->error;
                }
            } else {
                $message = "Error creating database: " . $conn->error;
            }
            $conn->close();
        }
    } elseif ($step == 2) {
        // Create admin        
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $full_name = $_POST['full_name'];

        // Include the new config file to get credentials
        $config_file = __DIR__ . '/../config/database.php';
        if (!file_exists($config_file)) {
            die("Configuration file not found. Please complete step 1 first.");
        }
        require_once $config_file;

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create role first
        $conn->query("INSERT IGNORE INTO roles (name, description) VALUES ('Admin', 'Administrator with full access')");
        
        // Fetch the role ID regardless of whether it was just inserted or already existed.
        $result = $conn->query("SELECT id FROM roles WHERE name = 'Admin'");
        if ($result->num_rows > 0) {
            $role_id = $result->fetch_assoc()['id'];
        } else {
            die("Failed to create or find the 'Admin' role.");
        }

        // Create admin user
        $stmt = $conn->prepare("INSERT INTO users (username, password_hash, full_name, role_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $password, $full_name, $role_id);

        if ($stmt->execute()) {
            $message = "Admin user created! Installation complete.";
            $step = 3;
        } else {
            $message = "Error creating admin user: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ceramic Management System Installation</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .install-box { max-width: 600px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0,0,0,0.2);}
        h1,h2 { text-align:center; }
        form label { display:block; margin:10px 0; }
        form input { width:100%; padding:8px; margin-top:5px; }
        button { display:block; width:100%; padding:10px; margin-top:20px; background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;}
        button:hover { background:#0056b3; }
    </style>
</head>
<body>
<div class="install-box">
    <h1>Installation Wizard</h1>
    <p><?= nl2br(htmlspecialchars($message)) ?></p>

    <?php if ($step == 1): ?>
        <form method="post">
            <h2>MySQL Database Details</h2>
            <label>Database Host: <input type="text" name="db_host" value="localhost" required></label>
            <label>Database User: <input type="text" name="db_user" value="root" required></label>
            <label>Database Password: <input type="password" name="db_pass"></label>
            <label>Database Name: <input type="text" name="db_name" value="product_management_system" required></label>
            <button type="submit">Create Database and Tables</button>
        </form>
    <?php elseif ($step == 2): ?>
        <form method="post">
            <h2>Create Admin Account</h2>
            <input type="hidden" name="step" value="2">
            <label>Username: <input type="text" name="username" required></label>
            <label>Password: <input type="password" name="password" required></label>
            <label>Full Name: <input type="text" name="full_name" required></label>
            <button type="submit">Create Admin</button>
        </form>
    <?php else: ?>
        <h2>Installation Complete!</h2>
        <p><a href="../public/login">Go to the App</a></p>
    <?php endif; ?>
</div>
</body>
</html>