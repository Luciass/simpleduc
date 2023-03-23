-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 06 jan. 2022 à 15:54
-- Version du serveur : 10.3.31-MariaDB-0+deb10u1
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `simpleduc`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE `avoir` (
  `id_user` int(11) NOT NULL,
  `id_comp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id_comp` int(11) NOT NULL,
  `nom_comp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id_comp`, `nom_comp`) VALUES
(1, 'HTML/CSS'),
(3, 'JS'),
(5, 'PHP'),
(6, 'MYSQL');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id_contrat` int(11) NOT NULL,
  `date_debut_contrat` date NOT NULL,
  `date_fin_contrat` date NOT NULL,
  `date_sign` date NOT NULL,
  `cout_global` float NOT NULL,
  `echeancier` varchar(50) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `durer`
--

CREATE TABLE `durer` (
  `id_user` int(11) NOT NULL,
  `id_tache` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom_entreprise` varchar(50) NOT NULL,
  `tel_entreprise` varchar(10) NOT NULL,
  `mail_entrerpise` varchar(50) NOT NULL,
  `nom_contact` varchar(50) NOT NULL,
  `tel_contact` varchar(10) NOT NULL,
  `cahier_charge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL,
  `nom_equipe` varchar(50) NOT NULL,
  `id_responsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `etre`
--

CREATE TABLE `etre` (
  `id_user` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `exercer`
--

CREATE TABLE `exercer` (
  `id_user` int(11) NOT NULL,
  `id_metier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `metier`
--

CREATE TABLE `metier` (
  `id_metier` int(11) NOT NULL,
  `nom_metier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `metier`
--

INSERT INTO `metier` (`id_metier`, `nom_metier`) VALUES
(1, 'Chef de Projet'),
(2, 'Developpeur Back-end'),
(3, 'Developpeur Front-end'),
(6, 'Developpeur Full-Stack'),
(4, 'Developpeur Web'),
(5, 'Web Designeur');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(50) NOT NULL,
  `id_contrat` int(11) NOT NULL,
  `date_debut_contrat` date NOT NULL,
  `date_fin_contrat` date NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `repartir`
--

CREATE TABLE `repartir` (
  `id_tache` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `delais` int(11) DEFAULT NULL,
  `cout` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `responsabiliser`
--

CREATE TABLE `responsabiliser` (
  `id_user` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `id_responsable` int(11) NOT NULL,
  `delais` date NOT NULL,
  `besoin` varchar(50) NOT NULL,
  `budget` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nom_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom_role`) VALUES
(0, 'user'),
(1, 'Admin'),
(2, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `nom_tache` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `codeVA` varchar(50) NOT NULL,
  `dateVA` date DEFAULT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `derniere_connexion` date DEFAULT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `mail`, `tel`, `mdp`, `codeVA`, `dateVA`, `valide`, `derniere_connexion`, `id_role`) VALUES
(5, 'Flahaut', 'Noha', 'noha.flahaut@epsi.fr', '0687519833', '$2y$10$HpMPpwHHS9v.h9/hKEChqeo/0zDxsmnwBJbaXat7n4M1QB3YeoJOO', '0', '2021-12-17', 1, NULL, 1),
(12, 'nicolas sarkozi', 'Président', 'charles.hennebicque@epsi.fr', '0123456789', '$2y$10$aFTOlk4o1GwCKf6tiqlSj.X0ks47FpkWXaVwM1.rO27Tr7UO5T2ji', '53497036561d6b91019a4b', NULL, 0, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD PRIMARY KEY (`id_user`,`id_comp`),
  ADD KEY `id_comp` (`id_comp`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id_comp`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id_contrat`,`date_debut_contrat`,`date_fin_contrat`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `durer`
--
ALTER TABLE `durer`
  ADD PRIMARY KEY (`id_user`,`id_tache`),
  ADD KEY `id_tache` (`id_tache`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`),
  ADD UNIQUE KEY `tel_entreprise` (`tel_entreprise`),
  ADD UNIQUE KEY `mail_entrerpise` (`mail_entrerpise`),
  ADD UNIQUE KEY `tel_contact` (`tel_contact`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Index pour la table `etre`
--
ALTER TABLE `etre`
  ADD PRIMARY KEY (`id_user`,`id_equipe`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `exercer`
--
ALTER TABLE `exercer`
  ADD PRIMARY KEY (`id_user`,`id_metier`),
  ADD KEY `id_metier` (`id_metier`);

--
-- Index pour la table `metier`
--
ALTER TABLE `metier`
  ADD PRIMARY KEY (`id_metier`),
  ADD UNIQUE KEY `nom_metier` (`nom_metier`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `id_contrat` (`id_contrat`,`date_debut_contrat`,`date_fin_contrat`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `repartir`
--
ALTER TABLE `repartir`
  ADD PRIMARY KEY (`id_tache`,`id_projet`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `responsabiliser`
--
ALTER TABLE `responsabiliser`
  ADD PRIMARY KEY (`id_user`,`id_responsable`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id_responsable`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `codeVA` (`codeVA`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id_contrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `metier`
--
ALTER TABLE `metier`
  MODIFY `id_metier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id_responsable` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`id_comp`) REFERENCES `competence` (`id_comp`);

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `durer`
--
ALTER TABLE `durer`
  ADD CONSTRAINT `durer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `durer_ibfk_2` FOREIGN KEY (`id_tache`) REFERENCES `tache` (`id_tache`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id_responsable`);

--
-- Contraintes pour la table `etre`
--
ALTER TABLE `etre`
  ADD CONSTRAINT `etre_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `etre_ibfk_2` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`);

--
-- Contraintes pour la table `exercer`
--
ALTER TABLE `exercer`
  ADD CONSTRAINT `exercer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `exercer_ibfk_2` FOREIGN KEY (`id_metier`) REFERENCES `metier` (`id_metier`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`id_contrat`,`date_debut_contrat`,`date_fin_contrat`) REFERENCES `contrat` (`id_contrat`, `date_debut_contrat`, `date_fin_contrat`),
  ADD CONSTRAINT `projet_ibfk_2` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`);

--
-- Contraintes pour la table `repartir`
--
ALTER TABLE `repartir`
  ADD CONSTRAINT `repartir_ibfk_1` FOREIGN KEY (`id_tache`) REFERENCES `tache` (`id_tache`),
  ADD CONSTRAINT `repartir_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Contraintes pour la table `responsabiliser`
--
ALTER TABLE `responsabiliser`
  ADD CONSTRAINT `responsabiliser_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `responsabiliser_ibfk_2` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id_responsable`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
