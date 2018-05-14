@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Button -->
                        <div class="form-group form-inline">
                          <label class="col-md-4 control-label" for="singlebutton">Clear Entries</label>
                          <div class="col-md-4">
                            <button id="cleanButton" name="cleanButton" class="btn btn-danger cleanDbAjax" data-module="logs">Clear</button>
                          </div>
                          <div class="col-md-4 text-success">
                                <b><span class="text-danger">{{ $total_log }}</span> total logs found system.</b>
                          </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="form-group form-inline">
                          <label class="col-md-4 control-label" for="singlebutton">Clear Logs</label>
                          <div class="col-md-4">
                            <button id="cleanButton" name="cleanButton" class="btn btn-danger cleanDbAjax" data-module="entries">Clear</button>
                          </div>
                          <div class="col-md-4 text-success">
                                <b><span class="text-danger">{{ $total_entries }}</span> total logs found system.</b>
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
