<?php

namespace Friparia\RestModel;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    protected $signature = "admin:setup";

    protected $description = "set up admin with role based access control";

    public function handle(){
        $migrate = new Migrate("Friparia\\Admin\\Models\\User");
        $migrate->migrate();
        $migrate = new Migrate("Friparia\\Admin\\Models\\Role");
        $migrate->migrate();
        $migrate = new Migrate("Friparia\\Admin\\Models\\Permission");
        $migrate->migrate();
        $this->line("create success!");

    }

}
