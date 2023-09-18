@extends('layouts.base')

@section('content')


        <?php //var_dump($model);die; ?>
        <a href="https://eda.ru{{$model->link_to_origin}}" class="card">
            <div class="title">наименование: {{$model->name}}</div>
            <div class="description">описание: {{$model->description}}</div>
            <div> время приготовления: {{$model->cooking_time}}</div>
            <div>порций: {{$model->portion}}</div>
            <div>ккал: {{$model->ccal}}</div>
            <div>белок: {{$model->protein}}</div>
            <div>жиры: {{$model->fat}}</div>
            <div>углеводы: {{$model->carbohydrates}}</div>
            <div>инструкция:
                <?php  $i=1; ?>
                @foreach(json_decode($model->instruction) as $step)
                    <br/> {{$i}}. {{$step->values}}
                    <?php  $i++; ?>
                @endforeach



            </div>

            <div>ингредиенты:
                <?php  $i=1; ?>
                @foreach(json_decode($ingredients) as $ingredient)
                    <br/> {{$i}}. {{$ingredient->name}} - {{$ingredient->value}}
                        <?php  $i++; ?>
                @endforeach



            </div>

            <div>ссылка на оригинал: {{$model->link_to_origin}}</div>
        </a>

@endsection
