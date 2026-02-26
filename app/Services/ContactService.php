<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function listContacts(?string $search = null, string $sortBy = 'name', int $perPage = 15): LengthAwarePaginator
    {
        return Contact::query()
            ->search($search)
            ->sortBy($sortBy)
            ->paginate($perPage);
    }

    public function createContact(array $data): Contact
    {
        return DB::transaction(function () use ($data): Contact {
            $contact = Contact::create($data);

            $contact->logActivity('Contact created');

            $this->clearAllCache();

            return $contact;
        });
    }

    public function updateContact(Contact $contact, array $data): Contact
    {
        return DB::transaction(function () use ($contact, $data): Contact {
            $contact->update($data);

            $contact->logActivity('Contact updated');

            $this->clearAllCache();

            return $contact;
        });
    }

    public function deleteContact(Contact $contact): void
    {
        $contact->delete();
        $this->clearAllCache();
    }

    public function clearAllCache(): void
    {
        Cache::forget('contacts:all:'.auth()->id());
        $this->dashboardService->clearCache(auth()->id());
    }

    public function getContactActivity(Contact $contact)
    {
        return $contact->activities()->with('subject')->latest()->get();
    }
}
