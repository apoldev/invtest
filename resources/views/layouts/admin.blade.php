
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
<div class="wrapper">
    <div class="header">
        <div class="container">
        	<h2> @yield('title') </h2>
        </div>
    </div>
    <div class="wrap">
        <div class="container">
        	@yield('content')
        </div>
    </div>
</div>

</body>
</html>