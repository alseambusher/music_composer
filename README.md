#Web based music composing software
This is designed to run online and allow a wide range of public to learn to play virtual keyboard, compose music and share it online. The software should be educative as it provides users with tutorials to learn music composed by other users apart from the default sample tunes
##How to run
1. Edit config.php and set all the database details and also set the base url i.e url where the application is hosted.
2. Import the export.sql to the database being used. You can either use phpMyAdmin or do this:  
<code>mysql --user=username  --password=my_password my_database_name &lt; export.sql</code>
