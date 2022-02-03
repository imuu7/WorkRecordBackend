<?php

namespace App\DataTables;

use App\Models\Clockin;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ClockinDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'clockins.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Clockin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Clockin $model)
    {
        if ($this->id) {
            return $model->newQuery()->where('user_id', $this->id)->orderBy('id', 'desc');
        }
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // [
                    //    'extend' => 'create',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    // ],
                    // [
                    //    'extend' => 'export',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    // ],
                    // [
                    //    'extend' => 'print',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    // ],
                    // [
                    //    'extend' => 'reset',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    // ],
                    // [
                    //    'extend' => 'reload',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    // ],
                ],
                 'language' => [
                   'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
                 ],
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
            'date' => new Column(['title' => __('models/clockins.fields.date'), 'data' => 'date']),
            'type' => new Column(['title' => __('models/clockins.fields.type'), 'data' => 'type']),
            'name' => new Column(['title' => __('models/clockins.fields.name'), 'data' => 'name']),
            // 'user_id' => new Column(['title' => __('models/clockins.fields.user_id'), 'data' => 'user_id']),
            'start_time' => new Column(['title' => __('models/clockins.fields.start_time'), 'data' => 'start_time']),
            'end_time' => new Column(['title' => __('models/clockins.fields.end_time'), 'data' => 'end_time']),
            'over_time' => new Column(['title' => __('models/clockins.fields.over_time'), 'data' => 'over_time']),
            'late_time' => new Column(['title' => __('models/clockins.fields.late_time'), 'data' => 'late_time']),
            'leave_early_time' => new Column(['title' => __('models/clockins.fields.leave_early_time'), 'data' => 'leave_early_time']),
            'total' => new Column(['title' => __('models/clockins.fields.total'), 'data' => 'total']),
            'verify' => new Column(['title' => __('models/clockins.fields.verify'), 'data' => 'verify']),
            'note' => new Column(['title' => __('models/clockins.fields.note'), 'data' => 'note'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clockins_datatable_' . time();
    }
}
