<?php

namespace Bubalubs\Gravity\Commands;

use Illuminate\Console\Command;

class SetUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gravity:set-admin {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give a user all laravel gravity admin permissions';

    private $userModel;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->userModel = config('auth.providers.users.model');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->userModel::where('email', $this->argument('user'))->firstOrFail();
        
        $user->givePermissionTo('access_admin');
        $user->givePermissionTo('edit_entities_in_admin');
        $user->givePermissionTo('edit_page_content_in_admin');
        $user->givePermissionTo('edit_global_content_in_admin');
        $user->givePermissionTo('manage_users_in_admin');
        $user->givePermissionTo('use_tools_in_admin');

        $this->info('Successfully given all admin roles to user: ' . $user->email);
    }
}
