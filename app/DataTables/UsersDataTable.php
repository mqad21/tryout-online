<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $edit_url = url('/pengguna/' . $data->id);
                return view('datatables.users.action', compact(['edit_url']));
            })
            ->editColumn('photo_url', function ($data) {
                return '<img data-enlargeable style="cursor:zoom-in" width="70" src="' . $data->photo_url . '"/>';
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d-m-Y H:i:s');
                return $formatedDate;
            })
            ->editColumn('is_verified', function ($data) {
                if (!$data->is_verified) return '';
                return '<i class="fa fa-check"></i>';
            })
            ->editColumn('is_approved', function ($data) {
                if (!$data->is_approved) return '';
                return '<i class="fa fa-check"></i>';
            })
            ->editColumn('activity.name', function ($data) {
                if (!$data->activity_id) {
                    return '';
                }
                return $data->activity->name;
            })
            ->rawColumns(['is_verified', 'is_approved', 'action', 'photo_url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->allowed()->with(['role', 'activity']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('usersdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->drawCallback('function(){
                initZoomImage();
            }')
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'scrollX' => true
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('photo_url')->title('Foto'),
            Column::make('name')->title('Nama'),
            Column::make('graduation_year')->title('Stambuk'),
            Column::make('address')->title('Alamat'),
            Column::make('birth_place')->title('Tempat Lahir'),
            Column::make('formatted_birth_date')->title('Tanggal Lahir')->searchable(false),
            Column::make('phone_number')->title('Nomor HP'),
            Column::make('activity.name')->title('Kegiatan'),
            Column::make('detail_activity')->title('Detail Kegiatan')->searchable(false),
            Column::make('role.name')->title('Role')->orderable(false),
            Column::make('is_verified')->title('Diverifikasi'),
            Column::make('is_approved')->title('Disetujui'),
            Column::make('created_at')->title('Dibuat pada'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
