<?php

if ($request->file('picture3')) {
      $ext3 = strtolower($request->file('picture3')->getClientOriginalExtension());
      if($ext3 != "jpg" && $ext3 != "jpeg" && $ext3 != "png" && $ext3 != "gif"){
        $ext3 = $pdt->picture3;
      }
      else{
        if(file_exists("public/images/product/{$pdt->id}-1.{$pdt->picture3}")){
          unlink("public/images/product/{$pdt->id}-1.{$pdt->picture3}");
        }
        $request->file('picture3')->move("public/images/product/", "{$pdt->id}-1.{$ext3}");
      }
    }
    else{
      $ext3 = $pdt->picture3;
    }
