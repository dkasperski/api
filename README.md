api
===

Installation:

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:create
    php bin/console doctrine:fixtures:load


or just execute sql:


     CREATE SCHEMA `user` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci ;
     
     CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     
     INSERT INTO `user`.`users` (`name`, `email`, `phone`) VALUES ('Jan Kowalski', 'jan.kowalski@gmail.com', '614234567');
     INSERT INTO `user`.`users` (`name`, `email`, `phone`) VALUES ('Piotr Nowak', 'piotr.nowak@gmail.com', '615334557');
     INSERT INTO `user`.`users` (`name`, `email`, `phone`) VALUES ('Marcin Lewandowski', 'marcin.lewandowski@gmail.com', '714534547');
     INSERT INTO `user`.`users` (`name`, `email`, `phone`) VALUES ('Paweł Kucharski', 'pawel.kucharski@gmail.com', '519534589');