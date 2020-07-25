<?php



function getLanguagesActive(){
    return \App\Models\Admin\Language::active()->selection()->get();
}



function languageLocal(){
    return \Config::get('app.locale');
}


function imageUpload($photo,$folder_save){

    $image = $photo->store("/",$folder_save);

    $path = "/images/" .$folder_save . "/" . $image;

    return $path;
}



function deleteFile($photo){
    if (\Illuminate\Support\Facades\File::exists(public_path($photo))) {

        \Illuminate\Support\Facades\File::delete(public_path($photo));
    }
}
