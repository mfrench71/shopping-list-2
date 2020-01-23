@extends('layouts.app')

@section('scripts')
    <script>
        $('.deleteProduct').on('click', function(e) {
            if (confirm('Are you sure you want to delete this product?')) 
            {
                var dataId = $(this).attr('data-id');
                var parent = $(this).parent();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url: 'products/' + dataId,
                    type: 'DELETE',
                    data: dataId,
                    success: function( msg ) {
                        if ( msg.status === 'success' ) {
                            toastr.success( msg.msg );
                            // remove row from DOM
                            parent.slideUp(300, function () {
                                parent.closest("tr").remove();
                            });
                        }
                    }
                });
            }
            return false;
        });
    </script>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list-alt"></i> Products
            <a href="{{ route('products.create') }}" class="btn btn-info float-right"><i class="fas fa-plus-circle"></i> New Product</a>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Essential</th>
                            <th class="d-none d-sm-table-cell">Used in Lists</th>
                            <th class="d-none d-sm-table-cell">Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->category->title }}</td>
                                <td>{{ $product->essential }}</td>
                                <td class="d-none d-sm-table-cell">{{ $product->shoppingLists->count() }}</td>
                                <td class="d-none d-sm-table-cell">{{ $product->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id]]) !!}
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-info" role="button"><i class="fas fa-edit"></i></a>
                                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-info deleteProduct', 'data-id' => $product->id]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">There are no products.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}

        </div>
    </div>

@endsection