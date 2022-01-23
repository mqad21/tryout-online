<div class="row d-inline">
    @isset($edit_url)
        <a class="btn btn-sm btn-primary" href="{{ $edit_url }}">
            <i class="fa fa-edit"></i>
        </a>
    @endisset
    @isset($view_url)
        <a target="__blank" class="btn btn-sm btn-primary" href="{{ $view_url }}">
            <i class="fa fa-eye"></i>
        </a>
    @endisset
    @isset($delete_url)
        <a class="btn btn-sm btn-danger btn-delete" onclick="deleteItem(event)" href="{{ $delete_url }}">
            <i class="fa fa-trash"></i>
        </a>
    @endisset
</div>