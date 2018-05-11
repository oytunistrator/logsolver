@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Uploaded Log Files <div class="float-right"><a href="/logs/uploader" class="btn btn-primary btn-sm">Upload File</a></div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <table class="logs" class="display" style="width:100%" class="table">
                        <thead>
                            <tr>
                                <th>IDX</th>
                                <th>FileName</th>
                                <th>Date/Time</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
