@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <button onclick="" id="makeScraping">make scraping</button>
                    <div class="xray">
                        <ul>
                            <li>
                                <div>
                                    <a href="">
                                        <img src="" alt="">
                                    </a>
                                </div>
                                <h5>hola</h5>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
