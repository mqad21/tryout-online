<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AlumniDataTable extends DataTable
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
            ->editColumn('department.name', function ($data) {
                if ($data->department) {
                    return $data->department->name;
                }
                return '';
            })
            ->editColumn('photo_url', function ($data) {
                return '<img data-enlargeable="true" style="cursor: zoom-in"  width="70" src="' . $data->photo_url . '"/>';
            })
            ->rawColumns(['photo_url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->alumni();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('alumnidatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->drawCallback('function(){
                initZoomImage();
            }')
            ->parameters([
                'responsive' => true,
                'autoWidth' => false
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
            Column::make('name')->title('Nama'),
            Column::make('graduation_year')->title('Stambuk'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Alumni_' . date('YmdHis');
    }
}
