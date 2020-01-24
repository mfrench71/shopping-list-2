@extends('layouts.app')

@section('scripts')
    <script>
        // AJAX category sort order
        $(function() {
            $(".sortable-categories").sortable({
                stop: function() {
                    $.map($(this).find('tr'), function(el) {
                        let category_id = el.id;
                        let sort_order = $(el).index();
                        $.ajax({
                            url: 'categories/sort',
                            type: 'GET',
                            data: {
                                category_id: category_id,
                                sort_order: sort_order
                            },
                        });
                    });
                }
            });
        });

        // AJAX category delete
        $('.deleteCategory').on('click', function(e) {
            if (confirm('Are you sure you want to delete this category?'))
            {
                let dataId = $(this).attr('data-id');
                let parent = $(this).parent();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url: 'categories/' + dataId,
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
            <i class="fas fa-list-alt"></i> Categories
            <a role="button" class="btn btn-primary float-right" data-toggle="collapse" href="#collapse" aria-expanded="true" aria-controls="collapse">
                <i class="fas fa-plus-circle"></i> New Category
            </a>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><i class="fas fa-sort"></i></th>
                            <th>Title</th>
                            <th>#Products</th>
                            <th class="d-none d-sm-table-cell">Date Added</th>
                            <th class="w-20">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable-categories">
                        @forelse ($categories as $category)
                            <tr id="{{ $category->id }}">
                                <td><i class="fas fa-bars" style="cursor: move;"></i></td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td class="d-none d-sm-table-cell">{{ $category->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id]]) !!}
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary" role="button"><i class="fas fa-edit"></i></a>
                                        @if ($category->title != 'Uncategorised')
                                            {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-primary deleteCategory', 'data-id' => $category->id]) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">There are no categories.</td>
                            </tr>
                        @endforelse
                        <div class="collapse pb-4" id="collapse">
                            {!! Form::open(['route' => 'categories.store']) !!}

                            <div class="form-group">
                                {!! Form::label('title', 'Category Title') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }}

        </div>
    </div>

@endsection
