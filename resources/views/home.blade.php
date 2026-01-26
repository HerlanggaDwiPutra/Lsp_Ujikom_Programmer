@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="max-w-4xl mx-auto text-center mt-10">
    <div class="mb-8">
        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded border border-gray-400">
            <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 1 0 10 10A10 10 0 0 0 10 0Zm3.48 14.717a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707Zm-2.121-2.121a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707Zm-2.122-2.122a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707Z"/>
            </svg>
            Sistem Integrasi v1.0
        </span>
    </div>

    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        Selamat Datang di <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-700 to-black">Portal Aplikasi</span>
    </h1>

    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48">
        Silakan pilih modul program di bawah ini atau gunakan menu navigasi untuk memulai pekerjaan Anda.
    </p>

    <div class="grid md:grid-cols-3 gap-6 text-left mt-12">

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition flex flex-col justify-between">
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Pengurutan Angka</h5>
                <p class="mb-3 font-normal text-gray-700">Algoritma sorting sederhana (Ascending).</p>
            </div>
            <a href="{{ route('sorting.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-900 w-fit">
                Buka Program
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
            </a>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition flex flex-col justify-between">
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Sistem Penggajian</h5>
                <p class="mb-3 font-normal text-gray-700">Hitung gaji karyawan PT Argo Industri.</p>
            </div>
            <a href="{{ route('payroll.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-900 w-fit">
                Buka Program
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
            </a>
        </div>

        <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg shadow text-white flex flex-col justify-between">
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Data Listrik</h5>
                <p class="mb-3 font-normal text-gray-400">Kelola Tarif, Pelanggan, dan Tagihan Listrik Pascabayar.</p>
            </div>
            <a href="{{ route('listrik.tarif.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 w-fit">
                Kelola Sekarang
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
            </a>
        </div>

    </div>
</div>
@endsection
