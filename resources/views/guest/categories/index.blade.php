@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Tutte le categorie</h1>
                <ul>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('categories.show', ['slug' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection