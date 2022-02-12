<?php

namespace App\DataTables;

use App\Models\Test;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExplanationDataTable extends DataTable
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
                $formatedDate = Carbon::parse($data->created_at)->locale('id')->format('d/m/Y H:i:s');
                return $formatedDate;
            })
            ->addColumn('action', function ($data) {
                $custom = [
                    [
                        'url' => route("tryout.explanation", encrypt($data->id)),
                        'title' => 'Pembahasan',
                        'icon' => 'fa fa-check-square',
                        'hide' => !$data->gtryOut->show_explanation
                    ],
                    [
                        'url' => route("tryout.result", encrypt($data->tryOut->id)),
                        'title' => 'Peringkat',
                        'icon' => 'fa fa-list-ol'
                    ],
                ];
                return view('datatables.action', compact(['custom']));
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Test $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Test $model)
    {
        return $model->newQuery()->own()->with(['tryOut']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('explanation-table')
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
            Column::computed('DT_RowIndex', 'No.'),
            Column::make('created_at')->title('Dikerjakan Pada'),
            Column::make('try_out.name')->title('Nama Try Out'),
            Column::make('duration')->title('Waktu Pengerjaan'),
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
        return 'Explanation_' . date('YmdHis');
    }
}
