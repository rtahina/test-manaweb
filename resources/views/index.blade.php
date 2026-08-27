<html>

<head>
    <title>Test ManaWeb</title>
    <!--Vite resource-->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
            "wdth" 100;
            color: 333;
            background: linear-gradient(to bottom, #ccc, #aaa); 
        }
    </style>
</head>

<body>
    <div id="app"></div>
</body>

</html>