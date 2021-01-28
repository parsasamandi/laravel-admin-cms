<?php

namespace App\DataTables;

use App\Models\Experience;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExperienceDataTable extends DataTable
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
            ->rawColumns(['action','image'])
            ->addColumn('title', function (Experience $experience) {
                return $experience->title;
            })
            ->addColumn('image', function (Experience $experience) {
                return "<img src=/images/". $experience->image ." height='auto' width='50%' />";
            })
            ->addColumn('action', function (Experience $experience){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$experience->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$experience->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Experience $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Experience $model)
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
            ->setTableId('experienceTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('experience.list.table'))
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
            Column::make('title')
            ->title('Title')
                ->addClass('column-title'),
            Column::make('image')
            ->title('Image')
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
        return 'Experience_' . date('YmdHis');
    }
}
