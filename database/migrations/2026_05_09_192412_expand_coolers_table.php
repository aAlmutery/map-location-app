<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coolers', function (Blueprint $table) {
            // Basic outlet information
            $table->string('outlet_serial_number')->nullable()->after('id');
            $table->string('region')->nullable()->after('outlet_serial_number');
            $table->string('city')->nullable()->after('region');
            $table->string('dc_name')->nullable()->after('city');
            $table->string('outlet_code_bsdc_lays_code')->nullable()->after('dc_name');
            $table->string('belongs_to_chain')->nullable()->after('outlet_code_bsdc_lays_code');
            $table->string('chain_name')->nullable()->after('belongs_to_chain');
            $table->string('area_name')->nullable()->after('chain_name');
            $table->text('detailed_address')->nullable()->after('area_name');
            $table->string('area_type')->nullable()->after('detailed_address');
            $table->string('area_classification')->nullable()->after('area_type');
            $table->string('area_houses_type')->nullable()->after('area_classification');
            $table->string('next_to')->nullable()->after('area_houses_type');
            $table->string('type')->nullable()->after('next_to');
            $table->string('classification')->nullable()->after('type');
            $table->decimal('size_per_sqm', 10, 2)->nullable()->after('classification');
            $table->string('outlet_photo')->nullable()->after('size_per_sqm');
            $table->string('geo_location_link')->nullable()->after('outlet_photo');
            $table->decimal('geo_location_lat', 10, 8)->nullable()->after('geo_location_link');
            $table->decimal('geo_location_long', 11, 8)->nullable()->after('geo_location_lat');
            $table->boolean('top_shop')->nullable()->after('geo_location_long');
            $table->string('signage_written_in')->nullable()->after('top_shop');
            $table->string('contact_person_name')->nullable()->after('signage_written_in');
            $table->string('phone_number')->nullable()->after('contact_person_name');
            $table->integer('cashier_system_count')->nullable()->after('phone_number');
            $table->boolean('delivery_availability')->nullable()->after('cashier_system_count');
            $table->string('pos_name')->nullable()->after('delivery_availability');
            $table->boolean('butcher_availability')->nullable()->after('pos_name');
            $table->boolean('frozen_food_availability')->nullable()->after('butcher_availability');
            $table->boolean('outlet_service')->nullable()->after('frozen_food_availability');
            $table->boolean('storage_availability')->nullable()->after('outlet_service');

            // Pepsi Coolers
            $table->integer('pepsi_coolers')->nullable()->change();
            $table->integer('pepsi_single_door_coolers')->nullable()->after('pepsi_coolers');
            $table->json('pepsi_single_door_pictures')->nullable()->after('pepsi_single_door_coolers');
            $table->integer('pepsi_double_door_coolers')->nullable()->after('pepsi_single_door_pictures');
            $table->json('pepsi_double_door_pictures')->nullable()->after('pepsi_double_door_coolers');
            $table->integer('pepsi_triple_door_coolers')->nullable()->after('pepsi_double_door_pictures');
            $table->json('pepsi_triple_door_pictures')->nullable()->after('pepsi_triple_door_coolers');
            $table->integer('pepsi_total_doors')->nullable()->after('pepsi_triple_door_pictures');
            $table->boolean('pepsi_prime_location')->nullable()->after('pepsi_total_doors');
            $table->string('pepsi_cooler_location')->nullable()->after('pepsi_prime_location');
            $table->boolean('pepsi_foreign_product_availability')->nullable()->after('pepsi_cooler_location');
            $table->boolean('pepsi_can_availability')->nullable()->after('pepsi_foreign_product_availability');
            $table->boolean('pepsi_nrb_availability')->nullable()->after('pepsi_can_availability');
            $table->boolean('pepsi_pet_availability')->nullable()->after('pepsi_nrb_availability');

            // Cola Coolers
            $table->integer('cola_coolers')->nullable()->change();
            $table->integer('cola_single_door_coolers')->nullable()->after('cola_coolers');
            $table->integer('cola_double_door_coolers')->nullable()->after('cola_single_door_coolers');
            $table->integer('cola_triple_door_coolers')->nullable()->after('cola_double_door_coolers');
            $table->json('cola_cooler_pictures')->nullable()->after('cola_triple_door_coolers');
            $table->integer('cola_total_doors')->nullable()->after('cola_cooler_pictures');
            $table->boolean('cola_prime_location')->nullable()->after('cola_total_doors');
            $table->string('cola_cooler_location')->nullable()->after('cola_prime_location');
            $table->boolean('cola_can_availability')->nullable()->after('cola_cooler_location');
            $table->boolean('cola_nrb_availability')->nullable()->after('cola_can_availability');
            $table->boolean('cola_pet_availability')->nullable()->after('cola_nrb_availability');

            // Other Brand Coolers - Rani
            $table->integer('rani_single_door_cooler')->nullable()->after('cola_pet_availability');
            $table->integer('rani_double_door_cooler')->nullable()->after('rani_single_door_cooler');
            $table->integer('rani_triple_door_cooler')->nullable()->after('rani_double_door_cooler');
            $table->integer('rani_total_doors')->nullable()->after('rani_triple_door_cooler');

            // Nada
            $table->integer('nada_single_door_cooler')->nullable()->after('rani_total_doors');
            $table->integer('nada_double_door_cooler')->nullable()->after('nada_single_door_cooler');
            $table->integer('nada_triple_door_cooler')->nullable()->after('nada_double_door_cooler');
            $table->integer('nada_total_doors')->nullable()->after('nada_triple_door_cooler');

            // Karawanchi
            $table->integer('karawanchi_single_door_cooler')->nullable()->after('nada_total_doors');
            $table->integer('karawanchi_double_door_cooler')->nullable()->after('karawanchi_single_door_cooler');
            $table->integer('karawanchi_triple_door_cooler')->nullable()->after('karawanchi_double_door_cooler');
            $table->integer('karawanchi_total_doors')->nullable()->after('karawanchi_triple_door_cooler');

            // RC
            $table->integer('rc_single_door_cooler')->nullable()->after('karawanchi_total_doors');
            $table->integer('rc_double_door_cooler')->nullable()->after('rc_single_door_cooler');
            $table->integer('rc_triple_door_cooler')->nullable()->after('rc_double_door_cooler');
            $table->integer('rc_total_doors')->nullable()->after('rc_triple_door_cooler');

            // AlSafi Danon
            $table->integer('alsafi_danon_single_door_cooler')->nullable()->after('rc_total_doors');
            $table->integer('alsafi_danon_double_door_cooler')->nullable()->after('alsafi_danon_single_door_cooler');
            $table->integer('alsafi_danon_triple_door_cooler')->nullable()->after('alsafi_danon_double_door_cooler');
            $table->integer('alsafi_danon_total_doors')->nullable()->after('alsafi_danon_triple_door_cooler');

            // Sinalco
            $table->integer('sinalco_single_door_cooler')->nullable()->after('alsafi_danon_total_doors');
            $table->integer('sinalco_double_door_cooler')->nullable()->after('sinalco_single_door_cooler');
            $table->integer('sinalco_triple_door_cooler')->nullable()->after('sinalco_single_door_cooler');
            $table->integer('sinalco_total_doors')->nullable()->after('sinalco_triple_door_cooler');

            // Other Juices
            $table->string('other_juices_brand_name')->nullable()->after('sinalco_total_doors');
            $table->integer('other_juices_single_door_cooler')->nullable()->after('other_juices_brand_name');
            $table->integer('other_juices_double_door_cooler')->nullable()->after('other_juices_single_door_cooler');
            $table->integer('other_juices_triple_door_cooler')->nullable()->after('other_juices_double_door_cooler');
            $table->integer('other_juices_total_doors')->nullable()->after('other_juices_triple_door_cooler');

            // Energy Drinks - FireBall
            $table->integer('fireball_single_door_cooler')->nullable()->after('other_juices_total_doors');
            $table->integer('fireball_double_door_cooler')->nullable()->after('fireball_single_door_cooler');
            $table->integer('fireball_triple_door_cooler')->nullable()->after('fireball_double_door_cooler');
            $table->integer('fireball_total_doors')->nullable()->after('fireball_triple_door_cooler');

            // Red Bull
            $table->integer('redbull_single_door_cooler')->nullable()->after('fireball_total_doors');
            $table->integer('redbull_double_door_cooler')->nullable()->after('redbull_single_door_cooler');
            $table->integer('redbull_triple_door_cooler')->nullable()->after('redbull_double_door_cooler');
            $table->integer('redbull_total_doors')->nullable()->after('redbull_triple_door_cooler');

            // RockStar
            $table->integer('rockstar_single_door_cooler')->nullable()->after('redbull_total_doors');
            $table->integer('rockstar_double_door_cooler')->nullable()->after('rockstar_single_door_cooler');
            $table->integer('rockstar_triple_door_cooler')->nullable()->after('rockstar_double_door_cooler');
            $table->integer('rockstar_total_doors')->nullable()->after('rockstar_triple_door_cooler');

            // Predator/Coca Cola Energy
            $table->integer('predator_single_door_cooler')->nullable()->after('rockstar_total_doors');
            $table->integer('predator_double_door_cooler')->nullable()->after('predator_single_door_cooler');
            $table->integer('predator_triple_door_cooler')->nullable()->after('predator_double_door_cooler');
            $table->integer('predator_total_doors')->nullable()->after('predator_triple_door_cooler');

            // Smart
            $table->integer('smart_single_door_cooler')->nullable()->after('predator_total_doors');
            $table->integer('smart_double_door_cooler')->nullable()->after('smart_single_door_cooler');
            $table->integer('smart_triple_door_cooler')->nullable()->after('smart_double_door_cooler');
            $table->integer('smart_total_doors')->nullable()->after('smart_triple_door_cooler');

            // Asan
            $table->integer('asan_single_door_cooler')->nullable()->after('smart_total_doors');
            $table->integer('asan_double_door_cooler')->nullable()->after('asan_single_door_cooler');
            $table->integer('asan_triple_door_cooler')->nullable()->after('asan_double_door_cooler');
            $table->integer('asan_total_doors')->nullable()->after('asan_triple_door_cooler');

            // Red Strong
            $table->integer('red_strong_single_door_cooler')->nullable()->after('asan_total_doors');
            $table->integer('red_strong_double_door_cooler')->nullable()->after('red_strong_single_door_cooler');
            $table->integer('red_strong_triple_door_cooler')->nullable()->after('red_strong_double_door_cooler');
            $table->integer('red_strong_total_doors')->nullable()->after('red_strong_triple_door_cooler');

            // Tiger
            $table->integer('tiger_single_door_cooler')->nullable()->after('red_strong_total_doors');
            $table->integer('tiger_double_door_cooler')->nullable()->after('tiger_single_door_cooler');
            $table->integer('tiger_triple_door_cooler')->nullable()->after('tiger_double_door_cooler');
            $table->integer('tiger_total_doors')->nullable()->after('tiger_triple_door_cooler');

            // White Tiger
            $table->integer('white_tiger_single_door_cooler')->nullable()->after('tiger_total_doors');
            $table->integer('white_tiger_double_door_cooler')->nullable()->after('white_tiger_single_door_cooler');
            $table->integer('white_tiger_triple_door_cooler')->nullable()->after('white_tiger_double_door_cooler');
            $table->integer('white_tiger_total_doors')->nullable()->after('white_tiger_triple_door_cooler');

            // Other Energy Drinks
            $table->string('other_energy_drink_brand_name')->nullable()->after('white_tiger_total_doors');
            $table->integer('other_energy_single_door_cooler')->nullable()->after('other_energy_drink_brand_name');
            $table->integer('other_energy_double_door_cooler')->nullable()->after('other_energy_single_door_cooler');
            $table->integer('other_energy_triple_door_cooler')->nullable()->after('other_energy_double_door_cooler');
            $table->integer('other_energy_total_doors')->nullable()->after('other_energy_triple_door_cooler');

            // Water Coolers - Life
            $table->integer('life_single_door_cooler')->nullable()->after('other_energy_total_doors');
            $table->integer('life_double_door_cooler')->nullable()->after('life_single_door_cooler');
            $table->integer('life_triple_door_cooler')->nullable()->after('life_double_door_cooler');
            $table->integer('life_total_doors')->nullable()->after('life_triple_door_cooler');

            // Aquafina
            $table->integer('aquafina_single_door_cooler')->nullable()->after('life_total_doors');
            $table->integer('aquafina_double_door_cooler')->nullable()->after('aquafina_single_door_cooler');
            $table->integer('aquafina_triple_door_cooler')->nullable()->after('aquafina_double_door_cooler');
            $table->integer('aquafina_total_doors')->nullable()->after('aquafina_triple_door_cooler');

            // Sulymaniyah
            $table->integer('sulymaniyah_single_door_cooler')->nullable()->after('aquafina_total_doors');
            $table->integer('sulymaniyah_double_door_cooler')->nullable()->after('sulymaniyah_single_door_cooler');
            $table->integer('sulymaniyah_triple_door_cooler')->nullable()->after('sulymaniyah_double_door_cooler');
            $table->integer('sulymaniyah_total_doors')->nullable()->after('sulymaniyah_triple_door_cooler');

            // Lulua
            $table->integer('lulua_single_door_cooler')->nullable()->after('sulymaniyah_total_doors');
            $table->integer('lulua_double_door_cooler')->nullable()->after('lulua_single_door_cooler');
            $table->integer('lulua_triple_door_cooler')->nullable()->after('lulua_double_door_cooler');
            $table->integer('lulua_total_doors')->nullable()->after('lulua_triple_door_cooler');

            // Alwaha
            $table->integer('alwaha_single_door_cooler')->nullable()->after('lulua_total_doors');
            $table->integer('alwaha_double_door_cooler')->nullable()->after('alwaha_single_door_cooler');
            $table->integer('alwaha_triple_door_cooler')->nullable()->after('alwaha_double_door_cooler');
            $table->integer('alwaha_total_doors')->nullable()->after('alwaha_triple_door_cooler');

            // Masafi
            $table->integer('masafi_single_door_cooler')->nullable()->after('alwaha_total_doors');
            $table->integer('masafi_double_door_cooler')->nullable()->after('masafi_single_door_cooler');
            $table->integer('masafi_triple_door_cooler')->nullable()->after('masafi_double_door_cooler');
            $table->integer('masafi_total_doors')->nullable()->after('masafi_triple_door_cooler');

            // Other Water
            $table->string('other_water_brand_name')->nullable()->after('masafi_total_doors');
            $table->integer('other_water_single_door_cooler')->nullable()->after('other_water_brand_name');
            $table->integer('other_water_double_door_cooler')->nullable()->after('other_water_single_door_cooler');
            $table->integer('other_water_triple_door_cooler')->nullable()->after('other_water_double_door_cooler');
            $table->integer('other_water_total_doors')->nullable()->after('other_water_triple_door_cooler');

            // Barbican
            $table->integer('barbican_single_door_cooler')->nullable()->after('other_water_total_doors');
            $table->integer('barbican_double_door_cooler')->nullable()->after('barbican_single_door_cooler');
            $table->integer('barbican_triple_door_cooler')->nullable()->after('barbican_double_door_cooler');
            $table->integer('barbican_total_doors')->nullable()->after('barbican_triple_door_cooler');

            // Sanabil
            $table->integer('sanabil_single_door_cooler')->nullable()->after('barbican_total_doors');
            $table->integer('sanabil_double_door_cooler')->nullable()->after('sanabil_single_door_cooler');
            $table->integer('sanabil_triple_door_cooler')->nullable()->after('sanabil_double_door_cooler');
            $table->integer('sanabil_total_doors')->nullable()->after('sanabil_triple_door_cooler');

            // Other MALT
            $table->string('other_malt_brand_name')->nullable()->after('sanabil_total_doors');
            $table->integer('other_malt_single_door_cooler')->nullable()->after('other_malt_brand_name');
            $table->integer('other_malt_double_door_cooler')->nullable()->after('other_malt_single_door_cooler');
            $table->integer('other_malt_triple_door_cooler')->nullable()->after('other_malt_double_door_cooler');
            $table->integer('other_malt_total_doors')->nullable()->after('other_malt_triple_door_cooler');

            // Summary fields
            $table->integer('total_number_of_coolers')->nullable()->after('other_malt_total_doors');
            $table->boolean('open_chiller_availability')->nullable()->after('total_number_of_coolers');
            $table->decimal('open_chiller_length', 8, 2)->nullable()->after('open_chiller_availability');
            $table->boolean('not_branded_coolers_availability')->nullable()->after('open_chiller_length');
            $table->integer('other_branded_coolers')->nullable()->change();

            // Snack availability - Lays
            $table->boolean('lays_availability')->nullable()->after('other_branded_coolers');
            $table->string('lays_availability_location')->nullable()->after('lays_availability');
            $table->integer('lays_blocks')->nullable()->after('lays_availability_location');
            $table->boolean('lays_stand')->nullable()->after('lays_blocks');

            // Doritos
            $table->boolean('doritos_availability')->nullable()->after('lays_stand');
            $table->string('doritos_availability_location')->nullable()->after('doritos_availability');
            $table->integer('doritos_blocks')->nullable()->after('doritos_availability_location');
            $table->boolean('doritos_stand')->nullable()->after('doritos_blocks');

            // Cheetos
            $table->boolean('cheetos_availability')->nullable()->after('doritos_stand');
            $table->string('cheetos_availability_location')->nullable()->after('cheetos_availability');
            $table->integer('cheetos_blocks')->nullable()->after('cheetos_availability_location');
            $table->boolean('cheetos_stand')->nullable()->after('cheetos_blocks');

            // Nice
            $table->boolean('nice_availability')->nullable()->after('cheetos_stand');
            $table->boolean('nice_stand')->nullable()->after('nice_availability');
            $table->integer('nice_blocks')->nullable()->after('nice_stand');

            // Bato
            $table->boolean('bato_availability')->nullable()->after('nice_blocks');
            $table->boolean('bato_stand')->nullable()->after('bato_availability');
            $table->integer('bato_blocks')->nullable()->after('bato_stand');

            // Pringles
            $table->boolean('pringles_availability')->nullable()->after('bato_blocks');
            $table->boolean('pringles_stand')->nullable()->after('pringles_availability');
            $table->integer('pringles_blocks')->nullable()->after('pringles_stand');

            // Dana Dana
            $table->boolean('dana_dana_availability')->nullable()->after('pringles_blocks');
            $table->boolean('dana_dana_stand')->nullable()->after('dana_dana_availability');
            $table->integer('dana_dana_blocks')->nullable()->after('dana_dana_stand');

            // Kish
            $table->boolean('kish_availability')->nullable()->after('dana_dana_blocks');
            $table->boolean('kish_stand')->nullable()->after('kish_availability');
            $table->integer('kish_blocks')->nullable()->after('kish_stand');

            // Other products
            $table->boolean('battery')->nullable()->after('kish_blocks');
            $table->boolean('biscuits')->nullable()->after('battery');
            $table->boolean('chocolate')->nullable()->after('biscuits');
            $table->boolean('ice_cream')->nullable()->after('chocolate');
            $table->boolean('nuts')->nullable()->after('ice_cream');
            $table->boolean('personal_care')->nullable()->after('nuts');
            $table->boolean('popcorn')->nullable()->after('personal_care');
            $table->boolean('rice_pack')->nullable()->after('popcorn');
            $table->boolean('tobacco')->nullable()->after('rice_pack');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coolers', function (Blueprint $table) {
            // Drop all added columns in reverse order
            $table->dropColumn([
                'tobacco', 'rice_pack', 'popcorn', 'personal_care', 'nuts', 'ice_cream', 'chocolate', 'biscuits', 'battery',
                'kish_blocks', 'kish_stand', 'kish_availability',
                'dana_dana_blocks', 'dana_dana_stand', 'dana_dana_availability',
                'pringles_blocks', 'pringles_stand', 'pringles_availability',
                'bato_blocks', 'bato_stand', 'bato_availability',
                'nice_blocks', 'nice_stand', 'nice_availability',
                'cheetos_blocks', 'cheetos_stand', 'cheetos_availability',
                'doritos_blocks', 'doritos_stand', 'doritos_availability',
                'lays_blocks', 'lays_stand', 'lays_availability_location', 'lays_availability',
                'other_branded_coolers', 'not_branded_coolers_availability', 'open_chiller_length', 'open_chiller_availability', 'total_number_of_coolers',
                'other_malt_total_doors', 'other_malt_triple_door_cooler', 'other_malt_double_door_cooler', 'other_malt_single_door_cooler', 'other_malt_brand_name',
                'sanabil_total_doors', 'sanabil_triple_door_cooler', 'sanabil_double_door_cooler', 'sanabil_single_door_cooler',
                'barbican_total_doors', 'barbican_triple_door_cooler', 'barbican_double_door_cooler', 'barbican_single_door_cooler',
                'other_water_total_doors', 'other_water_triple_door_cooler', 'other_water_double_door_cooler', 'other_water_single_door_cooler', 'other_water_brand_name',
                'masafi_total_doors', 'masafi_triple_door_cooler', 'masafi_double_door_cooler', 'masafi_single_door_cooler',
                'alwaha_total_doors', 'alwaha_triple_door_cooler', 'alwaha_double_door_cooler', 'alwaha_single_door_cooler',
                'lulua_total_doors', 'lulua_triple_door_cooler', 'lulua_double_door_cooler', 'lulua_single_door_cooler',
                'sulymaniyah_total_doors', 'sulymaniyah_triple_door_cooler', 'sulymaniyah_double_door_cooler', 'sulymaniyah_single_door_cooler',
                'aquafina_total_doors', 'aquafina_triple_door_cooler', 'aquafina_double_door_cooler', 'aquafina_single_door_cooler',
                'life_total_doors', 'life_triple_door_cooler', 'life_double_door_cooler', 'life_single_door_cooler',
                'other_energy_total_doors', 'other_energy_triple_door_cooler', 'other_energy_double_door_cooler', 'other_energy_single_door_cooler', 'other_energy_drink_brand_name',
                'white_tiger_total_doors', 'white_tiger_triple_door_cooler', 'white_tiger_double_door_cooler', 'white_tiger_single_door_cooler',
                'tiger_total_doors', 'tiger_triple_door_cooler', 'tiger_double_door_cooler', 'tiger_single_door_cooler',
                'red_strong_total_doors', 'red_strong_triple_door_cooler', 'red_strong_double_door_cooler', 'red_strong_single_door_cooler',
                'asan_total_doors', 'asan_triple_door_cooler', 'asan_double_door_cooler', 'asan_single_door_cooler',
                'smart_total_doors', 'smart_triple_door_cooler', 'smart_double_door_cooler', 'smart_single_door_cooler',
                'predator_total_doors', 'predator_triple_door_cooler', 'predator_double_door_cooler', 'predator_single_door_cooler',
                'rockstar_total_doors', 'rockstar_triple_door_cooler', 'rockstar_double_door_cooler', 'rockstar_single_door_cooler',
                'redbull_total_doors', 'redbull_triple_door_cooler', 'redbull_double_door_cooler', 'redbull_single_door_cooler',
                'fireball_total_doors', 'fireball_triple_door_cooler', 'fireball_double_door_cooler', 'fireball_single_door_cooler',
                'other_juices_total_doors', 'other_juices_triple_door_cooler', 'other_juices_double_door_cooler', 'other_juices_single_door_cooler', 'other_juices_brand_name',
                'sinalco_total_doors', 'sinalco_triple_door_cooler', 'sinalco_double_door_cooler', 'sinalco_single_door_cooler',
                'alsafi_danon_total_doors', 'alsafi_danon_triple_door_cooler', 'alsafi_danon_double_door_cooler', 'alsafi_danon_single_door_cooler',
                'rc_total_doors', 'rc_triple_door_cooler', 'rc_double_door_cooler', 'rc_single_door_cooler',
                'karawanchi_total_doors', 'karawanchi_triple_door_cooler', 'karawanchi_double_door_cooler', 'karawanchi_single_door_cooler',
                'nada_total_doors', 'nada_triple_door_cooler', 'nada_double_door_cooler', 'nada_single_door_cooler',
                'rani_total_doors', 'rani_triple_door_cooler', 'rani_double_door_cooler', 'rani_single_door_cooler',
                'cola_pet_availability', 'cola_nrb_availability', 'cola_can_availability', 'cola_cooler_location', 'cola_prime_location', 'cola_total_doors', 'cola_cooler_pictures', 'cola_triple_door_coolers', 'cola_double_door_coolers', 'cola_single_door_coolers',
                'pepsi_pet_availability', 'pepsi_nrb_availability', 'pepsi_can_availability', 'pepsi_foreign_product_availability', 'pepsi_cooler_location', 'pepsi_prime_location', 'pepsi_total_doors', 'pepsi_triple_door_pictures', 'pepsi_triple_door_coolers', 'pepsi_double_door_pictures', 'pepsi_double_door_coolers', 'pepsi_single_door_pictures', 'pepsi_single_door_coolers',
                'storage_availability', 'outlet_service', 'frozen_food_availability', 'butcher_availability', 'pos_name', 'delivery_availability', 'cashier_system_count', 'phone_number', 'contact_person_name', 'signage_written_in', 'top_shop', 'geo_location_long', 'geo_location_lat', 'geo_location_link', 'outlet_photo', 'size_per_sqm', 'classification', 'type', 'next_to', 'area_houses_type', 'area_classification', 'area_type', 'detailed_address', 'area_name', 'chain_name', 'belongs_to_chain', 'outlet_code_bsdc_lays_code', 'dc_name', 'city', 'region', 'outlet_serial_number'
            ]);
        });
    }
};
