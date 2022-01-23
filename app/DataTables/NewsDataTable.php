<?php

namespace App\DataTables;

use App\Models\News;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewsDataTable extends DataTable
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
                $edit_url = url('/berita/' . $data->id);
                $view_url = !$data->is_draft ? url('berita/' . $data->slug) : null;
                $delete_url = url('/berita/' . $data->id . '/hapus');
                return view('datatables.news.action', compact(['view_url', 'edit_url', 'delete_url']));
            })
            ->editColumn('date', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->date)->locale('id')->isoFormat('DD MMMM Y');
                return $formatedDate;
            })
            ->editColumn('is_draft', function ($data) {
                if ($data->is_draft) return '';
                return '<i class="fa fa-check"></i>';
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d-m-Y H:i:s');
                return $formatedDate;
            })
            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->locale('id')->format('d-m-Y H:i:s');
                return $formatedDate;
            })
            ->rawColumns(['is_draft', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\News $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(News $model)
    {
        return $model->newQuery()->withoutGlobalScope('published');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('news-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            // ->orderBy(0)
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
            Column::make('title')->title('Judul'),
            Column::make('date')->title('Tanggal'),
            Column::make('is_draft')->title('Terbit'),
            Column::make('created_at')->title('Dibuat pada'),
            Column::make('updated_at')->title('Diperbarui pada'),
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
        return 'berita_' . date('YmdHis');
    }
}
