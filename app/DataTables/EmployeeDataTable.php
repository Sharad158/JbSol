<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($employee) {
            $id = $employee->id;
            $edit = '<a class="label label-success badge badge-light-success" href="' . route('employee.edit',$id) . '"  title="Update"><i class="fa fa-edit"></i>&nbsp</a>';

            $delete = '<a class="label label-danger badge badge-light-danger" href="javascript:;"  title="Delete" onclick="deleteConfirm('.$id.')"><i class="fa fa-trash"></i>&nbsp</a>';

            $view = '<a class="label label-primary badge badge-light-primary" href="'. route('employee.show',$id).'"  title="View"><i class="fa fa-eye"></i>&nbsp</a>';
            return $view.' '.$edit.' '.$delete;
        })
        ->addColumn('status',  function($employee) {
            $id = $employee->id;
            $status = $employee->status;
            $class='text-danger';
            $label='Deactive';
            if($status==1)
            {
                $class='text-success';
                $label='Active';
            }
            return  '<a class="'.$class.' actStatus" id = "employee'.$id.'" data-sid="'.$id.'">'.$label.'</a>';

        })
        ->editColumn('name', function($employee) {
            return $employee->first_name.' '.$employee->last_name;
        })
        ->editColumn('company_id', function($employee) {
            if(isset($employee->companyData)){
                return $employee->companyData->name;
            }  
        })
        ->editColumn('created_at', function($employee) {
            $date = date_create($employee->created_at);
            return date_format($date, "d-M-Y");
        })

        ->rawColumns(['status','action','created_at']);//->toJson();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
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
                    ->setTableId('employee-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Employee_' . date('YmdHis');
    }
}
