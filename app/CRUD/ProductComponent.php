<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use App\Models\Product;

class ProductComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = true;

    public function getModel()
    {
        return Product::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['name', 'description', 'price', 'product_image', 'stock'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['name', 'description', 'price', 'product_image', 'stock'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            'name' => 'text', 'description' => 'ckeditor', 'price' => 'number', 'stock' => 'number', 'product_image' => 'file'
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [

            'name' => 'required', 'description' => 'required', 'price' => 'required', 'stock' => 'required', 'product_image' => 'required'
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [];
    }
}
