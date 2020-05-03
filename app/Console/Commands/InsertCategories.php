<?php

namespace App\Console\Commands;

use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class InsertCategories extends Command
{
    private $categories;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert predefined categories to corresponding DB table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->categories = [
            'Category 1',
            'Category 2',
            'Category 3'
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($this->categories as $category) {
            Category::create(
                [
                    'name' => $category,
                ]
            );
        }
    }
}
