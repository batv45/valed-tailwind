<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'post');
    }

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
            ->allowedSorts(['first_name','last_name', 'email'])
            ->allowedFilters(['first_name','last_name', 'email', $globalSearch])
            ->paginate()
            ->withQueryString();

        return inertia('User/Index',[
            'page_users' => $users
        ])->table(function (InertiaTable $table) {
            $table->addSearchRows([
                'first_name' => 'Ad',
                'last_name' => 'Soyad',
                'email' => 'E-Posta Adres',
            ]);
        });
    }

    public function create()
    {
        return inertia('User/Create');
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
        ]);

        flash('Yeni kullanıcı oluşturuldu.')->success();

        return redirect()->route('user.show',$user->id);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);


        return inertia('User/Show', [
            'page_user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return inertia('User/Edit', [
            'page_user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->fill($request->validated());
        if($user->isDirty()){
            $user->save();
            flash('Kullanıcı bilgisi güncellendi.')->success();
        }
        return redirect()->route('user.show', $user->id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
//        $user->delete();

        flash('Kullanıcı hesabı silindi.')->success();
        return redirect()->route('user.index');
    }
}
