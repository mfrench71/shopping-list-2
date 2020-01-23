@if ($errors->any())
    <div class="alert-important alert alert-danger">
        <h4><i class="fas fa-exclamation-triangle"></i> Warning</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif