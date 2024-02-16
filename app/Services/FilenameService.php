<?php

namespace App\Services;

use Illuminate\Support\Str;

class FilenameService
{
    public function generateUniqueFilename($file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $filename = $originalName . '_' . Str::random(5) . '.' . $extension;
        return $filename;
    }
}
