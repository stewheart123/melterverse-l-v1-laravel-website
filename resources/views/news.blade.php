@extends('layouts.app')
@section('title', 'News')
@section('content')
<div class="container">            
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark bg-gradient text-white">
                <div class="card-header"><h1>News</h1></div>
                <div class="card-body">
                    <p>{{ __('Hi ' . Auth::user()->name . '.') }}</p>
                   <p>We are currently busy building towards our first realease of <strong class="text-info">Melterverse</strong></p>  
                   <p>As we edge closer to our first release, we hope to document the journey with you. Check back in to see our progress.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
