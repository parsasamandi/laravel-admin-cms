<?php

namespace App\DataTables;

use App\Models\Refree;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RefreeDataTable extends DataTable
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
            ->rawColumns(['action','link','image'])
            ->addColumn('name', function (Refree $refree) {
                return $link->text;
            })
            ->addColumn('desc', function (Refree $refree) {
                return $refree->desc;
            })
            ->addColumn('image', function (Refree $refree) {
                return "<img src=/images/" . $refree->image . "height='auto' width='100px' ";
            })
            ->addColumn('link', function (Refree $refree) {
                return <<<ATAG
                            <a href="$refree->link">Open The Address</a>
                        ATAG; 
            })
            ->addColumn('action', function (Refree $refree){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$refree->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$refree->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Refree $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Refree $model)
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
            ->setTableId('refreeTable')
            ->minifiedAjax(route('refree.list.table'))
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
            Column::make('name')
            ->title('Name')
                ->addClass('column-title'),
            Column::make('desc')
            ->title('Description')
                ->addClass('column-title'),
            Column::make('image')
            ->title('Image')
                ->addClass('column-title'),
            Column::make('link')
            ->title('Link')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
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
        return 'Refree_' . date('YmdHis');
    }
}
