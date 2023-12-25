<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ISupplierRepository;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class SupplierRepository  extends BaseRepository implements ISupplierRepository
{
    public function __construct(Suppliers $model)
    {
        parent::__construct($model);
    }

    public function exists($code)
    {
        $bool =  $this->model->where('code', $code)->exists();
        return $bool;
    }

    /**
     * get list data sort by column
     * @param array $data
     */
    public function sortSupplier($data)
    {
        $column = $data['column'] ?? 'code';
        $direction = $data['direction'] ?? 'asc';
        return $this->model
            ->orderBy($column, $direction)
            ->paginate(20);
    }

    public function getListSupplier($data)
    {
        $column = $data['column'] ?? null;
        $direction = $data['direction'] ?? null;
        $key = $data['key'] ?? '';
        $staff_id = $data['staff_id'] ?? '';
        $payment_terms = $data['payment_terms'] ?? '';
        $filter_me = $data['filter_me'] ?? 'false';
        $query = $this->model;

        //
        $suppliers = Suppliers::query();

        if ($staff_id != '') {
            $suppliers = $suppliers->whereHas('supplier_managers', function ($query) use ($staff_id) {
                $query->where('person_in_charge_id', $staff_id);
            });
        };

        if ($payment_terms != '') {
            $suppliers = $suppliers->where('payment_terms', $payment_terms);
        };

        if ($filter_me == 'true') {
            $me_id = Auth::id();
            $suppliers = $suppliers->whereHas('supplier_managers', function ($query) use ($me_id) {
                $query->where('person_in_charge_id', $me_id);
            });
        }

        $suppliers = $suppliers->where(function ($query) use ($key) {
            $query->where('name', 'LIKE', '%' . $key . '%')
                ->orWhere('email', 'LIKE', '%' . $key . '%')
                ->orWhere('phone', 'LIKE', '%' . $key . '%')
                ->orWhere('address', 'LIKE', '%' . $key . '%')
                ->orWhereHas('supplier_managers', function ($subQuery) use ($key) {
                    $subQuery->whereHas('staff', function ($personQuery) use ($key) {
                        $personQuery->whereHas('profile', function ($profileQuery) use ($key) {
                            $profileQuery->where('first_name', 'LIKE', '%' . $key . '%')
                                        ->orWhere('last_name', 'LIKE', '%' . $key . '%');
                        });
                    });
                });
        });

        $suppliers = $suppliers->orderBy($column ?? 'code', $direction ?? 'asc')->paginate(20);

        $attr = [
            'column' => $column,
            'direction' => $direction,
            'key' => $key,
            'staff_id' => $staff_id,
            'suppliers' => $suppliers,
            'filter_me' => $filter_me,
            'payment_terms' => $payment_terms,
        ];
        return $attr;
    }
}
