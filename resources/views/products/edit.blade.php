@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
             <a href="{{route('products.index')}}"> <i class="fas fa-arrow-circle-left"></i></a> Products - Edit Product
            <span class="float-right">Date Added: {{ $product->created_at->toDayDateTImeString() }}</span>
        </div>
        <div class="card-body">

            {!! Form::model($product, ['route' => ['products.update', $product], 'method' => 'PUT']) !!}

                <div class="form-group row">
                    {!! Form::label('title', 'Product Title', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Product Title']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('category_id', 'Category', ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('category_id', [null => 'Select a Category'] + $categories, $product->category_id, ['class' => 'form-control']) !!}
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
                        {!! Form::submit('Update Product', ['class' => 'btn btn-info']) !!}
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection