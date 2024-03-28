<?php

// saving image
// this function return an image path which will be saved into mysql storage

function storeImage(?String $newImageName) : ?String{
    $imageFile = $_FILES[$newImageName]["name"];
    if($imageFile === null || $imageFile === ""){
        return null;
    }else{

        $copyFolder = "./app/imagedata/";
        $fileName = $copyFolder.uniqid()."_".$imageFile;
        $copy = copy($_FILES[$newImageName]["tmp_name"],$fileName);
        if($copy){
            return $fileName;
        }else{
            return null;
        }
    }
      
}

function imageSaver(String $newImageName,?String $oldImagePath) : ?String{
    
    // if oldimage is present, will remove the old image first and then, add new image
    // checking old image is good for updating the data to reduce the storage usage
    
    if($oldImagePath === null){
        return storeImage($newImageName);
    }else{
        if(file_exists($oldImagePath)){
            unlink($oldImagePath);
        }

        return storeImage($newImageName);
    }
}