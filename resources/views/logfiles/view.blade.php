@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Log: {{ $log['filename'] }} <div class="float-right"><a href="/logs" class="btn btn-primary btn-sm">Close</a></div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($warning)
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> Your Content is too long. File content limited only 3000 lines.
                    </div>
                    @endif

                    <code>
                        {{ $contents }}
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
