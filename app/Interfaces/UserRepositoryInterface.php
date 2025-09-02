<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Ambil semua data user
     */
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );

    /**
     * Ambil semua data user dengan paginasi
     */
    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    );

    /**
     * Ambil data user berdasarkan ID
     */
    public function getById(
        string $id
    );

    /**
     * Buat data user baru
     */
    public function create(
        array $data
    );

    /**
     * Update data user
     */
    public function update(
        string $id,
        array $data
    );

    /**
     * Hapus data user
     */
    public function delete(
        string $id
    );
}
