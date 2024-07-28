<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

use ZipArchive;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $file = File::firstWhere([
            ['document_type', '=', $request->get('document_type')],
            ['product_id', '=', $request->get('id')],
        ]);

        if ($file == null) {
            $file = new File;
        }

        if ($request->file()) {

            $originalFileName = $request->file->getClientOriginalName();
            $fileName = time() . '_' . $originalFileName;
            $filePath = $request->file('file')->storeAs('', $fileName, 'public');

            $zip = new ZipArchive();
            $zipFileName = time() . '_' . pathinfo($originalFileName, PATHINFO_FILENAME) . '.zip';
            $zipFilePath = storage_path('app/public/uploads/' . $zipFileName);

            if (!file_exists(storage_path('app/public/uploads'))) {
                mkdir(storage_path('app/public/uploads'), 0755, true);
            }

            if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                $fullFilePath = Storage::disk('public')->path($filePath);
                $zip->addFile($fullFilePath, $originalFileName);
                $zip->close();

                $file->document_type = $request->get('document_type');
                $file->name = $originalFileName;
                $file->path = 'app/public/uploads/' . $zipFileName;
                $file->product_id = $request->get('id');
                $file->save();

                Storage::disk('public')->delete($filePath);

                return response([
                    'message' => 'File uploaded and zipped successfully'
                ], 200);
            } else {
                return response([
                    'message' => 'Failed to create ZIP file'
                ], 500);
            }
        }
    }

    public function retrieve($id)
    {
        $image_product = File::firstWhere([
            ['document_type', '=', 'image_product'],
            ['product_id', '=', $id],
        ]);

        if ($image_product) {
            $zipFilePath = storage_path($image_product->path);
            $extractToPath = storage_path('app/public/uploads/');
    
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath) === TRUE) {
                $zip->extractTo($extractToPath);
                $zip->close();
            } else {
                return response()->json([
                    'message' => 'Failed to open ZIP file'
                ], 500);
            }
        }

        if($image_product){
            $image_product_encoded = "data:image/jpeg;base64,".base64_encode(Storage::get($image_product->name));
            Storage::disk('public')->delete($image_product->name);
        }else{
            $image_product_encoded = "data:image/jpeg;base64,".base64_encode(Storage::get('Blank.png'));
        }
            
        

        return response()->json([
            'image_product' => $image_product_encoded,
            'message' => 'File uploaded successfully'
        ], 200 );
    }

    public function delete(Request $request)
    {
        $file = File::firstWhere([
            ['document_type', '=', $request->get('document_type')],
            ['product_id', '=', $request->get('id')],
        ]);

        Storage::delete($file->name);

        $file->delete();

        return response([
            'message' => 'File delete successfully'
        ], 200 );
    }

    public function file_located(Request $request)
    {
        $image_product_visible = File::firstWhere('document_type', 'image_product');

            return response()->json([
                'image_product' => $image_product_visible ? true : false,
            ], 200 );

    }
}
