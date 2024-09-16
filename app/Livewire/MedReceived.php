<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class MedReceived extends Component
{
    public $lists = [];
    public $selected = [];
    public $medLists = [
        ['id' => 1, 'name' => 'Ecoxib'],
        ['id' => 2, 'name' => 'Celecoxib'],
        ['id' => 3, 'name' => 'Parecoxib'],
        ['id' => 4, 'name' => 'Diclofenac'],
        ['id' => 5, 'name' => 'Ibuprofen'],
        ['id' => 6, 'name' => 'Naproxen'],
        ['id' => 7, 'name' => 'Meloxicam'],
        ['id' => 8, 'name' => 'Piroxicam'],
        ['id' => 9, 'name' => 'Aceclofenac'],
    ];
    public $name = '';
    public function render()
    {
        $medReceived = Session::get('medReceived');
        if(empty($medReceived)) {
            $medReceived = [];
        }
        $this->selected = $medReceived;
        return view('livewire.med-received', ['lists' => $this->lists , 'selected' => $this->selected]);
    }
    public function search()
    {
        $this->lists = [];
        $input = $this->name;
        if (!empty($input)) {
            $this->lists = array_filter($this->medLists, function ($item) use ($input) {
                return strpos(strtolower($item['name']), strtolower($input)) !== false;
            });
        }

        // rebind component to reflect changes
        // $this->name = '';
    }
    public function clear()
    {
        $this->lists = [];
    }
    public function add($id)
    {

        $oldSelected = $this->selected;

        $newSelected = array_filter($this->medLists, function ($item) use ($id) {
            // if $id is in the oldSelected list, return false
            if(!in_array($item, $this->selected)) {
                return strpos(strtolower($item['id']), strtolower($id)) !== false;
            }
        });



        $this->selected = array_merge($oldSelected, $newSelected);

        // dd(array_merge($oldSelected, $newSelected));
        Session::put('medReceived', $this->selected);

        $this->clear();
    }
    public function remove($id)
    {
        $this->selected = array_filter($this->selected, function ($item) use ($id) {
            return strpos(strtolower($item['id']), strtolower($id)) === false;
        });
        Session::put('medReceived', $this->selected);

    }
}
