<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\V1\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function __construct(protected ContactService $contactService) {}

    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = (int) $request->query('per_page', 15);
        $sortBy = $request->query('sort_by', 'name');

        $contacts = $this->contactService->listContacts($search, $sortBy, $perPage);

        return ContactResource::collection($contacts);
    }

    public function store(StoreContactRequest $request): ContactResource
    {
        $contact = $this->contactService->createContact($request->validated());

        return new ContactResource($contact);
    }

    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact): ContactResource
    {
        $updated = $this->contactService->updateContact($contact, $request->validated());

        return new ContactResource($updated);
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $this->contactService->deleteContact($contact);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
