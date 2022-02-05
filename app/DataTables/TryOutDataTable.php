<?php

namespace App\DataTables;

use App\Models\TryOut;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TryOutDataTable extends DataTable
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
            ->editColumn('start_date', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->start_date)->locale('id')->format('d/m/Y');
                return $formatedDate;
            })
            ->editColumn('end_date', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->end_date)->locale('id')->format('d/m/Y');
                return $formatedDate;
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d/m/Y H:i:s');
                return $formatedDate;
            })
            ->addColumn('action', function ($data) {
                $edit_url = route('tryout.edit', $data);
                $delete_url = route('tryout.destroy', $data);
                $custom = [
                    [
                        'url' => route('tryout.set-question', $data->id),
                        'icon' => "fa fa-th",
                        'title' => 'Atur Soal'
                    ]
                ];
                return view('datatables.action', compact(['edit_url', 'delete_url', 'custom']));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TryOut $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TryOut $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('tryoutdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('Id'),
            Column::make('name')->title('Judul'),
            Column::make('duration')->title('Durasi (Menit)'),
            Column::make('start_date')->title('Tanggal Mulai'),
            Column::make('end_date')->title('Tanggal Berakhir'),
            Column::make('price')->title('Harga (Rp.)'),
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
        return 'TryOut_' . date('YmdHis');
    }
}
