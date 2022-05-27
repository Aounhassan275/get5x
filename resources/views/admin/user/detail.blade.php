@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>USER DETAIL | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xl-3">
        
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">User Details</h5>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title mb-0">{{$user->name}}</h5>
                <div class="text-muted mb-2">
                @if ($user->checkstatus() =='old')
                        <span class="badge badge-success">Active User</span>                            
                        @elseif($user->checkstatus() =='expired')
                        <span class="badge badge-primary">Expired User</span>  
                        @else
                                                <span class="badge badge-danger">Pending User</span>                                                      
                        @endif</div>
                @if ($user->status == 'block')
                <div>
                    <a class="btn btn-success btn-sm" href="{{route('admin.user.activation',$user->id)}}">Active</a>
                    @if(Auth::user()->type == 1)
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.delete',$user->id)}}">Delete</a>
                    @endif
                </div>
                @else
                <div>
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.block',$user->id)}}">Block</a>
                    @if(Auth::user()->type == 1)
                    <a class="btn btn-danger btn-sm" href="{{route('admin.user.delete',$user->id)}}">Delete</a>
                    @endif
                </div>
                <div>
                    @if(Auth::user()->type == 1)
                    <br>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.login.fake',$user->id) }}">Login</a>
                    @endif
                </div>
                @endif
            </div>
            <hr class="my-0">
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-danger" data-feather="dollar-sign"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">$ {{$user->balance}}</h3>
                                <div class="mb-0">User Balance</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Settings</h5>
            </div>
            <div class="list-group list-group-flush" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                Update Profile
                </a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                Deposit
                </a>   
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#draw" role="tab">
                Withdraw
                </a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#referral" role="tab">
                    User Referral
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xl-9">
        @if ($user->package)
        <div class="row">
            <div class="col-12 col-sm-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-primary" data-feather="activity"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{$user->package->name}}</h3>
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
                                <h3 class="mb-2">{{$user->a_date->format('d M,Y')}}</h3>
                                <div class="mb-0">Package Active On</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        @endif
        @if ($user->main_owner)
            <div class="row">
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-primary" data-feather="activity"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2">{{$user->refer_by_name($user->main_owner)}}</h3>
                                    <div class="mb-0">User Parent</div>
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
                                    <a href="{{route('admin.user.show_tree',$user->refer_by)}}">
                                        <h3 class="mb-2">{{$user->refer_by_name($user->refer_by)}}</h3>
                                    </a>
                                    <div class="mb-0">Refer By</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl  d-xxl-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-info" data-feather="aperture"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2">{{$user->placement()}}</h3>
                                    <div class="mb-0">User Placement</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            @foreach($placement as $key => $sub_parent)
            <div class="row">
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-primary" data-feather="activity"></i>
                                </div>
                                <div class="media-body">
                                    <a href="{{route('admin.user.detail',$sub_parent->id)}}">
                                        <h3 class="mb-2">{{$sub_parent->name}}</h3>
                                    </a>
                                    <div class="mb-0">Placement {{$key + 1}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        <div class="tab-content">
            <div class="tab-pane fade show active" id="account" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Private info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.user.update')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <label for="inputFirstName">User name</label>
                                    <input type="text" class="form-control" name="name" id="inputFirstName" value="{{$user->name}}" @if(Auth::user()->email != 'admin2@mail.com') readonly @endif>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Phone#</label>
                                    <input type="number" class="form-control" name="phone"  value="{{$user->phone}}" @if(Auth::user()->email != 'admin2@mail.com')readonly @endif>
                                </div>  
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" name="email"  value="{{$user->email}}" @if(Auth::user()->email != 'admin2@mail.com') readonly @endif>
                                </div>   
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Password</label>
                                    <input type="password" class="form-control" name="password" id="inputEmail4">
                                </div>
                            </div>
                            @if(Auth::user()->type == 1) 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Left Amount</label>
                                    <input type="text" class="form-control" name="left_amount"  value="{{$user->left_amount}}" >
                                </div>   
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Right Amount</label>
                                    <input type="text" class="form-control" name="right_amount" value="{{$user->right_amount}}" >
                                </div>   
                            </div>
                            @if(Auth::user()->email == 'admin2@mail.com')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Balance</label>
                                    <input type="text" class="form-control" name="balance"  value="{{$user->balance}}" >
                                </div> 
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Change Refer By</label>
                                    <input type="number" class="form-control" name="refer_by"  value="{{$user->refer_by}}" >
                                </div> 
                            </div><div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Left Refferal</label>
                                    <input type="number" class="form-control" name="left_refferal"  value="{{$user->left_refferal}}" >
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Right Refferal</label>
                                    <input type="number" class="form-control" name="right_refferal"  value="{{$user->right_refferal}}" >
                                </div> 
                            </div>
                            @endif
                            @endif
                            <div class="text-right">
                                <button type="submit"  class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="password" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">View Deposit History</h5>
                    </div>
                    <table id="datatables-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:auto;">Deposit Amount</th>
                                <th style="width:auto;">Deposit Tranc. ID# </th>
                                <th style="width:auto;">Payment Method </th>
                                <th style="width:auto;">Package</th>
                                <th style="width:auto;">Deposit Date </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->deposits as $deposit)
                            <tr> 
                                <td>{{$deposit->amount}}</td>
                                <td>{{$deposit->t_id}}</td>
                                <td>{{$deposit->payment}}</td>
                                <td>{{$deposit->package->name}}</td>
                                <td>{{Carbon\Carbon::parse($deposit->created_at)->format('d/m/Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>   
            <div class="tab-pane fade" id="draw" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">View Withdraw History</h5>
                    </div>
                    <table id="datatables-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:auto;">Withdraw Amount</th>
                                <th style="width:auto;">Account Holder</th>
                                <th style="width:auto;">Account Number</th>
                                <th style="width:auto;">Payment Method</th>
                                <th style="width:auto;">Withdraw Request Date </th>
                                <th style="width:auto;">Withdraw Request Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->withdraws as $withdraw)
                            <tr> 
                                <td>{{$withdraw->payment}}</td>
                                <td>{{$withdraw->name}}</td>
                                <td>{{$withdraw->account}}</td>
                                <td>{{$withdraw->method}}</td>
                                <td>{{Carbon\Carbon::parse($withdraw->created_at)->format('d/m/Y')}}</td>
                                <td> @if($withdraw->status=="Completed")
                                    <span class="badge badge-success">{{$withdraw->status}}</span>
                                    @elseif($withdraw->status=="in process")
                                    <span class="badge badge-danger">{{$withdraw->status}}</span>
                                    @else
                                    <span class="badge badge-primary">{{$withdraw->status}}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="tab-pane fade" id="referral" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">View Referral History</h5>
                    </div>
                    <table id="datatables-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:auto;">User Name</th>
                                <th style="width:auto;">User Email </th>
                                <th style="width:auto;">User Status </th>
                                <th style="width:auto;">User Earning </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->mrefers as $key => $user)
                            <tr> 
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if ($user->checkstatus() =='old')
                        <span class="badge badge-success">Active</span>                            
                        @elseif($user->checkstatus() =='expired')
                        <span class="badge badge-primary">Expired</span>  
                        @else
                                                <span class="badge badge-danger">Pending</span>                                                      
                        @endif</td>
                                <td>{{$user->balance}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



