@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>UPDATE PROFILE | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.admin.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                   <div class="row">
                    <input type="hidden" name="id" class="form-control" value="{{Auth::user()->id}}">
                        <div class="form-group col-6">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Your Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="form-label">Your Password</label>
                            <input type="password" name="password" class="form-control" >
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