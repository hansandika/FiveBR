@extends('layouts.app',['title' => 'Loved Gigs'])
@section('content')
    <div class="container">
        <div class="py-5">
            <h4 class="fw-bolder mb-4">Loved Gigs</h4>
            <div class="row">
                @forelse ($favourite_gigs as $favourite_gig)
                    <div class="col-md-2 mb-4 mx-3">
                        <div class="card" style="width : 15rem">
                            <a href="{{ route('show-gig', $favourite_gig->gig->id) }}"><img
                                    src="{{ asset('storage/gig-images/' . $favourite_gig->gig->gigImages->first()->image_name) }}"
                                    class="card-img-top w-100" style="height : 15rem;object-fit: cover"></a>
                            <div class="card-body">
                                @if ($favourite_gig->gig->user->profile_image)
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('storage/profile-pictures/' . $favourite_gig->gig->user->profile_image) }}"
                                            class="rounded-circle" style="width : 2rem;height : 2rem;object-fit: cover">
                                        <p class="mx-2 my-0">{{ $favourite_gig->gig->user->name }}</p>
                                    </div>
                                @else
                                    <p class="card-text" style="font-size: 1.2rem"><i
                                            class="fas fa-user-circle mx-2"></i>{{ $favourite_gig->gig->user->name }}</p>
                                @endif

                                <a href="{{ route('show-gig', $favourite_gig->gig->id) }}"
                                    class="text-decoration-none text-dark">
                                    <p class="card-title">{{ Str::limit($favourite_gig->gig->title, 20) }}</p>
                                </a>
                            </div>
                            <div class="card-footer border-top d-flex justify-content-between align-items-center">
                                <button class="btn p-0 liked likeGig" style="color:red"
                                    value="{{ $favourite_gig->gig->id }}"><i class="fas fa-heart"></i></button>
                                <a href="{{ route('show-gig', $favourite_gig->gig->id) }}"
                                    class="text-uppercase text-decoration-none text-dark">Starting At
                                    ${{ $favourite_gig->gig->basic_price }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary text-center fs-3">No loved gigs</p>
                @endforelse
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
