<?php

//Creates an array named colors that will hold all of the rgb values
$colors = array ();
for($i = 0; $i < 100; $i++)
{
   $temp =  "";

    for($j = 0; $j < 6; $j++)
    {
        $temp .= dechex(mt_rand (0, 15)); //Randomly generates/coverts the values to hex and adds it to a temp variable
    }

    $colors[$i] =  $temp; //Adds the completed hex value to the array
}

$counter = 0; //Declares a counter variable for the colors array
$table = "<table>\n"; // Creates variable for the table

//Loops for the rows and columns; adds a <td> for each color in the array
for($rows = 1; $rows <= 10; $rows++) {
    $table .= "\t<tr>";

    for($cols = 1; $cols <= 10; $cols++):
        $table .= "<td style='background-color:#$colors[$counter];'>" . $colors[$counter] . "<br /><span style='color:#ffffff'>" .  $colors[$counter] . "</span></td>";
        $counter++;
    endfor; //Alt syntax

    $table .= "</tr>\n";
}
$table .= "</table>\n";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 1</title>
    <style>
        td{
            height: 80px;
            width: 100px;
            text-align: center;
            font-size: 20px;
        }

    </style>
</head>
<body>
    <?php echo $table ?>
</body>
</html>