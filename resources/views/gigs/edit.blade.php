@extends('layouts.app',['title' => 'Edit GIG'])
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
            <form action="{{ route('update-gig', $gig->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('gigs.partials.form-control')
            </form>
            <form action="{{ route('delete-gig', $gig->id) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger form-control mt-3" type="submit">Delete</button>
            </form>
        </div>
    </div>
@endsection
