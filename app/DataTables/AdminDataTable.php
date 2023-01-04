<?php

namespace App\DataTables;

use App\Models\User;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;

class AdminDataTable extends DataTable
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
            ->addColumn('action', function (User $user){
                return $this->dataTable->setAction($user->id);
            });
    }
    

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'admin');
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
            Column::make('email')
            ->title('Email Adress'),
            Column::make('created_at')
            ->title('Created at'),
            Column::make('updated_at')
            ->title('Update at'),
            $this->dataTable->setActionCol('| Edit')
        ];
    }
}



