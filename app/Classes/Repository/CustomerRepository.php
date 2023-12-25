<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICustomerRepository;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;

class CustomerRepository  extends BaseRepository implements ICustomerRepository
{
    public function __construct(Customers $model)
    {
        parent::__construct($model);
    }


    public function exists($code)
    {
        $bool =  $this->model->where('code', $code)->exists();
        return $bool;
    }

    public function getListCustomer($data)
    {
        $column = $data['column'] ?? null;
        $direction = $data['direction'] ?? null;
        $key = $data['key'] ?? '';
        $staff_id = $data['staff_id'] ?? '';
        $payment_terms = $data['payment_terms'] ?? '';
        $filter_me = $data['filter_me'] ?? 'false';
        $query = $this->model;

        //
        $customer = Customers::query();

        if ($staff_id != '') {
            $customer = $customer->whereHas('customer_managers', function($query) use ($staff_id) {
                $query->where('person_in_charge_id', $staff_id);
            });
        };

        if ($payment_terms != '') {
            $customer = $customer ->where('payment_terms', $payment_terms);
        };

        if ($filter_me == 'true') {
            $me_id = Auth::id();
            $customer = $customer->whereHas('customer_managers', function($query) use ($me_id) {
                $query->where('person_in_charge_id', $me_id);
            });
        }

        $customer = $customer->where(function($query) use ($key) {
            $query->where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')
            ->orWhere('phone', 'LIKE', '%' . $key . '%')
            ->orWhere('address', 'LIKE', '%' . $key . '%')
            ->orWhereHas('customer_managers', function ($subQuery) use ($key) {
                $subQuery->whereHas('staff', function ($personQuery) use ($key) {
                    $personQuery->whereHas('profile', function ($profileQuery) use ($key) {
                        $profileQuery->where('first_name', 'LIKE', '%' . $key . '%')
                                    ->orWhere('last_name', 'LIKE', '%' . $key . '%');
                    });
                });
            });
        });
        $customer = $customer->orderBy($column ?? 'code', $direction ?? 'asc')->paginate(20);

        $attr = [
            'column' => $column,
            'direction' => $direction,
            'key' => $key,
            'staff_id' => $staff_id,
            'customer' => $customer,
            'filter_me' => $filter_me,
            'payment_terms' => $payment_terms,
        ];
        return $attr;
    }

    /**
     * get list data sort by column
     * @param array $data
     */
    public function sortCustomer($data)
    {
        $column = $data['column'] ?? 'code';
        $direction = $data['direction'] ?? 'asc';
        return $this->model
            ->orderBy($column, $direction)
            ->paginate(20);
    }

    /**
     * @inheritDoc
     */
    public function getByStaffIdInCustomerManager($staffId)
    {
        return $this->model
            ->whereHas('customer_managers', function ($qr) use ($staffId) {
            return $qr->where('person_in_charge_id', $staffId);
        })->get();
    }
}
