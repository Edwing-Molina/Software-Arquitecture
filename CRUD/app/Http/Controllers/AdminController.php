<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

use function Pest\Laravel\get;

class AdminController extends Controller
{
    
    public function index()
    {
        
        return view('admin.dashboard');
    }

    public function settings()
    {
        
        return view('admin.settings',);
    }


    public function updateSettings(Request $request)
    {
        $request->validate([
            'opening_time' => 'required',
            'closing_time' => 'required',
            'is_store_open' => 'required|boolean',
        ]);

        $openingTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('opening_time'));
        $closingTime = \Carbon\Carbon::createFromFormat('H:i', $request->input('closing_time'));

        if ($closingTime->lessThan($openingTime)) {
            $closingTime->addDay();
        }

        $settings = Settings::first();
        if (!$settings) {
            $settings = new Settings();
        }

        $settings->opening_time = $openingTime->format('H:i');
        $settings->closing_time = $closingTime->format('H:i');
        $settings->is_store_open = $request->input('is_store_open');
        $settings->save();

        return redirect()->back()->with('status', '¡Cambios guardados correctamente!');
    }

    public function getSettings()
    {
        
        $settings = Settings::first() ?? new Settings(); 

        return  view('admin.settings', compact('settings'));
    }
}
