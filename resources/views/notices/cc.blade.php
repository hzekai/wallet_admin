
@extends('layouts.main')
@section("content")
    <div>
        @foreach($notices as $value)
            <div>
                阿里账号是：{{$value -> title}}
                <time>{{$value -> content}}</time>
            </div>
        @endforeach
    </div>
    {{$notices -> links()}}
@endsection

