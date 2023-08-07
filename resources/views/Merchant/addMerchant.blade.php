@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <h3>Merchant</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{isset($merchant->id) ? route('merchant.update',$merchant->id) : route('merchant.store')}}" method="POST">
                @csrf
                @if (isset($merchant->id))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="domain">Domain</label>
                            <input type="text" class="form-control" id="domain" name="domain" placeholder="Enter Domain"
                                value="{{isset($merchant->domain) ? $merchant->domain : ''}}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                value="{{isset($merchant->user->name) ? $merchant->user->name : ''}}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email"
                                value="{{isset($merchant->user->email) ? $merchant->user->email : ''}}">
                        </div>
                    </div>
                    @if(isset($merchant->id))

                    @else
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="api_key">Password</label>
                                <input type="password" class="form-control" id="api_key" name="api_key" placeholder="Password">
                            </div>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                <a href="{{route('merchant')}}" type="submit" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
