<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ISubjectLabsRepository;
use App\Classes\Services\Interfaces\ILabsService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class LabsService extends BaseService implements ILabsService
{
    private $subjectLabsRepository;

    public function __construct(
        ISubjectLabsRepository $subjectLabsRepository,
    ) {
        $this->subjectLabsRepository = $subjectLabsRepository;
    }

    /**
     * @inheritDoc
     */
    public function createNewData($data)
    {
        DB::beginTransaction();
        try {

            $subject_labs = $this->subjectLabsRepository->findOne(['subject_id' => $data['subject_id']]);

            $attr = [
                $data['column'] =>$data['value'],
            ];

            if (!$subject_labs) {
                $attr['subject_id'] = $data['subject_id'];
                $this->subjectLabsRepository->create($attr);
            }else{
                $this->subjectLabsRepository->update($subject_labs, $attr);
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new subject labs: ' . $e->getMessage());
            return false;
        }
    }
}
