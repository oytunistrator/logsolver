@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Log File Uploader <div class="float-right"><a href="/logs" class="btn btn-primary btn-sm">Close</a></div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form action="/logs/store" method="post" class="ajaxUploader">
                        <fieldset>
                            <legend>Log Uploader</legend>
                        
                            <!-- File Button --> 
                            <div class="form-group">
                                <input id="file" name="file" class="input-file" type="file">
                            </div>
                            <div class="form-group">
                                <button id="submit" name="submit" class="btn btn-primary">Upload</button>
                            </div>
                            
                            <div class="form-group">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
