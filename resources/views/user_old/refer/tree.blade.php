@extends('user.layout.index')
@section('contents')
<div class="row">
    <div class="col-12 col-sm-12 col-xl  d-xxl-flex text-center">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">
                    <div class="media-body">
                        <i class="feather-lg text-warning" data-feather="user"></i>
                            <br>

                        <p class="mb-2">{{$user->name}}</p>

                        {{-- <div class="mb-0">{{$user->name}}</div> --}}

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-6 col-sm-6 col-xl  d-xxl-flex text-center">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">
                    <div class="media-body">

                        <p class="mb-2">
                            Left
                            <i class="feather-lg text-warning" data-feather="user"></i>
                            <br>
                            @if($user->left_refferal)
                            <a href="{{route('user.tree.show',$user->left_refferal)}}"> 
                                {{@$user->refer_by_name(@$user->left_refferal)}}
                            </a>
                            <br>
                            Match Income $ {{$user->left_amount}}
                            @endif
                        </p>

                        {{-- <div class="mb-0">{{$user->name}}</div> --}}

                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="col-6 col-sm-6 col-xl  d-xxl-flex text-center">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="media-body">

                        <p class="mb-2">
                            Right
                            <i class="feather-lg text-warning" data-feather="user"></i>
                            <br>
                            @if($user->right_refferal != null)
                            <a href="{{route('user.tree.show',$user->right_refferal)}}"> 
                                {{@$user->refer_by_name(@$user->right_refferal)}}
                            </a>
                            <br>
                            Match Income $ {{$user->right_amount}}
                            @endif
                        </p>

                        {{-- <div class="mb-0">{{$user->name}}</div> --}}

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex text-center">
        <div class="card flex-fill">

            <div class="card-body py-4" style="padding:0px!imporant;">

                <div class="media">
                    <div class="media-body">
                        <i class="feather text-warning" data-feather="user"></i>
                        <br>
                        @if(@$left && $left->left_refferal != null)
                        <p class="mb-2">
                            <a href="{{route('user.tree.show',$left->left_refferal)}}"> 
                                {{-- {{@$left->refer_by_name(@$left->left_refferal)}} --}}
                                $ {{$left->left_amount}}

                            </a>
                        </p>
                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex text-center">
        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">
                    <div class="media-body">
                        <i class="feather text-warning" data-feather="user"></i>
                        <br>
                        @if(@$left && $left->right_refferal != null)
                        <p class="mb-2">
                            <a href="{{route('user.tree.show',$left->right_refferal)}}"> 
                                {{-- {{@$left->refer_by_name(@$left->right_refferal)}} --}}
                                $ {{$left->left_amount}}
                            </a>
                        </p>
                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex text-center">

            <div class="card flex-fill">

                <div class="card-body py-4">

                    <div class="media">

                        <div class="media-body">
                            <i class="feather text-warning" data-feather="user"></i>
                            <br>
                            @if(@$right && @$right->left_refferal != null)
                            <p class="mb-2">
                                <a href="{{route('user.tree.show',$right->left_refferal)}}"> 
                                    {{-- {{$right->refer_by_name($right->left_refferal)}} --}}
                                    $ {{$right->left_amount}}
                                </a>
                            </p>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex text-center">

            <div class="card flex-fill">

                <div class="card-body py-4">

                    <div class="media">

                        <div class="media-body">
                            <i class="feather text-warning" data-feather="user"></i>
                            <br>
                            @if(@$right && @$right->right_refferal != null)
                            <p class="mb-2">
                                <a href="{{route('user.tree.show',$right->right_refferal)}}"> 
                                    {{-- {{$right->refer_by_name(@$right->right_refferal)}} --}}
                                    $ {{$right->right_amount}}
                                </a>
                            </p>
                            @endif

                        </div>

                    </div>

                </div>

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