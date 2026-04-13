-- ==========================================================
-- TUGAS 1: DATABASE & TABLE STRUCTURE (Poin a, b, c)
-- ==========================================================

CREATE DATABASE IF NOT EXISTS ecommerce_dino;
USE ecommerce_dino;

-- 1.a Tabel Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    harga INT,
    deskripsi TEXT,
    stok INT
);

-- 1.b Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

-- 1.c Tabel Orders
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT,
    total INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- ==========================================================
-- TUGAS 2: CRUD OPERATIONS (Poin a, b, c, d)
-- ==========================================================

-- [A] CREATE: Input data dari Website DinoMarket
INSERT INTO products (nama_produk, harga, deskripsi, stok) VALUES 
('DinoPhone 16 Pro Max', 18500000, 'Chip Rex-Core 5, Kamera Raptor-Eye 200MP', 20),
('SUV Raptor XT 2026', 450000000, 'Kendaraan segala medan lapis baja', 5),
('Drone Ptero-Scan 8K', 8200000, 'Drone pengintai stabilitas tinggi', 12);

-- [B] READ: Menampilkan data produk
SELECT * FROM products;

-- [C] UPDATE: Mengubah harga produk (Simulasi Diskon)
UPDATE products 
SET harga = 400000000 
WHERE nama_produk = 'SUV Raptor XT 2026';

-- [D] DELETE: Menghapus satu produk (Simulasi Stok Kosong)
DELETE FROM products 
WHERE nama_produk = 'Drone Ptero-Scan 8K';

-- FINAL CHECK: Melihat hasil akhir setelah Update & Delete
SELECT * FROM products;