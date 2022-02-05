<div class="row d-inline">
    @isset($edit_url)
        <a class="btn btn-sm btn-primary mb-1" href="{{ $edit_url }}" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="fa fa-edit"></i>
        </a>
    @endisset
    @isset($view_url)
        <a target="__blank" class="btn btn-sm btn-primary mb-1" href="{{ $view_url }}" itle="Lihat">
            <i class="fa fa-eye"></i>
        </a>
    @endisset
    @isset($custom)
        @foreach($custom as $c)
            <a class="btn btn-sm btn-secondary mb-1" href="{{ $c['url'] }}" title="{{ $c['title'] }}">
                <i class="{{ $c['icon'] }}"></i>
            </a>
        @endforeach
    @endisset
    @isset($delete_url)
        <a class="btn btn-sm btn-danger btn-delete mb-1" onclick="deleteItem(event)" href="{{ $delete_url }}" title="Hapus">
            <i class="fa fa-trash"></i>
        </a>
    @endisset

</div>