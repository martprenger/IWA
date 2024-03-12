<?php
 
namespace App\Http\Controllers;
 
use Illuminate\View\View;
 
class previewController extends Controller
{
    public function show(): View
    {
        return view('preview');
    }
}