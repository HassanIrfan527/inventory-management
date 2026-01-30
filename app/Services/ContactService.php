<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function listContacts(?string $search = null, string $sortBy = 'name', int $perPage = 15): LengthAwarePaginator
    {
        return Contact::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', '%'.$search.'%')
                        ->orWhere('last_name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            })
            ->when($sortBy === 'name', fn ($query) => $query->orderBy('first_name')->orderBy('last_name'))
            ->when($sortBy === 'created_at', fn ($query) => $query->latest())
            ->when($sortBy === 'updated_at', fn ($query) => $query->latest('updated_at'))
            ->paginate($perPage);
    }

    public function createContact(array $data): Contact
    {
        return DB::transaction(function () use ($data): Contact {
            $contact = Contact::create($data);

            $contact->logActivity('Contact created');

            return $contact;
        });
    }

    public function updateContact(Contact $contact, array $data): Contact
    {
        return DB::transaction(function () use ($contact, $data): Contact {
            $contact->update($data);

            $contact->logActivity('Contact updated');

            return $contact;
        });
    }

    public function deleteContact(Contact $contact): void
    {
        $contact->delete();
    }
}
