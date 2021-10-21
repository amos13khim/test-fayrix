@extends('layouts.app')
@section('title') All Products @endsection
@section('content')

    По фильтрам (страна производства, производитель, категория, цена..) вывести список товаров.
    <form method="post" action="">
        @csrf
        <label for="manufacturer_country">
            <span>Manufacturer Country</span>
            <select name="manufacturer_country" id="manufacturer_country">
                <option value="0">---Choose---</option>
                <option value="South Korea">South Korea</option>
                <option value="USA">USA</option>
                <option value="China">China</option>
            </select>
        </label>
        <br>
        <label for="manufacturer_id">
            <span>Manufacturer Name</span>
            <select name="manufacturer_id" id="manufacturer_id">
                <option value="0">---Choose---</option>
                <option value="1">Samsung</option>
                <option value="2">Apple</option>
                <option value="3">Xiaomi</option>
            </select>
        </label>
        <br>
        <label for="category_id">
            <span>Category</span>
            <select name="category_id" id="category_id">
                <option value="0">---Choose---</option>
                <option value="1">Phone</option>
                <option value="2">Tablet</option>
            </select>
        </label>
        <br>
        <input type="number" name="release_year" min="0" placeholder="Release year">
        <br>
        <input type="number" name="price_range_min" min="0" placeholder="Minimum Price">
        <br>
        <input type="number" name="price_range_max" min="0" placeholder="Maximum Price">
        <br>
        <input type="submit" name="filter_products" value="Filter!">
    </form>


    <h1>This is the Products page.</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Manufacturer</th>
            <th>Category</th>
            <th>Price</th>
            <th>Release Year</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->manufacturer_name}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->release_year}}</td>
                <td><a href="/product/{{$product->id}}">View Product</a></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Manufacturer</th>
            <th>Category</th>
            <th>Price</th>
            <th>Release Year</th>
            <th></th>
        </tr>
        </tfoot>
    </table>
@endsection
