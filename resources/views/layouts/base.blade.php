<?php
use Illuminate\Support\Facades\Session;

/** @var $ingredients Illuminate\Support\Collection */
/** @var $categories Illuminate\Support\Collection */
/** @var $filters array */

$filters = Session::get('filters');

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>


<nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="/">Рецепты</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                        <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                        <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbarsExample01">

            <form action="/" method="post">
                @csrf <!-- {{ csrf_field() }} -->

                <div class="navbar-nav">
                    <label for="">
                        Категории
                    </label>
                    <select class="js-example-basic-multiple" name="filters[category][]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(isset($filters['category']) && in_array($category->id, $filters['category'])) selected @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="navbar-nav">
                    <label for="">
                        Исключить категории
                    </label>
                    <select class="js-example-basic-multiple" name="filters[category][]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(isset($filters['category']) && in_array($category->id, $filters['category'])) selected @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="navbar-nav">
                    <label for="">
                        Ингредиенты
                    </label>
                    <select class="js-example-basic-multiple" name="filters[ingredients][]" multiple="multiple">
                        @foreach($ingredients as $ingredient)
                            <option value="{{$ingredient->id}}"
                                    @if(isset($filters['ingredients']) && in_array($ingredient->id, $filters['ingredients'])) selected @endif
                            >{{$ingredient->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="navbar-nav">
                    <label for="">
                        Исключитьи ингредиенты
                    </label>
                    <select class="js-example-basic-multiple" name="filters[ingredients][]" multiple="multiple">
                        @foreach($ingredients as $ingredient)
                            <option value="{{$ingredient->id}}"
                                    @if(isset($filters['ingredients']) && in_array($ingredient->id, $filters['ingredients'])) selected @endif
                            >{{$ingredient->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div><p class="exclude_label">Исключить</p></div>

                <div class="navbar-nav checkboxes">
                    <input type="checkbox" class="btn-check" id="btn-check-lactose" autocomplete="off" value="1" name="filters[no_lactose]" @if(isset($filters['no_lactose'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-lactose">Без лактозы</label>

                    <input type="checkbox" class="btn-check" id="btn-check-gluten" autocomplete="off" value="1" name="filters[no_gluten]" @if(isset($filters['no_gluten'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-gluten">Без глютена</label>

                    <input type="checkbox" class="btn-check" id="btn-check-sugar" autocomplete="off" value="1" name="filters[no_sugar]" @if(isset($filters['no_sugar'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-sugar">Без сахара</label>

                    <input type="checkbox" class="btn-check" id="btn-check-fry" autocomplete="off" value="1" name="filters[no_fry]" @if(isset($filters['no_fry'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-fry">Не жареное</label>

                    <input type="checkbox" class="btn-check" id="btn-check-fat" autocomplete="off" value="1" name="filters[no_fat]" @if(isset($filters['no_fat'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-fat">Не жирное</label>


                </div>

                <div><p class="exclude_label">Выбрать только</p></div>

                <div class="navbar-nav checkboxes">
                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Здоровое питание</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Для диабетиков</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Для гастрита(1 стол)</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Для гастрита(2 стол)</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Сладости</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Высокобелоковая</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Низкоуглеводная</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">На пару</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Мультиварка</label>

                    <input type="checkbox" class="btn-check" id="btn-check-health" autocomplete="off" value="1" name="filters[healthy_eating]" @if(isset($filters['healthy_eating'])) checked @endif >
                    <label class="btn btn-primary" for="btn-check-health">Духовка</label>




                </div>

                <button type="submit" class="btn btn-success">Применить</button>
                <a href="/gen" class="btn btn-danger">сгенерить рацион на день</a>
                <a href="/reset-filters" class="btn btn-danger">очистить фильтры</a>
{{--                <button type="submit" class="btn btn-danger">очистить фильтры</button>--}}
            </form>

        </div>


    </div>
</nav>





<div class="container my-12">
    @yield('content')
</div>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
