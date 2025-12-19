-- Z-Stack demo seed
-- Test user:
--   email: test@example.com
--   password: secret123
INSERT INTO users (email, password_hash) VALUES
('test@example.com', '$2b$10$bfM3sx3Be/XpbEXMxs3DFO6OfDTeeacexrLIUBAthq5D5NWk6Ugsi')
ON DUPLICATE KEY UPDATE email = VALUES(email);
