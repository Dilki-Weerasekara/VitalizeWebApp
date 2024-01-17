<?php

namespace App\Livewire\Settings;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Password;


class PasswordUpdate extends Component
{
     // Public properties for storing user input.
    public $existing_password;
    public $password;
    public $password_confirmation;

     // Function to handle password update.
    public function save()
    {
        // Validate the input fields.
        $this->validate([
            "existing_password" => "required",
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

         // Retrieve the authenticated user or fail with an exception if not found.
        $user = User::findOrFail(auth()->id());

        // Check if the existing password entered by the user matches the current password.
        if (Hash::check($this->existing_password, $user->password)) {

            // Start a database transaction.
            DB::beginTransaction();
            try {

                // Update the user's password and save it to the database.
                $user->password = Hash::make($this->password);
                $user->save();

                 // Create a notification indicating a successful password update.
                Notification::create([
                    "type" => "password_update",
                    "user_id" => auth()->id(),
                    "url"=>"#",
                    "message" => "Your Password has been updated"
                ]);

                  // Dispatch a success message to the browser.
                $this->dispatch('alert-pw-update', [
                    // "type" => "success", "message" =>  "Your Password his been updated.."
                ]);
                unset($this->existing_password);
                unset($this->password);
                unset($this->password_confirmation);

                // Commit the transaction.
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        } else {
            // Dispatch an error message if the existing password doesn't match.
            return $this->dispatch('alert-pw-update-incorrect', [
                // "type" => "success", "message" =>  "Incorrect Existing Password"
            ]);
        }
    }
    public function render()
    {
        return view('livewire.settings.password-update')->extends("layouts.app");
    }
}
