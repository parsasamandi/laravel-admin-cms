<?php

namespace App\DataTables;

use App\Models\Description;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DescriptionDataTable extends DataTable
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
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->addColumn('experience_id', function (Description $description) {
                return optional($description->experience)->title;
            })
            ->addColumn('project_id', function (Description $description) {
                return optional($description->project)->name;
            })
            ->addColumn('size', function (Description $description) {
                return $description->size;
            })
            ->addColumn('description', function (Description $description) {
                return $description->desc;
            })
            ->addColumn('action', function (Description $description){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$description->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$description->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Description $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Description $model)
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
            ->setTableId('descriptionTable')
            ->minifiedAjax(route('description.list.table'))
            ->columns($this->getColumns())
            ->searching(true)
            ->info(false)
            ->ordering(true)
            ->responsive(true)
            ->pageLength(6)
            ->dom('PBCfrtip')
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
            Column::make('DT_RowIndex')
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('experience_id')
            ->title('Experience')
                ->addClass('column-title'),
            Column::make('project_id')
            ->title('Project')
                ->addClass('column-title'),
            Column::make('size')
            ->title('Size')
                ->addClass('column-title'),
            Column::make('description')
            ->title('Description')
                ->addClass('column-title'),
            Column::computed('action') //This column is not in database
            ->title('Action')
                ->addClass('column-title')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('Action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Description_' . date('YmdHis');
    }
}
