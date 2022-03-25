@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <x-alerts.session-alert/>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!auth()->user()->token)
                        <a href="/oauth/redirect">Authorize</a>
                    @endif
                    @foreach ($posts as $post)
                        <h3>{{ $post['title']  }}</h3>
                        <p>{{ $post['content'] }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
