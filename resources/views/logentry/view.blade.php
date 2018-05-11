@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Entry ID: <b>{{ $entry['id'] }}</b> | Type: <span class="badge badge-{{ $typeClass }}">{{ $entry['type'] }}</span> <div class="float-right"><a href="/logentries" class="btn btn-primary btn-sm">Close</a></div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($warning)
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> Your Content is too long. File content limited only 1000 lines.
                    </div>
                    @endif

                    <code>
                        {{ $entry['entry'] }}
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
