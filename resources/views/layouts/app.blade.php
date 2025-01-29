<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Trix Editor CSS -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="block md:flex justify-between">
                            <div>{{ $header }}</div>
                            <div>
                                @isset($headerRight)
                                    
                                {{ $headerRight }}
    
                                @endisset
                            </div>
                        </div>
                       

                        @if($errors->any())
                        <div class="max-w-7xl mx-auto bg-red-500 p-3 mt-3 text-white rounded-md relative" id="error-notification">
                            <button class="absolute top-3 right-2 text-white" onclick="document.getElementById('error-notification').style.display='none'">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @session('success')
                        <div class="max-w-7xl mx-auto bg-blue-500 p-3 mt-3 text-white rounded-md relative" id="success-notification">
                            <button class="absolute top-3 right-2 text-white" onclick="document.getElementById('success-notification').style.display='none'">&times;</button>
                            <ul>
                                {{ session('success') }}
                            </ul>
                        </div>
                    @endsession
                    
                    

                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <!-- Trix Editor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond@4.24.6/dist/filepond.js"></script>
</html>
