-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 25 Mars 2017 à 10:06
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `licorebdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `acces`
--

CREATE TABLE `acces` (
  `idRole` int(11) NOT NULL,
  `idPage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `acces`
--

INSERT INTO `acces` (`idRole`, `idPage`) VALUES
(1, 2),
(1, 3),
(2, 3),
(4, 3),
(1, 4),
(3, 5),
(1, 6),
(4, 6),
(2, 7),
(3, 7),
(3, 8),
(1, 9),
(2, 9),
(3, 9),
(1, 10),
(2, 10),
(3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `idCompetence` int(11) NOT NULL,
  `refCompetence` varchar(50) NOT NULL,
  `nomCompetence` varchar(500) NOT NULL,
  `definition` text,
  `criteres` text,
  `idPereCompetence` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`idCompetence`, `refCompetence`, `nomCompetence`, `definition`, `criteres`, `idPereCompetence`, `visible`) VALUES
(67, 'C1', 'Compétences de production de l’oral', '', '', NULL, 1),
(69, 'C2', 'Compétences de production de l’écrit', '', '', NULL, 1),
(70, 'C1.1', 'Décrire à l’oral une expérience vécue de manière détaillée', '', 'B1 : \nPeut faire une description directe et simple de sujets familiers variés dans le cadre de son domaine d’intérêt.\nPeut relater en détail ses expériences en décrivant ses sentiments et ses réactions.\nPeut relater les détails essentiels d’un événement fortuit, tel un accident.\nB2 :\nPeut faire une description claire et détaillée d’une gamme étendue de sujets en relation avec son domaine d’intérêt.', 67, 1),
(71, 'C1.2', 'Exprimer à l’oral son opinion, ses idées sur des sujets familiers ou non', '', 'B1.1 :\nPeut donner brièvement les raisons et les explications relatives à des opinions, projets et actions.\nB1.2 :\nPeut développer une argumentation suffisamment bien pour être compris sans difficulté la plupart du temps.\nB2.1 :\nPeut développer une argumentation claire, en élargissant et confirmant ses points de vue par des arguments secondaires et des exemples pertinents. Peut enchaîner des arguments avec logique.\nB2.2 :\nPeut développer méthodiquement une argumentation en mettant en évidence les points significatifs et les éléments pertinents.', 67, 1),
(72, 'C1.3', 'Faire une annonce publique claire et compréhensible en soignant son élocution', '', 'B1 :\nPeut faire de brèves annonces préparées sur un sujet proche des faits quotidiens dans son domaine, éventuellement même avec un accent et une intonation étrangers qui n’empêchent pas d’être clairement intelligible.\nB2 :\nPeut faire des annonces sur la plupart des sujets généraux avec un degré de clarté, d’aisance et de spontanéité qui ne procurent à l’auditeur ni tension ni inconfort.', 67, 1),
(73, 'C1.4', 'Réaliser une présentation orale claire et détaillée en répondant aux questions de son auditoire', '', 'B1 :\nPeut faire un exposé simple et direct, préparé, sur un sujet familier dans son domaine qui soit assez clair pour être suivi sans difficulté la plupart du temps et dans lequel les points importants soient expliqués avec assez de précision.\nPeut gérer les questions qui suivent mais peut devoir faire répéter si le débit était rapide.\nB2.1 :\nPeut faire un exposé clair, préparé, en avançant des raisons pour ou contre un point de vue particulier et en présentant les avantages et les inconvénients d’options diverses.\nPeut prendre en charge une série de questions, après l’exposé, avec un degré d’aisance et de spontanéité qui ne cause pas de tension à l’auditoire ou à lui/elle-même.\nB2.2 :\nPeut développer un exposé de manière claire et méthodique en soulignant les points significatifs et les éléments pertinents.\nPeut s’écarter spontanément d’un texte préparé pour suivre les points intéressants soulevés par des auditeurs en faisant souvent preuve d’une aisance et d’une facilité d’expression remarquables.', 67, 1),
(74, 'C1.5', 'Planifier sa façon de communiquer de manière méthodique', '', 'B1.1 :\nPeut prévoir et préparer la façon de communiquer les points importants qu’il/elle veut transmettre en exploitant toutes les ressources disponibles et en limitant le message aux moyens d’expression qu’il/elle trouve ou dont il/elle se souvient.\nB1.2 :\nPeut préparer et essayer de nouvelles expressions et combinaisons de mots et demander des remarques en retour à leur sujet.\nB2 :\nPeut planifier ce qu’il faut dire et les moyens de le dire en tenant compte de l’effet à produire sur le(s) destinataire(s).', 67, 1),
(75, 'C3', 'Compétences de compréhension de l’oral', '', '', NULL, 1),
(76, 'C4', 'Compétences de compréhension de l’écrit', '', '', NULL, 1),
(77, 'C5', 'Compétences d’interaction à l’oral', '', '', NULL, 1),
(78, 'C5.1', 'Comprendre un locuteur natif lors d’une conversation', '', 'B1 :\nPeut suivre un discours clairement articulé et qui lui est destiné dans une conversation courante, mais devra quelquefois faire répéter certains mots ou expressions.\nB2 :\nPeut comprendre en détail ce qu’on lui dit en langue standard, même dans un environnement bruyant.', 77, 1),
(79, 'C5.2', 'S’engager dans une conversation sans être préparé', '', 'B1 :\nPeut aborder sans préparation une conversation sur un sujet familier.\nPeut suivre une conversation quotidienne si l’interlocuteur s’exprime clairement, bien qu’il lui soit parfois nécessaire de faire répéter certains mots ou expression.\nPeut soutenir une conversation ou une discussion mais risque d’être quelquefois difficile à suivre lorsqu’il/elle essaie de formuler exactement ce qu’il/elle aimerait dire.\nB2 :\nPeut s’impliquer dans une conversation d’une certaine longueur sur la plupart des sujets d’intérêt général en y participant réellement, et ce même dans un environnement bruyant.\nPeut maintenir des relations avec des locuteurs natifs sans les amuser ou les irriter involontairement ou les obliger à se comporter autrement qu’ils ne le feraient avec un interlocuteur natif.\nPeut transmettre différents degrés d’émotion et souligner ce qui est important pour lui/elle dans un événement ou une expérience.', 77, 1),
(80, 'C5.3', 'Prendre part à une discussion dans un contexte familier, de la vie courante', '', 'B1.1 :\nPeut, en règle générale, suivre les points principaux d’une discussion d’une certaine longueur se déroulant en sa présence à condition qu’elle ait lieu en langue standard clairement articulée.\nPeut émettre ou solliciter un point de vue personnel ou une opinion sur des points d’intérêt général.\nPeut faire comprendre ses opinions et réactions pour trouver une solution à un problème ou à des questions pratiques relatives à où aller ? que faire ? comment organiser (une sortie, par exemple) ?\nPeut exprimer poliment ses convictions, ses opinions, son accord et son désaccord.\nB1.2 :\nPeut suivre l’essentiel de ce qui se dit autour de lui sur des thèmes généraux, à condition que les interlocuteurs évitent l’usage d’expressions trop idiomatiques et articulent clairement.\nPeut exprimer sa pensée sur un sujet abstrait ou culturel comme un film ou de la musique. Peut expliquer pourquoi quelque chose pose problème.\nPeut commenter brièvement le point de vue d’autrui.\nPeut comparer et opposer des alternatives en discutant de ce qu’il faut faire, où il faut aller, qui désigner, qui ou quoi choisir, etc.\nB2.1 :\nPeut participer activement à une discussion informelle dans un contexte familier, en faisant des commentaires, en exposant un point de vue clairement, en évaluant d’autres propositions, ainsi qu’en émettant et en réagissant à des hypothèses.\nPeut suivre, avec quelque effort, l’essentiel de ce qui se dit dans une conversation à laquelle il/elle ne participe pas mais peut éprouver des difficultés à participer effectivement à une conversation avec plusieurs locuteurs natifs qui ne modifient en rien leur mode d’expression.\nPeut exprimer et exposer ses opinions dans une discussion et les défendre avec pertinence en fournissant explications, arguments et commentaires.\nB2.2 :\nPeut suivre facilement une conversation animée entre locuteurs natifs.\nPeut exprimer ses idées et ses opinions avec précision et argumenter avec conviction sur des sujets complexes et réagir de même aux arguments d’autrui.', 77, 1),
(81, 'C5.4', 'Prendre part à une discussion ou une réunion formelle', '', 'B1 :\nPeut suivre l’essentiel de ce qui se dit relatif à son domaine, à condition que les interlocuteurs évitent l’usage d’expressions trop idiomatiques et articulent clairement.\nPeut exprimer clairement un point de vue mais a du mal à engager un débat.\nPeut prendre part à une discussion formelle courante sur un sujet familier conduite dans une langue standard clairement articulée et qui suppose l’échange d’informations factuelles, en recevant des instructions ou la discussion de solutions à des problèmes pratiques.\nB2.1 :\nPeut participer activement à des discussions formelles habituelles ou non.\nPeut suivre une discussion sur des sujets relatifs à son domaine et comprendre dans le détail les points mis en évidence par le locuteur.\nPeut exprimer, justifier et défendre son opinion, évaluer d’autres propositions ainsi que répondre à des hypothèses et en faire.\nB2.2 :\nPeut suivre une conversation animée, en identifiant avec exactitude les arguments qui soutiennent et opposent les points de vue.\nPeut exposer ses idées et ses opinions et argumenter avec conviction sur des sujets complexes et réagir de même aux arguments d’autrui.', 77, 1),
(82, 'C5.5', 'Défendre, négocier ou réfuter un point de vue ou une action à l’oral pour résoudre une situation', '', 'B1.1 :\nPeut, en règle générale, suivre ce qui se dit et, le cas échéant, peut rapporter en partie ce qu’un interlocuteur a dit pour confirmer une compréhension mutuelle.\nPeut faire comprendre ses opinions et réactions par rapport aux solutions possibles ou à la suite à donner, en donnant brièvement des raisons et des explications.\nPeut inviter les autres à donner leur point de vue sur la façon de faire.\nB1.2 :\nPeut suivre ce qui se dit mais devoir occasionnellement faire répéter ou clarifier si le discours des autres est rapide et long.\nPeut expliquer pourquoi quelque chose pose problème, discuter de la suite à donner, comparer et opposer les solutions.\nPeut commenter brièvement le point de vue d’autrui.\nB2 :\nPeut comprendre avec sûreté des instructions détaillées.\nPeut faire avancer le travail en invitant autrui à s’y joindre, à dire ce qu’il pense, etc.\nPeut esquisser clairement à grands traits une question ou un problème, faire des spéculations sur les causes et les conséquences, et mesurer les avantages et les inconvénients des différentes approches.', 77, 1),
(83, 'C5.6', 'Dialoguer pour obtenir des biens et des services', '', 'B1 :\nPeut faire face à la majorité des situations susceptibles de se produire au cours d’un voyage ou en préparant un voyage ou un hébergement ou en traitant avec des autorités à l’étranger.\nPeut faire face à une situation quelque peu inhabituelle dans un magasin, un bureau de poste ou une banque, par exemple en demandant à retourner un achat défectueux.\nPeut formuler une plainte.\nPeut se débrouiller dans la plupart des situations susceptibles de se produire en réservant un voyage auprès d’une agence ou lors d’un voyage, par exemple en demandant à un passager où descendre pour une destination non familière.\nB2.1 :\nPeut exposer un problème qui a surgi et mettre en évidence que le fournisseur du service ou le client doit faire une concession.\nB2.2 :\nPeut gérer linguistiquement une négociation pour trouver une solution à une situation conflictuelle telle qu’une contravention imméritée, une responsabilité financière pour des dégâts dans un appartement, une accusation en rapport avec un accident.\nPeut exposer ses raisons pour obtenir un dédommagement en utilisant un discours convaincant et définissant clairement les limites des concessions qu’il/elle est prêt à faire.', 77, 1),
(84, 'C5.7', 'Interagir pour échanger de l’information à l’oral', '', 'B1.2 :\nPeut trouver et transmettre une information simple et directe.\nPeut demander et suivre des directives détaillées.\nPeut obtenir plus de renseignements.\nB1.2 :\nPeut échanger avec une certaine assurance un grand nombre d’informations factuelles sur des sujets courants ou non, familiers à son domaine.\nPeut expliquer comment faire quelque chose en donnant des instructions détaillées.\nPeut résumer – en donnant son opinion – un bref récit, un article, un exposé, une discussion, une interview ou un documentaire et répondre à d’éventuelles questions complémentaires de détail.\nB2.1 :\nPeut transmettre avec sûreté une information détaillée.\nPeut faire la description claire et détaillée d’une démarche.\nPeut faire la synthèse d’informations et d’arguments issus de sources différentes et en rendre compte.\nB2.2 :\nPeut comprendre et échanger une information complexe et des avis sur une gamme étendue de sujets relatifs à son rôle professionnel.', 77, 1),
(85, 'C5.8', 'Interviewer et être interviewé, tel un entretien', '', 'B1.1 ;\nPeut prendre certaines initiatives dans une consultation ou un entretien (par exemple introduire un sujet nouveau) mais reste très dépendant de l’interviewer dans l’interaction.\nPeut utiliser un questionnaire préparé pour conduire un entretien structuré, avec quelques questions spontanées complémentaires.\nB1.2 :\nPeut fournir des renseignements concrets exigés dans un entretien ou une consultation (par exemple, décrire des symptômes à un médecin) mais le fait avec une précision limitée.\nPeut conduire un entretien préparé, vérifier et confirmer les informations, bien qu’il lui soit parfois nécessaire de demander de répéter si la réponse de l’interlocuteur est trop rapide ou trop développée.\nB2.1 :\nPeut prendre des initiatives dans un entretien, élargir et développer ses idées, sans grande aide ni stimulation de la part de l’interlocuteur.\nB2.2 :\nPeut conduire un entretien avec efficacité et aisance, en s’écartant spontanément des questions préparées et en exploitant et relançant les réponses intéressantes.', 77, 1),
(86, 'C5.9', 'Comprendre le fonctionnement des tours de parole', '', 'B1.1 :\nPeut commencer, poursuivre et terminer une simple conversation en tête-à-tête sur des sujets familiers ou d’intérêt personnel.\nB1.2 :\nPeut intervenir dans une discussion sur un sujet familier en utilisant une expression adéquate pour prendre la parole.\nB2 :\nPeut intervenir de manière adéquate dans une discussion, en utilisant des moyens d’expression appropriés.\nPeut commencer, soutenir et terminer une conversation avec naturel et avec des tours de parole efficaces.\nPeut commencer un discours, prendre la parole au bon moment et terminer la conversation quand il/elle le souhaite, bien que parfois sans élégance.\nPeut utiliser des expressions toutes faites (par exemple, « C’est une question difficile ») pour gagner du temps pour formuler son propos et garder la parole.', 77, 1),
(87, 'C5.10', 'Reformuler des propos pour faciliter la compréhension et faire avancer la communication', '', 'B1.1 :\nPeut reformuler en partie les dires de l’interlocuteur pour confirmer une compréhension mutuelle et faciliter le développement des idées en cours. \nPeut inviter quelqu’un à se joindre à la discussion.\nB1.2 :\nPeut exploiter un répertoire élémentaire de langue et de stratégies pour faciliter la suite de la conversation ou de la discussion.\nPeut résumer et faire le point dans une conversation et faciliter ainsi la focalisation sur le sujet.\nB2.1 :\nPeut soutenir la conversation sur un terrain connu en confirmant sa compréhension, en invitant les autres à participer, etc.\nB2.2 :\nPeut faciliter le développement de la discussion en donnant suite à des déclarations et inférences faites par d’autres interlocuteurs, et en faisant des remarques à propos de celles-ci.', 77, 1),
(88, 'C5.11', 'Demander des clarifications sur des propos incompris', '', 'B1 :\nPeut demander à quelqu’un de clarifier ou de développer ce qui vient d’être dit.\nB2 :\nPeut poser des questions pour vérifier qu’il/elle a compris ce que le locuteur voulait dire et faire clarifier les points équivoques.', 77, 1),
(89, 'C2.1', 'Décrire une expérience à l’écrit de manière détaillée, claire et concis', '', 'B1 :\nPeut écrire des descriptions détaillées simples et directes sur une gamme étendue de sujets familiers dans le cadre de son domaine d’intérêt.\nPeut faire le compte rendu d’expériences en décrivant ses sentiments et ses réactions dans un texte simple et articulé.\nPeut écrire la description d’un événement, un voyage récent, réel ou imaginé.\nPeut raconter une histoire.\nB2.1 :\nPeut écrire des descriptions claires et détaillées sur une variété de sujets en rapport avec son domaine d’intérêt.\nPeut écrire une critique de film, de livre ou de pièce de théâtre.\nB2.2 :\nPeut écrire des descriptions élaborées d’événements et d’expériences réels ou imaginaires en indiquant la relation entre les idées dans un texte articulé et en respectant les règles du genre en question.', 69, 1),
(90, 'C2.2', 'Rédiger un essai ou un rapport  en argumentant ses idées, son opinion', '', 'B1.1 :\nPeut écrire des rapports très brefs de forme standard conventionnelle qui transmettent des informations factuelles courantes et justifient des actions.\nB1.2 :\nPeut écrire de brefs essais simples sur des sujets d’intérêt général.\nPeut résumer avec une certaine assurance une source d’informations factuelles sur des sujets familiers courants et non courants dans son domaine, en faire le rapport et donner son opinion.\nB2.1 :\nPeut écrire un essai ou un rapport qui développe une argumentation en apportant des justifications pour ou contre un point de vue particulier et en expliquant les avantages ou les inconvénients de différentes options.\nPeut synthétiser des informations et des arguments issus de sources diverses.\nB2.2 :\nPeut écrire un essai ou un rapport qui développe une argumentation de façon méthodique en soulignant de manière appropriée les points importants et les détails pertinents qui viennent l’appuyer.\nPeut évaluer des idées différentes ou des solutions à un problème.', 69, 1),
(91, 'C2.3', 'Prendre des notes lors de l’écoute d’un discours', '', 'B1.1 :\nPeut prendre des notes sous forme d’une liste de points clés lors d’un exposé simple à condition que le sujet soit familier, la formulation directe et la diction claire en langue courante.\nB1.2 :\nLors d’une conférence, peut prendre des notes suffisamment précises pour les réutiliser ultérieurement à condition que le sujet appartienne à ses centres d’intérêt et que l’exposé soit clair et bien structuré.\nB2 :\nPeut comprendre un exposé bien structuré sur un sujet familier et peut prendre en note les points qui lui paraissent importants même s’il (ou elle) s’attache aux mots eux-mêmes au risque de perdre de l’information.', 69, 1),
(92, 'C2.4', 'Traiter un texte pour collecter, analyser et synthétiser de l’information', '', 'B1.1 :\nPeut paraphraser simplement de courts passages écrits en utilisant les mots et le plan du texte.\nB1.2 :\nPeut collationner des éléments d’information issus de sources diverses et les résumer pour quelqu’un d’autre.\nB2 :\nPeut résumer un large éventail de textes factuels et de fiction en commentant et en critiquant les points de vue opposés et les thèmes principaux.\nPeut résumer des extraits de nouvelles (information), d’entretiens ou de documentaires traduisant des opinions, les discuter et les critiquer.\nPeut résumer l’intrigue et la suite des événements d’un film ou d’une pièce.', 69, 1),
(93, 'C2.5', 'Corriger ses productions pour faciliter la compréhension de son destinataire', '', 'B1.1\nPeut se faire confirmer la correction d’une forme utilisée.\nPeut recommencer avec une tactique différente s’il y a une rupture de communication.\nB1.2 :\nPeut corriger les confusions de temps ou d’expressions qui ont conduit à un malentendu à condition que l’interlocuteur indique qu’il y a un problème.\nB2 :\nPeut généralement corriger lapsus et erreurs après en avoir pris conscience ou s’ils ont débouché sur un malentendu.\nPeut relever ses erreurs habituelles et surveiller consciemment son discours afin de les corriger.', 69, 1),
(94, 'C3.1', 'Comprendre une interaction entre locuteurs natifs', '', 'B1 :\nPeut généralement suivre les points principaux d’une longue discussion se déroulant en sa présence, à condition que la langue soit standard et clairement articulée.\nB2.1 :\nPeut saisir, avec un certain effort, une grande partie de ce qui se dit en sa présence, mais pourra avoir des difficultés à effectivement participer à une discussion avec plusieurs locuteurs natifs qui ne modifient en rien leur discours.\nB2.2 :\nPeut réellement suivre une conversation animée entre locuteurs natifs.', 75, 1),
(95, 'C3.2', 'Comprendre un discours public, une conférence ou d’autres genres d’exposés', '', 'B1.1 :\nPeut suivre le plan général d’exposés courts sur des sujets familiers à condition que la langue en soit standard et clairement articulée.\nB1.2 :\nPeut suivre une conférence ou un exposé dans son propre domaine à condition que le sujet soit familier et la présentation directe, simple et clairement structurée.\nB2 :\nPeut suivre l’essentiel d’une conférence, d’un discours, d’un rapport et d’autres genres d’exposés éducationnels/professionnels, qui sont complexes du point de vue du fond et de la forme.', 75, 1),
(96, 'C3.3', 'Comprendre des annonces et des instructions orales, enregistrées ou non', '', 'B1 :\nPeut comprendre des informations techniques simples, tels que des modes d’emploi pour un équipement d’usage courant.\nPeut suivre des directives détaillées.\nB2 :\nPeut comprendre des annonces et des messages courants sur des sujets concrets et abstraits, s’ils sont en langue standard et émis à un débit normal.', 75, 1),
(97, 'C3.4', 'Comprendre des émissions de radio et des enregistrements', '', 'B1.1 :\nPeut comprendre les points principaux des bulletins d’information radiophoniques et de documents enregistrés simples, sur un sujet familier, si le débit est assez lent et la langue relativement articulée.\nB1.2 :\nPeut comprendre l’information contenue dans la plupart des documents enregistrés ou radiodiffusés, dont le sujet est d’intérêt personnel et la langue standard clairement articulée.\nB2.1 :\nPeut comprendre la plupart des documentaires radiodiffusés en langue standard et peut identifier correctement l’humeur, le ton, etc., du locuteur.\nB2.2 :\nPeut comprendre les enregistrements en langue standard que l’on peut rencontrer dans la vie sociale, professionnelle ou universitaire et reconnaître le point de vue et l’attitude du locuteur ainsi que le contenu informatif.', 75, 1),
(98, 'C3.5', 'Comprendre des émissions de télévision et des films', '', 'B1.1 :\nPeut suivre de nombreux films dans lesquels l’histoire repose largement sur l’action et l’image et où la langue est claire et directe.\nPeut comprendre les points principaux des programmes télévisés sur des sujets familiers si la langue est assez clairement articulée.\nB1.2 :\nPeut comprendre une grande partie des programmes télévisés sur des sujets d’intérêt personnel, tels que brèves interviews, conférences et journal télévisé si le débit est relativement lent et la langue assez clairement articulée.\nB2 :\nPeut comprendre la plupart des journaux et des magazines télévisés.\nPeut comprendre un documentaire, une interview, une table ronde, une pièce à la télévision et la plupart des films en langue standard.', 75, 1),
(99, 'C3.6', 'Reconnaître des indices liés au contexte de communication et faire des déductions pour faciliter la compréhension d’un message oral ou écrit', '', 'B1 :\nPeut identifier des mots inconnus à l’aide du contexte sur des sujets relatifs à son domaine et à ses intérêts.\nPeut, à l’occasion, extrapoler du contexte le sens de mots inconnus et en déduire le sens de la phrase à condition que le sujet en question soit familier.\nB2 :\nPeut utiliser différentes stratégies de compréhension dont l’écoute des points forts et le contrôle de la compréhension par les indices contextuels.', 75, 1),
(100, 'C4.1', 'Comprendre une un message personnel écrit plus ou moins détaillé, tel une carte postale ou une lettre', '', 'B1 :\nPeut comprendre la description d’événements, de sentiments et de souhaits suffisamment bien pour entretenir une correspondance régulière avec un correspondant ami.\nB2 :\nPeut lire une correspondance courante dans son domaine et saisir l’essentiel du sens.', 76, 1),
(101, 'C4.2', 'Relever les points importants lors de la lecture d’un texte', '', 'B1.1 :\nPeut trouver et comprendre l’information pertinente dans des écrits quotidiens tels que lettres, prospectus et courts documents officiels.\nB1.2 :\nPeut parcourir un texte assez long pour y localiser une information cherchée et peut réunir des informations provenant de différentes parties du texte ou de textes différents afin d’accomplir une tâche spécifique.\nB2 :\nPeut parcourir rapidement un texte long et complexe et en relever les points pertinents.\nPeut identifier rapidement le contenu et la pertinence d’une information, d’un article ou d’un reportage dans une gamme étendue de sujets professionnels afin de décider si une étude plus approfondie vaut la peine.', 76, 1),
(102, 'C4.3', 'Comprendre un texte écrit pour recueillir l’information recherchée', '', 'B1.1 :\nPeut reconnaître les points significatifs d’un article de journal direct et non complexe sur un sujet familier.\nB1.2 :\nPeut identifier les principales conclusions d’un texte argumentatif clairement articulé.\nPeut reconnaître le schéma argumentatif suivi pour la présentation d’un problème sans en comprendre nécessairement le détail.\nB2.1 :\nPeut comprendre des articles et des rapports sur des problèmes contemporains et dans lesquels les auteurs adoptent une position ou un point de vue particuliers.\nB2.2 :\nPeut obtenir renseignements, idées et opinions de sources hautement spécialisées dans son domaine.\nPeut comprendre des articles spécialisés hors de son domaine à condition de se référer à un dictionnaire de temps en temps pour vérifier la compréhension.', 76, 1),
(103, 'C4.4', 'Lire des instructions pour les comprendre et les suivre', '', 'B1 :\nPeut comprendre le mode d’emploi d’un appareil s’il est direct, non complexe et rédigé clairement.\nB2 :\nPeut comprendre des instructions longues et complexes dans son domaine, y compris le détail des conditions et des mises en garde, à condition de pouvoir en relire les passages difficiles.', 76, 1),
(104, 'C6', 'Compétences d’interaction à l’écrit', '', '', NULL, 1),
(105, 'C6.1', 'Rédiger un message personnel plus ou moins détaillé, adressé à un destinataire précis, tel une carte postale ou une lettre', '', 'B1.1 :\nPeut écrire des lettres personnelles décrivant en détail expériences, sentiments et événements.\nB1.2 :\nPeut écrire une lettre personnelle pour donner des nouvelles ou exprimer sa pensée sur un sujet abstrait ou culturel, tel un film ou de la musique.\nB2 :\nPeut écrire des lettres exprimant différents degrés d’émotion, souligner ce qui est important pour lui/elle dans un événement ou une expérience et faire des commentaires sur les nouvelles et les points de vue du correspondant.', 104, 1),
(106, 'C6.2', 'Rédiger des notes, messages et formulaires pour transmettre de l’information à l’écrit', '', 'B1.1 :\nPeut laisser des notes qui transmettent une information simple et immédiatement pertinente à des amis, à des employés, à des professeurs et autres personnes fréquentées dans la vie quotidienne, en communiquant de manière compréhensible les points qui lui semblent importants.\nB1.2 :\nPeut prendre un message concernant une demande d’information, l’explication d’un problème.\nB2 :\nComme B1', 104, 1),
(107, 'C7', 'Compétences linguistiques', '', '', NULL, 1),
(108, 'C7.1', 'Etre conscient de l’étendu de son vocabulaire', '', 'B1 :\nPossède un vocabulaire suffisant pour s’exprimer à l’aide de périphrases sur la plupart des sujets relatifs à sa vie quotidienne tels que la famille, les loisirs et les centres d’intérêt, le travail, les voyages et l’actualité.\nB2 :\nPossède une bonne gamme de vocabulaire pour les sujets relatifs à son domaine et les sujets les plus généraux. \nPeut varier sa formulation pour éviter de répétitions fréquentes, mais des lacunes lexicales peuvent encore provoquer des hésitations et l’usage de périphrases.', 107, 1),
(109, 'C7.2', 'Etre conscient de son degré de maitrise de la grammaire française', '', 'B1 :\nDispose de compétences grammaticales encore en cours d’acquisition. Fait preuve d’une bonne maitrise des structures de base de la langue qui lui permettent de communiquer de manière efficace.\nB2 :\nPossède de bonnes compétences grammaticales.\nA acquis l’essentiel des structures de la langue et peut les mobiliser pour réaliser les échanges langagiers.', 107, 1),
(110, 'C7.3', 'Etre conscient de son degré de maitrise de la conjugaison française', '', 'B1 :\nMaitrise les connaissances de base de la conjugaison française qu’il peut mobiliser pour exprimer et décrire des situations de la vie courante Commet quelques erreurs en rapport surtout lors de l’emploi de temps plus rares.\nB2 :\nPossède une bonne connaissance de la conjugaison française. Peut s’exprimer avec clarté et précision en faisant appel à une large gamme de temps et modes verbaux.', 107, 1),
(111, 'C7.4', 'Maitriser l’orthographe des mots utilisés pour s’exprimer correctement à l’écrit', '', 'B1 :\nPeut produire un écrit suivi généralement compréhensible tout du long.\nL’orthographe, la ponctuation et la mise en page sont assez justes pour être suivies facilement le plus souvent.\nB2 :\nPeut produire un écrit suivi, clair et intelligible qui suive les règles d’usage de la mise en page et de l’organisation.\nL’orthographe et la ponctuation sont relativement exacts mais peuvent subir l’influence de la langue maternelle.', 107, 1),
(112, 'C7.5', 'Corriger ses erreurs grammaticales', '', 'B1.1 :\nPeut se servir avec une correction suffisante d’un répertoire de tournures et expressions fréquemment utilisées et associées à des situations plutôt prévisibles.\nB1.2 :\nCommunique avec une correction suffisante dans des contextes familiers ; en règle générale, a un bon contrôle grammatical malgré de nettes influences de la langue maternelle. Des erreurs peuvent se produire mais le sens général reste clair.\nB2.1 :\nA un assez bon contrôle grammatical. Ne fait pas de fautes conduisant à des malentendus\nB2.2 :\nA un bon contrôle grammatical ; des bévues occasionnelles, des erreurs non systématiques et de petites fautes syntaxiques peuvent encore se produire mais elles sont rares et peuvent souvent être corrigées rétrospectivement.', 107, 1),
(113, 'C7.6', 'Maitriser la prononciation de la langue française pour s’exprimer clairement à l’oral', '', 'B1 :\nLa prononciation est clairement intelligible même si un accent étranger est quelquefois perceptible et si des erreurs de prononciation proviennent occasionnellement.\nB2 :\nA acquis une prononciation et une intonation claires et naturelles.', 107, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composante`
--

CREATE TABLE `composante` (
  `idComposante` int(11) NOT NULL,
  `nomComposante` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `composante`
--

INSERT INTO `composante` (`idComposante`, `nomComposante`) VALUES
(4, 'Faculté des Sciences et Techniques'),
(5, 'Faculté des Lettres, Langues et Sciences Humaines'),
(6, 'Antenne de la Faculté de Droit à Laval'),
(7, 'IUT du Mans'),
(8, 'IUT de Laval'),
(9, 'ENSIM'),
(10, 'Faculté de Droit, Sciences Economiques et de Gestion');

-- --------------------------------------------------------

--
-- Structure de la table `erreur`
--

CREATE TABLE `erreur` (
  `idErreur` int(11) NOT NULL,
  `nomErreur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `erreur`
--

INSERT INTO `erreur` (`idErreur`, `nomErreur`) VALUES
(4, 'Erreur: L\'encadrant doit être référencé comme enseignant'),
(7, 'Erreur: L\'étudiant doit être référencé comme étudiant ou tuteur'),
(8, 'Erreur: La compétence à valider doit être référencé comme compétence feuille'),
(13, 'Erreur: Le groupe est déjà complet'),
(1, 'Erreur: Le tuteur doit être référencé comme tuteur'),
(9, 'Erreur: Le tuteur doit être référencé comme tuteur ou enseignant ou administrateur'),
(15, 'Erreur: Vous devez retirer des étudiants du groupe avant de pouvoir diminuer sa taille');

-- --------------------------------------------------------

--
-- Structure de la table `explication`
--

CREATE TABLE `explication` (
  `idExplication` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `commentaire` text,
  `nomFichier` varchar(250) DEFAULT NULL,
  `nomFichierOrigine` varchar(250) DEFAULT NULL,
  `idTuteur` int(11) DEFAULT NULL,
  `idValidation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `explication`
--

INSERT INTO `explication` (`idExplication`, `date`, `commentaire`, `nomFichier`, `nomFichierOrigine`, `idTuteur`, `idValidation`) VALUES
(3, '2017-01-17 14:00:12', 'Je sais formuler des phrases compréhensible en français. Veuillez accepter ma requête', NULL, NULL, NULL, 9),
(4, '2017-02-10 20:00:01', 'Valider moi svp', NULL, NULL, NULL, 10);

--
-- Déclencheurs `explication`
--
DELIMITER $$
CREATE TRIGGER `before_insert_explication` BEFORE INSERT ON `explication` FOR EACH ROW BEGIN
	IF((new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 1 OR idRole = 2 OR idRole = 4)) AND (new.idTuteur IS NOT NULL))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ('Erreur: Le tuteur doit être référencé comme tuteur ou enseignant ou administrateur');
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_explication` BEFORE UPDATE ON `explication` FOR EACH ROW BEGIN
	IF((new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 1 OR idRole = 2 OR idRole = 4)) AND (new.idTuteur IS NOT NULL))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ('Erreur: Le tuteur doit être référencé comme tuteur ou enseignant ou administrateur');
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL,
  `nomGroupe` varchar(250) NOT NULL,
  `cle` varchar(250) NOT NULL,
  `taille` int(11) NOT NULL,
  `idTuteur` int(11) NOT NULL,
  `idEncadrant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`idGroupe`, `nomGroupe`, `cle`, `taille`, `idTuteur`, `idEncadrant`) VALUES
(2, 'Jean-Marc', '17111987', 25, 24, 44);

--
-- Déclencheurs `groupe`
--
DELIMITER $$
CREATE TRIGGER `before_insert_groupe` BEFORE INSERT ON `groupe` FOR EACH ROW BEGIN
	IF(new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 2)) 	 	 THEN
			INSERT INTO erreur (nomErreur) VALUES ('Erreur: Le tuteur doit être référencé comme tuteur');
	END IF;
    
    IF(new.idEncadrant NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 4))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: L'encadrant doit être référencé comme enseignant");
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_groupe` BEFORE UPDATE ON `groupe` FOR EACH ROW BEGIN 
    DECLARE varNbPersonne integer; 
    
    IF(new.taille != old.taille) 
    	THEN 
    		SET @varNbPersonne := (SELECT COUNT(*) FROM utilisateur WHERE idGroupe = new.idGroupe);
            IF(@varNbPersonne > new.taille) 
            	THEN 
            		INSERT INTO erreur (nomErreur) VALUES ('Erreur: Vous devez retirer des étudiants du groupe avant de pouvoir diminuer sa taille');
            END IF;
	END IF;
    
    IF(new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 2)) 	 	 THEN
			INSERT INTO erreur (nomErreur) VALUES ('Erreur: Le tuteur doit être référencé comme tuteur');
	END IF;
    
    IF(new.idEncadrant NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 4))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: L'encadrant doit être référencé comme enseignant");
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `groupecomposante`
--

CREATE TABLE `groupecomposante` (
  `idGroupe` int(11) NOT NULL,
  `idComposante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupecomposante`
--

INSERT INTO `groupecomposante` (`idGroupe`, `idComposante`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `idPage` int(11) NOT NULL,
  `nomPage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`idPage`, `nomPage`) VALUES
(2, 'gestion-competences'),
(3, 'valider-competences-utilisateurs'),
(4, 'gestion-utilisateurs'),
(5, 'rejoindre-groupe'),
(6, 'gestion-groupes'),
(7, 'mes-competences'),
(8, 'mon-groupe'),
(9, 'statistique'),
(10, 'bilan');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`idRole`, `nomRole`) VALUES
(1, 'Administrateur'),
(2, 'Tuteur'),
(3, 'Etudiant'),
(4, 'Enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `identifiant` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `mdp` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idRole` int(11) NOT NULL,
  `idGroupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `identifiant`, `prenom`, `nom`, `mdp`, `idRole`, `idGroupe`) VALUES
(2, 'Admin', 'Admin', 'Admin', '5u9CgyJ4', 1, NULL),
(4, 'Hae.J', 'Haemi', 'JO', '3Jv5f4vG', 3, 2),
(5, 'Soy.J', 'Soyoung', 'JONG', 'Qx4Axy76', 3, NULL),
(6, 'Dah.K', 'Dahyeon', 'KANG', '5S5hyJg8', 3, NULL),
(7, 'Bob.K', 'Bobae', 'KIM', 'C45qe2jR', 3, NULL),
(8, 'Lin.L', 'Linjie', 'LU', '7uMEv8v2', 3, NULL),
(9, 'Soh.P', 'Sohyeon', 'PARK', 'R3a93Kyi', 3, NULL),
(10, 'Nat.W', 'Natasha', 'WELCH', 'ar64MXt2', 3, 2),
(24, 'Cel.L', 'Céline', 'LOUZIER', 'dwMS448y', 2, NULL),
(25, 'Cam.D', 'Camille', 'DANGEARD', '5u9CgyJ4', 2, NULL),
(44, 'Pie.S', 'Pierre', 'SALAM', 'dwMS448y', 4, NULL),
(46, 'Soj.P', 'Sojin', 'PARK', 'mYnT558u', 3, NULL),
(47, 'Amm.A', 'Ammar', 'ALEID', '8L95baIu', 3, NULL),
(48, 'Bla.A', 'Blakeman', 'ALAHNA', '8a7s6kOH', 3, NULL),
(49, 'Mia.f', 'Mia Louise', 'FORD', 'zkT31m8M', 3, NULL),
(50, 'Jih.H', 'Jihyeon', 'HWANG', 'tFJ164qc', 3, NULL),
(51, 'Olg.K', 'Olga', 'KARKANEVATOS', '9v27uBTm', 3, NULL),
(52, 'Soh.P', 'Sohyun', 'PARK', '8HR3pgs4', 3, NULL),
(53, 'Hay.T', 'Hayley', 'TOMLINSON', 'mX8kC8h7', 3, 2),
(54, 'Via.Z', 'Vian', 'ZINA', 'nM69Yk2h', 3, NULL),
(55, 'Con.M', 'Connor', 'MAHER-DEWAR', '9td2VXp0', 3, NULL),
(56, 'She.F', 'Shenika', 'FRANCIS', 'pwe4M4S2', 3, NULL);

--
-- Déclencheurs `utilisateur`
--
DELIMITER $$
CREATE TRIGGER `before_update_utilisateur` BEFORE UPDATE ON `utilisateur` FOR EACH ROW BEGIN
	DECLARE varTaille integer;
    DECLARE varNbPersonne integer;
    
	IF(new.idGroupe IS NOT NULL)
    	THEN
        	SET @varTaille := (SELECT taille FROM groupe WHERE idGroupe = new.idGroupe);
			SET @varNbPersonne := (SELECT COUNT(*) FROM utilisateur WHERE idGroupe = new.idGroupe);
     		IF(@varNbPersonne >= @varTaille)
            	THEN
                	INSERT INTO erreur (nomErreur) VALUES ('Erreur: Le groupe est déjà complet');
            END IF;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `validation`
--

CREATE TABLE `validation` (
  `idValidation` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idCompetence` int(11) NOT NULL,
  `dateValidation` date NOT NULL,
  `idTuteur` int(11) DEFAULT NULL,
  `etat` int(1) NOT NULL COMMENT '1 = validé, 2 = en attente, 3 = refusé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `validation`
--

INSERT INTO `validation` (`idValidation`, `idUtilisateur`, `idCompetence`, `dateValidation`, `idTuteur`, `etat`) VALUES
(9, 4, 89, '2017-01-24', 2, 1),
(10, 4, 100, '2017-03-08', 2, 3),
(13, 10, 89, '2017-03-23', NULL, 3),
(14, 46, 89, '2017-03-23', NULL, 3),
(15, 9, 89, '2017-03-23', NULL, 1),
(16, 46, 90, '2017-03-24', NULL, 1);

--
-- Déclencheurs `validation`
--
DELIMITER $$
CREATE TRIGGER `before_insert_validation` BEFORE INSERT ON `validation` FOR EACH ROW BEGIN
	IF(new.idUtilisateur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 2 OR idRole = 3))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: L'étudiant doit être référencé comme étudiant ou tuteur");
	END IF;
    
    IF(new.idCompetence IN (Select DISTINCT(comp1.idCompetence) From competence comp1 INNER JOIN competence comp2 on comp1.idCompetence = comp2.idPereCompetence))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: La compétence à valider doit être référencé comme compétence feuille");
	END IF;
    
    IF((new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 1 OR idRole = 2 OR idRole = 4)) AND (new.idTuteur IS NOT NULL))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: Le tuteur doit être référencé comme tuteur ou enseignant ou administrateur");
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_validation` BEFORE UPDATE ON `validation` FOR EACH ROW BEGIN
	IF(new.idUtilisateur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 2 OR idRole = 3))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: L'étudiant doit être référencé comme étudiant ou tuteur");
	END IF;
    
    IF(new.idCompetence IN (Select DISTINCT(comp1.idCompetence) From competence comp1 INNER JOIN competence comp2 on comp1.idCompetence = comp2.idPereCompetence))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: La compétence à valider doit être référencé comme compétence feuille");
	END IF;
    
    IF((new.idTuteur NOT IN (SELECT idUtilisateur FROM utilisateur WHERE idRole = 1 OR idRole = 2 OR idRole = 4)) AND (new.idTuteur IS NOT NULL))
    	THEN
			INSERT INTO erreur (nomErreur) VALUES ("Erreur: Le tuteur doit être référencé comme tuteur ou enseignant ou administrateur");
	END IF;
END
$$
DELIMITER ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acces`
--
ALTER TABLE `acces`
  ADD PRIMARY KEY (`idRole`,`idPage`),
  ADD KEY `fk_page_id` (`idPage`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`idCompetence`),
  ADD KEY `fk_pereCompetence_id` (`idPereCompetence`);

--
-- Index pour la table `composante`
--
ALTER TABLE `composante`
  ADD PRIMARY KEY (`idComposante`);

--
-- Index pour la table `erreur`
--
ALTER TABLE `erreur`
  ADD PRIMARY KEY (`idErreur`),
  ADD UNIQUE KEY `nomErreur` (`nomErreur`);

--
-- Index pour la table `explication`
--
ALTER TABLE `explication`
  ADD PRIMARY KEY (`idExplication`),
  ADD KEY `fk_tuteur_id_explication` (`idTuteur`),
  ADD KEY `fk_validation_id` (`idValidation`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idGroupe`),
  ADD KEY `fk_id_Tuteur` (`idTuteur`),
  ADD KEY `fk_id_encadrant` (`idEncadrant`);

--
-- Index pour la table `groupecomposante`
--
ALTER TABLE `groupecomposante`
  ADD PRIMARY KEY (`idGroupe`,`idComposante`),
  ADD KEY `fk_idComposante` (`idComposante`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`idPage`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `fk_role_id` (`idRole`),
  ADD KEY `fk_groupe_id` (`idGroupe`);

--
-- Index pour la table `validation`
--
ALTER TABLE `validation`
  ADD PRIMARY KEY (`idValidation`),
  ADD KEY `fk_utilisateur_id` (`idUtilisateur`),
  ADD KEY `fk_competence_id` (`idCompetence`),
  ADD KEY `fk_tuteur_id` (`idTuteur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `idCompetence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT pour la table `composante`
--
ALTER TABLE `composante`
  MODIFY `idComposante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `erreur`
--
ALTER TABLE `erreur`
  MODIFY `idErreur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `explication`
--
ALTER TABLE `explication`
  MODIFY `idExplication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `idGroupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `idPage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `validation`
--
ALTER TABLE `validation`
  MODIFY `idValidation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acces`
--
ALTER TABLE `acces`
  ADD CONSTRAINT `fk_page_id` FOREIGN KEY (`idPage`) REFERENCES `page` (`idPage`),
  ADD CONSTRAINT `fk_role_id_acces` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`);

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `fk_pereCompetence_id` FOREIGN KEY (`idPereCompetence`) REFERENCES `competence` (`idCompetence`);

--
-- Contraintes pour la table `explication`
--
ALTER TABLE `explication`
  ADD CONSTRAINT `fk_tuteur_id_explication` FOREIGN KEY (`idTuteur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `fk_validation_id` FOREIGN KEY (`idValidation`) REFERENCES `validation` (`idValidation`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `fk_id_Tuteur` FOREIGN KEY (`idTuteur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `fk_id_encadrant` FOREIGN KEY (`idEncadrant`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `groupecomposante`
--
ALTER TABLE `groupecomposante`
  ADD CONSTRAINT `fk_idComposante` FOREIGN KEY (`idComposante`) REFERENCES `composante` (`idComposante`),
  ADD CONSTRAINT `fk_idGroupe` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_groupe_id` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`);

--
-- Contraintes pour la table `validation`
--
ALTER TABLE `validation`
  ADD CONSTRAINT `fk_competence_id` FOREIGN KEY (`idCompetence`) REFERENCES `competence` (`idCompetence`),
  ADD CONSTRAINT `fk_tuteur_id` FOREIGN KEY (`idTuteur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `fk_utilisateur_id` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
