<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Bubalubs\Gravity\Page;

class UsersController extends Controller
{
    private $userModel;

    function __construct() {
        $this->userModel = config('auth.providers.users.model');
    }

    public function manage()
    {
        $users = $this->userModel::all();

        return view('gravity::manage-users')->with(compact(
            'users'
        ));
    }

    public function edit(int $id)
    {
        $user = $this->userModel::findOrFail($id);

        return view('gravity::edit-user')->with(compact(
            'user'
        ));
    }

    public function update(int $id, Request $request)
    {
        $user = $this->userModel::findOrFail($id);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($request->access_admin) {
            $user->givePermissionTo('access_admin');
        } else {
            $user->revokePermissionTo('access_admin');
        }

        if ($request->edit_entities_in_admin) {
            $user->givePermissionTo('edit_entities_in_admin');
        } else {
            $user->revokePermissionTo('edit_entities_in_admin');
        }

        if ($request->edit_page_content_in_admin) {
            $user->givePermissionTo('edit_page_content_in_admin');
        } else {
            $user->revokePermissionTo('edit_page_content_in_admin');
        }

        if ($request->edit_global_content_in_admin) {
            $user->givePermissionTo('edit_global_content_in_admin');
        } else {
            $user->revokePermissionTo('edit_global_content_in_admin');
        }

        if ($request->manage_users_in_admin) {
            $user->givePermissionTo('manage_users_in_admin');
        } else {
            $user->revokePermissionTo('manage_users_in_admin');
        }

        if ($request->use_tools_in_admin) {
            $user->givePermissionTo('use_tools_in_admin');
        } else {
            $user->revokePermissionTo('use_tools_in_admin');
        }

        return redirect('/admin/users/' . $id)->with('success', 'Successfully updated user');
    }
}
