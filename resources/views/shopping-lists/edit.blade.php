@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list-alt"></i> Shopping Lists - Edit List
             <span class="float-right">Date Added: {{ $shoppingList->created_at->toDayDateTImeString() }}</span>
        </div>
        <div class="card-body">

            {!! Form::model($shoppingList, ['route' => ['shopping-lists.update', $shoppingList], 'method' => 'PUT']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'List Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Update List', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection
