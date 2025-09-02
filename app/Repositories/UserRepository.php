<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = User::where(function ($query) use ($search) {

            // jika ada parameter search dia akan melakukan pencarian yang kita definisikan di model user
            if ($search) {
                $query->search($search);
            }
        });

        // jika ada parameter limit dia akan membatasi jumlah data yang diambil
        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    ) {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = User::where('id', $id);
        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();

        try {
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();

        try {
            $user = User::find($id);
            $user->name = $data['name'];
            if (isset($data['password'])) {
                $user->password = bcrypt($data['password']);
            }

            $user->save();

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        } 
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();

        try {
            $user = User::find($id);
            $user->delete();

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}