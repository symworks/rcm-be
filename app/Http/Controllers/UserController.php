<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = 15;
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $results = [];

        $queryBuilder = DB::table('users');
        if ($request->has('fields')) {
            $queryBuilder = $queryBuilder->select($request->fields);
        } else {
            $queryBuilder = $queryBuilder->select('*');
        }

        if ($request->has('match_col') && $request->has('match_key')) {
            $queryBuilder = $queryBuilder->where($request->match_col, $request->match_key);
        }

        if ($request->has('find_col') && $request->has('find_key')) {
            $queryBuilder = $queryBuilder->where($request->find_col, 'like', '%'.$request->find_key.'%');
        }

        if ($request->has('order_col') && $request->has('order_key')) {
            $queryBuilder = $queryBuilder->orderBy($request->order_col, $request->order_key);
        }

        if (!$request->has('use_paginate') || $request->use_paginate == 'true') {
            $results = $queryBuilder->paginate($perPage);
        } else {
            $results = $queryBuilder->get();
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $results,
        ];
    }

    public function selfUser(Request $request)
    {
        if (!request()->user()) {
            return [
                'error_code' => 400,
                'msg' => 'Not login yet',
            ];
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $request->user(),
        ];
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->anonymous_user = false;
        $user->status = User::STATUS_NEED_EMAIL_VERIFICATION;
        $user->avatar = "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200";
        $user->created_by_id = $request->user()->id;
        $user->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $user->id,
            ]
        ];
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'name' => ['required','string','max:255'],
                'avatar' => ['required', 'string', 'max:255'],
            ]
        );

        if ($request->user()->id != $request->id) {
            $user = User::find($request->id);
            if (!$user) {
                return [
                    'error_code' => 400,
                    'msg' => 'User not exist',
                ];
            }

            $currentRoles = $request->user()->roles;
            $targetRoles = $user->roles;

            if (!User::hasRole($currentRoles, "SupperUser") && User::hasRole($currentRoles, "Admin")) {
                if (User::hasRole($targetRoles, "SupperUser") || User::hasRole($targetRoles, "Admin")) {
                    return [
                        'error_code' => 200,
                        'msg' => 'Permission denied',
                    ];
                }
            }
        }

        $affected = User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'updated_by_id' => $request->user()->id,
        ]);

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'updatedCount' => $affected
                ]
            ]
        );
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'password' => ['required', 'string', 'max:255'],
            'confirmation_password' => ['required', 'string', 'max:255'],
        ]);

        if ($request->password != $request->confirmation_password) {
            return [
                'error_code' => 400,
                'msg' => 'Confirmation password not match',
            ];
        }

        if ($request->user()->id != $request->id) {
            $user = User::find($request->id);
            if (!$user) {
                return [
                    'error_code' => 400,
                    'msg' => 'User not exist',
                ];
            }

            $currentRoles = $request->user()->roles;
            $targetRoles = $user->roles;

            if (!User::hasRole($currentRoles, "SupperUser") && User::hasRole($currentRoles, "Admin")) {
                if (User::hasRole($targetRoles, "SupperUser") || User::hasRole($targetRoles, "Admin")) {
                    return [
                        'error_code' => 200,
                        'msg' => 'Permission denied',
                    ];
                }
            }
        }

        
        $affected = User::where('id', $request->id)
        ->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'updatedCount' => $affected
                ]
            ]
        );
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->id == $id) {
            return [
                'error_code' => 400,
                'msg' => 'Cannot delete your own account',
            ];
        }

        $user = User::find($id);
        if (!$user) {
            return [
                'error_code' => 400,
                'msg' => 'User not found',
            ];
        }

        $targetRoles = $user->roles;
        $currentRoles = $request->user()->roles;

        if (!User::hasRole($currentRoles, "SupperUser") && User::hasRole($currentRoles, "Admin")) {
            if (User::hasRole($targetRoles, "SupperUser") || User::hasRole($targetRoles, "Admin")) {
                return [
                    'error_code' => 200,
                    'msg' => 'Permission denied',
                ];
            }
        }


        $affected = $user->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
