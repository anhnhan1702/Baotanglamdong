<?php

namespace App\Observers;

use App\Models\Hienvat;
use App\Models\Fileuploads;
use File;

class HienvatObserver
{
    /**
     * Handle the HienvatModel "created" event.
     *
     * @param  \App\Models\HienvatModel  $hienvatModel
     * @return void
     */
    public function created(Hienvat $hienvatModel)
    {
        $vitri = strpos($hienvatModel->so_ky_hieu, '.', 0);
        $substring = substr($hienvatModel->so_ky_hieu, $vitri + 1,strlen($hienvatModel->so_ky_hieu));
        $vitri2 = strpos($substring, '/', 0);
        $substring2 = substr($substring, 0,$vitri2);
        $suahienvat = Hienvat::find($hienvatModel->id);
        $suahienvat->orderby = (int)$substring2;
        $suahienvat->create_by = auth()->user()->id;

        $suahienvat->save();
    }

    /**
     * Handle the HienvatModel "updated" event.
     *
     * @param  \App\Models\HienvatModel  $hienvatModel
     * @return void
     */
    public function updated(Hienvat $hienvatModel)
    {
        // $vitri = strpos($hienvatModel->so_ky_hieu, '.', 0);
        // $substring = substr($hienvatModel->so_ky_hieu, $vitri + 1,strlen($hienvatModel->so_ky_hieu));
        // $vitri2 = strpos($substring, '/', 0);
        // $substring2 = substr($substring, 0,$vitri2);
        // $suahienvat = Hienvat::find($hienvatModel->id);
        // $suahienvat->orderby = $substring2;
        // $suahienvat->save();
    }

    /**
     * Handle the HienvatModel "deleted" event.
     *
     * @param  \App\Models\HienvatModel  $hienvatModel
     * @return void
     */
    public function deleted(Hienvat $hienvatModel)
    {
        $file = Fileuploads::where('tenbang','anhhienvat')->where('idtruong', $hienvatModel->id)->get();
        foreach(  $file as $f){
         File::delete($f->link);
         Fileuploads::where('tenfile', $f->name)->delete();
        }
        $file2 = Fileuploads::where('tenbang','tailieuhienvat')->where('idtruong', $hienvatModel->id)->get();
        foreach(  $file2 as $f){
         File::delete($f->link);
         Fileuploads::where('tenfile', $f->name)->delete();
        }
    }

    /**
     * Handle the HienvatModel "restored" event.
     *
     * @param  \App\Models\HienvatModel  $hienvatModel
     * @return void
     */
    public function restored(Hienvat $hienvatModel)
    {
        //
    }

    /**
     * Handle the HienvatModel "force deleted" event.
     *
     * @param  \App\Models\HienvatModel  $hienvatModel
     * @return void
     */
    public function forceDeleted(Hienvat $hienvatModel)
    {
     
    }
}
