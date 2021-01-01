<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Recortar extends Controller
{
    public function subirImagen(Request $request)
    {
      $mediaQuery = [
        ['1920','1080'],
        ['1280','720'],
        ['854','480'],
        ['640','360'],
      ];
     
      foreach($request->file('imagen') as $imagen){
        foreach($mediaQuery as $mq){
          $img = Image::make($imagen)->resize($mq[0], $mq[1]);
          //$nombreOriginal = $request->imagen->getCLientOriginalName(); con extension incluida
          $nombreOriginal = $imagen->getCLientOriginalName();
          $NombreSinExtension = pathinfo($nombreOriginal, PATHINFO_FILENAME);
          Storage::disk('local')->put('public/'.$mq[1].'/'.$NombreSinExtension.'.webp', $img->save($imagen,100,'webp'));
        }
        
      }
     
      return back()->with('success','imagenes guardadas con exito');

      }
    
}
