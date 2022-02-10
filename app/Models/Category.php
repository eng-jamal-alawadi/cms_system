<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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



}
