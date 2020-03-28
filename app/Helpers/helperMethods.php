<?php

function fileUpload ($file) {
    try {
        //Get the file name with the extension
        $fileNameWithExtension = $file->getClientOriginalName();
        //Get just file name
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();
        //File name to store
        $fileNameToStore = $fileName.'_'.time().'_'.$fileExtension;
        //upload file path

        return ['success' => true, 'fileName' => $fileNameToStore];
    } catch (\Exception $e) {
        return ['success' => false, 'fileName' => null,'message'=>'there is no file'];
    }
}
