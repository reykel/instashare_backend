<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Tenants\PersistTenantEvent;
use App\Listeners\Tenants\MailTenantEvent;
use App\Listeners\Users\PersistUserInvitationEvent;
use App\Listeners\Users\PersistUserInvitationAceptedEvent;
use App\Listeners\Users\MailUserInvitationEvent;
use App\Listeners\Ofertas\MailOfertaLinkEvent;
use App\Listeners\Ofertas\MailAceptanceLinkEvent;
use App\Listeners\Users\MailUserInvitationAceptedEvent;
use App\Listeners\Users\PersistMemberInvitationAceptedEvent;
use App\Listeners\Users\MailMemberInvitationAceptedEvent;
use App\Listeners\Users\PersistMemberEmailVerifiedEvent;
//use App\Listeners\Users\MailMemberEmailVerifiedEvent;
use App\Listeners\Users\PersistUserEmailVerifiedEvent;  
use App\Listeners\Users\MailUserEmailVerifiedEvent;
use App\Listeners\Users\UserEmailVerifiedEvent;
use App\Listeners\Users\PersistOfferSendedEvent;
use App\Listeners\Users\PersistOfferAceptedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewUserAdded;
use App\Events\NewUserInvited;
use App\Events\UserInvitationAcepted;
use App\Events\MemberInvitationAcepted;
use App\Events\MemberEmailVerified;
use App\Events\UserEmailVerified;
use App\Events\OfertaEnviada;
use App\Events\OfertaAceptada;

//use App\Events\OwnEmailVerified;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserAdded::class => [
            PersistTenantEvent::class,
            MailTenantEvent::class,
        ],
        NewUserInvited::class => [
            PersistUserInvitationEvent::class,
            MailUserInvitationEvent::class,         
        ],
        UserInvitationAcepted::class => [
            PersistUserInvitationAceptedEvent::class,       
            MailUserInvitationAceptedEvent::class,
            UserEmailVerifiedEvent::class,
        ],
        MemberInvitationAcepted::class => [
            PersistMemberInvitationAceptedEvent::class,       
            MailMemberInvitationAceptedEvent::class,
        ],
        MemberEmailVerified::class => [
            PersistMemberEmailVerifiedEvent::class,       
            //MailMemberEmailVerifiedEvent::class,
        ],
        UserEmailVerified::class => [
            PersistUserEmailVerifiedEvent::class,       
            MailUserEmailVerifiedEvent::class,

        ],
        OfertaEnviada::class => [
            PersistOfferSendedEvent::class,
            MailOfertaLinkEvent::class,
        ],
        OfertaAceptada::class => [
            PersistOfferAceptedEvent::class,
            MailAceptanceLinkEvent::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
