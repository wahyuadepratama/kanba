<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;

class SliderController extends Controller
{
    public function index(){
      $images = Slider::all();
      return view('admin.kelola_slider')->with(compact('images'));
    }

    public function update(Request $request, $id){
        $request->validate([
          'file' => 'required|image'
        ]);
        
        $request->file('file')->move('img', $id);;
        return back()->with('success', 'Upload file berhasil!');
    }
}
