<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-note', function (?User $user, Note $note) {
            if ($note->public === 1) {
                return true;
            }

            if (!$user) {
                return false;
            }

            if ($user->id === $note->user_id) {
                return true;
            }

            $noteCheck = Note::query()
                ->select(['id'])
                ->where('id', $note->id)
                ->whereHas('shares', function (Builder $query) use ($user) {
                    $query->where('user_id', '=', $user->id);
                })
                ->first();

            if ($noteCheck) {
                return true;
            }

            return false;
        });
    }
}
