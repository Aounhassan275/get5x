@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>ADD PACKAGE | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Package</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.package.store')}}" >
                   @csrf
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Package Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Package Name">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Package Price</label>
                            <input type="number" class="form-control" name="price"  placeholder="Package Price">
                        </div>
                   </div>
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Package Direct Income</label>
                            <input type="number" class="form-control" name="direct_income"  placeholder="Package Direct Income" value="">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Package Matching Income</label>
                            <input type="number" class="form-control" name="matching_income"  placeholder="Package Matching Income" value="">
                        </div>
                    </div>
                   <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">Package Withdraw Limit</label>
                            <input type="number" class="form-control" name="withdraw_limit"  placeholder="Package Withdraw Limit" value="">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Package Income Limit</label>
                            <input type="number" class="form-control" name="income_limit"  placeholder="Package Income Limit" value="">
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