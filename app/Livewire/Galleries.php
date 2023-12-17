<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Galleries extends Component
{
    public function render()
    {
        $galleries = Gallery::orderBy('seq-no', 'asc')->get();
        // $galleries = DB::table('galleries')->orderBy('seq-no', 'asc')->toSql();
        // dd($galleries);
        
        return view('livewire.galleries', [
            'galleries' => $galleries
        ]);
    }
}
