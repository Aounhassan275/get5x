@extends('admin.layout.index')

@section('title')
    Send Email | ADMIN
@endsection

@section('contents')


<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Send Email</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.email.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input name="id"  type="hidden" class="form-control" >
                            <label>Client Name</label>
                        <input name="name" type="text" class="form-control" value="{{$message->name}}" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Client Email</label>
                            <input name="email" type="email" class="form-control" value="{{$message->email}}" readonly>
                            <input name="message_id" type="hidden" class="form-control" value="{{$message->id}}" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Client Message</label>
                            <textarea name="message" class="form-control" cols="130" rows="02"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Send Mailed 
                            <i class="icon-plus22 ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>
@endsection