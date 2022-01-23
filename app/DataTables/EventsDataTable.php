<?php

namespace App\DataTables;

use App\Models\Event;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EventsDataTable extends DataTable
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
                $edit_url = url('/event/' . $data->id);
                $view_url = !$data->is_draft ? url('event?page=' . $data->page) : null;
                $delete_url = url('/event/' . $data->id . '/hapus');
                return view('datatables.events.action', compact(['view_url', 'edit_url', 'delete_url']));
            })
            ->editColumn('poster_url', function ($data) {
                return '<img width="70" src="' . $data->poster_url . '"/>';
            })
            ->editColumn('start_date', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->start_date)->locale('id')->format('d F Y');
                return $formatedDate;
            })
            ->editColumn('end_date', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->end_date)->locale('id')->format('d F Y');
                return $formatedDate;
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->locale('id')->format('d-m-Y H:i:s');
                return $formatedDate;
            })
            ->rawColumns(['poster_url', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Event $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Event $model)
    {
        return $model->newQuery()->own()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('eventsdatatable-table')
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
            Column::make('poster_url')->title('Poster'),
            Column::make('title')->title('Judul'),
            Column::make('start_date')->title('Tanggal Mulai'),
            Column::make('end_date')->title('Tanggal Selesai'),
            Column::make('place')->title('Tempat'),
            Column::make('user.name')->title('Dibuat oleh'),
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
        return 'Event_' . date('YmdHis');
    }
}
