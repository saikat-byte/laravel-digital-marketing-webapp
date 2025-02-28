<?php
// Security Check (Unauthorized Access Block)
if (!isset($_GET['key']) || $_GET['key'] !== 'saikat_gold_fish') {
    die("❌ Unauthorized access!");
}

// Laravel Root Path Go to the root directory of your Laravel project
$rootPath = __DIR__ . '/../';

// Run Artisan Commands
$output = [];

// Cache Clear Commands
exec("php {$rootPath}artisan cache:clear 2>&1", $output);
exec("php {$rootPath}artisan config:clear 2>&1", $output);
exec("php {$rootPath}artisan route:clear 2>&1", $output);
exec("php {$rootPath}artisan view:clear 2>&1", $output);

// Optimization Commands (Config & Routes Optimization)
exec("php {$rootPath}artisan config:cache 2>&1", $output);
exec("php {$rootPath}artisan route:cache 2>&1", $output);
exec("php {$rootPath}artisan view:cache 2>&1", $output);
exec("php {$rootPath}artisan event:cache 2>&1", $output);

// Show Output
echo "<pre>";
print_r($output);
echo "</pre>";

echo "✅ Artisan commands executed successfully!";
?>
