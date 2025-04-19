<?php
foreach (glob(__DIR__ . "/package/*.php") as $filename) {
    require $filename;
}

require __DIR__ . "/helper.php";