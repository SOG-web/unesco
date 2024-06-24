<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Any model that has a user_id foreign key can use this policy
         * to determine if the authenticated user is the owner of the model.
         * This is useful for protecting routes that are only accessible
         * to the owner of a resource.
         * @return boolean
         */
        Gate::define('user-access', function (User $user, $model) {
            return $model->user->is($user);
        });

        /**
         * This policy is used to determine if the authenticated user is an admin.
         * @return boolean
         */
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin';
        });

        /**
         * This policy is used to determine if the authenticated user is a teacher.
         * @return boolean
         */
        Gate::define('teacher-access', function (User $user) {
            return $user->role === 'teacher';
        });

        /**
         * This policy is used to determine if the authenticated user is a students.
         * @return boolean
         */
        Gate::define('students-access', function (User $user) {
            return $user->role === 'students';
        });

        /**
         * This policy is used to determine if the authenticated user is an admin or a teacher.
         * @return boolean
         */
        Gate::define('teacher-or-admin-access', function (User $user) {
            return $user->role === 'teacher' || $user->role === 'admin';
        });

        Gate::define('teacher-or-student-access', function (User $user) {
            return $user->role === 'teacher' || $user->role === 'students';
        });
    }
}
