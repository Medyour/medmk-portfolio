<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactRequestReceived;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $contact = $request->safe()->only([
            'name',
            'email',
            'organization',
            'category',
            'message',
        ]);

        try {
            Mail::to(
                config('contact.recipient.address'),
                config('contact.recipient.name'),
            )->send(new ContactRequestReceived($contact));
        } catch (Throwable $exception) {
            report($exception);

            return redirect(route('home').'#contact')
                ->withInput($contact)
                ->with('contact_error', 'Votre demande n’a pas pu être envoyée pour le moment. Veuillez réessayer.');
        }

        return redirect(route('home').'#contact')
            ->with('contact_success', 'Votre demande a bien été envoyée. Merci pour votre message.');
    }
}
