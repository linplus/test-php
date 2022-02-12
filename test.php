<!DOCTYPE html>
<html>
<body>
   raw: <?php echo strrev( file_get_contents('php://input'));?>
   Request: <?php echo print_r($_GET); ?>
   Post: <?php echo $_POST[toke]; ?>
   Post: <?php echo strrev($_POST[token]); ?>
</body>
</html>