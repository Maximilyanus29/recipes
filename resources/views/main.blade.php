@extends('layouts.base')

@section('content')

    @foreach($models as $model)
        <a href="/{{$model->slug}}" class="card">
            <div class="title">наименование: {{$model->name}}</div>
            <div class="description">описание: {{$model->description}}</div>
            <div> время приготовления: {{$model->cooking_time}}</div>
            <div>порций: {{$model->portion}}</div>
            <div>ккал: {{$model->ccal}}</div>
            <div>белок: {{$model->protein}}</div>
            <div>жиры: {{$model->fat}}</div>
            <div>углеводы: {{$model->carbohydrates}}</div>
{{--            <div>инструкция: {{$model->instruction}}</div>--}}
{{--            <div>ссылка на оригинал: {{$model->link_to_origin}}</div>--}}
        </a>
    @endforeach

@endsection
