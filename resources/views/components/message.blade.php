@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible no-print" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible no-print" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
