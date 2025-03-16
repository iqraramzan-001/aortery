<?php

namespace App\Traits;

use App\Models\CompanyDocument;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait FileUploads
{
//    public function saveFile($files, $newModel, $id = null, $type = null)
//    {
//        if (!is_array($files)) {
//            $files = [$files];
//        }
//
//        $savedFiles = [];
//
//        foreach ($files as $file) {
//            if ($file instanceof \Illuminate\Http\UploadedFile) { // Ensure it's a file object
//                $filePath = $file->store('public/docs');
//                $filePath = str_replace('public/', '', $filePath);
//
//                if ($newModel instanceof UserDocument) {
//                    DB::table('user_documents')->insert([
//                        'document' => $filePath,
//                        'user_id' => Auth::id(),
//                        'uploaded_by_id' => getLoggedUserId(),
//                        'uploaded_by_type' => getModelRef(),
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                }
//
//                if ($newModel instanceof CompanyDocument) {
//                    DB::table('company_documents')->insert([
//                        'file' => $filePath,
//                        'company_id' => $id ?? null,
//                        'type' => $type,
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                }
//
//                $savedFiles[] = $filePath;
//            }
//        }
//
//        return $savedFiles;
//    }

    public function saveFile($files, $newModel, $id = null, $type = null)
    {
        if (!is_array($files)) {
            $files = [$files];
        }

        $savedFiles = [];

        foreach ($files as $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                \Log::info('Uploading file: ', ['file' => $file->getClientOriginalName()]);

                // Define path inside "public/docs/"
                $destinationPath = public_path('docs');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); // Ensure directory exists
                }

                // Move file to "public/docs/"
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move($destinationPath, $fileName);

                $filePath = $fileName;
                \Log::info('Saving file path:', ['path' => $filePath]);

                if ($newModel instanceof UserDocument) {
                    DB::table('user_documents')->insert([
                        'document' => $filePath,
                        'user_id' => Auth::id(),
                        'uploaded_by_id' => getLoggedUserId(),
                        'uploaded_by_type' => getModelRef(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                if ($newModel instanceof CompanyDocument) {
                    DB::table('company_documents')->insert([
                        'file' => $filePath,
                        'company_id' => $id ?? null,
                        'type' => $type,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $savedFiles[] = $filePath;
            }
        }

        return $savedFiles;
    }


}
