@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><i class="fas fa-list-alt"></i> Shopping Lists - New List</div>
        <div class="card-body">

            {!! Form::open(['route' => 'shopping-lists.store']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'List Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Add List', ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection