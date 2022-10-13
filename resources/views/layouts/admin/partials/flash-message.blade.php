<div>
    @if(Session::has('message'))
        <div class="alert alert-success mt-8">
            {{ Session::get('message') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger mt-8">
            {{ Session::get('error') }}
        </div>
    @endif
</div>