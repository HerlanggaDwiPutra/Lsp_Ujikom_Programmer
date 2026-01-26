<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Terintegrasi - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ sidebarOpen: false }">

    <div
        class="bg-white border-b border-gray-200 p-4 flex items-center justify-between fixed w-full z-20 h-16 shadow-sm">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen"
                class="text-gray-600 hover:text-black focus:outline-none lg:hidden">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-gray-900 hover:text-gray-600">
                Dashboard Utama
            </a>
        </div>
        <div class="text-sm font-medium text-gray-500 hidden sm:block">
            Herlangga Dwi P.
        </div>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 transition-opacity lg:hidden" style="display: none;"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 lg:translate-x-0 shadow-lg lg:shadow-none">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('home') ? 'bg-gray-200' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ml-3">Beranda</span>
                    </a>
                </li>

                <hr class="my-2 border-gray-200">
                <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Modul Program</div>

                <li>
                    <a href="{{ route('sorting.index') }}"
                        class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('sorting.*') ? 'bg-gray-200' : '' }}">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                        </svg>
                        <span class="ml-3">Pengurutan Angka</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('payroll.index') }}"
                        class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('payroll.*') ? 'bg-gray-200' : '' }}">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="ml-3">Penggajian</span>
                    </a>
                </li>

                <li x-data="{ open: {{ request()->routeIs('listrik.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="flex items-center w-full p-3 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Data Listrik</span>
                        <svg :class="{ 'rotate-180': open }" class="w-3 h-3 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <ul x-show="open" class="py-2 space-y-2 ml-4">
                        <li>
                            <a href="{{ route('listrik.tarif.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('listrik.tarif.*') ? 'bg-gray-200' : '' }}">
                                Tarif Listrik
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('listrik.pelanggan.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('listrik.pelanggan.*') ? 'bg-gray-200' : '' }}">
                                Data Pelanggan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('listrik.tagihan.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ request()->routeIs('listrik.tagihan.*') ? 'bg-gray-200' : '' }}">
                                Data Tagihan
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 lg:ml-64 pt-20">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white min-h-[85vh]">
            @yield('content')
        </div>

        <footer class="mt-4 text-center text-xs text-gray-400">
            &copy; 2026 ListrikApp - Modul Uji Kompetensi LSP
        </footer>
    </div>
</body>

</html>
