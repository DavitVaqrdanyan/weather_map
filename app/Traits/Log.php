<?php

namespace App\Traits;


use App\Models\Log as LogTable;
use Illuminate\Database\Eloquent\Model;

/**
 * Add log
 */
trait Log
{
    /**
     * @param array $data Api Data
     * @return Model | Bool
     */
    public function addLog(array $data)
    {
        try {
            return LogTable::create(['city' => $data['name'] , 'weather' => $data['main']['temp_min']]);
        }
        catch (\Exception $e){
            return false;
        }

    }
}
