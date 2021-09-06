@if (session($key ?? 'error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span>{{ session($key ?? 'error') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
    </button>
</div>
@endif
