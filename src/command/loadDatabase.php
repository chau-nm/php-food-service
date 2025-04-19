<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . "/../conf/appConfig.php";

$options = getopt("f:", ["file:"]);
$filename = $options["f"] ?? $options["file"] ?? "dump.sql";
$filepath = __DIR__ . "/../../db/dump/" . $filename;

if (!file_exists($filepath)) {
    echo "file $filepath does not exists\n";
    return;
}

if (!str_ends_with($filepath, ".sql")) {
    echo "file $filepath is not sql file\n";
    return;
}

try {
    $database = \app\conf\Database::connection();
    $database->exec(file_get_contents($filepath));
} catch (\Exception $e) {
    echo $e->getMessage();
}
