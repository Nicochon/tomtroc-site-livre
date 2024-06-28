## TomTroc

## Pour utiliser ce projet : 

- Commencer par cloner le projet. 
- installez le projet chez vous, dans un dossier exécuté par un serveur local (type MAMP, WAMP, LAMP, etc...)
- Une fois installé chez vous, créez un base de données vide appelée : "projet6_Mission"
- Importez le fichier _db.sql_ dans votre base de données.

## Connectez vous a la base de données:

Renseigner les bonnes informations dans le fichier  www/models/DBManager.php ligne 25
"$this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);"

## Copyright : 

Projet utilisé dans le cadre d'une formation Openclassrooms. 
