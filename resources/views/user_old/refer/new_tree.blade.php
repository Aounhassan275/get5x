@extends('user.layout.index')
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
                        <a href="{{route('user.left_refferal_tree.index',$user->id)}}"><span class="badge badge-success">${{@$user->left_amount}}</span></a>
                        @endif
                    </div>
                    <div class="col-4 text-center">
                        {{-- <i class="align-middle mr-2" data-feather="arrow-up-circle"></i><span class="text-muted">$ {{@$user->earnings()->where('type','direct_income')->sum('price')}}</span> --}}
                    </div>
                    <div class="col-4 text-center">
                        @if(@$user->right_refferal)
                        <a href="{{route('user.right_refferal_tree.index',$user->id)}}"><span class="badge badge-info">${{@$user->right_amount}}</span></a>
                        @endif
                    </div>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-4 text-center">
                        @if(@$user->left_refferal)
                        <a href="{{route('user.left_refferal_tree.index',$user->id)}}">L :<span class="text-muted">{{count(@$user->getOrginalLeft())}}</span></a>
                        @endif
                    </div>
                    <div class="col-4 text-center">
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i><span class="text-muted">$ {{@$user->earnings()->where('type','direct_income')->sum('price')}}</span>
                    </div>
                    <div class="col-4 text-center">
                        @if(@$user->right_refferal)
                        <a href="{{route('user.right_refferal_tree.index',$user->id)}}">R :<span class="text-muted">{{count(@$user->getOrginalRight())}}</span></a>
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
                <a href="{{route('user.tree.show',@$left->id)}}"> 
                    <h5 class="card-title mb-0">{{@$left->name}}</h5>
                </a>
                @endif
            </div>
            <div class="card-body my-2">
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-6 text-center">
                        @if(@$left->left_refferal)
                        <a href="{{route('user.left_refferal_tree.index',$left->id)}}"><span class="text-muted">{{count(@$left->getOrginalLeft())}}</span><i class="align-middle mr-2" data-feather="corner-down-left"></i></a>
                        @endif
                    </div>
                    <div class="col-6 text-center">
                        @if(@$left->right_refferal)
                        <a href="{{route('user.right_refferal_tree.index',$left->id)}}"><i class="align-middle mr-2" data-feather="corner-down-right"></i><span class="text-muted">{{count(@$left->getOrginalRight())}}</span></a>
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
                <a href="{{route('user.tree.show',$user->right_refferal)}}"> <h5 class="card-title mb-0">{{@$right->name}}</h5></a>
                @endif
            </div>
            <div class="card-body my-2">
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-6 text-center">
                        @if(@$right->left_refferal)
                        <a href="{{route('user.left_refferal_tree.index',$right->id)}}"><span class="text-muted">{{count(@$right->getOrginalLeft())}}</span><i class="align-middle mr-2" data-feather="corner-down-left"></i></a>
                        @endif
                    </div>
                    <div class="col-6 text-center">
                        @if(@$right->right_refferal)
                        <a href="{{route('user.right_refferal_tree.index',$right->id)}}"><i class="align-middle mr-2" data-feather="corner-down-right"></i><span class="text-muted">{{count(@$right->getOrginalRight())}}</span></a>
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
<div class="row">
    <div class="col-3 col-sm-3 col-xl  d-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                {{-- <span class="badge badge-primary"> --}}
                    @if(@$left && @$left->left_refferal != null)
                    <a href="{{route('user.tree.show',$left->left_refferal)}}" style="color:black;"> 
                        {{-- {{@$left->refer_by_name(@$left->left_refferal)}} --}}
                        {{-- $ {{$left->left_amount}} --}}
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i>
                    </a>
                    @endif
                {{-- </span> --}}
                {{-- <h5 class="card-title mb-0">Income</h5> --}}
            </div>
        </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                {{-- <span class="badge badge-warning "> --}}
                    @if(@$left && @$left->right_refferal != null)
                    <a href="{{route('user.tree.show',$left->right_refferal)}}" style="color:black;"> 
                        {{-- {{@$left->refer_by_name(@$left->right_refferal)}} --}}
                        {{-- $ {{$left->left_amount}} --}}
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i>
                    </a>
                    @endif
                {{-- </span> --}}
                {{-- <h5 class="card-title mb-0">Orders</h5> --}}
            </div>
        </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                {{-- <span class="badge badge-info"> --}}
                    @if(@$right && @$right->left_refferal != null)
                    <a href="{{route('user.tree.show',$right->left_refferal)}}" style="color:black;"> 
                        {{-- {{$right->refer_by_name($right->left_refferal)}} --}}
                        {{-- $ {{$right->left_amount}} --}}
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i>
                    </a>
                    @endif
                {{-- </span> --}}
                {{-- <h5 class="card-title mb-0">Activity</h5> --}}
            </div>
        </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-flex text-center">
        <div class="card flex-fill">
            <div class="card-header">
                {{-- <span class="badge badge-success"> --}}
                    @if(@$right && @$right->right_refferal != null)
                    <a href="{{route('user.tree.show',$right->right_refferal)}}" style="color:black;"> 
                        {{-- {{$right->refer_by_name($right->right_refferal)}} --}}
                        {{-- $ {{$right->right_amount}} --}}
                        <i class="align-middle mr-2" data-feather="arrow-up-circle"></i>
                    </a>
                    @endif
                {{-- </span> --}}
                {{-- <h5 class="card-title mb-0">Revenue</h5> --}}
            </div>
        </div>
    </div>
</div>
@endsection
