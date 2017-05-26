<?php 
echo `/usr/bin/git pull 2>&1`;
echo `php composer.phar install 2>&1`;
echo `php artisan migrate 2>&1`;
?>
