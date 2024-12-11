<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-4 text-lg font-semibold">Project Toko Online</div>
            <nav class="flex-1">
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="block p-4 hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="#" class="block p-4 hover:bg-gray-700">eCommerce</a></li>
                    <li><a href="#" class="block p-4 hover:bg-gray-700">Analytics</a></li>
                    <li><a href="{{ route('products.create') }}" class="block p-4 hover:bg-gray-700">Tambah Produk</a></li>
                    <li><a href="{{ route('products.index') }}" class="block p-4 hover:bg-gray-700">Lihat Product</a></li>
                    <li><a href="{{ route('users.create') }}" class="block p-4 hover:bg-gray-700">Tambah User</a></li>
                     <li><a href="{{ route('users.index') }}" class="block p-4 hover:bg-gray-700">Lihat User</a></li>
                    <!-- Tambahkan menu lainnya -->
                </ul>
            </nav>
             <div class="p-4 border-t border-gray-700">
            <a href="#" id="logout-link" class="block p-2 bg-red-500 hover:bg-red-600 text-white text-center rounded">
                Logout
            </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
           <script>
                document.getElementById('logout-link').addEventListener('click', function (event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Yakin ingin logout?',
                        text: "Kamu akan diarahkan ke halaman login.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    
                     }).then((result) => {
                        if (result.isConfirmed) {
                        // Submit form logout jika user menekan tombol 'Ya'
                            document.getElementById('logout-form').submit();
                         }
                    });
                });
            </script>

            <!-- AJAX FUNCTION SETTING -->
            <script>
                function checkSession () {
                    fetch("{ { route:('check.session')}}",{
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', //For MakeSure this is <- AJAX Request
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.isLoggedIn){
                        // IF Session was not valid, redirect to login page
                        window.location.href = "{{ route('login') }}";
                        }
                    })
                    .catch(error => console.error("Error Checking the Session", error));
                }
                // Check the Interval with much 5 Seccond
                setInterval(checkSession, 5000);
            </script>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <header class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-gray-800">This Week's Overview</h2>
                <!-- Search bar -->
                <input type="text" placeholder="Type to search..." class="px-4 py-2 border rounded">
            </header>

            <div class="grid gap-6 mt-6 lg:grid-cols-3">
                <!-- Stats Cards -->
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold">197</h3>
                    <p>Clients Added</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold">745</h3>
                    <p>Contracts Signed</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold">512</h3>
                    <p>Invoices Sent</p>
                </div>
            </div>

            <!-- Charts (Placeholder) -->
            <div class="grid gap-6 mt-6 lg:grid-cols-2">
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Payments Overview</h3>
                    <!-- Chart Placeholder -->
                    <canvas id="paymentsChart" class="w-full h-40"></canvas>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Used Devices</h3>
                    <!-- Chart Placeholder -->
                    <canvas id="devicesChart" class="w-full h-40"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Payments Chart
        const paymentsCtx = document.getElementById('paymentsChart').getContext('2d');
        new Chart(paymentsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Payments Overview',
                    data: [20, 50, 30, 80, 60, 90, 40, 100],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    fill: true
                }]
            },
            options: {}
        });

        // Devices Chart
        const devicesCtx = document.getElementById('devicesChart').getContext('2d');
        new Chart(devicesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Mobile', 'Tablet', 'Desktop'],
                datasets: [{
                    data: [10, 20, 70],
                    backgroundColor: ['#3490dc', '#38c172', '#e3342f']
                }]
            },
            options: {}
        });
    </script>
</body>
</html>
