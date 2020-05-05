<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bitfumes</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="app">
        <v-app>
            <app-home></app-home>
        </v-app>
    </div>
</body>

</html>