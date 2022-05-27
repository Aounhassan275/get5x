@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Withdraw Edit | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Withdraw Request</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.withdraw.update',$withdraw->id)}}" >
                    @method('PUT')
                    @csrf                   
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Withdraw Payment</label>
                            <input type="number" min="{{Auth::user()->package->min}}" max="{{Auth::user()->package->max}}"   name="payment" class="form-control" value="{{$withdraw->payment}}" required>                        
                          <input class="form-control" type="hidden" name="id" value="{{$withdraw->id}}" required/>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Account Holder Name</label>
                            <input type="text" name="name" value="{{$withdraw->name}}" class="form-control" placeholder="Enter Account Holder Name" required>
                        <input type="hidden" name="status" class="form-control border-teal border-1" value="in process" required>
                        </div>
                    </div>   
                    <div class="row">
                      
                        <div class="form-group col-6">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account" value="{{$withdraw->account}}" class="form-control bg-slate-600 border-slate-600 border-1" placeholder="Enter Account Number Please" required>
                        </div> 
                        <div class="form-group col-6">
                            <label class="form-label">Payment Method</label>
                            <select name="method" class="form-control" required>
                                <option value="{{$withdraw->method}}">{{$withdraw->method}}</option>
                                <option value="Perfect Money">Perfect Money</option>
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
@endsection