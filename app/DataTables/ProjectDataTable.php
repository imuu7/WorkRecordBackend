<?php

namespace App\DataTables;

use App\Models\Project;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProjectDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'projects.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        $data = $model->newQuery();
        $user_data = auth()->user();
        if($user_data->role == 'guest'){
            $data = $data->where('user_id',$user_data->id);
        }
        return $data;
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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [

//                    [
//                        'extend' => 'create',
//                        'className' => 'btn btn-default btn-sm no-corner',
//                        'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
//                    ],
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
                    'url' => 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Chinese-traditional.json'

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
        if (auth()->user()->role == 'admin') {
            return [
                'project_name' => new Column(['title' => __('models/project.fields.project_name'), 'data' => 'project_name']),
                // 'user_id' => new Column(['title' => __('models/project.fields.user_id'), 'data' => 'user_id']),
                // 'detail' => new Column(['title' => __('models/project.fields.detail'), 'data' => 'detail']),
                'client_name' => new Column(['title' => __('models/project.fields.client_name'), 'data' => 'client_name']),
                'phone_num' => new Column(['title' => __('models/project.fields.phone_num'), 'data' => 'phone_num']),
                'contact_person' => new Column(['title' => __('models/project.fields.contact_person'), 'data' => 'contact_person']),
                // 'project_story' => new Column(['title' => __('models/project.fields.project_story'), 'data' => 'project_story']),
                // 'gantt' => new Column(['title' => __('models/project.fields.gantt'), 'data' => 'gantt']),
                // 'structure' => new Column(['title' => __('models/project.fields.structure'), 'data' => 'structure']),
                'start_time' => new Column(['title' => __('models/project.fields.start_time'), 'data' => 'start_time']),
                'end_time' => new Column(['title' => __('models/project.fields.end_time'), 'data' => 'end_time']),
                // 'contract_file' => new Column(['title' => __('models/project.fields.contract_file'), 'data' => 'contract_file']),
            ];
        }else if(auth()->user()->role == 'guest'){
            return [
                'project_name' => new Column(['title' => __('models/project.fields.project_name'), 'data' => 'project_name']),
                // 'user_id' => new Column(['title' => __('models/project.fields.user_id'), 'data' => 'user_id']),
                // 'detail' => new Column(['title' => __('models/project.fields.detail'), 'data' => 'detail']),
                'client_name' => new Column(['title' => __('models/project.fields.client_name'), 'data' => 'client_name']),
                'phone_num' => new Column(['title' => __('models/project.fields.phone_num'), 'data' => 'phone_num']),
                'contact_person' => new Column(['title' => __('models/project.fields.contact_person'), 'data' => 'contact_person']),
                // 'project_story' => new Column(['title' => __('models/project.fields.project_story'), 'data' => 'project_story']),
                // 'gantt' => new Column(['title' => __('models/project.fields.gantt'), 'data' => 'gantt']),
                // 'structure' => new Column(['title' => __('models/project.fields.structure'), 'data' => 'structure']),
                'start_time' => new Column(['title' => __('models/project.fields.start_time'), 'data' => 'start_time']),
                'end_time' => new Column(['title' => __('models/project.fields.end_time'), 'data' => 'end_time']),
                // 'contract_file' => new Column(['title' => __('models/project.fields.contract_file'), 'data' => 'contract_file']),
            ];
        }
        // return [
        //     'project_name',
        //     'user_id',
        //     'detail',
        //     'client_name',
        //     'phone_num',
        //     'contact_person',
        //     'project_story',
        //     'gantt',
        //     'structure',
        //     'start_time',
        //     'end_time',
        //     'contract_file'
        // ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'projects_datatable_' . time();
    }
}
