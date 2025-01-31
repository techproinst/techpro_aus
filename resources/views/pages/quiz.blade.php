<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Test</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/quiz.css') }}">
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">Home / Personality Test</div>
        <div class="question" id="question">Loading question...</div>
        <div class="options" id="options"></div>

        <div class="progress-bar">
            <div class="progress-bar-inner" id="progress-bar-inner"></div>
        </div>
        <div class="progress-text" id="progress-text">0% complete</div>
        <div class="preloader" id="preloader">Calculating your result...</div>
        <div class="result" id="result"></div>
    </div>

    <script src="{{ asset('assets/scripts/quiz.js') }}"></script>
</body>
</html>