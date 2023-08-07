@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row">
        <div class="p-2">
            <a href="{{route('merchant')}}" type="button" class="btn btn-sm btn-primary">Merchants</a>
        </div>
        <div class="p-2">
            <a href="{{route('affiliate')}}" type="button" class="btn btn-sm btn-info">Affiliates</a>
        </div>
    </div>
@endsection