<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads; // Include file upload capabilities provided by Livewire.

class AccountInformation extends Component
{
    use WithFileUploads;
     // Public properties for user account details.
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $mobile;
    public $address;
    public $country;
    public $profile;
    public $thumbnail;
    public $description;

     // Initialize the component with the authenticated user's information.
    public function mount()
    {
        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->mobile = auth()->user()->mobile;
        $this->address = auth()->user()->address;
        $this->country = auth()->user()->location;
        $this->description = auth()->user()->description;
    }

     // Function to handle profile updates.
    public function updateProfile()
    {
        // Validate input fields to ensure data integrity
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'profile' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        // Update the authenticated user's details with the provided information.
        $user = User::find(auth()->id());
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->address = $this->address;
        $user->location = $this->country;

         // Save profile and thumbnail images to the 'profiles' directory and make them public.
        $user->profile = $this->profile->store("profiles","public");
        $user->thumbnail = $this->thumbnail->store("profiles","public");
        $user->description = $this->description;
        $user->save();

           // Dispatch a browser event to show a success message after updating.
        $this->dispatch('alert', [
            "type" => "success", "message" =>  " Account Informaiton Updated successfully."
        ]);
         // Redirect to the account information settings page.
        return redirect()->route("settings");
    }

     // Render the view for the account information settings.
    public function render()
    {
        return view('livewire.settings.account-information')->extends("layouts.app");
    }
}
