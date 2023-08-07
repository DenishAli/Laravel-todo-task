@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <h3>Affiliate</h3>
                </div>
                <div class="p-2">
                    <a href="{{route('affiliate.add')}}" type="button" class="btn btn-sm btn-primary">Add Affiliate</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Merchant Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Comission Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($affiliates as $key=>$item)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$item->merchant->display_name}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->commission_rate}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection