@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Edit Outlet</h1>
            <p class="text-gray-600">Update the comprehensive outlet survey data.</p>
        </div>
        <a href="{{ route('coolers.show', $cooler) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Back to Details</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="text-red-800 font-semibold">Please fix the following errors:</div>
            <ul class="list-disc list-inside mt-2 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coolers.update', $cooler) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Basic Outlet Information -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Basic Outlet Information</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="outlet_serial_number" class="block text-sm font-medium text-gray-700 mb-1">Outlet Serial Number</label>
                        <input type="text" name="outlet_serial_number" id="outlet_serial_number" value="{{ old('outlet_serial_number', $cooler->outlet_serial_number) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="outlet_name" class="block text-sm font-medium text-gray-700 mb-1">Outlet Name</label>
                        <input type="text" name="outlet_name" id="outlet_name" value="{{ old('outlet_name', $cooler->outlet_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                        <input type="text" name="region" id="region" value="{{ old('region', $cooler->region) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $cooler->city) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="dc_name" class="block text-sm font-medium text-gray-700 mb-1">DC Name</label>
                        <input type="text" name="dc_name" id="dc_name" value="{{ old('dc_name', $cooler->dc_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="outlet_code_bsdc_lays_code" class="block text-sm font-medium text-gray-700 mb-1">Outlet Code BSDC Lays Code</label>
                        <input type="text" name="outlet_code_bsdc_lays_code" id="outlet_code_bsdc_lays_code" value="{{ old('outlet_code_bsdc_lays_code', $cooler->outlet_code_bsdc_lays_code) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="chain_name" class="block text-sm font-medium text-gray-700 mb-1">Chain Name</label>
                        <input type="text" name="chain_name" id="chain_name" value="{{ old('chain_name', $cooler->chain_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="belongs_to_chain" class="block text-sm font-medium text-gray-700 mb-1">Belongs to Chain</label>
                        <select name="belongs_to_chain" id="belongs_to_chain" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('belongs_to_chain', $cooler->belongs_to_chain) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('belongs_to_chain', $cooler->belongs_to_chain) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="area_name" class="block text-sm font-medium text-gray-700 mb-1">Area Name</label>
                        <input type="text" name="area_name" id="area_name" value="{{ old('area_name', $cooler->area_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label for="detailed_address" class="block text-sm font-medium text-gray-700 mb-1">Detailed Address</label>
                        <textarea name="detailed_address" id="detailed_address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('detailed_address', $cooler->detailed_address) }}</textarea>
                    </div>
                    <div>
                        <label for="area_type" class="block text-sm font-medium text-gray-700 mb-1">Area Type</label>
                        <input type="text" name="area_type" id="area_type" value="{{ old('area_type', $cooler->area_type) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="area_classification" class="block text-sm font-medium text-gray-700 mb-1">Area Classification</label>
                        <input type="text" name="area_classification" id="area_classification" value="{{ old('area_classification', $cooler->area_classification) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="area_houses_type" class="block text-sm font-medium text-gray-700 mb-1">Area Houses Type</label>
                        <input type="text" name="area_houses_type" id="area_houses_type" value="{{ old('area_houses_type', $cooler->area_houses_type) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="next_to" class="block text-sm font-medium text-gray-700 mb-1">Next To</label>
                        <input type="text" name="next_to" id="next_to" value="{{ old('next_to', $cooler->next_to) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <input type="text" name="type" id="type" value="{{ old('type', $cooler->type) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="classification" class="block text-sm font-medium text-gray-700 mb-1">Classification</label>
                        <input type="text" name="classification" id="classification" value="{{ old('classification', $cooler->classification) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="size_per_sqm" class="block text-sm font-medium text-gray-700 mb-1">Size Per SQM</label>
                        <input type="number" step="0.01" name="size_per_sqm" id="size_per_sqm" value="{{ old('size_per_sqm', $cooler->size_per_sqm) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="top_shop" class="block text-sm font-medium text-gray-700 mb-1">Top Shop</label>
                        <select name="top_shop" id="top_shop" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('top_shop', $cooler->top_shop) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('top_shop', $cooler->top_shop) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="signage_written_in" class="block text-sm font-medium text-gray-700 mb-1">Signage Written In</label>
                        <input type="text" name="signage_written_in" id="signage_written_in" value="{{ old('signage_written_in', $cooler->signage_written_in) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Contact Information</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="contact_person_name" class="block text-sm font-medium text-gray-700 mb-1">Contact Person Name</label>
                        <input type="text" name="contact_person_name" id="contact_person_name" value="{{ old('contact_person_name', $cooler->contact_person_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $cooler->phone_number) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="cashier_system_count" class="block text-sm font-medium text-gray-700 mb-1">Number of Cashier System</label>
                        <input type="number" name="cashier_system_count" id="cashier_system_count" value="{{ old('cashier_system_count', $cooler->cashier_system_count) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="pos_name" class="block text-sm font-medium text-gray-700 mb-1">POS Name</label>
                        <input type="text" name="pos_name" id="pos_name" value="{{ old('pos_name', $cooler->pos_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="delivery_availability" class="block text-sm font-medium text-gray-700 mb-1">Delivery Availability</label>
                        <select name="delivery_availability" id="delivery_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('delivery_availability', $cooler->delivery_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('delivery_availability', $cooler->delivery_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="butcher_availability" class="block text-sm font-medium text-gray-700 mb-1">Butcher Availability</label>
                        <select name="butcher_availability" id="butcher_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('butcher_availability', $cooler->butcher_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('butcher_availability', $cooler->butcher_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="frozen_food_availability" class="block text-sm font-medium text-gray-700 mb-1">Frozen Food Availability</label>
                        <select name="frozen_food_availability" id="frozen_food_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('frozen_food_availability', $cooler->frozen_food_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('frozen_food_availability', $cooler->frozen_food_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="outlet_service" class="block text-sm font-medium text-gray-700 mb-1">Outlet Service</label>
                        <select name="outlet_service" id="outlet_service" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('outlet_service', $cooler->outlet_service) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('outlet_service', $cooler->outlet_service) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="storage_availability" class="block text-sm font-medium text-gray-700 mb-1">Storage Availability</label>
                        <select name="storage_availability" id="storage_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('storage_availability', $cooler->storage_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('storage_availability', $cooler->storage_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pepsi Coolers -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Pepsi Coolers</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="pepsi_coolers" class="block text-sm font-medium text-gray-700 mb-1">Total Pepsi Coolers</label>
                        <input type="number" name="pepsi_coolers" id="pepsi_coolers" value="{{ old('pepsi_coolers', $cooler->pepsi_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="pepsi_single_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Single Door Coolers</label>
                        <input type="number" name="pepsi_single_door_coolers" id="pepsi_single_door_coolers" value="{{ old('pepsi_single_door_coolers', $cooler->pepsi_single_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="pepsi_double_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Double Door Coolers</label>
                        <input type="number" name="pepsi_double_door_coolers" id="pepsi_double_door_coolers" value="{{ old('pepsi_double_door_coolers', $cooler->pepsi_double_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="pepsi_triple_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Triple Door Coolers</label>
                        <input type="number" name="pepsi_triple_door_coolers" id="pepsi_triple_door_coolers" value="{{ old('pepsi_triple_door_coolers', $cooler->pepsi_triple_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pepsi_total_doors" class="block text-sm font-medium text-gray-700 mb-1">Total Doors</label>
                        <input type="number" name="pepsi_total_doors" id="pepsi_total_doors" value="{{ old('pepsi_total_doors', $cooler->pepsi_total_doors) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="pepsi_prime_location" class="block text-sm font-medium text-gray-700 mb-1">Prime Location</label>
                        <select name="pepsi_prime_location" id="pepsi_prime_location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pepsi_prime_location', $cooler->pepsi_prime_location) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pepsi_prime_location', $cooler->pepsi_prime_location) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="pepsi_cooler_location" class="block text-sm font-medium text-gray-700 mb-1">Cooler Location</label>
                        <input type="text" name="pepsi_cooler_location" id="pepsi_cooler_location" value="{{ old('pepsi_cooler_location', $cooler->pepsi_cooler_location) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="pepsi_foreign_product_availability" class="block text-sm font-medium text-gray-700 mb-1">Foreign Product Availability</label>
                        <select name="pepsi_foreign_product_availability" id="pepsi_foreign_product_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pepsi_foreign_product_availability', $cooler->pepsi_foreign_product_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pepsi_foreign_product_availability', $cooler->pepsi_foreign_product_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="pepsi_can_availability" class="block text-sm font-medium text-gray-700 mb-1">Can Availability</label>
                        <select name="pepsi_can_availability" id="pepsi_can_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pepsi_can_availability', $cooler->pepsi_can_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pepsi_can_availability', $cooler->pepsi_can_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="pepsi_nrb_availability" class="block text-sm font-medium text-gray-700 mb-1">NRB Availability</label>
                        <select name="pepsi_nrb_availability" id="pepsi_nrb_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pepsi_nrb_availability', $cooler->pepsi_nrb_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pepsi_nrb_availability', $cooler->pepsi_nrb_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="pepsi_pet_availability" class="block text-sm font-medium text-gray-700 mb-1">PET Availability</label>
                        <select name="pepsi_pet_availability" id="pepsi_pet_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pepsi_pet_availability', $cooler->pepsi_pet_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pepsi_pet_availability', $cooler->pepsi_pet_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cola Coolers -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Cola Coolers</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="cola_coolers" class="block text-sm font-medium text-gray-700 mb-1">Total Cola Coolers</label>
                        <input type="number" name="cola_coolers" id="cola_coolers" value="{{ old('cola_coolers', $cooler->cola_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="cola_single_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Single Door Coolers</label>
                        <input type="number" name="cola_single_door_coolers" id="cola_single_door_coolers" value="{{ old('cola_single_door_coolers', $cooler->cola_single_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="cola_double_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Double Door Coolers</label>
                        <input type="number" name="cola_double_door_coolers" id="cola_double_door_coolers" value="{{ old('cola_double_door_coolers', $cooler->cola_double_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="cola_triple_door_coolers" class="block text-sm font-medium text-gray-700 mb-1">Triple Door Coolers</label>
                        <input type="number" name="cola_triple_door_coolers" id="cola_triple_door_coolers" value="{{ old('cola_triple_door_coolers', $cooler->cola_triple_door_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cola_total_doors" class="block text-sm font-medium text-gray-700 mb-1">Total Doors</label>
                        <input type="number" name="cola_total_doors" id="cola_total_doors" value="{{ old('cola_total_doors', $cooler->cola_total_doors) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="cola_prime_location" class="block text-sm font-medium text-gray-700 mb-1">Prime Location</label>
                        <select name="cola_prime_location" id="cola_prime_location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cola_prime_location', $cooler->cola_prime_location) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('cola_prime_location', $cooler->cola_prime_location) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="cola_cooler_location" class="block text-sm font-medium text-gray-700 mb-1">Cooler Location</label>
                        <input type="text" name="cola_cooler_location" id="cola_cooler_location" value="{{ old('cola_cooler_location', $cooler->cola_cooler_location) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="cola_can_availability" class="block text-sm font-medium text-gray-700 mb-1">Can Availability</label>
                        <select name="cola_can_availability" id="cola_can_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cola_can_availability', $cooler->cola_can_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('cola_can_availability', $cooler->cola_can_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="cola_nrb_availability" class="block text-sm font-medium text-gray-700 mb-1">NRB Availability</label>
                        <select name="cola_nrb_availability" id="cola_nrb_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cola_nrb_availability', $cooler->cola_nrb_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('cola_nrb_availability', $cooler->cola_nrb_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="cola_pet_availability" class="block text-sm font-medium text-gray-700 mb-1">PET Availability</label>
                        <select name="cola_pet_availability" id="cola_pet_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cola_pet_availability', $cooler->cola_pet_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('cola_pet_availability', $cooler->cola_pet_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Branded Coolers Summary -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Other Branded Coolers Summary</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="other_branded_coolers" class="block text-sm font-medium text-gray-700 mb-1">Total Other Branded Coolers</label>
                        <input type="number" name="other_branded_coolers" id="other_branded_coolers" value="{{ old('other_branded_coolers', $cooler->other_branded_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="total_number_of_coolers" class="block text-sm font-medium text-gray-700 mb-1">Total Number of Coolers</label>
                        <input type="number" name="total_number_of_coolers" id="total_number_of_coolers" value="{{ old('total_number_of_coolers', $cooler->total_number_of_coolers) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="open_chiller_availability" class="block text-sm font-medium text-gray-700 mb-1">Open Chiller Availability</label>
                        <select name="open_chiller_availability" id="open_chiller_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('open_chiller_availability', $cooler->open_chiller_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('open_chiller_availability', $cooler->open_chiller_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="open_chiller_length" class="block text-sm font-medium text-gray-700 mb-1">Open Chiller Length</label>
                        <input type="number" step="0.01" name="open_chiller_length" id="open_chiller_length" value="{{ old('open_chiller_length', $cooler->open_chiller_length) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="not_branded_coolers_availability" class="block text-sm font-medium text-gray-700 mb-1">Not Branded Coolers Availability</label>
                        <select name="not_branded_coolers_availability" id="not_branded_coolers_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('not_branded_coolers_availability', $cooler->not_branded_coolers_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('not_branded_coolers_availability', $cooler->not_branded_coolers_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snack Availability -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Snack Availability</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="lays_availability" class="block text-sm font-medium text-gray-700 mb-1">Lays Availability</label>
                        <select name="lays_availability" id="lays_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('lays_availability', $cooler->lays_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('lays_availability', $cooler->lays_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="text" name="lays_availability_location" id="lays_availability_location" value="{{ old('lays_availability_location', $cooler->lays_availability_location) }}"
                            placeholder="Location" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="lays_blocks" id="lays_blocks" value="{{ old('lays_blocks', $cooler->lays_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="lays_stand" id="lays_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('lays_stand', $cooler->lays_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('lays_stand', $cooler->lays_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="doritos_availability" class="block text-sm font-medium text-gray-700 mb-1">Doritos Availability</label>
                        <select name="doritos_availability" id="doritos_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('doritos_availability', $cooler->doritos_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('doritos_availability', $cooler->doritos_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="text" name="doritos_availability_location" id="doritos_availability_location" value="{{ old('doritos_availability_location', $cooler->doritos_availability_location) }}"
                            placeholder="Location" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="doritos_blocks" id="doritos_blocks" value="{{ old('doritos_blocks', $cooler->doritos_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="doritos_stand" id="doritos_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('doritos_stand', $cooler->doritos_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('doritos_stand', $cooler->doritos_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="cheetos_availability" class="block text-sm font-medium text-gray-700 mb-1">Cheetos Availability</label>
                        <select name="cheetos_availability" id="cheetos_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cheetos_availability', $cooler->cheetos_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('cheetos_availability', $cooler->cheetos_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="text" name="cheetos_availability_location" id="cheetos_availability_location" value="{{ old('cheetos_availability_location', $cooler->cheetos_availability_location) }}"
                            placeholder="Location" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="cheetos_blocks" id="cheetos_blocks" value="{{ old('cheetos_blocks', $cooler->cheetos_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="cheetos_stand" id="cheetos_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('cheetos_stand', $cooler->cheetos_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('cheetos_stand', $cooler->cheetos_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="nice_availability" class="block text-sm font-medium text-gray-700 mb-1">Nice Availability</label>
                        <select name="nice_availability" id="nice_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('nice_availability', $cooler->nice_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('nice_availability', $cooler->nice_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="number" name="nice_blocks" id="nice_blocks" value="{{ old('nice_blocks', $cooler->nice_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="nice_stand" id="nice_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('nice_stand', $cooler->nice_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('nice_stand', $cooler->nice_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="bato_availability" class="block text-sm font-medium text-gray-700 mb-1">Bato Availability</label>
                        <select name="bato_availability" id="bato_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('bato_availability', $cooler->bato_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('bato_availability', $cooler->bato_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="number" name="bato_blocks" id="bato_blocks" value="{{ old('bato_blocks', $cooler->bato_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="bato_stand" id="bato_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('bato_stand', $cooler->bato_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('bato_stand', $cooler->bato_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="pringles_availability" class="block text-sm font-medium text-gray-700 mb-1">Pringles Availability</label>
                        <select name="pringles_availability" id="pringles_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pringles_availability', $cooler->pringles_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('pringles_availability', $cooler->pringles_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="number" name="pringles_blocks" id="pringles_blocks" value="{{ old('pringles_blocks', $cooler->pringles_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="pringles_stand" id="pringles_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('pringles_stand', $cooler->pringles_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('pringles_stand', $cooler->pringles_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="dana_dana_availability" class="block text-sm font-medium text-gray-700 mb-1">Dana Dana Availability</label>
                        <select name="dana_dana_availability" id="dana_dana_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('dana_dana_availability', $cooler->dana_dana_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('dana_dana_availability', $cooler->dana_dana_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="number" name="dana_dana_blocks" id="dana_dana_blocks" value="{{ old('dana_dana_blocks', $cooler->dana_dana_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="dana_dana_stand" id="dana_dana_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('dana_dana_stand', $cooler->dana_dana_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('dana_dana_stand', $cooler->dana_dana_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                    <div>
                        <label for="kish_availability" class="block text-sm font-medium text-gray-700 mb-1">Kish Availability</label>
                        <select name="kish_availability" id="kish_availability" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('kish_availability', $cooler->kish_availability) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('kish_availability', $cooler->kish_availability) ? 'selected' : '' }}>Yes</option>
                        </select>
                        <input type="number" name="kish_blocks" id="kish_blocks" value="{{ old('kish_blocks', $cooler->kish_blocks) }}" min="0"
                            placeholder="Blocks" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <select name="kish_stand" id="kish_stand" class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('kish_stand', $cooler->kish_stand) ? '' : 'selected' }}>No Stand</option>
                            <option value="1" {{ old('kish_stand', $cooler->kish_stand) ? 'selected' : '' }}>Has Stand</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Other Products</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="battery" class="block text-sm font-medium text-gray-700 mb-1">Battery</label>
                        <select name="battery" id="battery" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('battery', $cooler->battery) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('battery', $cooler->battery) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="biscuits" class="block text-sm font-medium text-gray-700 mb-1">Biscuits</label>
                        <select name="biscuits" id="biscuits" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('biscuits', $cooler->biscuits) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('biscuits', $cooler->biscuits) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="chocolate" class="block text-sm font-medium text-gray-700 mb-1">Chocolate</label>
                        <select name="chocolate" id="chocolate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('chocolate', $cooler->chocolate) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('chocolate', $cooler->chocolate) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="ice_cream" class="block text-sm font-medium text-gray-700 mb-1">Ice Cream</label>
                        <select name="ice_cream" id="ice_cream" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('ice_cream', $cooler->ice_cream) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('ice_cream', $cooler->ice_cream) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="nuts" class="block text-sm font-medium text-gray-700 mb-1">Nuts</label>
                        <select name="nuts" id="nuts" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('nuts', $cooler->nuts) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('nuts', $cooler->nuts) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="personal_care" class="block text-sm font-medium text-gray-700 mb-1">Personal Care</label>
                        <select name="personal_care" id="personal_care" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('personal_care', $cooler->personal_care) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('personal_care', $cooler->personal_care) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="popcorn" class="block text-sm font-medium text-gray-700 mb-1">Popcorn</label>
                        <select name="popcorn" id="popcorn" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('popcorn', $cooler->popcorn) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('popcorn', $cooler->popcorn) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="rice_pack" class="block text-sm font-medium text-gray-700 mb-1">Rice Pack</label>
                        <select name="rice_pack" id="rice_pack" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('rice_pack', $cooler->rice_pack) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('rice_pack', $cooler->rice_pack) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div>
                        <label for="tobacco" class="block text-sm font-medium text-gray-700 mb-1">Tobacco</label>
                        <select name="tobacco" id="tobacco" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0" {{ old('tobacco', $cooler->tobacco) ? '' : 'selected' }}>No</option>
                            <option value="1" {{ old('tobacco', $cooler->tobacco) ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Save Changes</button>
            <a href="{{ route('coolers.show', $cooler) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
