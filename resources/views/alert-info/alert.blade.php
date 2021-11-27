@if (session()->has('success'))
    <div class="alert alert-success m-0 p-0">
        <button type="button" class="btn-close float-end py-3" aria-label="Close" data-bs-dismiss="alert"></button>
        <p class="text-center my-0 py-3">{{ session()->get('success') }}</p>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger m-0 p-0">
        <button type="button" class="btn-close float-end py-3" aria-label="Close" data-bs-dismiss="alert"></button>
        <p class="text-center my-0 py-3">{{ session()->get('error') }}</p>
    </div>
@endif
