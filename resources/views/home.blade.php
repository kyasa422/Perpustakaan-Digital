<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home</title>
</head>

<body class="bg-gray-200 shadow flex flex-col min-h-screen">
    <header class="flex justify-between items-center p-4 bg-gray-700 text-white">
        <h1 class="text-2xl font-bold ">PERPUSTAKAAN DIGITAL</h1>
        <div class="font-medium mr-4">
            @if (Route::has('login'))
            <livewire:welcome.navigation />
            @endif
        </div>

    </header>

    <main class="w-full flex flex-grow  items-center my-20 space-y-10 px-4 lg:space-x-20 max-lg:flex-col ">
        <div class="max-w-3xl space-y-6 text-center">
            <h2 class="text-4xl lg:text-6xl font-bold text-black">Temukan Pengetahuan dan Inspirasi Terbaik di Perpustakaan Kami</h2>
            <p class="text-gray-600">Tempat ideal untuk menjelajahi dunia buku dan pengetahuan di lingkungan yang tenang dan nyaman. Dari literatur klasik hingga penelitian modern, kami menyediakan koleksi favorit Anda dengan akses yang mudah. Datang dan rasakan suasana belajar yang inspiratif di sini!</p>

        </div>
        <img src="https://images.unsplash.com/photo-1505664063603-28e48ca204eb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Restaurant" class="rounded-lg shadow-lg w-full lg:max-w-3xl">
    </main>

    <footer class="bg-gray-800 mt-10 lg:mt-20">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-gray-300 text-center">&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>