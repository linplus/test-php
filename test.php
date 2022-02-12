<!DOCTYPE html>
<html>
<body>
   raw: <?php strrev( file_get_contents('php://input'));?>
   Request: <?php print_r($_GET); ?>
   Post: <?php strrev($_REQUEST); ?>
</body>
</html>