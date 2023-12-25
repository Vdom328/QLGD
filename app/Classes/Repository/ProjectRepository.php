<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectRepository extends BaseRepository implements IProjectRepository
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function filter($dataFilter)
    {
        $pageDefault = !(empty($dataFilter['totalPages'])) ? $dataFilter['totalPages'] : 20;
        return $this->model
            /* select status */
            ->when(!empty($dataFilter['dataStatus']), function ($qr) use ($dataFilter) {
                $qr->whereIn('status', $dataFilter['dataStatus']);
            })
            /* select category */
            ->when(!empty($dataFilter['category']), function ($qr) use ($dataFilter) {
                $qr->where('category_id', $dataFilter['category']);
            })
            /* select staff */
            ->when(!empty($dataFilter['staff_id']), function ($qr) use ($dataFilter) {
                $qr->where('staff_id', $dataFilter['staff_id']);
            })
            /* filter me (checkbox)*/
            ->when(!empty($dataFilter['filter_me']) && $dataFilter['filter_me'] === "true", function ($qr) use ($dataFilter) {
                $qr->where('staff_id', Auth::id());
            })
            /* filter free word */
            ->when(!empty($dataFilter['keywords']), function ($qr) use ($dataFilter) {
                $qr->where('name', 'LIKE', '%' . $dataFilter['keywords'] . '%');
            })
            /* select customer_id */
            ->when(!empty($dataFilter['customer_id']), function ($qr) use ($dataFilter) {
                $qr->where('customer_id', $dataFilter['customer_id']);
            })
            /* select supplier_id */
            ->when(!empty($dataFilter['supplier_id']), function ($qr) use ($dataFilter) {
                $qr->whereHas('supplier', function ($subQr) use ($dataFilter) {
                    $subQr->where('id', $dataFilter['supplier_id']);
                });
            })
            /* select supplier_manager_id */
            ->when(!empty($dataFilter['supplier_manager_id']), function ($qr) use ($dataFilter) {
                $qr->whereHas('supplier.supplier_managers', function ($subQr) use ($dataFilter) {
                    $subQr->where('id', $dataFilter['supplier_manager_id']);
                });
            })
            /* select supplier_manager_id */
            ->when(!empty($dataFilter['supplier_manager_staff_id']), function ($qr) use ($dataFilter) {
                $qr->whereHas('supplier.supplier_managers', function ($subQr) use ($dataFilter) {
                    $subQr->where('person_in_charge_id', $dataFilter['supplier_manager_staff_id']);
                });
            })
            /* sort */
            ->when(!empty($dataFilter['filed_sort']) && !empty($dataFilter['type_sort']), function ($qr) use ($dataFilter) {
                /* sort supplier_name */
                if ($dataFilter['filed_sort'] == 'supplier_name') {
                    $qr->join('supplies', 'projects.supplier_id', '=', 'supplies.id')
                        ->orderBy('supplies.name', $dataFilter['type_sort'])
                        ->select('projects.*');
                }
                /* sort by customer name */
                else if ($dataFilter['filed_sort'] == 'customer') {
                    $qr->whereHas('customer', function ($queryCustomer) use ($dataFilter) {
                        $queryCustomer->orderBy('name', $dataFilter['type_sort']);
                    });
                }
                else {
                    $qr->orderBy($dataFilter['filed_sort'], $dataFilter['type_sort']);
                }
            })
            ->paginate($pageDefault);
    }

    public function getByStaffId($staff_id, $key)
    {
        return $this->model->where('staff_id', $staff_id)
            ->where('name', 'LIKE', '%' . $key . '%')
            ->get();
    }

    public function searchAndFilter($request)
    {
        $query = $this->model;

        if ($request['category']) {
            $query = $query->where('category_id', $request['category']);
        }

        if ($request['customer']) {
            $query = $query->where('customer_id', $request['customer']);
        }

        if ($request['free_input']) {
            $query = $query->where('name', 'LIKE', '%' . $request['free_input'] . '%');
        }

        if ($request['status']) {
            $query = $query->where('status', $request['status']);
        }

        if ($request['staff']) {
            $query = $query->where('staff_id', $request['staff']);
        }

        if ($request['filter_project'] == 'true') {

            $staffId = Auth::user()->id;

            $query =  $query->where('staff_id', $staffId);
        }

        if ($request['sort_column' == 'name_supplier']) {
            $query = $query->with(['supplier' => function ($query) use ($request) {
                $query->orderBy('name', $request['sort_direction']);
            }]);
        }else{
            $query = $query->orderBy($request['sort_column'], $request['sort_direction']);
        }

        return $query->paginate(3);
    }

    public function getProjectByCompanyId($id)
    {
        return $this->model->where('company_id', $id)->first();
    }
}
