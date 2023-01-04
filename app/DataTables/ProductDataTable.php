<?php

namespace App\DataTables;

use App\Models\Product;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    public $dataTable;

    public function __construct() {
        $this->dataTable = new GeneralDataTable();
    }
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
            ->editColumn('status', function (Product $product) {

                $status = $product->status;

                switch($status) {
                    case 0: return 'avialable'; 
                    break;
                    case 1: return 'unavailable';
                }

            })
            ->addColumn('action', function (Product $product){
                return $this->dataTable->setAction($product->id);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            ->setTableId("productTable")
            ->minifiedAjax(route("product.list.table"))
            ->columns($this->getColumns())
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->lengthMenu([10,25,40])
            ->info(false)
            ->ordering(true)
            ->responsive(true)
            ->pageLength(8)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('print'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            $this->dataTable->getIndexCol(),
            Column::make('name')
            ->title('Name'),
            Column::make('price')
            ->title('Price'),
            Column::make('description')
            ->title('Description'),
            Column::make('status')
            ->title('Status'),
            $this->dataTable->setActionCol('| Edit')
        ];
    }
}
