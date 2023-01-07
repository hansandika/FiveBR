@extends('layouts.app', ['title' => $user->name])
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="card-body">
                        @if ($user->profile_image)
                            <div class="d-flex justify-content-center mb-4">
                                <img src="{{ asset('storage/profile-pictures/' . $user->profile_image) }}"
                                    class="rounded-circle" style="width : 10rem;height : 10rem;object-fit: cover">
                            </div>
                        @else
                            <div class="text-center" style="font-size: 9rem">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        @endif
                        <h5 class="card-title text-center fw-bolder">{{ $user->name }}</h5>
                        @if ($user->about)
                            <p class="card-text text-center">{{ $user->about }}</p>
                        @endif
                        @if ($user->description)
                            <h5 class="card-title text-center">Description</h5>
                            <p class="card-text text-center">{{ $user->description }}</p>
                        @endif
                        <a href="{{ route('edit-profile', $user->id) }}" class="btn btn-info w-100 text-light mb-3"><i
                                class="fas fa-pencil-alt"></i>
                            Edit Profile</a>
                        <div class="d-flex justify-content-between border-top pt-3">
                            <p><i class="fas fa-user mx-2"></i>Member Since</p>
                            <p class="fw-bolder">{{ $user->join_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-3">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h3 class="fw-bolder">{{ $user->name }}'s Gigs</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('create-gig') }}" class="w-100 btn btn-info text-light">
                            <i class="fas fa-plus"></i> Create Gig</a>
                    </div>
                </div>
                <div class="row p-3">
                    @foreach ($user->gigs as $gig)
                        <div class="col-md-4 mb-4">
                            <div class="card">
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
                                                class="fas fa-user-circle mx-2"></i>{{ $user->name }}</p>
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
                                                <button class="btn p-0 liked likeGig" style="color:red"
                                                    value="{{ $gig->id }}"><i class="fas fa-heart"></i></button>
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
                    @endforeach
                </div>
            </div>
        </div>
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
