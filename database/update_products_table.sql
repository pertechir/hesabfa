ALTER TABLE products
ADD COLUMN sub_unit VARCHAR(255) NULL AFTER main_unit,
ADD COLUMN conversion_factor DECIMAL(8, 4) DEFAULT 1 AFTER sub_unit;