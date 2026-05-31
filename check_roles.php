<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$roles = DB::select('SELECT id, nombre FROM roles');
echo "=== ROLES EN LA BD ===\n";
foreach($roles as $r) {
    echo "ID: {$r->id}, Nombre: {$r->nombre}\n";
}
?>
