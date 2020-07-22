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
