@extends('layouts.app',['title' => $gig->title])
@section('content')
    <div class="container" style="position: relative">
        <div class="py-5">
            <div class="row">
                <div class="col-md-8">
                    <p class="m-0">{{ $gig->category->name }}</p>
                    <p class="fw-bolder fs-3">{{ $gig->title }}</p>
                    <div class="d-flex mb-3 align-items-center">
                        @if ($gig->user->profile_image)
                            <img src="{{ asset('storage/profile-pictures/' . $gig->user->profile_image) }}"
                                class="rounded-circle" style="width : 2rem;height : 2rem;object-fit: cover">
                        @else
                            <p class="fs-3 p-0"><i class="fas fa-user-circle"></i></p>
                        @endif
                        <p class="mx-2 my-0">{{ $gig->user->name }} | <i class="fas fa-star text-warning"></i> <span
                                class="text-warning">{{ $avg_rate }}</span> ({{ $rating }}) |
                            @auth
                                @if ($favourite_gig->count() > 0)
                                    <button class="btn p-0 liked" id="likeGig" style="color:red"><i
                                            class="fas fa-heart"></i></button>
                                @else
                                    <button class="btn p-0" id="likeGig"><i class="far fa-heart"></i></button>
                                @endif
                            @endauth
                        </p>
                    </div>
                    <img src="{{ asset('storage/gig-images/' . $gig->gigImages->first()->image_name) }}"
                        style="height: 25rem;width:object-fit : cover" class="mw-100">
                    <div class="d-flex overflow-auto my-3">
                        @foreach ($gig->gigImages as $index => $image)
                            @if ($index > 0)
                                <img src="{{ asset('storage/gig-images/' . $image->image_name) }}"
                                    style="width: 7rem;height : 7rem;object-fit: cover" class="border mx-2">
                                <img src="{{ asset('storage/gig-images/' . $image->image_name) }}"
                                    style="width: 7rem;height : 7rem;object-fit: cover" class="border mx-2">
                            @endif
                        @endforeach
                    </div>
                    <p class="fw-bolder fs-5">About This Gig</p>
                    <p>{{ $gig->about }}</p>
                    <p class="fw-bolder fs-5 mt-5">About The Seller</p>
                    <div class="d-flex align-items-center mb-3">
                        @if ($gig->user->profile_image)
                            <img src="{{ asset('storage/profile-pictures/' . $gig->user->profile_image) }}"
                                class="rounded-circle" style="width : 5rem;height : 5rem;object-fit: cover">
                        @else
                            <p style="font-size : 5rem"><i class="fas fa-user-circle"></i></p>
                        @endif
                        <div class="mx-2">
                            <p>{{ $gig->user->name }}</p>
                            <p>{{ $gig->user->about }}</p>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <p class="card-text">Member Since</p>
                            <p class="card-text">{{ $gig->user->join_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @auth
                        @can('comment', $gig)
                            <form action="{{ route('store-review', $gig->id) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating (1 To 5)</label>
                                    <input type="number" class="form-control @error('rating')is-invalid @enderror" name="rating"
                                        value="{{ old('rating') ?? '' }}" min="1" max="5">
                                    @error('rating')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description"
                                        class="form-label @error('description')is-invalid @enderror">Body</label>
                                    <textarea class="form-control" name="description"
                                        rows="3">{{ old('description') ?? '' }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                            </form>
                        @endcan
                    @endauth
                    @foreach ($reviews as $review)
                        <div class="border-top mb-3 py-3  ">
                            <div class="d-flex align-items-center">
                                @if ($review->user->profile_image)
                                    <img src="{{ asset('storage/profile-pictures/' . $review->user->profile_image) }}"
                                        class="rounded-circle" style="width : 2rem;height : 2rem;object-fit: cover">
                                @else
                                    <p class="fs-3 p-0"><i class="fas fa-user-circle"></i></p>
                                @endif
                                <p class="mx-2">{{ $review->user->name }} <i
                                        class="fas fa-star text-warning">{{ $review->rating }}</i>
                                </p>
                            </div>
                            <p>{{ $review->description }}</p>
                            <p>{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                    {{ $reviews->links() }}
                </div>
                <div class="col-md-4 align-self-start sticky-top" style="z-index : 1">
                    @auth
                        @can('edit', $gig)
                            <a href="{{ route('edit-gig', $gig->id) }}" class="btn btn-primary w-100 ">Edit Gig</a>
                        @endcan
                    @endauth
                    <div class="card mt-4 p-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <p class="card-title">Starter Package</p>
                                <p class="card-text">$ {{ $gig->basic_price }}</p>
                            </div>
                            <div class="card-text">{{ $gig->basic_description }}</div>
                            @auth
                                @can('purchase', $gig)
                                    <a href="{{ route('show-checkout', [$gig->id, 'basic']) }}"
                                        class="btn btn-info mt-3 w-100 text-light">Continue (${{ $gig->basic_price }})</a>
                                @endcan
                            @endauth
                        </div>
                    </div>
                    <div class="card mt-4 p-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <p class="card-title">Best Package</p>
                                <p class="card-text">$ {{ $gig->standard_price }}</p>
                            </div>
                            <div class="card-text">{{ $gig->standard_description }}</div>
                            @auth
                                @can('purchase', $gig)
                                    <a href="{{ route('show-checkout', [$gig->id, 'standard']) }}"
                                        class="btn btn-info mt-3 w-100 text-light">Continue (${{ $gig->standard_price }})</a>
                                @endcan
                            @endauth
                        </div>
                    </div>
                    <div class="card mt-4 p-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <p class="card-title">Premium Package</p>
                                <p class="card-text">$ {{ $gig->premium_price }}</p>
                            </div>
                            <div class="card-text">{{ $gig->premium_description }}</div>
                            @auth
                                @can('purchase', $gig)
                                    <a href="{{ route('show-checkout', [$gig->id, 'premium']) }}"
                                        class="btn btn-info mt-3 w-100 text-light">Continue
                                        (${{ $gig->premium_price }})</a>
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
        <?php $user_id = auth()->user()->id; ?>
        <script>
            $("#likeGig").on('click', (e) => {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if ($('#likeGig').hasClass('liked')) {
                    $.ajax({
                        url: "/api/love/<?= $user_id ?>/<?= $gig->id ?>",
                        type: "DELETE",
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#likeGig').html('<i class="far fa-heart"></i>');
                            $('#likeGig').css('color', 'black')
                            $('#likeGig').removeClass('liked');
                            console.log(data);
                        },
                        error: (data) => {
                            console.log(data);
                        },
                    });
                } else {
                    $.ajax({
                        url: "/api/love/<?= $user_id ?>/<?= $gig->id ?>",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#likeGig').html('<i class="fas fa-heart"></i>');
                            $('#likeGig').css('color', 'red');
                            $('#likeGig').addClass('liked');
                            console.log(data);
                        },
                        error: (data) => {
                            console.log(data);
                        },
                    });
                }
            });
        </script>
    @endauth
@endsection
