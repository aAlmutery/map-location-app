@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-6">Import Cooler Data</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="text-red-800 font-semibold">Please fix the following errors:</div>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('coolers.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload CSV File
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition"
                        ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
                        <input type="file" id="file" name="file" accept=".csv" class="hidden"
                            onchange="handleFileSelect(event)">
                        <label for="file" class="cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v24a4 4 0 004 4h24a4 4 0 004-4V20m-8-12v12m0 0l-3-3m3 3l3-3" />
                            </svg>
                            <p class="text-gray-600 font-medium">Click to select or drag and drop</p>
                            <p class="text-gray-500 text-sm">CSV (max 10MB)</p>
                        </label>
                    </div>
                    <div id="fileInfo" class="mt-2 text-sm text-gray-600"></div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-900 mb-2">File Format Requirements:</h3>
                    <p class="text-blue-800 text-sm mb-2">Your CSV file should have these columns in this exact order:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 text-blue-800 text-xs">
                        <div>1. Outlet Serial Number</div>
                        <div>2. Region</div>
                        <div>3. City</div>
                        <div>4. Outlet Name</div>
                        <div>5. DC Name</div>
                        <div>6. Outlet Code BSDC Lays Code</div>
                        <div>7. Belongs to Chain</div>
                        <div>8. Chain Name</div>
                        <div>9. Area Name</div>
                        <div>10. Detailed Address</div>
                        <div>11. Area Type</div>
                        <div>12. Area Classification</div>
                        <div>13. Area Houses Type</div>
                        <div>14. Next To</div>
                        <div>15. TYPE</div>
                        <div>16. Classification</div>
                        <div>17. Size Per SQM</div>
                        <div>18. Outlet photo</div>
                        <div>19. Geo-Location Link (URL)</div>
                        <div>20. Geo-Location (Lat)</div>
                        <div>21. Geo-Location (Long)</div>
                        <div>22. Top Shop</div>
                        <div>23. Signage written in</div>
                        <div>24. Contact person name</div>
                        <div>25. Phone number</div>
                        <div>26. # of Cashier System</div>
                        <div>27. Delivery Availability</div>
                        <div>28. POS Name</div>
                        <div>29. Butcher Availability</div>
                        <div>30. Frozen food Availability</div>
                        <div>31. Outlet Service</div>
                        <div>32. Storage Availability</div>
                        <div>33. No. of Pepsi Coolers</div>
                        <div>34-39. Pepsi Single Door Pictures</div>
                        <div>40. No. of Pepsi Double Door Coolers</div>
                        <div>41-46. Pepsi Double Door Pictures</div>
                        <div>47. No. of Pepsi Triple Door Coolers</div>
                        <div>48-53. Pepsi Triple Door Pictures</div>
                        <div>54. PEPSI Total Door</div>
                        <div>55. Pepsi Prime location</div>
                        <div>56. Pepsi Cooler Location</div>
                        <div>57. Foreign product in Pepsi Cooler</div>
                        <div>58. Pepsi Can Availability</div>
                        <div>59. Pepsi NRB Availability</div>
                        <div>60. Pepsi PET Availability</div>
                        <div>61. No. of Cola Coolers</div>
                        <div>62. No. of Cola Single Door Coolers</div>
                        <div>63. No. of Cola Double Door Coolers</div>
                        <div>64. No. of Cola Triple Door Coolers</div>
                        <div>65-69. Cola Cooler Pictures</div>
                        <div>70. Cola Total Door</div>
                        <div>71. Coca Cola Prime location</div>
                        <div>72. Coca Cola Cooler Location</div>
                        <div>73. Coca Cola Can Availability</div>
                        <div>74. Coca Cola NRB Availability</div>
                        <div>75. Coca Cola PET Availability</div>
                        <div>76-79. Rani Cooler Data</div>
                        <div>80-83. Nada Cooler Data</div>
                        <div>84-87. Karawanchi Cooler Data</div>
                        <div>88-91. RC Cooler Data</div>
                        <div>92-95. AlSafi Danon Cooler Data</div>
                        <div>96-99. Sinalco Cooler Data</div>
                        <div>100-104. Other Juices Cooler Data</div>
                        <div>105-108. FireBall Cooler Data</div>
                        <div>109-112. Red Bull Cooler Data</div>
                        <div>113-116. RockStar Cooler Data</div>
                        <div>117-120. Predator/Coca Cola Energy Data</div>
                        <div>121-124. Smart Cooler Data</div>
                        <div>125-128. Asan Cooler Data</div>
                        <div>129-132. Red Strong Cooler Data</div>
                        <div>133-136. Tiger Cooler Data</div>
                        <div>137-140. White Tiger Cooler Data</div>
                        <div>141-145. Other Energy Drink Data</div>
                        <div>146-149. Life Water Cooler Data</div>
                        <div>150-153. Aquafina Water Cooler Data</div>
                        <div>154-157. Sulymaniyah Water Cooler Data</div>
                        <div>158-161. Lulua Water Cooler Data</div>
                        <div>162-165. Alwaha Water Cooler Data</div>
                        <div>166-169. Masafi Water Cooler Data</div>
                        <div>170-174. Other Water Cooler Data</div>
                        <div>175-178. Barbican MALT Cooler Data</div>
                        <div>179-182. Sanabil MALT Cooler Data</div>
                        <div>183-187. Other MALT Cooler Data</div>
                        <div>188. Total Number of Coolers</div>
                        <div>189. Open Chiller Coolers Availability</div>
                        <div>190. The Length of the Open Chiller</div>
                        <div>191. Not Branded Coolers Availability</div>
                        <div>192. No. of Other Branded Coolers</div>
                        <div>193-196. Lays availability data</div>
                        <div>197-200. Doritos availability data</div>
                        <div>201-204. Cheetos availability data</div>
                        <div>205-207. Nice availability data</div>
                        <div>208-210. Bato availability data</div>
                        <div>211-213. Pringles availability data</div>
                        <div>214-216. Dana Dana availability data</div>
                        <div>217-219. Kish availability data</div>
                        <div>220-228. Other products (Battery to Tobacco)</div>
                    </div>
                    <p class="text-blue-700 text-xs mt-2 font-medium">
                        Total: 228 columns. Boolean values can be: Yes/No, True/False, 1/0, Y/N, Available/Not Available.
                    </p>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Import Data
                    </button>
                    <a href="{{ route('coolers.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition">
                        View Data
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function handleDragOver(e) {
        e.preventDefault();
        e.currentTarget.classList.add('border-blue-500', 'bg-blue-50');
    }

    function handleDragLeave(e) {
        e.currentTarget.classList.remove('border-blue-500', 'bg-blue-50');
    }

    function handleDrop(e) {
        e.preventDefault();
        e.currentTarget.classList.remove('border-blue-500', 'bg-blue-50');
        const files = e.dataTransfer.files;
        document.getElementById('file').files = files;
        handleFileSelect({ target: { files } });
    }

    function handleFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('fileInfo').textContent = `Selected: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
        }
    }
</script>
@endsection
