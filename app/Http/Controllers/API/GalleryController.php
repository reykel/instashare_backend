<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    //
    public function upload(Request $request)
    {
        $file = Gallery::firstWhere('document_type', $request->get('document_type'));

        if($file == null)
            $file = new Gallery;

        if($request->file()){
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

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
        $file_acreditacion_cpi_front = Gallery::firstWhere('document_type', 'image_product');
        $file_acreditacion_cpi_back = Gallery::firstWhere('document_type', 'acreditacion_cpi_back');

        $file_carnet_de_identidad_front = Gallery::firstWhere('document_type', 'carnet_de_identidad_front');
        $file_carnet_de_identidad_back = Gallery::firstWhere('document_type', 'carnet_de_identidad_back');

            return response()->json([
                'image_product' => $file_acreditacion_cpi_front ? "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud'.$file_acreditacion_cpi_front->path)) : "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud/storage/app/public/uploads/Blank.png')),
                'acreditacion_cpi_back' => $file_acreditacion_cpi_back ? "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud'.$file_acreditacion_cpi_back->path)) : "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud/storage/app/public/uploads/Blank.png')),
                'carnet_de_identidad_front' => $file_carnet_de_identidad_front ? "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud'.$file_carnet_de_identidad_front->path)) : "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud/storage/app/public/uploads/Blank.png')),
                'carnet_de_identidad_back' => $file_carnet_de_identidad_back ? "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud'.$file_carnet_de_identidad_back->path)) : "data:image/jpeg;base64,".base64_encode(file_get_contents('C:/xampp/htdocs/api_crud/storage/app/public/uploads/Blank.png')),

                'message' => 'File uploaded successfully'
            ], 200 );
    }

    public function delete(Request $request)
    {
        $file = Gallery::firstWhere('document_type', $request->get('document_type'));

        unlink('C:/xampp/htdocs/api_crud'.$file->path);

        $file->delete();

        return response([
            'message' => 'File delete successfully'
        ], 200 );
    }

    public function file_located(Request $request)
    {
        $file_acreditacion_cpi_front_visible = Gallery::firstWhere('document_type', 'image_product');
        $file_acreditacion_cpi_back_visible = Gallery::firstWhere('document_type', 'acreditacion_cpi_back');

        $file_carnet_de_identidad_front_visible = Gallery::firstWhere('document_type', 'carnet_de_identidad_front');
        $file_carnet_de_identidad_back_visible = Gallery::firstWhere('document_type', 'carnet_de_identidad_back');

            return response()->json([
                'image_product' => $file_acreditacion_cpi_front_visible ? true : false,
                'acreditacion_cpi_back' => $file_acreditacion_cpi_back_visible ? true : false,
                'carnet_de_identidad_front' => $file_carnet_de_identidad_front_visible ? true : false,
                'carnet_de_identidad_back' => $file_carnet_de_identidad_back_visible ?  true : false,

                'message' => 'ok'
            ], 200 );

    }
}
