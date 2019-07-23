# Horse_Races

STORIES
============
• Each horse has 3 stats: speed, strength, endurance

• Each stat ranges from 0.0 to 10.0

• A horse's speed is their base speed (5 m/s) + their speed stat (in m/s)

• Endurance represents how many hundreds of meters they can run at their best speed, before the weight of the jockey slows them down

• A jockey slows the horse down by 5 m/s, but this effect is reduced by the horse's strength * 8 as a percentage

• Each race is run by 8 randomly generated horses, over 1500m

• Up to 3 races are allowed at the same time

TODO
============
There must be a webpage that include:
• A "create race" button which generates a new race of 8 random horses

• A button "progress" which advances all races by 10 "seconds" until all horses in the race have completed 1500m

• Any currently running races, showing distance covered, horse position, current time

• The last 5 race results (top 3 positions and times to complete 1500m)

• The best ever time, and the stats of the horse that generated it

REQUIREMENTS
============
• Symfony 4.3. (https://symfony.com/download)

• Apache WEB server, version 2.0 or higher. ( http://httpd.apache.org/download.cgi )

• PHP 7.3. ( http://www.php.net/ )

• MySQL 8. ( http://dev.mysql.com/downloads/ )

• IDE (like PhpStorm). (https://www.jetbrains.com/phpstorm/download/)

INSTALLATION
============
1- Download and Extract the Source Code.

2- Create DataBase:

   - in the terminal of the IDE type the following commands:

		a. composer update
		
		b. according to env file of the root of the project DATABASE_URL=mysql://apaa:apaa@127.0.0.1:3306/hcompetition
		
		create a user with password which has access to the database: DATABASE_URL=mysql://user_db:user_password@127.0.0.1:3306/dbName
		
		c. php bin/console doctrin:database:create

    note: you can also use hcompetition.sql which is located in the root of project

3- Create Table:

    -in the terminal of the IDE type these commands to create tables for the entities of the project:
    
    a. php bin/console doctrine:migrations:diff

    b. php bin/console doctrine:migrations:migrate
    
4- register:

   - only the first user registering in the system will be considered as an admin and has an access to create a race or progress button to proceed races
        
