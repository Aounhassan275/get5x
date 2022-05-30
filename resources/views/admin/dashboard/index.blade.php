@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>DASHBOARD | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $expense_income= App\Models\CompanyAccount::expense_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$expense_income->balance, 2)}}</h3>

                        <div class="mb-0">Expense Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $product_income= App\Models\CompanyAccount::product_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$product_income->balance, 2)}}</h3>

                        <div class="mb-0">Product Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $flash_income= App\Models\CompanyAccount::flash_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$flash_income->balance, 2)}}</h3>

                        <div class="mb-0">Flash Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $reward_income= App\Models\CompanyAccount::reward_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$reward_income->balance, 2)}}</h3>

                        <div class="mb-0">Reward Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row">
    
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $matching_income= App\Models\CompanyAccount::matching_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$matching_income->balance, 2)}}</h3>

                        <div class="mb-0">Matching Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">


                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $loss_income= App\Models\CompanyAccount::loss_income();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$loss_income->balance, 2)}}</h3>

                        <div class="mb-0">Loss Income</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        @php  
                            $salary= App\Models\CompanyAccount::salary();
                        @endphp
                        <h3 class="mb-2">PKR {{number_format(@$salary->balance, 2)}}</h3>

                        <div class="mb-0">Salary Balance</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-3 col-sm-3 col-xl  d-xxl-flex">

        <div class="card flex-fill">

            <div class="card-body py-4">

                <div class="media">

                    <div class="d-inline-block mt-2 mr-3">

                        <i class="feather-lg text-info" data-feather="dollar-sign"></i>

                    </div>

                    <div class="media-body">
                        <h3 class="mb-2">PKR  {{App\Models\User::all()->sum('balance')}}</h3>

                        <div class="mb-0">User Balance</div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{route('admin.package.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-primary float-right">All</span>
                                <h5 class="card-title mb-0">Total Packages</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Package::count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{route('admin.messages.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-info float-right">All</span>
                                <h5 class="card-title mb-0">Total Messages</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Message::count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{route('admin.user.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-warning float-right">All</span>
                                <h5 class="card-title mb-0">Total User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.pendings')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-success float-right">All</span>
                                <h5 class="card-title mb-0">Total Pending User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::pending()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.user.actives')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-primary float-right">All</span>
                                <h5 class="card-title mb-0">Active User</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\User::active()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{route('admin.deposit.show')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-info float-right">{{App\Models\Deposit::count()}}</span>
                                <h5 class="card-title mb-0">Total Deposit</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            <h3 class="mb-0">{{App\Models\Deposit::sum('amount')}}</h3>
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{route('admin.deposit.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-info float-right">{{App\Models\Deposit::new()->count()}}</span>
                                <h5 class="card-title mb-0">Total Deposit Pending</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            <h3 class="mb-0">{{App\Models\Deposit::new()->sum('amount')}}</h3>
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{route('admin.withdraw.complete')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-warning float-right">All</span>
                                <h5 class="card-title mb-0">Total Withdraw</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Withdraw::all()->sum('payment')}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{route('admin.withdraw.complete')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-success float-right">All</span>
                                <h5 class="card-title mb-0">Total Complete Withdraw</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Withdraw::completed()->sum('payment')}}

                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{route('admin.withdraw.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-success float-right">All</span>
                                <h5 class="card-title mb-0">Total Pending Withdraw</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Withdraw::process()->sum('payment')}}

                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{route('admin.withdraw.holds')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-success float-right">All</span>
                                <h5 class="card-title mb-0">Total OnHold Withdraw</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Withdraw::hold()->sum('payment')}}

                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{route('admin.admin.index')}}">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <span class="badge badge-warning float-right">All</span>
                                <h5 class="card-title mb-0">Total Employee</h5>
                            </div>
                            <div class="card-body my-2">
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                            {{App\Models\Admin::employee()->count()}}
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress progress-sm shadow-sm mb-1">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection