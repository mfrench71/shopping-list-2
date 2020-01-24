@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><i class="fas fa-list-alt"></i> Products - New Product</div>
        <div class="card-body">

            {!! Form::open(['route' => 'products.store']) !!}

                <div class="form-group row">
                    {!! Form::label('title', 'Product Title', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Product Title']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('category_id', 'Category', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('category_id', [null => 'Select a Category'] + $categories,  null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">Essential?</div>
                    {!! Form::hidden('essential', 0) !!}
                    <div class="col-sm-10">
                        <div class="form-check">
                            {!! Form::checkbox('essential', 1, null, ['class' => 'form-check-input']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        {!! Form::submit('Add Product', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
