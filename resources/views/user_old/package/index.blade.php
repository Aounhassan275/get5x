@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>PACKAGE SUBSRIPTION | GET 5X</h3>
    </div>
</div>
<div class="tab-content">
    <div class="tab-pane fade show active" id="monthly">
        <div class="row py-4">
            @foreach (App\Models\Package::orderBy('price', 'ASC')->get()->all() as $package)
            <div class="col-sm-4 mb-3 mb-md-0" style="margin-top:10px;">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-4">
                            <h5>{{$package->name}}</h5>
                            <span class="display-4">$ {{$package->price}} /-</span><br>                           
                        </div>
                        <h6>Includes:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                Direct Income : $ {{$package->direct_income}} /-
                            </li>
                            <li class="mb-2">
                                Matching Income : $ {{$package->matching_income}} /-
                            </li>
                            <li class="mb-2">
                                Withdraw Limit : $ {{$package->withdraw_limit}}
                            </li>
                            <li class="mb-2">
                                Income Limit : $ {{$package->income_limit}}
                            </li>
                        </ul>
                        <div class="mt-auto">
                            <a href="{{route('user.package.payment',$package->id)}}" class="btn btn-lg btn-primary">Purchase</a>
                            {{-- @if(Auth::user()->balance >= $package->price || Auth::user()->balance >= $package->price)
                            <br>
                            or 
                            <br>
                            <a href="{{route('user.package.direct_deposit',$package->id)}}" class="btn btn-lg btn-secondary" onclick="$('.btn').text('Please Wait!!!').attr('disabled',true)">Purchase Through Your Balance</a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection