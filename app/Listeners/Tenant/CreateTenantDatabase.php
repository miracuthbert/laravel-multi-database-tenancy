<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use App\Events\Tenant\TenantWasCreated;
use App\Tenant\Database\DatabaseCreator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTenantDatabase
{
    /**
     * Instance of DatabaseCreator.
     *
     * @var DatabaseCreator
     */
    protected $databaseCreator;

    /**
     * Create the event listener.
     *
     * @param DatabaseCreator $databaseCreator
     */
    public function __construct(DatabaseCreator $databaseCreator)
    {
        $this->databaseCreator = $databaseCreator;
    }

    /**
     * Handle the event.
     *
     * @param  TenantWasCreated $event
     * @return void
     * @throws \Exception
     */
    public function handle(TenantWasCreated $event)
    {
        if (!$this->databaseCreator->create($event->tenant)) {
            throw  new \Exception("Database failed to be created.");
        }

//
//        try {
//            $this->databaseCreator->create($event->tenant);
//        } catch (\Exception $e) {
//            // do something here
//            // redirect to retry page
//
//            return redirect('/home')->withError($e->getMessage());
//        }

        event(new TenantDatabaseCreated($event->tenant));
    }
}
