-- Creazione tabella scuole
CREATE TABLE `scuole` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `indirizzo` VARCHAR(100),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creazione tabella docenti
CREATE TABLE `docenti` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(20) NOT NULL,
  `cognome` VARCHAR(20) NOT NULL,
  `scuola_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`scuola_id`) REFERENCES `scuole`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserimento dati di esempio per scuole
INSERT INTO `scuole` (`nome`, `indirizzo`) VALUES
('ITIS Meucci', 'Via del Filarete, 17'),
('Leonardo da Vinci', 'Via Garibaldi, 10');

-- Inserimento dati di esempio per docenti
INSERT INTO `docenti` (`nome`, `cognome`, `scuola_id`) VALUES
('Claudio', 'Benvenuti', 1),
('Ivan', 'Bruno', 1),
('Francesco', 'Bertoli', 2);
