<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    //SELECT products.name, product_categories.name, manufacturers.name, manufacturers.country, products.price,
    // products.release_year FROM products
    // INNER JOIN product_categories
    // ON product_categories.id = products.category_id INNER JOIN manufacturers
    // ON manufacturers.id = products.manufacturer_id
    // WHERE products.release_year = 2021 AND products.price BETWEEN 0 AND 1000;
    // AND products.manufacturer_id = 1
    // AND products.category_id = 1
    // AND manufacturers.country = "South Korea"

    public function getAll() {
        $manufacturer = new Manufacturer();
        $product_category = new ProductCategory();
        $manufacturers = $manufacturer->getTable();
        $product_categories = $product_category->getTable();

        $query = self::query()
            ->join($manufacturers, $manufacturers.'.id', '=', $this->table . '.manufacturer_id')
            ->join($product_categories, $product_categories.'.id', '=', $this->table . '.category_id')
            ->select(
                $this->table.'.id',
                $this->table . '.price',
                $this->table . '.name as product_name',
                $manufacturers.'.name as manufacturer_name',
                $manufacturers . '.country',
                $product_categories . '.name as category_name',
                $this->table.'.release_year'
            );

        return $query->get();
    }

    public function filter($data)
    {
        $manufacturer = new Manufacturer();
        $product_category = new ProductCategory();
        $manufacturers = $manufacturer->getTable();
        $product_categories = $product_category->getTable();
        $query = self::query()
            ->join($manufacturers, $manufacturers.'.id', '=', $this->table . '.manufacturer_id')
            ->join($product_categories, $product_categories.'.id', '=', $this->table . '.category_id')
            ->select(
                $this->table.'.id',
                $this->table . '.price',
                $this->table . '.name as product_name',
                $manufacturers.'.name as manufacturer_name',
                $manufacturers . '.country',
                $product_categories . '.name as category_name',
                $this->table.'.release_year'
            );
        if( $data['manufacturer_country'] !== "0" ) {
            $query->where($manufacturers . '.country' , $data['manufacturer_country']);
        }
        if( $data['manufacturer_id'] !== "0" ) {
            $query->where($manufacturers . '.id', '=', $data['manufacturer_id']);
        }
        if( $data['category_id'] !== "0" ) {
            $query->where($product_categories.'.id', '=', $data['category_id']);
        }
        if( $data['release_year'] != null ) {
            $query->where($this->table.'.release_year', '=', $data['release_year']);
        }
        if( $data['price_range_min'] != null ) {
            $query->where($this->table.'.price', '>=', $data['price_range_min']);
        }
        if( $data['price_range_max'] != null ) {
            $query->where($this->table.'.price', '<=', $data['price_range_max']);
        }
        return $query->get();

    }
}
