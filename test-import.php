<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\Cooler;
use App\Http\Controllers\CoolerController;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = Illuminate\Http\Request::capture()
);

// Test the import
try {
    echo "Testing import from CSV file...\n";
    
    // Clear existing data
    Cooler::truncate();
    echo "Database cleared.\n";
    
    $filePath = __DIR__ . '/storage/test-import.csv';
    
    if (!file_exists($filePath)) {
        echo "ERROR: Test CSV file not found at $filePath\n";
        exit(1);
    }
    
    $controller = new CoolerController();
    
    // Use reflection to call private method
    $reflection = new ReflectionClass($controller);
    $method = $reflection->getMethod('importFromCSV');
    $method->setAccessible(true);
    
    $method->invoke($controller, $filePath);
    
    $count = Cooler::count();
    echo "✓ Import successful! Imported $count records.\n";
    
    // Display the imported data
    $coolers = Cooler::all();
    foreach ($coolers as $cooler) {
        echo "  - ID: " . $cooler->id . ", Name: " . $cooler->outlet_name . ", Pepsi: " . $cooler->pepsi_coolers . ", Cola: " . $cooler->cola_coolers . "\n";
    }
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}
