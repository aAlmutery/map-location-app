<?php

// Set up Laravel application
$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Test direct method call
use App\Models\Cooler;
use App\Http\Controllers\CoolerController;
use Illuminate\Support\Facades\DB;

try {
    echo "=== Testing CSV Import ===\n\n";
    
    // Clear existing data
    Cooler::truncate();
    echo "✓ Database cleared\n";
    
    $filePath = __DIR__ . '/storage/test-import.csv';
    
    if (!file_exists($filePath)) {
        echo "✗ File not found: $filePath\n";
        exit(1);
    }
    
    echo "✓ Test file found\n";
    
    // Create controller instance
    $controller = new CoolerController();
    
    // Use Reflection to call private method
    $reflection = new ReflectionClass($controller);
    $method = $reflection->getMethod('importFromCSV');
    $method->setAccessible(true);
    
    // Call import
    echo "\n→ Starting import...\n";
    $method->invoke($controller, $filePath);
    
    // Check results
    $count = Cooler::count();
    echo "\n✓ Import completed!\n";
    echo "✓ Total records imported: $count\n\n";
    
    // Display imported records
    $coolers = Cooler::all();
    foreach ($coolers as $cooler) {
        echo "Record #{$cooler->id}:\n";
        echo "  Name: {$cooler->outlet_name}\n";
        echo "  Region: {$cooler->region}\n";
        echo "  City: {$cooler->city}\n";
        echo "  Pepsi Coolers: {$cooler->pepsi_coolers}\n";
        echo "  Cola Coolers: {$cooler->cola_coolers}\n";
        echo "  Other Branded Coolers: {$cooler->other_branded_coolers}\n";
        echo "\n";
    }
    
    echo "✓ All tests passed!\n";
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}
