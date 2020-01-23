@extends('layouts.app')

@section('scripts')
    <script>
        $('.deleteShoppingList').on('click', function(e) {
            if (confirm('Are you sure you want to delete this list?')) 
            {
                var dataId = $(this).attr('data-id');
                var parent = $(this).parent();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url: 'shopping-lists/' + dataId,
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
            <i class="fas fa-list-alt"></i> Shopping Lists
            <a href="{{ route('shopping-lists.create') }}" class="btn btn-info float-right"><i class="fas fa-plus-circle"></i> New List</a>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th class="w-30 d-none d-sm-table-cell">Description</th>
                            <th class="d-none d-sm-table-cell">#Products</th>
                            <th class="d-none d-sm-table-cell">Date Added</th>
                            <th class="w-20">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shoppingLists as $shoppingList)
                            <tr>
                                <td>{{ $shoppingList->id }}</td>
                                <td>{{ $shoppingList->title }}</td>
                                <td class="d-none d-sm-table-cell">{{ $shoppingList->description }}</td>
                                <td class="d-none d-sm-table-cell">{{ $shoppingList->products->count() }}</td>
                                <td class="d-none d-sm-table-cell">{{ $shoppingList->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['shopping-lists.destroy', $shoppingList->id]]) !!}
                                        <a href="{{ route('shopping-lists-products.edit', $shoppingList) }}" class="btn btn-info"><i class="fas fa-eye fa-fw "></i></a>
                                        <a href="{{ route('shopping-lists.edit', $shoppingList) }}" class="btn btn-info" role="button"><i class="fas fa-edit"></i></a>
                                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-info deleteShoppingList', 'data-id' => $shoppingList->id]) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">There are no shopping lists.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $shoppingLists->links() }}

        </div>
    </div>

@endsection