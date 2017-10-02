<?php

$table = "<table>\n"; // Empty table var
for($rows = 1; $rows <= 5; $rows++) {
    $table .= "\t<tr>";

    for($cols = 1; $cols <= 5; $cols++):
        $table .= "<td>" . $rows * $cols . "</td>";
    endfor; //questionable alt syntax

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