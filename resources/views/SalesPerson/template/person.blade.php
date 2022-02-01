<tr data-id="{{$value->id}}">
    <td class="text-center">{{$i}}</td>
    <td class="text-center">{{$value->name?:'-'}}</td>
    <td class="text-center">{{$value->email?:'-'}}</td>
    <td class="text-center" >{{$value->telephone?:'-'}}</td>
    <td class="text-center"></td>
    <td class="text-center">
        <div class="btn-group">
            <a href="javascript:void(0);" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="View Sales Person" onclick="viewPerson({{$result->id}})"><i class="fa fa-eye view"></i></a>
            <a href="{{ route('person.edit', ['id' => $value->id]) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Edit Person"><i class="fa fa-pencil"></i></a>
            <a href="javascript:void(0);" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Delete Sales Person" onclick="deletePerson({{$result->id}})"><i class="fa fa-trash-o"></i></a>
        </div>
     </td>
</tr>