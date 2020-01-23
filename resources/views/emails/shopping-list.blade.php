@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
<p>Hi {{ $user->name}}</p>

<p>Here is your Shopping List:</p>

<h1>{{ $shoppingList->title }}</h1>

<p>{{ $shoppingList->description }}</p>

{{-- Subcopy --}}
@slot('subcopy')
@component('mail::subcopy')
<ul>
@foreach ($shoppingList->products as $product)
<li>
{{ $product->title}}<br>
<em>{{ $product->pivot->note }}</em>
</li>
@endforeach
</ul>
@endcomponent
@endslot


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            {{ config('app.name') }}
        @endcomponent
    @endslot
@endcomponent