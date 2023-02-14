<!doctype html>

<title>&#x2764; YJMT &#x267b;</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="icon" href="/images/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif;">
<section class="py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/header-logo.png" alt="" width="165" height="165">
            </a>
        </div>
        <div class="mt-8 md:mt-0 flex items-center">
            @auth
                <span class="text-xs font-bold">Hi, {{auth()->user()->name}}</span>
                <a href="/posts/create" class="ml-6 text-xs font-bold uppercase bg-red">Sell!</a>
                <form method="POST" action="/logout" class="ml-3 text-xs font-bold text-blue-800 uppercase py-3 px-5">
                    @csrf
                    <button type="submit"><b>Log Out</b></button>
                </form>
            @else
                <span class="font-bold text-red text-xs">
                        Register or Login To Start Selling!
                    </span>
                <a href="/register" class="ml-3 text-xs font-bold text-dark-blue uppercase py-3 px-5">Register</a>
                <a href="/login" class="ml-3 text-xs font-bold text-dark-blue uppercase py-3 px-5">Log In</a>
            @endauth
        </div>
    </nav>
    {{$slot}}
</section>
<x-flash/>
</body>
