-- جدول اشخاص
CREATE TABLE IF NOT EXISTS ashkhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    family VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول کالاها
CREATE TABLE IF NOT EXISTS kala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(15, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول خدمات
CREATE TABLE IF NOT EXISTS khadamat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(15, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول فروش
CREATE TABLE IF NOT EXISTS forosh (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ashkhas_id INT NOT NULL,
    date DATE NOT NULL,
    total_price DECIMAL(15, 2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ashkhas_id) REFERENCES ashkhas(id)
);

-- جدول اقلام فروش
CREATE TABLE IF NOT EXISTS item_forosh (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forosh_id INT NOT NULL,
    kala_id INT,
    khadamat_id INT,
    price DECIMAL(15, 2) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (forosh_id) REFERENCES forosh(id),
    FOREIGN KEY (kala_id) REFERENCES kala(id),
    FOREIGN KEY (khadamat_id) REFERENCES khadamat(id)
);
