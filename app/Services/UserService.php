<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\{Sponsor, Charity, Event};
use App\Enums\{ MorphType, UserRole };

class UserService
{
    /**
     * Get a user with id
     *
     * @param integer $userId
     * @return App\Models\User
     */
    public function user($userId)
    {
        return User::find($userId);
    }

    /**
     * Get all users belong to the sponsor
     *
     * @param integer $sponsorId
     * @return array
     */
    public function usersWithSponsorId($sponsorId)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin() || $user->canRead(MorphType::Sponsor, $sponsorId)) {
            return Sponsor::find($sponsorId)->users;
        }

        return [];
    }

    /**
     * Get all users
     *
     * @param string $search
     * @return array
     */
    public function users($search)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            if (isset($search)) {
                return User::search($search)->except(Auth::id());
            } else {
                return User::all()->except(Auth::id());
            }
        }

        return [];
    }

    /**
     * Create or update an user belongs to the sponsor
     *
     * @param array $data
     * @return App\Models\User
     */
    public function createOrUpdateUserUnderSponsor($data)
    {
        if (isset($data['user_id'])) {
            $user = User::find($data['user_id']);
            $user->sponsors()->updateExistingPivot($data['sponsor_id'], [
                'role' => $data['role']
            ]);

            return $user;
        } else {
            $sponsor = Sponsor::find($data['sponsor_id']);
            $names = explode(' ', $data['name'], 2);
            $firstname = $names[0];
            $lastname = !empty($names[1]) ? $names[1] : '';
            $user = $sponsor->users()->create([
                'name' => $data['name'],
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $data['email'],
                'password' => bcrypt(str_random(8))
            ]);

            return $user;
        }
    }

    /**
     * Create or Update an user
     *
     * @param array $data
     * @return App\Models\User
     */
    public function createOrUpdateUser($data)
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $names = explode(' ', $data['name'], 2);
            $firstname = $names[0];
            $lastname = !empty($names[1]) ? $names[1] : '';
            $values = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => bcrypt(str_random(8))
            ];
            if (isset($data['id'])) {
                $user = User::find($data['id']);
                if ($user->update($values)) {
                    return $user;
                }
            } else {
                $user = User::create($values);
                return $user;
            }
        }

        return null;
    }

    /**
     * Delete a user
     *
     * @param integer userId
     * @return boolean
     */
    public function deleteUser($userId)
    {
        if (Auth::user()->isSuperAdmin()) {
            $user = User::find($userId);
            $user->sponsors()->detach();
            $user->charities()->detach();
            $user->events()->detach();
            return $user->delete();
        }

        return false;
    }

    /**
     * get user relations data Sponsors, Charities, Events
     * or total Sponsors, Charities, Events, Users if user is admin
     *
     * @param integer userId
     * @return array
     */
    public function getDashboardAchievements($userId)
    {
        $user = User::find($userId);
        if ($user->isSuperAdmin()) {
            $totalSponsors = Sponsor::all();
            $totalCharities = Charity::all();
            $totalEvents = Event::all();
            $totalUsers = User::all()->except(Auth::id());

            return [
                'total_sponsors' => json_encode($totalSponsors),
                'total_charities' => json_encode($totalCharities),
                'total_events' => json_encode($totalEvents),
                'total_users' => json_encode($totalUsers)
            ];
        }
        $userSponsors = $user->sponsors;
        $userCharities = $user->charities;
        $userEvents = $user->events;

        return [
            'user_sponsors' => json_encode($userSponsors),
            'user_charities' => json_encode($userCharities),
            'user_events' => json_encode($userEvents)
        ];
    }
}
