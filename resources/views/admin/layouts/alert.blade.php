@if(Session::has('message'))
<div class="alert alert-{{ Session::get('typealert') }} alert-dismissible fade show" role="alert">
    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
    <span class="alert-inner--text"><strong>{{ Session::get('message') }}</strong>
        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>
        @endif
    </span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
