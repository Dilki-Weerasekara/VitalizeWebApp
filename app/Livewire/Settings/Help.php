<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Faq;

class Help extends Component
{
    public $paginate_no = 9;
    public $search;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }
    public function render()
    {
         // Return the view for the help or FAQ section.
        return view('livewire.settings.help', [
            // Fetch FAQ data from the 'Faq' model.
            // Filter FAQs based on a search term entered by the user, applying it to the 'question' field.
            // Sort the results by the latest entries and paginate them based on a specified number.
            "data" => Faq::where("question", "LIKE", "%" . $this->search . "%")->latest()->paginate($this->paginate_no)
        ])->extends("layouts.app");
    }
}
