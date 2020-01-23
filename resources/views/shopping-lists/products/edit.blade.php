@extends('layouts.app')

@section('scripts')
    <script>
        ( function( $ ) {
          $( '#availableCheckbox' ).multicheck( $( '.availableListCheckbox' ) );
        })( jQuery );

        ( function( $ ) {
          $( '#productsCheckbox' ).multicheck( $( '.productsListCheckbox' ) );
        })( jQuery );
    </script>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
           <a href="{{route('shopping-lists.index')}}"> <i class="fas fa-arrow-circle-left"></i></a>  Shopping Lists
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    {{ $shoppingList->title }}
                    <span class="float-right">Date Added: {{ $shoppingList->created_at->toDayDateTImeString() }}</span>
                </div>
                <div class="card-body">
                    {{ $shoppingList->description }}
                    <hr />
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['shopping-lists-products.destroy', $shoppingList], 'method' => 'delete']) !!}
                                <div class="card mb-2">
                                    <div class="card-header">
                                        {!! Form::checkbox('productsCheckbox', null, false, ['id' => 'productsCheckbox', 'class' => 'mr-1']) !!}
                                        Products in List:
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            @forelse ($products_in_list as $product_in_list)
                                                <div class="row">
                                                    <div class="col-1">
                                                        {!! Form::checkbox('products[]', $product_in_list->id, false , ['class' => 'input-control productsListCheckbox']) !!}
                                                    </div>
                                                    <div class="col">
                                                        @if ($product_in_list->essential)
                                                            <span class="essential">{{ $product_in_list->title}}</span>
                                                        @else
                                                            {{ $product_in_list->title}}
                                                        @endif
                                                        @if ($product_in_list->pivot->note)
                                                           <i class="fas fa-info-circle" data-trigger="hover" data-toggle="popover" data-content="{{ $product_in_list->pivot->note }}"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            @empty
                                                There are no products in this list.
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if (count($products_in_list))
                                            {!! Form::button('<i class="fas fa-minus-circle"></i> Remove Selected', ['type' => 'submit', 'class' => 'btn btn-info btn-sm pull-right']) !!}
                                            <a class="btn btn-info btn-sm pull-right mr-2" href="{{ route('shopping-lists.email', $shoppingList) }}"><i class="fas fa-envelope"></i> Email List</a>
                                        @endif
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['shopping-lists-products.update', $shoppingList], 'method' => 'put']) !!}
                                <div class="card">
                                    <div class="card-header">
                                        {!! Form::checkbox('availableCheckbox', null, false, ['id' => 'availableCheckbox', 'class' => 'mr-1']) !!}
                                        Available Products:
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            @forelse ($products_available as $product)
                                                <div class="row mb-1">
                                                    <div class="col-1">
                                                        {!! Form::checkbox('products[]', $product->id, false, ['class' => 'input-control availableListCheckbox']) !!}
                                                    </div>
                                                    <div class="col">
                                                        @if ($product->essential)
                                                            <span class="essential">{{ $product->title}}</span>
                                                        @else 
                                                            {{ $product->title}}
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        {!! Form::text('notes[' . $product->id . ']', null, ['class' => 'form-control-sm', 'placeholder' => 'Note']) !!}
                                                    </div>
                                                </div>
                                            @empty
                                                There are no available products.
                                            @endforelse
                                        </div>
                                    </div>
                                     <div class="card-footer">
                                        @if (count($products_available))
                                            {!! Form::button('<i class="fas fa-plus-circle"></i> Add Selected', ['type' => 'submit', 'name' => 'action', 'value' => 'add_products', 'class' => 'btn btn-info btn-sm pull-right']) !!}
                                            {!! Form::button('<i class="fas fa-plus-circle"></i> Add Essentials', ['type' => 'submit', 'name' => 'action', 'value' => 'add_essentials', 'class' => 'btn btn-info btn-sm pull-right mr-2']) !!}
                                        @endif
                                     </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection