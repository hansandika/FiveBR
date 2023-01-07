@extends('layouts.app', ['title' => 'Checkout'])
@section('content')
    <div class="container py-5">
        <h3 class="fw-bolder mb-3">Gig Checkout</h3>
        <div class="row">
            <div class="col-md-8 my-2">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="m-0">{{ $gig->category->name }}</p>
                                <h5 class="card-title fw-bolder mb-5">{{ $gig->title }}</h5>
                                <div class="d-flex mb-3 align-items-center">
                                    @if ($gig->user->profile_image)
                                        <img src="{{ asset('storage/profile-pictures/' . $gig->user->profile_image) }}"
                                            class="rounded-circle" style="width : 2rem;height : 2rem;object-fit: cover">
                                    @else
                                        <p class="fs-3 p-0"><i class="fas fa-user-circle"></i></p>
                                    @endif
                                    <p class="mx-2">{{ $gig->user->name }} | <i class="fas fa-star text-warning"></i><span
                                            class="text-warning">
                                            {{ $avg_rate }}</span> ({{ $rating }})</p>
                                </div>
                                <p>{{ $gig->about }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('storage/gig-images/' . $gig->gigImages->first()->image_name) }}"
                                class="rounded   w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-2">
                <div class="card p-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder">{{ ucfirst($type) }}</h5>
                        <p>${{ $price }}</p>
                        <form action="{{ route('store-checkout', $gig->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="price" value="{{ $price }}">
                            <button type="submit" class="btn btn-info mt-3 w-100 text-light">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
