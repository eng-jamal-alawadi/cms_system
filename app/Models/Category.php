<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded =[];
    //Append attribute
    //public function get______Attribute(){}
        protected $appends =['status'];

        public function getStatusAttribute(){

            return $this->active ? "Active" : "Disabled";
        }
    //append attribute
    //public function getStatusAttribute(){} --> this is the general format for an appends attributes

        public function user(){
            return $this->belongsTo(User::class);
        }

        public function admin(){
            return $this->belongsTo(Admin::class);
        }

        public function tasks(){
            return $this->hasMany(Task::class);
        }

}
