<?php
// check_status.php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::first();
echo "User: " . $user->name . "\n";
echo "Email: " . $user->email . "\n";
echo "Status: " . ($user->status ?? 'COLUMN MISSING') . "\n";
