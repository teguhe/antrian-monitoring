<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Antrian Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #sidebar { transition: width 0.3s ease; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- ========== SIDEBAR COLLAPSIBLE TEMPLATE ========== -->
        @include('layouts.admin-sidebar')

        <!-- ========== MAIN CONTENT ========== -->
        <div class="flex-1 flex flex-col">

            @include('layouts.admin-header', ['title' => '📊 Dashboard Super Admin'])

            <!-- PAGE CONTENT -->
            <main class="p-6">
                <!-- Statistik Box -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-blue-600">0</div>
                        <div class="text-gray-500 text-sm">Total Antrian Hari Ini</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-green-600">0</div>
                        <div class="text-gray-500 text-sm">Sudah Selesai</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-orange-600">0</div>
                        <div class="text-gray-500 text-sm">Menunggu Antrian</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-purple-600">{{ \App\Models\User::count() }}</div>
                        <div class="text-gray-500 text-sm">Total User Operator</div>
                    </div>
                </div>
            </main>

        </div>
    </div>


</body>
</html>
