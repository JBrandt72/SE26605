<?php

$table = "<table>\n"; // Empty table var
for($rows = 0; $rows < 5; $rows++) {
    $table .= "\t<tr>";

    $table .= "</tr>\n";
}
$table .= "</table>\n";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
 <?php echo $table ?>
</body>
</html>