<?php

use Phinx\Seed\AbstractSeed;

class Types extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $this->table('reports_types')
            ->insert([
                [
                    'id' => 1,
                    'apps_id' => 1,
                    'priorities_id' => 1,
                    'entity_namespace' => 'Kanvas\Moderation\Models\Reports',
                    'name' => 'Pending',
                    'description' => 'Report is pending',
                    'created_at' => date('Y-m-d H:i:s'),
                ],

            ])
            ->saveData();
    }
}
