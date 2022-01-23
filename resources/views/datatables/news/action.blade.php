<div class="row d-flex">
    @if ($edit_url)
    <div class="col mb-2">
        <a class="btn btn-sm btn-primary" href="{{$edit_url}}">
            <i class="fa fa-edit"></i>
        </a>
    </div>
    @endif
    @if ($view_url)
    <div class="col mb-2">
        <a target="__blank" class="btn btn-sm btn-primary" href="{{$view_url}}">
            <i class="fa fa-eye"></i>
        </a>
    </div>
    @endif
    @if ($delete_url)
    <div class="col mb-2">
        <a class="btn btn-sm btn-danger btn-delete" onclick="deleteItem(event)" href="{{$delete_url}}">
            <i class="fa fa-trash"></i>
        </a>
    </div>      
    @endif
</div>