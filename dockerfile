# Utilisation de l'image MySQL officielle depuis Docker Hub
FROM mysql:latest

# Création d'une base de données et ajout de scripts d'initialisation (si nécessaire)
ENV MYSQL_DATABASE vinyls

# Copie des fichiers SQL pour l'initialisation (s'ils existent)
COPY init.sql /docker-entrypoint-initdb.d/
