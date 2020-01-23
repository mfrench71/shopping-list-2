@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><i class="fas fa-list-alt"></i> Categories - New Category</div>
        <div class="card-body">

            {!! Form::open(['route' => 'categories.store']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Category Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sort_order', 'Sort Order') !!}
                    {!! Form::selectRange('sort_order', 0, 10, 0, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Add Category', ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection