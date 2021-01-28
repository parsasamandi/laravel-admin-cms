<?php

namespace App\DataTables;

use App\Models\Education;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EducationDataTable extends DataTable
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
            ->addColumn('name', function (Education $education) {
                return $education->name;
            })
            ->addColumn('degree', function (Education $education) {
                return $education->degree;
            })
            ->addColumn('GPA', function (Education $education) {
                return $education->GPA;
            })
            ->addColumn('TOEFL', function (Education $education) {
                return $education->TOEFL;
            })
            ->addColumn('Thesis_topic', function (Education $education) {
                return $education->Thesis_topic;
            })
            ->addColumn('education_period', function (Education $education) {
                return $education->education_period;
            })
            ->addColumn('university_desc', function (Education $education) {
                return $education->university_desc;
            })
            ->addColumn('action', function (Education $education){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$education->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$education->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Education $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Education $model)
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
                ->setTableId('educationTable')
                ->minifiedAjax(route('education.list.table'))
                ->columns($this->getColumns())
                ->columnDefs(
                    [
                        ["className" => 'dt-center text-center', "target" => '_all'],
                    ]
                )
                ->searching(true)
                ->info(false)
                ->ordering(true)
                ->responsive(true)
                ->pageLength(8)
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
            Column::make('degree')
            ->title('Degree')
                ->addClass('column-title'),
            Column::make('GPA')
            ->title('GPA')
                ->addClass('column-title'),
            Column::make('TOEFL')
            ->title('TOEFL')
                ->addClass('column-title'),
            Column::make('Thesis_topic')
            ->title('Thesis Topic')
                    ->addClass('column-title'),
            Column::make('education_period')
            ->title('Education Period')
                    ->addClass('column-title'),
            Column::make('university_desc')
            ->title('University Description')
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
        return 'Education_' . date('YmdHis');
    }
}
