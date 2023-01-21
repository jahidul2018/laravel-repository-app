<?php
namespace App\Repositories\Interfaces;

Interface CategoryRepositoryInterface{
    
    public function allCategories();
    public function storeCategory($data);
    public function findCategory($id);
    public function updateCategory($data, $id); 
    public function destroyCategory($id);
}