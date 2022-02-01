@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-header">Sales Team</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="{{route('add')}}" title="Add New Sales Person"> <i class="fas fa-plus-circle"></i> Add New Sales Person</a>
                </div>
                <table class="table table-bordered table-responsive-lg mt-2">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Current Route</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php $i = ($salesPerson->currentpage()-1) * $salesPerson->perpage() + 1; ?>
                    @if($salesPerson && sizeof($salesPerson) > 0)
                        @foreach($salesPerson as $value)
                            <tr data-id="{{$value->id}}">
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center">{{$value->name?:'-'}}</td>
                                <td class="text-center">{{$value->email?:'-'}}</td>
                                <td class="text-center" >{{$value->telephone?:'-'}}</td>
                                <td class="text-center">{{$value->route?$value->route->working_route:'-'}}</td>
                                <td class="text-center">
                                    <!-- <div class="btn-group"> -->
                                        <a href="javascript:void(0);" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="View Sales Person" onclick="viewPerson({{$value->id}})"><i class="fa fa-eye view"></i> View</a>
                                        <a  href="{{ route('edit', ['id' => $value->id]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Edit Person"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Delete Sales Person" onclick="deletePerson({{$value->id}})"><i class="fa fa-trash-o"></i> Delete</a>
                                    <!-- </div> -->
                                </td>
                            </tr>
                            <?php $i++;?>
                        @endforeach
                    @else
                        <tr><td colspan="6" class="text-center">No data found.</td></tr>
                    @endif
                    </tbody>

                </table>
                Showing {{$salesPerson->firstItem()}} to {{$salesPerson->lastItem()}} of {{$salesPerson->total()}} Product      
                <div class="pull-right">{!! $salesPerson->appends($_GET)->render() !!}</div>
                    </div>
                </div>
    </div>
</div>
@endsection