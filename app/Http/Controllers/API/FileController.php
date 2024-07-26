<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function upload(Request $request)
    {
        $file = File::firstWhere('document_type', $request->get('document_type'));

        if($file == null)
            $file = new File;

        if($request->file()){
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('', $file_name, 'public');

            $file->document_type = request('document_type');

            $file->name = $file_name;
            $file->path = '/storage/app/public/'.$file_path;
            $file->save();

            return response([
                'message' => 'File uploaded successfully'
            ], 200 );
        }

    }

    public function retrieve(Request $request)
    {
        $image_product = File::firstWhere('document_type', 'image_product');

            return response()->json([
                'image_product' => $image_product ? "data:image/jpeg;base64,".base64_encode(Storage::get($image_product->name)) : "data:image/jpeg;base64,".base64_encode(Storage::get('Blank.png')),
                'message' => 'File uploaded successfully'
            ], 200 );
    }

    public function delete(Request $request)
    {
        $file = File::firstWhere('document_type', $request->get('document_type'));

        Storage::delete($file->name);

        $file->delete();

        return response([
            'message' => 'File delete successfully'
        ], 200 );
    }

    public function file_located(Request $request)
    {
        $image_product_visible = File::firstWhere('document_type', 'image_product');
        $file_acreditacion_cpi_back_visible = File::firstWhere('document_type', 'acreditacion_cpi_back');

        $file_carnet_de_identidad_front_visible = File::firstWhere('document_type', 'carnet_de_identidad_front');
        $file_carnet_de_identidad_back_visible = File::firstWhere('document_type', 'carnet_de_identidad_back');

            return response()->json([
                'image_product' => $image_product_visible ? true : false,
                'acreditacion_cpi_back' => $file_acreditacion_cpi_back_visible ? true : false,
                'carnet_de_identidad_front' => $file_carnet_de_identidad_front_visible ? true : false,
                'carnet_de_identidad_back' => $file_carnet_de_identidad_back_visible ?  true : false,
            ], 200 );

    }
}
