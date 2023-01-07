@extends('layouts.app', ['title' => 'Home'])
@section('content')
    <section
        style="background-image: url('https://picsum.photos/1920');background-size:cover;background-position:center;background-repeat:no-repeat;"
        class="d-flex align-items-center justify-content-center min-vh-100 min-vw-100">
        <div class="mx-auto px-4 py-5 my-5">
            <h1 class="text-light display-5 fw-bolder text-center mb-5">
                Find the
                perfect freelance
                services for your business</h1>
            <form class="d-flex" action="{{ route('search-gig') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="title">
                <button class="btn btn-light" type="submit">Search</button>
            </form>
        </div>
    </section>
    <div class="container py-5">
        <h3 class="fw-bolder mb-5">Popular Categories</h3>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('search-gig') }}?category_id=6" class="text-decoration-none">
                    <div class="card h-100 ">
                        <div class="card-body d-flex align-items-center">
                            <p class="card-text text-secondary">Digital Marketing</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <a href="{{ route('search-gig') }}?category_id=8" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text text-secondary">Music & Audio</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a href="{{ route('search-gig') }}?category_id=5" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text text-secondary">Business</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('search-gig') }}?category_id=2" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <p class="card-text text-secondary">Writting & Translation</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <a href="{{ route('search-gig') }}?category_id=4" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text text-secondary">Programming & Tech</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a href="{{ route('search-gig') }}?category_id=9" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text text-secondary">Data</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5 mx-auto">
        <h3 class="fw-bolder mb-3">All Gigs</h3>
        <div class="text-center">
            <div class="d-flex justify-content-center justify-content-md-start gap-3 flex-wrap align-items-center align-content-center"
                id="gig-data">
                @include('gigs.data')
            </div>
        </div>
    </div>
    <div class="ajax-load auto-load text-center" style="display: none">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
            xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                    to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 1 >= $(document).height() && page <=
                {{ $gigs->lastPage() }}) {
                page++;
                loadMoreData(page);
            }
        });


        function loadMoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data) {
                    if (data.html == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#gig-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }
    </script>
@endsection
