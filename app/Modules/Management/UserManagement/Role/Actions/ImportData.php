<?php

namespace App\Modules\Management\UserManagement\Role\Actions;
use App\Modules\Management\UserManagement\Role\Others\ImportJob;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
class ImportData
{
    static $model = \App\Modules\Management\UserManagement\Role\Models\Model::class;

    public static function execute()
    {
        try {
            // dd(request()->all());
            if (!request()->hasFile('file')) {
                return messageResponse('Plase select a file', [], 404, 'error');
            }

            $path = request()->file->store('temp');
            $data = Excel::toArray([], storage_path('app/' . $path));
            $chunks = array_chunk($data[0], 10);
            $header = [];
            $batch = Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunk) {
                if ($key === 0) {
                    $header = array_shift($chunk); // Set the header and remove it from data
                }
                $batch->add(new ImportJob($chunk, $header));
            }

            $filePath = storage_path('app/' . $path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return messageResponse('Item Successfully updated', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}