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

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive-lg mt-2">
                    <tr>
                        <td>ID</td>
                        <td id="id"></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td id="name"></td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <td>Telephone</td>
                        <td id="telephone"></td>
                    </tr>
                    <tr>
                        <td>Joined Date</td>
                        <td id="date"></td>
                    </tr>
                    <tr>
                        <td>Current Routes</td>
                        <td id="route"></td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td id="comment"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.10/sweetalert2.min.js" integrity="sha512-LwESE8nE3vcnoUWmYo6skVQ+BRT5UhqnPweGro7e22RSDLVwftCfFIPt+Ha2tm1Gg7RXvYp/jPyih3DUB06PwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
function viewPerson(id){
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
        keyboard: false
    })

    $.ajax({
      url: "{{URL::to('sales-person')}}",
      method: 'GET',
      data: {'person': id},
      async: false,
      success: function (data) {
        if(data){
          $('.modal-title').text(data.name);
          $('#id').text(data.id);
          $('#name').text(data.name);
          $('#email').text(data.email);
          $('#telephone').text(data.telephone);
          $('#date').text(data.joined_date);
          $('#route').text(data.route.working_route);
          $('#comment').text(data.comment);

        }

      },
      error: function () {
        alert('error');
      }
  });
    myModal.show();
}

function deletePerson(id){
    Swal.fire({
        title: 'Do you want to delete?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: "{{URL::to('delete')}}",
                method: 'GET',
                data: {'person': id},
                async: false,
                success: function (data) {
                    if(data == 1){
                        location.reload();
                    }
                },
                error: function () {
                    alert('error');
                }
            });
            Swal.fire('Deleted!', '', 'success')
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })

}
</script>