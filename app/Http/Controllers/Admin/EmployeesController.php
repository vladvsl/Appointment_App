<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $query = Employee::with(['services'])->select(sprintf('%s.*', (new Employee())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'employee_show';
                $editGate = 'employee_edit';
                $deleteGate = 'employee_delete';
                $crudRoutePart = 'employees';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('services', function ($row) {
                $labels = [];
                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->price);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'services']);

            return $table->make(true);
        }

        return view('admin.employees.index');
    }

    public function create()
    {


        $services = Service::pluck('price', 'id');

        return view('admin.employees.create', compact('services'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());
        $employee->services()->sync($request->input('services', []));

        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {


        $services = Service::pluck('price', 'id');

        $employee->load('services');

        return view('admin.employees.edit', compact('employee', 'services'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        $employee->services()->sync($request->input('services', []));

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {


        $employee->load('services');

        return view('admin.employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
