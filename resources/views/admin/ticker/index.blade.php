@extends('admin.layout.index')
@section('contents')

<div class="row mb-2 mb-xl-4">
    <div class="col-auto d-none d-sm-block">
    <h3>Add Ticker | GET 5X</h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Ticker</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.ticker.store')}}" >
                   @csrf
                   <div class="row">
                       
                        <div class="form-group col-12">
                            <label class="form-label">Ticker Message</label>
                            <textarea name="message" id="" cols="100" rows="2" class="form-control"></textarea>
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
<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Ticker Messages</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:auto;">Ticker Message</th>
                    <th style="width:auto;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\Ticker::all() as $key => $ticker)
                <tr> 
                    <td>{{$ticker->message}}</td>
                    <td class="table-action">
                        {{-- <a href="{{url('poll/delete',$package->id)}}"><i class="align-middle" data-feather="trash"></i></a> --}}
                        <form action="{{route('admin.ticker.destroy',$ticker->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection