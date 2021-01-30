<?php

namespace App\DataTables;

use App\Models\Link;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LinkDataTable extends DataTable
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
            ->rawColumns(['action','link'])
            ->addColumn('text', function (Link $link) {
                return $link->text;
            })
            ->addColumn('link', function (Link $link) {
                return <<<ATAG
                            <a href="$link->link">Open The Address</a>
                        ATAG; 
            })
            ->addColumn('desc_id', function (Link $link) {
                return optional($link->description)->desc;
            })
            ->addColumn('action', function (Link $link){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$link->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$link->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Link $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Link $model)
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
            ->setTableId('linkTable')
            ->minifiedAjax(route('link.list.table'))
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
            Column::make('text')
            ->title('Text')
                ->addClass('column-title'),
            Column::make('link')
            ->title('Link')
                ->addClass('column-title'),
            Column::make('desc_id')
            ->title('Description')
                ->addClass('column-title'),
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
        return 'Link_' . date('YmdHis');
    }
}
