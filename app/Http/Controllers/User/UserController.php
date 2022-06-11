<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('first_name', 'LIKE', "%{$value}%")
                    ->orWhere('last_name', 'LIKE', "%{$value}%")
                    ->orWhere('email', 'LIKE', "%{$value}%");
            });
        });

        $users = QueryBuilder::for(User::class)
            ->defaultSort('first_name')
            ->allowedSorts(['first_name','last_name', 'email'])
            ->allowedFilters(['first_name','last_name', 'email', $globalSearch])
            ->paginate(5)
            ->withQueryString();

        return inertia('User/Index',[
            'page_users' => $users
        ])->table(function (InertiaTable $table) {
            $table->addSearchRows([
                'first_name' => 'Ad',
                'last_name' => 'Soyad',
                'email' => 'E-Posta Adres',
            ])->addFilter('last_name', 'Soyad', [
                'ok' => 'Ok',
                'nl' => 'Nederlands',
            ])->addColumns([
                'email' => 'E-Posta Adres',
                'last_name' => 'Soyad',
            ]);
        });
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
