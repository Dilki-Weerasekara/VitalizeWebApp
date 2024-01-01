<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;


class CreateGroup extends Component
{
    use WithFileUploads;
    public $name;
    public $location;
    public $type;
    public $icon;
    public $thumbnail;
    public $description;


    public function creategroup()
    {
        $this->validate([
            "name" => "required|string",
            "location" => "required|string",
            "type" => "required|string",
            "icon" => "required|image",
            "thumbnail" => "required|image",
            "description" => "required|string",
        ]);

        DB::beginTransaction();
        try {
            $group = Group::create([
                "uuid" => Str::uuid(),
                "user_id" => auth()->id(),
                "icon" => $this->icon->store("groups", "public"),
                "thumbnail" => $this->thumbnail->store("groups", "public"),
                "description" => $this->description,
                "name" => $this->name,
                "location" => $this->location,
                "type" => $this->type
            ]);
            GroupMember::create([
                "user_id" => auth()->id(),
                "group_id" => $group->id
            ]);

            // display the notifications in home page
            Notification::create([
                "type" => "create_group",
                "user_id" => auth()->id(),
                "message" => $group->name . " group has been created successfully.",
                "url" => route("group", $group->uuid),
            ]);

            $this->dispatch('alert', [
                "type" => "success", "message" =>  $group->name . " group  has been created successfully."
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return to_route("group", $group->uuid);
    }
    public function render()
    {
        return view('livewire.create-group')->extends("layouts.app");
    }
}
