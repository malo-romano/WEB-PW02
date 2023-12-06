-- Création de la table pour les artistes
CREATE TABLE Artistes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_scene VARCHAR(100),
    pays_origine VARCHAR(50)
);

-- Création de la table pour les vinyles
CREATE TABLE Vinyles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    bpm INT,
    annee_sortie INT,
    artiste_id INT,
    FOREIGN KEY (artiste_id) REFERENCES Artistes(id)
);

-- Insertion d'artistes fictifs
INSERT INTO Artistes (nom_scene, pays_origine) VALUES
    ('DJ Electron', 'USA'),
    ('Maestro Beats', 'Italie'),
    ('Electrico DJ', 'Espagne'),
    ('TechnoMaster', 'Allemagne'),
    ('FrenchGroove', 'France');

-- Insertion de vinyles fictifs
INSERT INTO Vinyles (nom, bpm, annee_sortie, artiste_id) VALUES
    ('Euphoric Nights', 128, 2015, 1),
    ('Sunset Groove', 120, 2018, 2),
    ('Electric Dreams', 135, 2017, 3),
    ('Midnight Pulse', 124, 2016, 4),
    ('French Touch', 118, 2019, 5),
    ('Summer Beats', 122, 2020, 1),
    ('Deep Vibes', 126, 2019, 2),
    ('Neon Rhythms', 130, 2018, 3),
    ('Sunrise Melodies', 115, 2021, 4),
    ('Groovy Waves', 132, 2017, 5),
    ('Funky Pulse', 118, 2016, 1),
    ('Chill Zone', 112, 2022, 2),
    ('Acid Trip', 136, 2018, 3),
    ('Retro Beats', 124, 2015, 4),
    ('Underground Groove', 126, 2019, 5),
    ('Blissful Moments', 120, 2020, 1),
    ('Golden Age', 114, 2017, 2),
    ('Echoes in Space', 134, 2016, 3),
    ('Melancholic Rhythms', 122, 2019, 4),
    ('Vibrant Harmony', 128, 2021, 5);
