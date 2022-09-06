@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                  

                    {{ __('Welcome') }} {{ Auth::user()->name }}.
                    {{ __('Go to your list of song lyrics') }} <a href="{{ url('/songs')}}"> {{ __('here') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
