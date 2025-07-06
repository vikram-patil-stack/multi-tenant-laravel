<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class RegisterTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new tenant';

    /**
     * Execute the console command.
     */
    protected $tenantModel;
    public function __construct()
    {
        parent::__construct();
        $this->tenantModel = new Tenant();
    }

    public function handle()
    {

        $domain = $this->ask('Enter the domain name for the tenant');

        if (!$this->is_valid_domain_name($domain)) {
            $this->error('Invalid domain name format. Please try again.');
            return;
        }
        // Check if the tenant already exists
        if ($this->tenantModel->isDomainExists($domain)) {
            $this->error('Domain is already registered. Please try with different domain name.');
            return;
        }

        $isCreated = $this->tenantModel->create($domain);
        if ($isCreated) {
            $this->info('Tenant registered successfully with domain: ' . $domain);
        } else {
            $this->error('Failed to register tenant. Please try again.');
        }

    }

    function is_valid_domain_name($domainName)
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domainName) //valid chars check
                && preg_match("/^.{1,253}$/", $domainName) //overall length check
                && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domainName)   ); //length of each label
    }

}
