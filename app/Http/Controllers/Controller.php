<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Exceptions\DomainException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dispatchNow($job)
    {
        $jobResult = null;

        try {
            DB::beginTransaction();

            $jobResult = dispatch_sync($job);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw new DomainException($exception->getMessage(), 0, $exception);
        }

        return $jobResult;
    }
}
