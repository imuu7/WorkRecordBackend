<?php

namespace App\DataTables;

use App\Models\tel_msg_log;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class tel_msg_logDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'tel_msg_logs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\tel_msg_log $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(tel_msg_log $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
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
            'message_id' => new Column(['title' => __('models/telMsgLogs.fields.message_id'), 'data' => 'message_id']),
            'msg_from_id' => new Column(['title' => __('models/telMsgLogs.fields.msg_from_id'), 'data' => 'msg_from_id']),
            'msg_from_body' => new Column(['title' => __('models/telMsgLogs.fields.msg_from_body'), 'data' => 'msg_from_body']),
            'message_date' => new Column(['title' => __('models/telMsgLogs.fields.message_date'), 'data' => 'message_date']),
            'chat_body' => new Column(['title' => __('models/telMsgLogs.fields.chat_body'), 'data' => 'chat_body']),
            'chat_text' => new Column(['title' => __('models/telMsgLogs.fields.chat_text'), 'data' => 'chat_text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tel_msg_logs_datatable_' . time();
    }
}
