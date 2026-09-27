<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#050914" id="theme-color">
    <title>Billy Harion | Portfolio</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('portfolio-theme');
                const theme = savedTheme === 'light' || savedTheme === 'dark'
                    ? savedTheme
                    : window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

                document.documentElement.dataset.theme = theme;
            } catch {
                document.documentElement.dataset.theme = 'light';
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
</body>
</html>
