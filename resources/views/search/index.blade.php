@extends('layouts.app', ['title' => 'Search'])
@section('content')
    <div class="container py-5">
        <form class="mb-3">
            <div class="row">
                <div class="col-md-2 my-2">
                    <input type="text" class="form-control" name="title" placeholder="Search"
                        value="{{ request('title') }}">
                </div>
                <div class="col-md-2 my-2">
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>-- Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == request('category_id') ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 my-2">
                    <input type="number" class="form-control" name="min_budget" placeholder="Min Budget..."
                        value="{{ request('min_budget') }}">
                </div>
                <div class="col-md-2 my-2">
                    <input type="number" class="form-control" name="max_budget" placeholder="Max Budget..."
                        value="{{ request('max_budget') }}">
                </div>
                <div class="col-md-2 my-2">
                    <input type="text" class="form-control" name="seller_name" placeholder="Seller Name..."
                        value="{{ request('seller_name') ?? old('seller_name') }}">
                </div>
                <div class="col-md-2 my-2">
                    <button type="submit" class="btn btn-primary form-control">Search</button>
                </div>
            </div>
        </form>
        <div
            class="d-flex justify-content-center justify-content-md-start gap-3 flex-wrap align-items-center align-content-center p-3">
            @forelse ($gigs as $gig)
                <div class="mb-4">
                    <div class="card" style="width : 15rem">
                        <a href="{{ route('show-gig', $gig->id) }}"><img
                                src="{{ asset('storage/gig-images/' . $gig->gigImages->first()->image_name) }}"
                                class="card-img-top w-100" style="height : 15rem;object-fit: cover"></a>
                        <div class="card-body">
                            @if ($gig->user->profile_image)
                                <div class="d-flex mb-3">
                                    <img src="{{ asset('storage/profile-pictures/' . $gig->user->profile_image) }}"
                                        class="rounded-circle" style="width : 2rem;height : 2rem;object-fit: cover">
                                    <p class="mx-2 my-0">{{ $gig->user->name }}</p>
                                </div>
                            @else
                                <p class="card-text" style="font-size: 1.2rem"><i
                                        class="fas fa-user-circle mx-2"></i>{{ $gig->user->name }}</p>
                            @endif
                            <a href="{{ route('show-gig', $gig->id) }}" class="text-decoration-none text-dark">
                                <p class="card-title">{{ Str::limit($gig->title, 20) }}</p>
                            </a>
                        </div>
                        <div class="card-footer border-top d-flex justify-content-between align-items-center">
                            @auth
                                <?php $fav = false; ?>
                                @foreach ($gig->favouriteGigs as $favouriteGig)
                                    @if ($favouriteGig->user_id == auth()->user()->id)
                                        <button class="btn p-0 liked likeGig" style="color:red" value="{{ $gig->id }}"><i
                                                class="fas fa-heart"></i></button>
                                        <?php $fav = true; ?>
                                    @endif
                                @endforeach
                                @if (!$fav)
                                    <button class="btn p-0 likeGig" value="{{ $gig->id }}"><i
                                            class="far fa-heart"></i></button>
                                @endif
                            @endauth
                            <a href="{{ route('show-gig', $gig->id) }}"
                                class="text-uppercase text-decoration-none text-dark">Starting At
                                ${{ $gig->basic_price }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center fs-3 fw-bolder">No gigs found</p>
            @endforelse
        </div>
        {{ $gigs->appends(request()->except('page'))->links() }}
    </div>
    @auth
        <?php $user_id = auth()->user()->id; ?>
        <script>
            const likedGig = $('.likeGig');
            likedGig.each(function() {
                $(this).on('click', function() {
                    var gig_id = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if ($(this).hasClass('liked')) {
                        $.ajax({
                            url: "/api/love/<?= $user_id ?>/" + gig_id,
                            type: "DELETE",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="far fa-heart"></i>');
                                $(this).css('color', 'black')
                                $(this).removeClass('liked');
                                console.log(data);
                            },
                            error: (data) => {
                                console.log(data);
                            },
                        });
                    } else {
                        $.ajax({
                            url: "/api/love/<?= $user_id ?>/" + gig_id,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="fas fa-heart"></i>');
                                $(this).css('color', 'red');
                                $(this).addClass('liked');
                                console.log(data);
                            },
                            error: (data) => {
                                console.log(data);
                            },
                        });
                    }
                })
            });
        </script>
    @endauth
@endsection
