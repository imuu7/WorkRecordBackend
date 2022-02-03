{!! Form::open(['route' => ['reservations.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="javascript:void(0)" onclick="ajaxCU({{ json_encode(\App\Models\Reservation::find($id))}})" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
    ]) !!}
</div>
{!! Form::close() !!}
