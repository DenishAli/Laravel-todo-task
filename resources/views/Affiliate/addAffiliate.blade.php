@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <h3>Affiliate </h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('affiliate.store') }}" method="POST">
                @csrf
                <div class="row">
                    @if(isset($merchents))
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Selet Merchant</label>
                            <select name="merchant_id" class="form-control">
                                <option value=>Select Merchent</option>
                                @foreach ($merchents as $key=>$item)
                                    <option value="{{$item->id}}">{{$item->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="commission_rate">Commission Rate</label>
                            <input type="number" class="form-control" id="commission_rate" name="commission rate" placeholder="commission_rate">
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                <a href="{{route('merchant')}}" type="submit" class="btn btn-sm btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
