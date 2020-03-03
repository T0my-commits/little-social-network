SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `unaware`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `ID_MSG` int(11) NOT NULL,
  `ID_COM` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `ID_FORUM` int(11) NOT NULL,
  `type` varchar(230) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur_topic` int(150) NOT NULL,
  `activite` date NOT NULL,
  `nb_vues` int(11) NOT NULL,
  `nb_followers` int(11) NOT NULL,
  `nb_messages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `birthday` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `icone_session` varchar(100) NOT NULL,
  `registration_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `ID_FORUM` int(11) NOT NULL,
  `ID_MSG` int(11) NOT NULL,
  `message` text NOT NULL,
  `auteur` int(11) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `taps`
--

CREATE TABLE `taps` (
  `id` int(11) NOT NULL,
  `ID_TIP` int(11) NOT NULL,
  `msg` text NOT NULL,
  `send_date` date NOT NULL,
  `alert` varchar(20) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `send_date` datetime NOT NULL,
  `no_answers` int(11) NOT NULL,
  `alert` int(11) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `ID_TYPE` int(11) NOT NULL,
  `valeur_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`ID_COM`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ID_FORUM`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID_MSG`);

--
-- Index pour la table `taps`
--
ALTER TABLE `taps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_TYPE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `ID_COM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `ID_FORUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID_MSG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `taps`
--
ALTER TABLE `taps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
