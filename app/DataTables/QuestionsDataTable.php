<?php

namespace App\DataTables;

use App\Models\Question;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuestionsDataTable extends DataTable
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
            ->rawColumns(['question'])
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d F Y H:i:s');
                return $formatedDate;
            })
            ->addColumn('action', function ($data) {
                $edit_url = route('question.edit', $data);
                $delete_url = route('question.destroy', $data);
                return view('datatables.action', compact(['edit_url', 'delete_url']));
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Question $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Question $model)
    {
        return $model->newQuery()->with(['category']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('questionsdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip');
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
            Column::make('category.name')->title('Kategori'),
            Column::make('question')->title('Pertanyaan'),
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
        return 'Questions_' . date('YmdHis');
    }
}
