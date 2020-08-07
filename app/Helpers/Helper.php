<?php
function getactivelanguages()
{
    return \App\Models\Language::where('active',1)->selection()->get();
}


function get_default_language()
{
     return Config::get('app.locale');
}

// function saveimage($image,$path)
// {
//     $name=time().$image->getClientOriginalName();
//     $photo=$image->move('images/'.$path.'/',$name);
//     return $photo;
// }

function uploadimage($folder,$image){
    $image ->store('/',$folder);
    $filename=$image->hashName();
    $path='images/'.$folder.'/'.$filename;
    return $path;
}


