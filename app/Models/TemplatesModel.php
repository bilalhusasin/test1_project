<?php namespace App\Models;
 
use App\Models\BaseModel;
 
class TemplatesModel extends BaseModel
{
    protected $table = 'templates';
    protected $allowedFields = [
        'name',
        'file'
    ];
}