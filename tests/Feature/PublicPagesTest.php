<?php

use Livewire\Volt\Volt;

it('can view the welcome page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Inventory Intelligence')
        ->assertSee('Kinetic Hub');
});

it('can view the contact page', function () {
    $this->get(route('contact.us'))
        ->assertOk()
        ->assertSee('Let\'s talk about')
        ->assertSee('your growth.');
});

it('can submit the contact form', function () {
    Volt::test('pages.⚡contact-us')
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('subject', 'Inquiry')
        ->set('message', 'Hello, I would like to know more.')
        ->call('submit')
        ->assertSet('sent', true)
        ->assertSee('Message Sent!');
});

it('validates contact form fields', function () {
    Volt::test('pages.⚡contact-us')
        ->set('name', '')
        ->set('email', 'not-an-email')
        ->call('submit')
        ->assertHasErrors(['name' => 'required', 'email' => 'email']);
});
