<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?", [DB::getDatabaseName()]);

echo "=== TABLAS EN LA BASE DE DATOS ===\n\n";

foreach ($tables as $table) {
    $tableName = $table->TABLE_NAME;
    echo "TABLE: $tableName\n";
    
    $columns = DB::select("
        SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA, COLUMN_DEFAULT
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
        ORDER BY ORDINAL_POSITION
    ", [DB::getDatabaseName(), $tableName]);
    
    foreach ($columns as $col) {
        $pk = ($col->COLUMN_KEY === 'PRI') ? ' [PRIMARY KEY]' : '';
        $nullable = ($col->IS_NULLABLE === 'YES') ? ' (nullable)' : '';
        echo "  - {$col->COLUMN_NAME}: {$col->COLUMN_TYPE}{$pk}{$nullable}\n";
    }
    echo "\n";
}
?>
