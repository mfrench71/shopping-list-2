@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Home</div>
        <div class="card-body">
            
            @auth

                <div class="row">

                    <div class="container">

                        <div class="card-deck">

                            {{-- Step 1 --}}
                            <div class="card border-info">
                                <div class="card-header text-white bg-info">
                                    Step 1
                                    @if ($categories_count)
                                        <i class="fas fa-check-circle fa-lg pull-right"></i>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Create Product Categories</h5>
                                    <p class="card-text">Product categories help you group and organise your shopping list items. Create categories such as Dairy, Meat, Frozen, or organise your products by aisle.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-info">Add</a>
                                            @if ($categories_count)
                                                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 2 --}}
                            <div class="card {{ $categories_count ? 'border-info' : 'border-secondary' }}">
                                <div class="card-header text-white {{ $categories_count ? 'bg-info' : 'bg-secondary' }}">
                                    @if ($products_count)
                                        <i class="fas fa-check-circle fa-lg pull-right"></i>
                                    @endif
                                    Step 2
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Add Your Products</h5>
                                    <p class="card-text">Now that you've created your product categories, you can start adding your products.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($categories_count)
                                            <div class="btn-group">
                                                <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-info">Add</a>
                                                @if ($products_count)
                                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Step 3 --}}
                            <div class="card {{ $products_count ? 'border-info' : 'border-secondary' }}">
                                <div class="card-header text-white {{ $products_count ? 'bg-info' : 'bg-secondary' }}">
                                    Step 3
                                    @if ($shopping_lists_count)
                                        <i class="fas fa-check-circle fa-lg pull-right"></i>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Create Your Lists!</h5>
                                    <p class="card-text">This is what it's all about. Create your lists and start adding your products!</p>
                                </div>
                                <div class="card-footer">
                                     <div class="d-flex justify-content-between align-items-center">
                                        @if ($products_count)
                                            <div class="btn-group">
                                                <a href="{{ route('shopping-lists.create') }}" class="btn btn-sm btn-outline-info">Add</a>
                                                @if ($shopping_lists_count)
                                                    <a href="{{ route('shopping-lists.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div> {{-- End of card deck --}}

                    </div> {{-- End of container --}}
            
                </div> {{-- End of row --}}

            @endauth

            @guest
                <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to manage your Shopping Lists
            @endguest
            
        </div> {{-- End of outer card body --}}
    </div> {{-- End of outer card --}}
@endsection
