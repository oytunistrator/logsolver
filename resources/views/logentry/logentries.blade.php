@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Log Filter</div>
                <div class="card-body">
                    <form action="data" class="filter">
                        <div class="form-group form-inline">
                            <div class="col-md-2">
                                <label>Log Type:</label>
                            </div>
                            <div class="col-md-2">    
                                <select class="custom-select" name="type" id="filter">
                                    <option value="" selected>ALL</option>
                                    <option value="ERROR" class="text-danger">ERROR</option>
                                    <option value="EXCEPTION" class="text-danger">EXCEPTION</option>
                                    <option value="WARNING" class="text-warning">WARNING</option>
                                    <option value="INFO" class="text-info">INFO</option>
                                </select>
                            </div>
                            <div class="col-md-2">    
                                    <button class="btn btn-success filter-button" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center py-1 logentries-data-row">
        
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">Log Entries</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <table class="logentries" class="display" style="width:100%" class="table">
                        <thead>
                            <tr>
                                <th>IDX</th>
                                <th>Type</th>
                                <th>Entry</th>
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
