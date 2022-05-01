# Docker-Back-end
1.Clonare il repository Docker-Back-end ed al suo interno il repository Docker-Front-end;


2.Avviare Docker;


3.Avviare un container Docker di Apache:

docker run -d -p 8080:80 --name my-apache-php-app --rm  -v Percorso-Docker-Back-end:/var/www/html zener79/php:7.4-apache

Se la porta 8080 è gia in uso, sostituire la porta del rigo 3 del file Docker-Back-end/index.php con la porta scelta 
e la porta del rigo 3 del file Docker-Front-end/js.js con la porta scelta;


4.Avviare un container Docker di MySQL:

docker run --name my-mysql-server --rm -v Percorso-mysqldata:/var/lib/mysql -v Percorso-dump:/dump -e MYSQL_ROOT_PASSWORD=hu12hui26tao -p 3306:3306 -d mysql:latest

Se la porta 3306 è gia in uso, sostituire la porta del rigo 4 del file Back-end/Connessione.php con la porta scelta;


5.Ottenere una bash del container di MySQL:

docker exec -it my-mysql-server bash


6.Importare il dump (password: hu12hui26tao): 

mysql -u root -p < /dump/create_employee.sql; exit;


7.Iniziare sull'url localhost:8080/Docker-Front-end/index.html

Se la porta 8080 era già in uso, sostituirlo con la porta scelta.
