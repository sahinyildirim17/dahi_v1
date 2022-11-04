<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Permission;
use App\Models\Backend\PermissionCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        // Tüm kontrolcülerde yetki kontrolü construct metodunda yapılacak
        // Gerekirse resource kontrolcülerinde metodun içinde de kontrol edilebilir.
        $this->middleware(['permission:panel']); // Backend altındaki tüm kontrolcülerde mecburi olarak bulunacak.
        //$this->middleware(['permission:beta_tester']);
    }

    public function index(){

        return view("backend.dashboard.index");
    }
}
