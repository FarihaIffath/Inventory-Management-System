<?php
require_once('db.php');
function formatMoney($number, $fractional = false)
{
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

if ($_POST['from'] && $_POST['to']) {
    ?>
    Total Sales:
    <?php
    $a = $_POST['from'];
    $b = $_POST['to'];
    $result1 = mysql_query("SELECT sum(sales) FROM sales where date BETWEEN '$a' AND '$b'");
    while ($row = mysql_fetch_array($result1)) {
        $rrr = $row['sum(sales)'];
        echo formatMoney($rrr, true);
    }
}
?>