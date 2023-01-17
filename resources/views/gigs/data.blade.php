@if ($gigs->count() > 0)
    @foreach ($gigs as $gig)
        <div class="mb-4">
            <div class="card rounded" style="width : 18rem">
                <a href="{{ route('show-gig', $gig->id) }}"><img
                        src="{{ asset('storage/gig-images/' . $gig->gigImages->first()->image_name) }}"
                        class="card-img-top w-100" style="height : 18rem;object-fit: cover"></a>
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
                <div class="card-footer border-top d-flex justify-content-end align-items-center">
                    <a href="{{ route('show-gig', $gig->id) }}"
                        class="text-uppercase text-decoration-none text-dark">Starting At
                        ${{ $gig->basic_price }}</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
