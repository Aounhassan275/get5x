@extends('admin.layout.index')
@section('contents')
<div class="row">
    <div class="col-md-12">
        <div class="card flex-fill">
            <div class="card-header">
                <span class="badge badge-primary float-right">{{@$user->package->name}}</span>
                <h1 class="card-title mb-0 text-center" >{{@$user->name}}</h1>
            </div>
            <div class="card-body my-2">
                
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-4 text-center">
                        @if(@$user->left_refferal)
                        <a href="{{route('admin.user.show_tree',$user->id)}}"><span class="badge badge-success">${{@$user->left_amount}}</span></a>
                        @endif
                    </div>
                    <div class="col-4 text-center">
                        {{-- <i class="align-middle mr-2" data-feather="arrow-up-circle"></i><span class="text-muted">$ {{@$user->earnings()->where('type','direct_income')->sum('price')}}</span> --}}
                    </div>
                    <div class="col-4 text-center">
                        @if(@$user->right_refferal)
                        <a href="{{route('admin.user.show_tree',$user->id)}}"><span class="badge badge-info">${{@$user->right_amount}}</span></a>
                        @endif
                    </div>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-4 text-center">
                        @if(@$user->left_refferal)
                        <a href="{{route('admin.user.show_tree',$user->id)}}">L :<span class="text-muted">{{count(@$user->getOrginalLeft())}}</span></a>
                        @endif
                    </div>
                    <div class="col-4 text-center">
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i><span class="text-muted">$ {{@$user->earnings()->where('type','direct_income')->sum('price')}}</span>
                    </div>
                    <div class="col-4 text-center">
                        @if(@$user->right_refferal)
                        <a href="{{route('admin.user.show_tree',$user->id)}}">R :<span class="text-muted">{{count(@$user->getOrginalRight())}}</span></a>
                        @endif
                    </div>
                </div>

                <div class="progress progress-sm shadow-sm mb-1">
                    <div class="progress-bar bg-success" role="progressbar" 
                    style="width: {{Carbon\Carbon::today()->diffInDays(@$user->a_date)/@$user->package->package_validity * 100}}%"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6 col-sm-6 col-xl  d-xxl-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                
                <span class="badge badge-primary float-right">${{@$left->package->price}}</span>
                @if(@$left)
                <a href="{{route('admin.user.show_tree',@$left->id)}}"> 
                    <h5 class="card-title mb-0">{{@$left->name}}</h5>
                </a>
                @endif
            </div>
            <div class="card-body my-2">
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-6 text-center">
                        @if(@$left->left_refferal)
                        <a href="{{route('admin.user.show_tree',$left->id)}}"><span class="text-muted">{{count(@$left->getOrginalLeft())}}</span><i class="align-middle mr-2" data-feather="corner-down-left"></i></a>
                        @endif
                    </div>
                    <div class="col-6 text-center">
                        @if(@$left->right_refferal)
                        <a href="{{route('admin.user.show_tree',$left->id)}}"><i class="align-middle mr-2" data-feather="corner-down-right"></i><span class="text-muted">{{count(@$left->getOrginalRight())}}</span></a>
                        @endif
                    </div>
                </div>

                <div class="progress progress-sm shadow-sm mb-1">
                    <div class="progress-bar bg-primary" role="progressbar" 
                    @if($user->left_refferal)
                    style="width: {{Carbon\Carbon::today()->diffInDays($left->a_date)/$left->package->package_validity * 100}}%"
                    @else  
                    style="width: 0%"
                    @endif
                    ></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-6 col-xl  d-xxl-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                
                <span class="badge badge-primary float-right">${{@$right->package->price}}</span>
                @if(@$right)
                <a href="{{route('admin.user.show_tree',$user->right_refferal)}}"> <h5 class="card-title mb-0">{{@$right->name}}</h5></a>
                @endif
            </div>
            <div class="card-body my-2">
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-6 text-center">
                        @if(@$right->left_refferal)
                        <a href="{{route('admin.user.show_tree',$right->id)}}"><span class="text-muted">{{count(@$right->getOrginalLeft())}}</span><i class="align-middle mr-2" data-feather="corner-down-left"></i></a>
                        @endif
                    </div>
                    <div class="col-6 text-center">
                        @if(@$right->right_refferal)
                        <a href="{{route('admin.user.show_tree',$right->id)}}"><i class="align-middle mr-2" data-feather="corner-down-right"></i><span class="text-muted">{{count(@$right->getOrginalRight())}}</span></a>
                        @endif
                    </div>
                </div>

                <div class="progress progress-sm shadow-sm mb-1">
                    <div class="progress-bar bg-warning" role="progressbar" 
                    @if(@$user->right_refferal)
                    style="width: {{Carbon\Carbon::today()->diffInDays(@$right->a_date)/@$right->package->package_validity * 100}}%"
                    @else  
                    style="width: 0%"
                    @endif
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($user->left_refferal == null || $user->right_refferal == null )
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Change Placement</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.change.placement')}}" >
                   @csrf
                   <div class="row">
                       
                        <div class="form-group col-6">
                            <label class="form-label">User Name</label>
                            <input name="username" type="text" class="form-control" placeholder="Username" required>
                            <input name="user_id" class="form-control" type="hidden"  value="{{$user->id}}">
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">User Name</label>
                            <select name="placement" class="form-control" required>
                                <option selected disabled>Select Placement</option>
                                <option value="Left" @if($user->left_refferal == null && $user->right_refferal != null) selected @endif>Left</option>
                                <option value="Right" @if($user->right_refferal == null && $user->left_refferal != null) selected @endif>Right</option>
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
@endif
@endsection

@section('scripts')
<script>
    $(function() {
        // Datatables with Buttons
        var datatablesButtons = $("#datatables-buttons").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: ["copy", "print"]
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection