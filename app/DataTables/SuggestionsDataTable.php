<?php

namespace App\DataTables;

use App\Models\Suggestion;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SuggestionsDataTable extends DataTable
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
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d-m-Y H:i:s');
                return $formatedDate;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Suggestion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Suggestion $model)
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
            ->setTableId('developmentsuggestionsdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('id')->title('Id'),
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Nomor HP'),
            Column::make('message')->title('Pesan'),
            Column::make('created_at')->title('Dibuat pada'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Suggestions_' . date('YmdHis');
    }
}
