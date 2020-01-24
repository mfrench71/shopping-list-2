@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="{{route('categories.index')}}"> <i class="fas fa-arrow-circle-left"></i></a>
            Categories - Edit Category
            <span class="float-right">Date Added: {{ $category->created_at->toDayDateTImeString() }}</span>
        </div>
        <div class="card-body">

            {!! Form::model($category, ['route' => ['categories.update', $category], 'method' => 'PUT']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Category Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', $category->title == 'Uncategorised' ? 'readonly' : '']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sort_order', 'Sort Order') !!}
                    {!! Form::selectRange('sort_order', 0, 10, null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection
