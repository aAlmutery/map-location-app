<?php

namespace App\Http\Controllers;

use App\Models\Cooler;
use Illuminate\Http\Request;

class CoolerController extends Controller
{
    /**
     * Show the import form and data table
     */
    public function index(Request $request)
    {
        $query = Cooler::query();

        // Apply filters
        if ($request->filled('outlet_name')) {
            $query->where('outlet_name', 'like', '%' . $request->outlet_name . '%');
        }

        if ($request->filled('region')) {
            $query->where('region', 'like', '%' . $request->region . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('chain_name')) {
            $query->where('chain_name', 'like', '%' . $request->chain_name . '%');
        }

        if ($request->filled('pepsi_coolers')) {
            $query->where('pepsi_coolers', '>=', $request->pepsi_coolers);
        }

        if ($request->filled('cola_coolers')) {
            $query->where('cola_coolers', '>=', $request->cola_coolers);
        }

        if ($request->filled('other_branded_coolers')) {
            $query->where('other_branded_coolers', '>=', $request->other_branded_coolers);
        }

        if ($request->filled('total_number_of_coolers')) {
            $query->where('total_number_of_coolers', '>=', $request->total_number_of_coolers);
        }

        $coolers = $query->paginate(25);
        $regions = Cooler::distinct()->pluck('region')->sort()->filter();
        $cities = Cooler::distinct()->pluck('city')->sort()->filter();
        $chains = Cooler::distinct()->pluck('chain_name')->sort()->filter();

        return view('coolers.index', compact('coolers', 'regions', 'cities', 'chains'));
    }

    /**
     * Show the upload form
     */
    public function showImportForm()
    {
        return view('coolers.import');
    }

    /**
     * Display a single cooler record
     */
    public function show(Cooler $cooler)
    {
        return view('coolers.show', compact('cooler'));
    }

    /**
     * Show the edit form for a cooler record
     */
    public function edit(Cooler $cooler)
    {
        return view('coolers.edit', compact('cooler'));
    }

    /**
     * Update cooler record
     */
    public function update(Request $request, Cooler $cooler)
    {
        $request->validate([
            'outlet_name' => 'required|string|max:255',
            'pepsi_coolers' => 'required|integer|min:0',
            'cola_coolers' => 'required|integer|min:0',
            'other_branded_coolers' => 'required|integer|min:0',
        ]);

        // Get all fillable fields from the model
        $fillableFields = $cooler->getFillable();
        $data = $request->only($fillableFields);
        
        $cooler->update($data);

        return redirect()->route('coolers.show', $cooler)
            ->with('success', 'Outlet record updated successfully.');
    }

    /**
     * Handle file upload and import
     */
    public function import(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:csv,xlsx,xls|max:10240',
        // ]);
        $request->validate([
            'file' => 'required|file|mimes:csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $filePath = $file->path();
            $extension = $file->getClientOriginalExtension();

            // Clear existing data
            Cooler::truncate();

            // Determine file type and import
            if ($extension === 'csv') {
                $this->importFromCSV($filePath);
            // } elseif (in_array($extension, ['xlsx', 'xls'])) {
            //     $this->importFromExcel($filePath);
            } else {
                throw new \Exception('Unsupported file format');
            }

            return redirect()->route('coolers.index')
                ->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }

    /**
     * Import data from CSV file
     */
    private function importFromCSV($filePath)
    {
        $file = fopen($filePath, 'r');
        
        // Read and skip header row
        $header = fgetcsv($file);
        
        $rowCount = 0;
        while (($row = fgetcsv($file)) !== false) {
            if (empty(array_filter($row))) {
                continue; // Skip empty rows
            }

            try {
              if($row[0]!='') // Ensure outlet name is present
              {
                $data = $this->mapCsvRowToData($row);
                Cooler::create($data);
                $rowCount++;
              }
            } catch (\Exception $e) {
                // Log error but continue with next row
                \Log::warning("Error importing row: " . json_encode($row) . " - " . $e->getMessage());
            }
        }

        fclose($file);
    }

    /**
     * Map CSV row data to database fields
     */
    private function mapCsvRowToData($row)
    {
        return [
            // Basic outlet information
            'outlet_serial_number' => trim($row[0] ?? ''),
            'region' => trim($row[1] ?? ''),
            'city' => trim($row[2] ?? ''),
            'outlet_name' => trim($row[3] ?? ''),
            'dc_name' => trim($row[4] ?? ''),
            'outlet_code_bsdc_lays_code' => trim($row[5] ?? ''),
            'belongs_to_chain' => trim($row[6] ?? ''),
            'chain_name' => trim($row[7] ?? ''),
            'area_name' => trim($row[8] ?? ''),
            'detailed_address' => trim($row[9] ?? ''),
            'area_type' => trim($row[10] ?? ''),
            'area_classification' => trim($row[11] ?? ''),
            'area_houses_type' => trim($row[12] ?? ''),
            'next_to' => trim($row[13] ?? ''),
            'type' => trim($row[14] ?? ''),
            'classification' => trim($row[15] ?? ''),
            'size_per_sqm' => $this->parseDecimal($row[16] ?? ''),
            'outlet_photo' => trim($row[17] ?? ''),
            'geo_location_link' => trim($row[18] ?? ''),
            'geo_location_lat' => $this->parseDecimal($row[19] ?? ''),
            'geo_location_long' => $this->parseDecimal($row[20] ?? ''),
            'top_shop' => $this->parseBoolean($row[21] ?? ''),
            'signage_written_in' => trim($row[22] ?? ''),
            'contact_person_name' => trim($row[23] ?? ''),
            'phone_number' => trim($row[24] ?? ''),
            'cashier_system_count' => $this->parseInteger($row[25] ?? ''),
            'delivery_availability' => $this->parseBoolean($row[26] ?? ''),
            'pos_name' => trim($row[27] ?? ''),
            'butcher_availability' => $this->parseBoolean($row[28] ?? ''),
            'frozen_food_availability' => $this->parseBoolean($row[29] ?? ''),
            'outlet_service' => $this->parseBoolean($row[30] ?? ''),
            'storage_availability' => $this->parseBoolean($row[31] ?? ''),

            // Pepsi Coolers
            'pepsi_coolers' => $this->parseInteger($row[32] ?? ''),
            'pepsi_single_door_coolers' => $this->parseInteger($row[33] ?? ''),
            'pepsi_single_door_pictures' => $this->parsePictureArray(array_slice($row, 34, 6)),
            'pepsi_double_door_coolers' => $this->parseInteger($row[40] ?? ''),
            'pepsi_double_door_pictures' => $this->parsePictureArray(array_slice($row, 41, 6)),
            'pepsi_triple_door_coolers' => $this->parseInteger($row[47] ?? ''),
            'pepsi_triple_door_pictures' => $this->parsePictureArray(array_slice($row, 48, 6)),
            'pepsi_total_doors' => $this->parseInteger($row[54] ?? ''),
            'pepsi_prime_location' => $this->parseBoolean($row[55] ?? ''),
            'pepsi_cooler_location' => trim($row[56] ?? ''),
            'pepsi_foreign_product_availability' => $this->parseBoolean($row[57] ?? ''),
            'pepsi_can_availability' => $this->parseBoolean($row[58] ?? ''),
            'pepsi_nrb_availability' => $this->parseBoolean($row[59] ?? ''),
            'pepsi_pet_availability' => $this->parseBoolean($row[60] ?? ''),

            // Cola Coolers
            'cola_coolers' => $this->parseInteger($row[61] ?? ''),
            'cola_single_door_coolers' => $this->parseInteger($row[62] ?? ''),
            'cola_double_door_coolers' => $this->parseInteger($row[63] ?? ''),
            'cola_triple_door_coolers' => $this->parseInteger($row[64] ?? ''),
            'cola_cooler_pictures' => $this->parsePictureArray(array_slice($row, 65, 5)),
            'cola_total_doors' => $this->parseInteger($row[70] ?? ''),
            'cola_prime_location' => $this->parseBoolean($row[71] ?? ''),
            'cola_cooler_location' => trim($row[72] ?? ''),
            'cola_can_availability' => $this->parseBoolean($row[73] ?? ''),
            'cola_nrb_availability' => $this->parseBoolean($row[74] ?? ''),
            'cola_pet_availability' => $this->parseBoolean($row[75] ?? ''),

            // Other Brand Coolers - Rani
            'rani_single_door_cooler' => $this->parseInteger($row[76] ?? ''),
            'rani_double_door_cooler' => $this->parseInteger($row[77] ?? ''),
            'rani_triple_door_cooler' => $this->parseInteger($row[78] ?? ''),
            'rani_total_doors' => $this->parseInteger($row[79] ?? ''),

            // Nada
            'nada_single_door_cooler' => $this->parseInteger($row[80] ?? ''),
            'nada_double_door_cooler' => $this->parseInteger($row[81] ?? ''),
            'nada_triple_door_cooler' => $this->parseInteger($row[82] ?? ''),
            'nada_total_doors' => $this->parseInteger($row[83] ?? ''),

            // Karawanchi
            'karawanchi_single_door_cooler' => $this->parseInteger($row[84] ?? ''),
            'karawanchi_double_door_cooler' => $this->parseInteger($row[85] ?? ''),
            'karawanchi_triple_door_cooler' => $this->parseInteger($row[86] ?? ''),
            'karawanchi_total_doors' => $this->parseInteger($row[87] ?? ''),

            // RC
            'rc_single_door_cooler' => $this->parseInteger($row[88] ?? ''),
            'rc_double_door_cooler' => $this->parseInteger($row[89] ?? ''),
            'rc_triple_door_cooler' => $this->parseInteger($row[90] ?? ''),
            'rc_total_doors' => $this->parseInteger($row[91] ?? ''),

            // AlSafi Danon
            'alsafi_danon_single_door_cooler' => $this->parseInteger($row[92] ?? ''),
            'alsafi_danon_double_door_cooler' => $this->parseInteger($row[93] ?? ''),
            'alsafi_danon_triple_door_cooler' => $this->parseInteger($row[94] ?? ''),
            'alsafi_danon_total_doors' => $this->parseInteger($row[95] ?? ''),

            // Sinalco
            'sinalco_single_door_cooler' => $this->parseInteger($row[96] ?? ''),
            'sinalco_double_door_cooler' => $this->parseInteger($row[97] ?? ''),
            'sinalco_triple_door_cooler' => $this->parseInteger($row[98] ?? ''),
            'sinalco_total_doors' => $this->parseInteger($row[99] ?? ''),

            // Other Juices
            'other_juices_brand_name' => trim($row[100] ?? ''),
            'other_juices_single_door_cooler' => $this->parseInteger($row[101] ?? ''),
            'other_juices_double_door_cooler' => $this->parseInteger($row[102] ?? ''),
            'other_juices_triple_door_cooler' => $this->parseInteger($row[103] ?? ''),
            'other_juices_total_doors' => $this->parseInteger($row[104] ?? ''),

            // Energy Drinks - FireBall
            'fireball_single_door_cooler' => $this->parseInteger($row[105] ?? ''),
            'fireball_double_door_cooler' => $this->parseInteger($row[106] ?? ''),
            'fireball_triple_door_cooler' => $this->parseInteger($row[107] ?? ''),
            'fireball_total_doors' => $this->parseInteger($row[108] ?? ''),

            // Red Bull
            'redbull_single_door_cooler' => $this->parseInteger($row[109] ?? ''),
            'redbull_double_door_cooler' => $this->parseInteger($row[110] ?? ''),
            'redbull_triple_door_cooler' => $this->parseInteger($row[111] ?? ''),
            'redbull_total_doors' => $this->parseInteger($row[112] ?? ''),

            // RockStar
            'rockstar_single_door_cooler' => $this->parseInteger($row[113] ?? ''),
            'rockstar_double_door_cooler' => $this->parseInteger($row[114] ?? ''),
            'rockstar_triple_door_cooler' => $this->parseInteger($row[115] ?? ''),
            'rockstar_total_doors' => $this->parseInteger($row[116] ?? ''),

            // Predator/Coca Cola Energy
            'predator_single_door_cooler' => $this->parseInteger($row[117] ?? ''),
            'predator_double_door_cooler' => $this->parseInteger($row[118] ?? ''),
            'predator_triple_door_cooler' => $this->parseInteger($row[119] ?? ''),
            'predator_total_doors' => $this->parseInteger($row[120] ?? ''),

            // Smart
            'smart_single_door_cooler' => $this->parseInteger($row[121] ?? ''),
            'smart_double_door_cooler' => $this->parseInteger($row[122] ?? ''),
            'smart_triple_door_cooler' => $this->parseInteger($row[123] ?? ''),
            'smart_total_doors' => $this->parseInteger($row[124] ?? ''),

            // Asan
            'asan_single_door_cooler' => $this->parseInteger($row[125] ?? ''),
            'asan_double_door_cooler' => $this->parseInteger($row[126] ?? ''),
            'asan_triple_door_cooler' => $this->parseInteger($row[127] ?? ''),
            'asan_total_doors' => $this->parseInteger($row[128] ?? ''),

            // Red Strong
            'red_strong_single_door_cooler' => $this->parseInteger($row[129] ?? ''),
            'red_strong_double_door_cooler' => $this->parseInteger($row[130] ?? ''),
            'red_strong_triple_door_cooler' => $this->parseInteger($row[131] ?? ''),
            'red_strong_total_doors' => $this->parseInteger($row[132] ?? ''),

            // Tiger
            'tiger_single_door_cooler' => $this->parseInteger($row[133] ?? ''),
            'tiger_double_door_cooler' => $this->parseInteger($row[134] ?? ''),
            'tiger_triple_door_cooler' => $this->parseInteger($row[135] ?? ''),
            'tiger_total_doors' => $this->parseInteger($row[136] ?? ''),

            // White Tiger
            'white_tiger_single_door_cooler' => $this->parseInteger($row[137] ?? ''),
            'white_tiger_double_door_cooler' => $this->parseInteger($row[138] ?? ''),
            'white_tiger_triple_door_cooler' => $this->parseInteger($row[139] ?? ''),
            'white_tiger_total_doors' => $this->parseInteger($row[140] ?? ''),

            // Other Energy Drinks
            'other_energy_drink_brand_name' => trim($row[141] ?? ''),
            'other_energy_single_door_cooler' => $this->parseInteger($row[142] ?? ''),
            'other_energy_double_door_cooler' => $this->parseInteger($row[143] ?? ''),
            'other_energy_triple_door_cooler' => $this->parseInteger($row[144] ?? ''),
            'other_energy_total_doors' => $this->parseInteger($row[145] ?? ''),

            // Water Coolers - Life
            'life_single_door_cooler' => $this->parseInteger($row[146] ?? ''),
            'life_double_door_cooler' => $this->parseInteger($row[147] ?? ''),
            'life_triple_door_cooler' => $this->parseInteger($row[148] ?? ''),
            'life_total_doors' => $this->parseInteger($row[149] ?? ''),

            // Aquafina
            'aquafina_single_door_cooler' => $this->parseInteger($row[150] ?? ''),
            'aquafina_double_door_cooler' => $this->parseInteger($row[151] ?? ''),
            'aquafina_triple_door_cooler' => $this->parseInteger($row[152] ?? ''),
            'aquafina_total_doors' => $this->parseInteger($row[153] ?? ''),

            // Sulymaniyah
            'sulymaniyah_single_door_cooler' => $this->parseInteger($row[154] ?? ''),
            'sulymaniyah_double_door_cooler' => $this->parseInteger($row[155] ?? ''),
            'sulymaniyah_triple_door_cooler' => $this->parseInteger($row[156] ?? ''),
            'sulymaniyah_total_doors' => $this->parseInteger($row[157] ?? ''),

            // Lulua
            'lulua_single_door_cooler' => $this->parseInteger($row[158] ?? ''),
            'lulua_double_door_cooler' => $this->parseInteger($row[159] ?? ''),
            'lulua_triple_door_cooler' => $this->parseInteger($row[160] ?? ''),
            'lulua_total_doors' => $this->parseInteger($row[161] ?? ''),

            // Alwaha
            'alwaha_single_door_cooler' => $this->parseInteger($row[162] ?? ''),
            'alwaha_double_door_cooler' => $this->parseInteger($row[163] ?? ''),
            'alwaha_triple_door_cooler' => $this->parseInteger($row[164] ?? ''),
            'alwaha_total_doors' => $this->parseInteger($row[165] ?? ''),

            // Masafi
            'masafi_single_door_cooler' => $this->parseInteger($row[166] ?? ''),
            'masafi_double_door_cooler' => $this->parseInteger($row[167] ?? ''),
            'masafi_triple_door_cooler' => $this->parseInteger($row[168] ?? ''),
            'masafi_total_doors' => $this->parseInteger($row[169] ?? ''),

            // Other Water
            'other_water_brand_name' => trim($row[170] ?? ''),
            'other_water_single_door_cooler' => $this->parseInteger($row[171] ?? ''),
            'other_water_double_door_cooler' => $this->parseInteger($row[172] ?? ''),
            'other_water_triple_door_cooler' => $this->parseInteger($row[173] ?? ''),
            'other_water_total_doors' => $this->parseInteger($row[174] ?? ''),

            // MALT Coolers - Barbican
            'barbican_single_door_cooler' => $this->parseInteger($row[175] ?? ''),
            'barbican_double_door_cooler' => $this->parseInteger($row[176] ?? ''),
            'barbican_triple_door_cooler' => $this->parseInteger($row[177] ?? ''),
            'barbican_total_doors' => $this->parseInteger($row[178] ?? ''),

            // Sanabil
            'sanabil_single_door_cooler' => $this->parseInteger($row[179] ?? ''),
            'sanabil_double_door_cooler' => $this->parseInteger($row[180] ?? ''),
            'sanabil_triple_door_cooler' => $this->parseInteger($row[181] ?? ''),
            'sanabil_total_doors' => $this->parseInteger($row[182] ?? ''),

            // Other MALT
            'other_malt_brand_name' => trim($row[183] ?? ''),
            'other_malt_single_door_cooler' => $this->parseInteger($row[184] ?? ''),
            'other_malt_double_door_cooler' => $this->parseInteger($row[185] ?? ''),
            'other_malt_triple_door_cooler' => $this->parseInteger($row[186] ?? ''),
            'other_malt_total_doors' => $this->parseInteger($row[187] ?? ''),

            // Summary fields
            'total_number_of_coolers' => $this->parseInteger($row[188] ?? ''),
            'open_chiller_availability' => $this->parseBoolean($row[189] ?? ''),
            'open_chiller_length' => $this->parseDecimal($row[190] ?? ''),
            'not_branded_coolers_availability' => $this->parseBoolean($row[191] ?? ''),
            'other_branded_coolers' => $this->parseInteger($row[192] ?? ''),

            // Snack availability - Lays
            'lays_availability' => $this->parseBoolean($row[193] ?? ''),
            'lays_availability_location' => trim($row[194] ?? ''),
            'lays_blocks' => $this->parseInteger($row[195] ?? ''),
            'lays_stand' => $this->parseBoolean($row[196] ?? ''),

            // Doritos
            'doritos_availability' => $this->parseBoolean($row[197] ?? ''),
            'doritos_availability_location' => trim($row[198] ?? ''),
            'doritos_blocks' => $this->parseInteger($row[199] ?? ''),
            'doritos_stand' => $this->parseBoolean($row[200] ?? ''),

            // Cheetos
            'cheetos_availability' => $this->parseBoolean($row[201] ?? ''),
            'cheetos_availability_location' => trim($row[202] ?? ''),
            'cheetos_blocks' => $this->parseInteger($row[203] ?? ''),
            'cheetos_stand' => $this->parseBoolean($row[204] ?? ''),

            // Nice
            'nice_availability' => $this->parseBoolean($row[205] ?? ''),
            'nice_stand' => $this->parseBoolean($row[206] ?? ''),
            'nice_blocks' => $this->parseInteger($row[207] ?? ''),

            // Bato
            'bato_availability' => $this->parseBoolean($row[208] ?? ''),
            'bato_stand' => $this->parseBoolean($row[209] ?? ''),
            'bato_blocks' => $this->parseInteger($row[210] ?? ''),

            // Pringles
            'pringles_availability' => $this->parseBoolean($row[211] ?? ''),
            'pringles_stand' => $this->parseBoolean($row[212] ?? ''),
            'pringles_blocks' => $this->parseInteger($row[213] ?? ''),

            // Dana Dana
            'dana_dana_availability' => $this->parseBoolean($row[214] ?? ''),
            'dana_dana_stand' => $this->parseBoolean($row[215] ?? ''),
            'dana_dana_blocks' => $this->parseInteger($row[216] ?? ''),

            // Kish
            'kish_availability' => $this->parseBoolean($row[217] ?? ''),
            'kish_stand' => $this->parseBoolean($row[218] ?? ''),
            'kish_blocks' => $this->parseInteger($row[219] ?? ''),

            // Other products
            'battery' => $this->parseBoolean($row[220] ?? ''),
            'biscuits' => $this->parseBoolean($row[221] ?? ''),
            'chocolate' => $this->parseBoolean($row[222] ?? ''),
            'ice_cream' => $this->parseBoolean($row[223] ?? ''),
            'nuts' => $this->parseBoolean($row[224] ?? ''),
            'personal_care' => $this->parseBoolean($row[225] ?? ''),
            'popcorn' => $this->parseBoolean($row[226] ?? ''),
            'rice_pack' => $this->parseBoolean($row[227] ?? ''),
            'tobacco' => $this->parseBoolean($row[228] ?? ''),
        ];
    }

    /**
     * Parse boolean values from various formats
     */
    private function parseBoolean($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $value = strtolower(trim($value));
        return in_array($value, ['yes', 'true', '1', 'y', 'on', 'available', 'yes available']) ? true : false;
    }

    /**
     * Parse integer values safely
     */
    private function parseInteger($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $value = trim($value);
        return is_numeric($value) ? (int)$value : null;
    }

    /**
     * Parse decimal values safely
     */
    private function parseDecimal($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $value = trim($value);
        return is_numeric($value) ? (float)$value : null;
    }

    /**
     * Parse picture arrays from multiple columns
     */
    private function parsePictureArray($pictures)
    {
        $filtered = array_filter($pictures, function($pic) {
            return !is_null($pic) && trim($pic) !== '';
        });

        return empty($filtered) ? null : array_values($filtered);
    }

    /**
     * Import data from Excel file
     * Converts Excel to CSV format for processing
     */
    private function importFromExcel($filePath)
    {
        try {
            // Try using PHP's SimpleXML for XLSX files
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            
            if ($extension === 'xlsx') {
                $this->importFromXLSX($filePath);
            } else {
                // For .xls files, we need a different approach
                throw new \Exception('For .xls files, please convert to CSV or XLSX format first');
            }
        } catch (\Exception $e) {
            // Fallback: suggest CSV conversion
            throw new \Exception('Excel import encountered an issue. Please convert your Excel file to CSV format and try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Import XLSX files by reading the XML structure
     */
    private function importFromXLSX($filePath)
    {
        // Create a temporary directory to extract the XLSX
        $tempDir = sys_get_temp_dir() . '/' . uniqid();
        mkdir($tempDir);

        try {
            // Extract the XLSX file (it's a ZIP archive)
            $zip = new \ZipArchive();
            if ($zip->open($filePath) !== true) {
                throw new \Exception('Failed to open Excel file');
            }
            $zip->extractTo($tempDir);
            $zip->close();

            // Read the worksheet data
            $xmlFile = $tempDir . '/xl/worksheets/sheet1.xml';
            if (!file_exists($xmlFile)) {
                throw new \Exception('Worksheet not found in Excel file');
            }

            $xml = simplexml_load_file($xmlFile);
            $rows = $xml->sheetData->row;

            $rowCount = 0;
            $headerSkipped = false;

            foreach ($rows as $rowIndex => $row) {
                // Skip header row
                if (!$headerSkipped) {
                    $headerSkipped = true;
                    continue;
                }

                $cells = [];
                foreach ($row->c as $cell) {
                    $cells[] = (string)$cell->v;
                }

                if (empty(array_filter($cells))) {
                    continue;
                }

                try {
                    Cooler::create([
                        'outlet_name' => trim($cells[0] ?? ''),
                        'login' => trim($cells[1] ?? ''),
                        'outlet_type' => trim($cells[2] ?? ''),
                        'pepsi_coolers' => (int)($cells[3] ?? 0),
                        'cola_coolers' => (int)($cells[4] ?? 0),
                        'other_branded_coolers' => (int)($cells[5] ?? 0),
                    ]);
                    $rowCount++;
                } catch (\Exception $e) {
                    \Log::warning("Error importing row: " . json_encode($cells) . " - " . $e->getMessage());
                }
            }
        } finally {
            // Clean up temporary directory
            $this->deleteDirectory($tempDir);
        }
    }

    /**
     * Recursively delete a directory
     */
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . '/' . $item;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }

        rmdir($dir);
    }
}

