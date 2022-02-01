<?php

namespace App\Helper;

use App\Helper\Uuid;

class Storage
{
    public static function uploadImageKlub($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/klub"), $name);

      return $name;
    }

    public static function uploadImagePemain($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/pemain"), $name);

      return $name;
    }

    public static function uploadImageKontrak($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/kontrak"), $name);

      return $name;
    }
    public static function uploadImageBerita($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/berita"), $name);

      return $name;
    }

    public static function getLinkImageKlub($name)
    {
        return url('/assets/img/klub/'.$name);
    }

    public static function getLinkImagePemain($name)
    {
        return url('/assets/img/pemain/'.$name);
    }

    public static function getLinkImageKontrak($name)
    {
        return url('/assets/img/kontrak'.$name);
    }
}
