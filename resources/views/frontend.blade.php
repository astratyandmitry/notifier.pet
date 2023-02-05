<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Notifier App</title>
  {{ Vite::useBuildDirectory('/frontend') }}
  @vite('resources/js/frontend/app.js')
</head>
<body>

<div id="app"></div>

</body>
</html>
