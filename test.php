<!DOCTYPE html>
<html>
<body>
   raw: <?php var_dump( file_get_contents('php://input'));?>
   Request: <?php print_r($_GET); ?>
   Post: <?php var_dump($_REQUEST); ?>
</body>
</html>