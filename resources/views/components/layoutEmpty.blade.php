<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zlecamy</title>
    {{-- TODO wszystkie mata tagi --}}
    @vite('resources/css/app.css')

    {{-- GoogleFonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    {{-- FontAwosome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    {{-- AlpineJS --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-background text-white">

    <main>
        {{$slot}}
    </main>


</body>

</html>