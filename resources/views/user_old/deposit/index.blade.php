@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Deposit | GET 5X</h3>
    </div>
</div>
@if(@$payment->image)
<div class="row">
    <div class="col-12 text-center">
        <img src="{{asset($payment->image)}}" width="250px;" height="250px;">
    </div>
</div>
@endif
<div class="row" style="margin-top:5px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Deposit Information For Package</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.deposit.store')}}" >
                   @csrf
                   <div class="row">
                    <input type="hidden" name="pakage_id" value="{{$package}}">
                    <input type="hidden" name="method" value="{{$payment}}">
                    <input type="hidden" class="form-control text-violet" name="package_id" value="{{$package->id}}">
                        <div class="form-group col-6">
                            <label class="form-label">Trancation ID#</label>
                            <input type="number" class="form-control" name="t_id" value="" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Deposit Amount</label>
                            <input type="number" class="form-control text-violet" name="amount" value="{{$package->price}}" readonly>
                        </div>
                    </div>   
                    <div class="row">
                      
                        <div class="form-group col-12">
                            <label class="form-label">Payment Method</label>
                            <input type="text" class="form-control text-violet" name="payment" value="{{$payment->method}}" readonly>
              
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
@endsection