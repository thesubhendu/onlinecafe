<?php

namespace App\Console\Commands;

use App\Models\ProductCategory;
use Database\Seeders\AllProductSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class UpdateAllProductTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:all-product-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update All products table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        ProductCategory::updateOrCreate(['name' => 'Tea'], ['slug' => 'tea']);
        DB::table('all_products')->truncate();
        Artisan::call('db:seed', ['class' => AllProductSeeder::class]);

        $this->info('"All products table successfully updated');
    }
}
