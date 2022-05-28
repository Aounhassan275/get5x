@extends('user.layout.index')
@section('style')
@endsection
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>REFERRALS | GET 5X</h3>
       
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Referrals</h5>
                <div class="text-right">
                    {{-- <a href="{{route('user.tree.show',Auth::user()->id)}}" class="btn btn-primary" >Binary Tree</a> --}}
                    {{-- @if(Auth::user()->top_referral == 'Pending')
                    <a href="{{route('user.referral_tree.index',Auth::user()->refer_by)}}" class="btn btn-primary" >Active Your Binary Tree</a>
                    @endif --}}
                </div>
            </div>
            <div class="card-body">
                <form >
                   <div class="row">
                       
                        <div class="form-group col-6">
                            <label class="form-label">Copy Link For Left Pair</label>
                            {{-- <input type="text" class="form-control" name="myInput" value="{{url('user/register',$user->left)}}" onclick="copyToClipboard()" readonly>     --}}
                             {{-- <label for="title">Copy Link For Left Pair <button type="button" class="copy-button btn btn-info  btn-xs" data-clipboard-action="copy" data-clipboard-target="#link_area">Copy to clipboard</button></label>
                             <textarea id="link_area" class="form-control">{{url('user/register',$user->left)}}</textarea>
                             <input type="text" value="{{ $photo->filename }}"> --}}
                            <input type="text" class="form-control" id="{{url('user/register',$user->left)}}"  value="{{url('user/register',$user->left)}}"  readonly>    
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Copy Link For Right Pair</label>
                            <input type="text" class="form-control" name="" value="{{url('user/register',$user->right)}}" readonly>                       
                            {{-- <button style="margin-top:5px;" class="btn btn-info">Copy</button>                --}}
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->main_owner)
<div class="row">

    <div class="col-12 col-sm-6 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="package"></i>

                    </div>

                    <div class="media-body">
                        
                        <h3 class="mb-2">{{Auth::user()->refer_by_name(Auth::user()->main_owner)}}</h3>

                        <div class="mb-0">Parent</div>

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

                        <i class="feather-lg text-success" data-feather="airplay"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->refer_by_name(Auth::user()->refer_by)}}</h3>

                        <div class="mb-0">Refer By</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div class="row">

    <div class="col-12 col-sm-12 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="package"></i>

                    </div>

                    <div class="media-body">
                        
                        <h3 class="mb-2">{{Auth::user()->placement()}}</h3>

                        <div class="mb-0">Placement</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endif
<div class="row">

    <div class="col-12 col-sm-6 col-xl d-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-warning" data-feather="package"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->active_refer()->where('refer_type','Left')->where('status','active')->count()}}</h3>

                        <div class="mb-0">Active Left Referrals</div>

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

                        <i class="feather-lg text-success" data-feather="airplay"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->active_refer()->where('status','active')->where('refer_type','Right')->count()}}</h3>

                        <div class="mb-0">Active Right Referrals</div>

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

                        <i class="feather-lg text-warning" data-feather="package"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->pending_refer()->where('status','pending')->where('refer_type','Left')->count()}}</h3>

                        <div class="mb-0">Left Referral Pending</div>

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

                        <i class="feather-lg text-success" data-feather="airplay"></i>

                    </div>

                    <div class="media-body">

                        <h3 class="mb-2">{{Auth::user()->pending_refer()->where('status','pending')->where('refer_type','Right')->count()}}</h3>

                        <div class="mb-0">Right Referrals Pending</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div class="row">
    @if($user->left_refferal)
    <div class="col-12 col-sm-6 col-xl d-flex">
            <div class="card flex-fill">

                <div class="card-body py-4">

                    <div class="media">

                        <div class="d-inline-block mt-2 mr-3">

                            <i class="feather-lg text-warning" data-feather="package"></i>

                        </div>

                        <div class="media-body">
                            <a href="{{route('user.left_refferal_tree.index',$user->id)}}">
                                <h3 class="mb-2">{{count(@$user->getOrginalLeft())}}</h3>

                                <div class="mb-0">Left Referral </div>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

    </div>
    @endif
    @if($user->right_refferal)
    <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-success" data-feather="airplay"></i>

                    </div>

                    <div class="media-body">
                        <a href="{{route('user.right_refferal_tree.index',$user->id)}}">
                            <h3 class="mb-2">{{count(@$user->getOrginalRight())}}</h3>

                            <div class="mb-0">Right Referral </div>
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>
    @endif
</div>
<div class="row">

    <div class="col-12 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">View Referral</h5>
            </div>
            <table id="datatables-buttons" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Refer By</th>
                        <th>User Placement</th>
                        <th>User Type</th>
                        <th>User Status</th>
                        <th>User Earning</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->all_refer() as $key => $user)
                    <tr> 
                        <td>{{$key + 1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        
                        <td>
                            @if($user->refer_by)
                            {{$user->refer_by_name($user->refer_by)}}
                            @endif
                        </td>
                        <td>{{$user->placement()}}</td>
                        <td>{{$user->refer_type}}</td>
                        <td>
                        @if ($user->checkstatus() =='old')
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
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">View Referral Direct Earning</h5>
            </div>
            <table id="datatables-buttons" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Earn Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->earnings()->where('type','direct_income')->get() as $key => $earning)
                    <tr> 
                        <td class="text-center">{{$key + 1}}</td>
                        <td class="text-center">{{$earning->created_at->format('M d,Y h:i A')}}</td>
                        <td class="text-center">$ {{$earning->price}}</td>
                    </tr>
                    @endforeach
                    <tr> 
                        <td class="text-center"></td>
                        <td class="text-center">Total Direct Income:</td>
                        <td class="text-center">$ {{Auth::user()->earnings()->where('type','direct_income')->sum('price')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">View Referral Matching Earning</h5>
            </div>
            <table id="datatables-buttons" class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Earn Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->earnings()->where('type','matching_income')->get() as $key => $earning)
                    <tr> 
                        <td class="text-center">{{$key + 1}}</td>
                        <td class="text-center">{{$earning->created_at->format('M d,Y h:i A')}}</td>
                        <td class="text-center">$ {{$earning->price}}</td>
                    </tr>
                    @endforeach
                    <tr> 
                        <td class="text-center"></td>
                        <td class="text-center">Total Matching Income:</td>
                        <td class="text-center">$ {{Auth::user()->earnings()->where('type','matching_income')->sum('price')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
@section('scripts')
<script>
  
  function copyToClipboard() {
        document.getElementById("{{url('user/register',$user->left)}}").select();
        document.execCommand('copy');
    }
</script>
@endsection