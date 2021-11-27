@extends('layouts.app',['title' => 'Create GIG'])
@section('content')
    <div class="container py-5">
        <div class="p-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    Please Fix The Following Error
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('store-gig') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('gigs.partials.form-control')
            </form>
        </div>
    </div>
@endsection
