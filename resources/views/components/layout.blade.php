<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$page ?? 'App ToDo'}}</title>

    <!-- Importtando fonts do google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css" />
</head>

<body>
    <div class="container">

        <div class="sidebar">
            <a href="{{route('home')}}"><img src="/assets/images/logo3.png" /></a>
        </div>

        <div class="content">
            <nav>
                {{$btn ?? null}}
            </nav>

            <main>
                {{$slot}}
            </main>
        </div>
    </div>
</body>

</html>

{{--
Esse layout é comum a todas as rotas, mas o {{$slot}} é o conteúdo dinamico
que será inserido de acordo com a requisição/rota. --}}
