<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Cubet Techno Labs](https://cubettech.com)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[Many](https://www.many.co.uk)**
-   **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
-   **[DevSquad](https://devsquad.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[OP.GG](https://op.gg)**
-   **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
-   **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

## reference

## Laravel 9 Repository Design Pattern CRUD Example

## by larainfo.com and mishuk

## In this tutorial, we'll see how to use repository design pattern in laravel 9. We'll create a simple crud application using laravel 9 repository design pattern. If you're building a complex laravel application, then you should use repository design pattern and for small and low maintenance app, don't use repository design pattern.

## follow for more info

https://larainfo.com/blogs/laravel-9-repository-design-pattern-crud-example

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

##Step 1: Install Laravel & Connect Database

composer create-project laravel/laravel laravel-repository

## Now, you need to set up the Laravel app to connect to the database, thus open up.env and add the database credentials as given below.

in .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user_name
DB_PASSWORD=database_password

## Step 2: Create Category Modal Migration and Controller

php artisan make:model Category -m

## create_categories_table.php

public function up()
{
Schema::create('categories', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug');
$table->timestamps();
});
}

## Create Category Controller

php artisan make:controller CategoryController -r

app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

}

## Create routes web.PHP

Route::resource('categories', CategoryController::class);

## Step 3: Create the Repository and Interface Folder Structure

1. First you need to create Repositories Folder inside app

2. Then you need to create Interfaces Folder and add CategoryRepositoryInterface.php

3. Now Create CategoryRepository.php inside Repositories

## Step 4: Add CRUD Functionality Repository and Interface

Add CRUD Functions in CategoryRepositoryInterface.php Interface

App/Repositories/Interfaces/CategoryRepositoryInterface.php

<?php
namespace App\Repositories\Interfaces;

Interface CategoryRepositoryInterface{
    
    public function allCategories();
    public function storeCategory($data);
    public function findCategory($id);
    public function updateCategory($data, $id); 
    public function destroyCategory($id);
} 

Import CategoryRepositoryInterface inteface and Category class in CategoryRepository.php

App/Repositories/CategoryRepository.php

<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function allCategories()
    {
        return Category::latest()->paginate(10);
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::find($id);
    }

    public function updateCategory($data, $id)
    {
        $category = Category::where('id', $id)->first();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}

## Step 5: Bind Repository In App Service Provider 


Next, you need to add to bind CategoryRepositoryInterface and CategoryRepository in app/Providers/AppServiceProvider.php

app/Providers/AppServiceProvider.php

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

## Step 6: Add Repository Design Pattern In CategoryController  

Add CategoryRepositoryInterface in CategoryController 

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  $this->categoryRepository->allCategories();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $this->categoryRepository->storeCategory($data);

        return redirect()->route('categories.index')->with('message', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findCategory($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $this->categoryRepository->updateCategory($request->all(), $id);

        return redirect()->route('categories.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroyCategory($id);

        return redirect()->route('categories.index')->with('status', 'Category Delete Successfully');
    }
}

## Step 7: Create Blade View Files 

Now perform crud operations. 

resources/views/categories/create.blade.php 

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Category Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Category Name</span>
                                <input type="text" name="name"
                                    class="block w-full @error('name') border-red-500 @enderror mt-1 rounded-md"
                                    placeholder="" value="{{old('name')}}" />
                            </label>
                            @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Slug</span>
                                <input type="text" name="slug"
                                    class="block w-full @error('slug') border-red-500 @enderror mt-1 rounded-md"
                                    placeholder="" value="{{old('slug')}}" />
                            </label>
                            @error('slug')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

resources/views/categories/index.blade.php

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-1 mb-4">
                        <a class="px-2 py-2 text-sm text-white bg-blue-600 rounded"
                            href="{{ route('categories.create') }}">{{ __('Add Category') }}</a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Slug
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{$category->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$category->name}}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{$category->slug}}

                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="px-4 py-2 text-white bg-red-700 rounded"
                                                value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

https://larainfo.com/storage/canvas/images/OctxYnEIcw7bIYVd1hqyszraz8To5GEFHqGg3GNr.png

resources/views/categories/edit.blade.php

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Category Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('categories.update',$category->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Category Name</span>
                                <input type="text" name="name"
                                    class="block w-full @error('name') border-red-500 @enderror mt-1 rounded-md"
                                    placeholder="" value="{{old('name',$category->name)}}" />
                            </label>
                            @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Slug</span>
                                <input type="text" name="slug"
                                    class="block w-full @error('slug') border-red-500 @enderror mt-1 rounded-md"
                                    placeholder="" value="{{old('slug',$category->slug)}}" />
                            </label>
                            @error('slug')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

## Step 8: Run Laravel and vite server 

php artisan serve
//and next terminal
npm run dev 


## end 

## tags
 #Laravel9

## api repositories pattern for laravel server

https://blog.devgenius.io/laravel-api-repository-pattern-make-your-code-more-structured-the-simple-guide-5b770da766d7

https://medium.com/@shadi.hariri68/resource-summary-rest-api-with-laravel-using-repository-b7ffcbc8ef1
