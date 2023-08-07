@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <h3>Merchant</h3>
                </div>
                <div class="p-2">
                    <a href="{{route('merchant.add')}}" type="button" class="btn btn-sm btn-primary">Add Merchant</a>
                </div>
                <div class="p-2">
                    <form action="{{ route('merchant.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Find by email">
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Domain</th>
                        <th scope="col">Email</th>
                        <th scope="col">Comission Rate</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($merchants as $key=>$merchant)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$merchant->display_name}}</td>
                        <td>{{$merchant->domain}}</td>
                        <td>{{$merchant->user->email}}</td>
                        <td>{{$merchant->default_commission_rate}}</td>
                        <td>
                            <a href="{{route('merchant.edit', $merchant->id)}}" type="button" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection