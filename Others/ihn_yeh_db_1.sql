-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mar 18, 2024 alle 20:40
-- Versione del server: 10.3.35-MariaDB
-- Versione PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ihn_yeh_db_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli_ordine`
--

CREATE TABLE `articoli_ordine` (
  `id` int(11) NOT NULL,
  `ordine_id` int(11) NOT NULL,
  `prodotto_id` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articoli_ordine`
--

INSERT INTO `articoli_ordine` (`id`, `ordine_id`, `prodotto_id`, `quantita`) VALUES
(2, 4, 2, 1),
(9, 7, 5, 1),
(10, 7, 2, 1);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `dettagli_ordini`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `dettagli_ordini` (
`id_ordine` int(11)
,`id_utente` int(11)
,`nome_cliente` varchar(255)
,`cognome_cliente` varchar(255)
,`email_cliente` varchar(255)
,`data_ordine` datetime
,`stato_ordine` enum('In corso','Completato','Annullato')
,`numero_ordine` varchar(255)
,`nome_prodotto` varchar(255)
,`descrizione_prodotto` text
,`prezzo_prodotto` decimal(10,2)
,`quantita_ordinata` int(11)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `stato` enum('In corso','Completato','Annullato') NOT NULL DEFAULT 'In corso',
  `numero_ordine` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id`, `cliente_id`, `data`, `stato`, `numero_ordine`) VALUES
(4, 1, '2023-11-17 00:00:00', 'In corso', 'FGDBST'),
(7, 3, '2024-02-19 00:00:00', 'In corso', 'DDD111');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `immagine` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`id`, `nome`, `descrizione`, `prezzo`, `immagine`) VALUES
(1, 'T-shirt con logo', 'T-shirt in cotone con logo del nostro brand.', '25.00', 'img/t-shirt'),
(2, 'Tazza personalizzata', 'Tazza in ceramica con stampa personalizzata.', '15.00', 'img/tazza'),
(3, 'Cappellino estivo', 'Cappellino di cotone ', '10.00', 'img/cappellino'),
(4, 'Libro di cucina', 'Libro con ricette di cucina italiana tradizionale.', '20.00', 'img/libro-ricette'),
(5, 'Smartphone', 'Ultimo modello di smartphone con caratteristiche avanzate.', '800.00', 'img/smartphone');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `prodotti_ordine`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `prodotti_ordine` (
`id_ordine` int(11)
,`nome_prodotto` varchar(255)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `riepilogo_ordini`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `riepilogo_ordini` (
`id_ordine` int(11)
,`id_utente` int(11)
,`nome_cliente` varchar(255)
,`cognome_cliente` varchar(255)
,`numero_ordine` varchar(255)
,`data_ordine` datetime
,`stato_ordine` enum('In corso','Completato','Annullato')
,`quantita_totale` decimal(32,0)
,`totale_ordine` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('cliente','amministratore') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `email`, `password`, `ruolo`) VALUES
(1, 'Mario', 'Rossi', 'mario.rossi@email.com', 'password123', 'cliente'),
(2, 'Anna', 'Verdi', 'anna.verdi@email.com', '$2y$10$oJrwTOZfVAJVJNdvJWfVBOS9UNFQOD6PTZgy0BzScg9udwHEsBTv6', 'cliente'),
(3, 'Luca', 'Bianchi', 'luca.bianchi@email.com', 'password789', 'amministratore'),
(4, 'TestNome', 'TestCognome', 'testmail@gmail.com', '$2y$10$oJrwTOZfVAJVJNdvJWfVBOS9UNFQOD6PTZgy0BzScg9udwHEsBTv6', 'amministratore'),
(5, 'pino', 'alpino', 'testmail@mail.com', '$2y$10$wTHYe4P67KL.6V6kQuttZ.x.EseZbkfyPUb2Aq8JPtF5m3byyZ3pG', 'cliente'),
(6, 'enrico', 'sandrini', 'xaxaxaxa@gmail.com', '$2y$10$4NaL.u8DGv8pOwZrnn.O8.1uc8jvt0.yyko.FQghtiFA0x04HiHKa', 'cliente'),
(7, 'a', 'a', 'a@gmail.com', '$2y$10$GCB3UXmD7BU0FXGahI10W.LYUnzDPOWrDlQW7OLSb/.NgrsY/UbNW', 'cliente');

-- --------------------------------------------------------

--
-- Struttura per vista `dettagli_ordini`
--
DROP TABLE IF EXISTS `dettagli_ordini`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ihnatenko`@`localhost` SQL SECURITY DEFINER VIEW `dettagli_ordini`  AS SELECT `ordini`.`id` AS `id_ordine`, `utenti`.`id` AS `id_utente`, `utenti`.`nome` AS `nome_cliente`, `utenti`.`cognome` AS `cognome_cliente`, `utenti`.`email` AS `email_cliente`, `ordini`.`data` AS `data_ordine`, `ordini`.`stato` AS `stato_ordine`, `ordini`.`numero_ordine` AS `numero_ordine`, `prodotti`.`nome` AS `nome_prodotto`, `prodotti`.`descrizione` AS `descrizione_prodotto`, `prodotti`.`prezzo` AS `prezzo_prodotto`, `articoli_ordine`.`quantita` AS `quantita_ordinata` FROM (((`ordini` join `utenti` on(`ordini`.`cliente_id` = `utenti`.`id`)) join `articoli_ordine` on(`ordini`.`id` = `articoli_ordine`.`ordine_id`)) join `prodotti` on(`articoli_ordine`.`prodotto_id` = `prodotti`.`id`))  ;

-- --------------------------------------------------------

--
-- Struttura per vista `prodotti_ordine`
--
DROP TABLE IF EXISTS `prodotti_ordine`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ihnatenko`@`localhost` SQL SECURITY DEFINER VIEW `prodotti_ordine`  AS SELECT `ordini`.`id` AS `id_ordine`, `prodotti`.`nome` AS `nome_prodotto` FROM ((`ordini` join `articoli_ordine` on(`ordini`.`id` = `articoli_ordine`.`ordine_id`)) join `prodotti` on(`articoli_ordine`.`prodotto_id` = `prodotti`.`id`))  ;

-- --------------------------------------------------------

--
-- Struttura per vista `riepilogo_ordini`
--
DROP TABLE IF EXISTS `riepilogo_ordini`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ihnatenko`@`localhost` SQL SECURITY DEFINER VIEW `riepilogo_ordini`  AS SELECT `ordini`.`id` AS `id_ordine`, `utenti`.`id` AS `id_utente`, `utenti`.`nome` AS `nome_cliente`, `utenti`.`cognome` AS `cognome_cliente`, `ordini`.`numero_ordine` AS `numero_ordine`, `ordini`.`data` AS `data_ordine`, `ordini`.`stato` AS `stato_ordine`, sum(`articoli_ordine`.`quantita`) AS `quantita_totale`, sum(`articoli_ordine`.`quantita` * `prodotti`.`prezzo`) AS `totale_ordine` FROM (((`ordini` join `utenti` on(`ordini`.`cliente_id` = `utenti`.`id`)) join `articoli_ordine` on(`ordini`.`id` = `articoli_ordine`.`ordine_id`)) join `prodotti` on(`articoli_ordine`.`prodotto_id` = `prodotti`.`id`)) GROUP BY `ordini`.`id``id`  ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli_ordine`
--
ALTER TABLE `articoli_ordine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordine_id` (`ordine_id`),
  ADD KEY `prodotto_id` (`prodotto_id`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli_ordine`
--
ALTER TABLE `articoli_ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articoli_ordine`
--
ALTER TABLE `articoli_ordine`
  ADD CONSTRAINT `articoli_ordine_ibfk_1` FOREIGN KEY (`ordine_id`) REFERENCES `ordini` (`id`),
  ADD CONSTRAINT `articoli_ordine_ibfk_2` FOREIGN KEY (`prodotto_id`) REFERENCES `prodotti` (`id`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utenti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
