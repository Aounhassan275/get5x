@extends('user.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>SELECT PACKAGE PAYMENT | GET 5X</h3>
    </div>
</div>
<div class="tab-content">
    <div class="tab-pane fade show active" id="monthly">
        <div class="row py-4">
            @foreach (App\Models\Payment::all() as $payment)
            <div class="col-sm-4 mb-3 mb-md-0">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-4">
                            <h5>{{$payment->method}}</h5>
                        </div>
                        <h6>Detail:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                Account Holder Name : {{$payment->name}}
                            </li>
                            <li class="mb-2">
                                Account Number : {{$payment->number}}
                            </li>
                            @if ($payment->method =='Bank Account')
                               <li class="mb-2">
                                Bank Name : {{$payment->bank}}
                            </li>
                            <li class="mb-2">
                                Receiver Number : {{$payment->bnumber}}
                            </li>
                            @endif
                        </ul>
                        <div class="mt-auto">
                            <a href="{{route('user.deposits.index',[$payment->id,$package])}}" class="btn btn-lg btn-primary">Select</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection