<?php

namespace App\DataTables;

use App\Models\Interest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use App\DataTables\Media;
use Yajra\DataTables\Services\DataTable;

class InterestDataTable extends DataTable
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
            ->rawColumns(['action','media_id'])
            ->addColumn('title', function(Interest $interest) {
                return $interest->title;
            })
            ->addColumn('media_id', function(Interest $interest) {
                switch($interest->media->type) {
                    case 0:
                        return "<img src=/images/". $interest->media->media_url ." height='auto' width='60%' />";
                    case 1:
                        return '<iframe src="'. $interest->media->media_url. '" height="auto" width="60%" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
                }
            })
            ->addColumn('action', function (Interest $interest){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$interest->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$interest->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Interest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Interest $model)
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
            ->setTableId('interestTable')
            ->minifiedAjax(route('interest.list.table'))
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
            Column::make('title')
            ->title('Title')
                ->addClass('column-title'),
            Column::make('media_id')
            ->title('Media')
                ->addClass('Media'),
            Column::computed('action') // This column is not in database
            ->title('Action')
                ->addClass('column-title')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Interest_' . date('YmdHis');
    }
}
