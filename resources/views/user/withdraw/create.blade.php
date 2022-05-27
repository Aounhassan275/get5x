@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Withdraw | GET 5X</h3>
    </div>
</div>
@if(Auth::user()->checkWithdrawStatus() == false)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Withdraw Request</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.withdraw.store')}}" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Withdraw Payment</label>
                            <input type="number"  name="payment" class="form-control" value="" required>                        
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Account Holder Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Account Holder Name" required>
                            <input type="hidden" name="status" class="form-control border-teal border-1" value="in process" required>
                        </div>
                    </div>   
                    <div class="row">
                      
                        <div class="form-group col-6">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account" class="form-control bg-slate-600 border-slate-600 border-1" placeholder="Enter Account Number Please" required>
                        </div> 
                        <div class="form-group col-6">
                            <label class="form-label">Payment Method</label>
                            <select name="method" class="form-control" required>
                                <option value="opt1">Select</option>
                                @foreach(App\Models\Source::all() as $source)
                                <option value="{{$source->name}}">{{$source->name}}</option>
                                @endforeach
                            </select>
              
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->checkWithdrawStatus() == true)
<div class="row">  

    <div class="col-md-12 text-center">
        <div class="card bg-info py-2 py-md-3 border">

            <div class="card-body blink_me">

                <a href="{{route('user.package.upgrade')}}">
                    <h1 class="blink_me" style="color:white">   
                        Your Package Withdraw Limit is Exceeded.Upgrade Your Package to get more withdraw amount.
                    </h1>
                </a>

            </div>

            </div>


    </div>

</div>
@endif
@if(Auth::user()->package)
<div class="row">

    <div class="col-12 col-sm-6 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-primary" data-feather="activity"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->package->name}}</h3>

                        <div class="mb-0">Package Subcription</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="calendar"></i>



                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->a_date->format('d M,Y')}}</h3>

                        <div class="mb-0">Package Active On</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-12 col-sm-4 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-primary" data-feather="slash"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">$ {{round(Auth::user()->package->withdraw_limit,2)}}</h3>

                        <div class="mb-0">Package Withdraw Limit</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-4 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="credit-card"></i>



                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">$ {{Auth::user()->withdrawLimit()}}</h3>

                        <div class="mb-0">Your Withdraw Amount</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-12 col-sm-4 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="credit-card"></i>



                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">$ {{Auth::user()->withdrawPending()}}</h3>

                        <div class="mb-0">Pending Withdraw Amount</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    

    <div class="col-12 col-sm-4 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2"> $ {{Auth::user()->package->price}}</h3>

                        <div class="mb-0">Packages Price</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endif
@endsection