<?php
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Role;
use App\Permission;
use App\kategorimenu;
use App\kategori_permission;

class NavigasiComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $permission=Permission::leftJoin('permission_role','permissions.id','=','permission_role.permission_id')
                        ->where('permission_role.role_id','=',Auth::user()->roles->first()->id)
                        ->pluck('permission_role.permission_id');
                        // ->get();
            // dd($permission);
            $tanpakategoris=kategorimenu::leftJoin('kategori_permission','kategori_permission.kategori_id','=','kategorimenu.id')
                                ->whereIn('kategori_permission.permission_id',$permission)
                                // ->groupBy('kategori_permission.kategori_id')
                                ->distinct()
                                ->select('kategorimenu.id','kategorimenu.namakategorimenu','kategorimenu.icon')
                                ->get();
            $datas=array();
            foreach ($tanpakategoris as $key => $tanpakategori){
                $subdata=[];
                $subdata['id']=$tanpakategori->id;
                $subdata['namakategorimenu']=$tanpakategori->namakategorimenu;
                $subdata['icon']=$tanpakategori->icon;
                    $pages=kategorimenu::leftJoin('kategori_permission','kategori_permission.kategori_id','=','kategorimenu.id')
                                        ->leftJoin('permissions','kategori_permission.permission_id','=','permissions.id')
                                        ->whereIn('kategori_permission.permission_id',$permission)
                                        ->where('kategorimenu.id','=',$tanpakategori->id)
                                        // ->groupBy('kategori_permission.kategori_id')
                                        // ->distinct()
                                        ->select('permissions.id','permissions.display_name','permissions.urlindex')
                                        ->get();;
                $subdata['page']=[];
                    foreach ($pages as $key=>$page){
                        $detaildata=[];
                        $detaildata['id']=$page->id;
                        $detaildata['display_name']=$page->display_name;
                        $detaildata['urlindex']=$page->urlindex;

                        array_push($subdata['page'],$detaildata);
                    }
                array_push($datas,$subdata);
            }
            // dd($datas);
            $view->with('sidebars',$datas);
        }
    }
 
}