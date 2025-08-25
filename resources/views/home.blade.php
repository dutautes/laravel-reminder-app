@extends('templates.app')

@section('content')
    <div class="container d-flex align-content-center mt-4 gap-2">
        {{-- card 1 --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <button type="button" class="btn btn-primary" data-mdb-ripple-init>Button</button>
            </div>
        </div>
        {{-- card 2 --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <button type="button" class="btn btn-primary" data-mdb-ripple-init>Button</button>
            </div>
        </div>
        {{-- card 3 --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <button type="button" class="btn btn-primary" data-mdb-ripple-init>Button</button>
            </div>
        </div>
    </div>
@endsection
