<?php

use Phinx\Seed\AbstractSeed;

class Init extends AbstractSeed
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
                    'apps_id' => 1,
                    'priorities_id' => 1,
                    'entity_namespace' => 'Kanvas\Content\Contracts\ContentInterface',
                    'name' => 'Content',
                    'description' => 'Any Content type entity',
                    'created_at' => date('Y-m-d H:i:s'),
                ], [
                    'apps_id' => 1,
                    'priorities_id' => 1,
                    'entity_namespace' => 'Kanvas\Content\Contracts\CommentInterface',
                    'name' => 'Comments',
                    'description' => 'Any Comment type entity',
                    'created_at' => date('Y-m-d H:i:s'),
                ],

            ])
            ->saveData();

        $this->table('reports_status')
            ->insert([
                [
                    'id' => 1,
                    'apps_id' => 0,
                    'name' => 'Pending',
                    'description' => 'New Reports',
                    'created_at' => date('Y-m-d H:i:s'),
                ], [
                    'id' => 2,
                    'apps_id' => 0,
                    'name' => 'Review',
                    'description' => 'New been reviewed',
                    'created_at' => date('Y-m-d H:i:s'),
                ], [
                    'id' => 3,
                    'apps_id' => 0,
                    'name' => 'Solved',
                    'description' => 'Report resolved',
                    'created_at' => date('Y-m-d H:i:s'),
                ],

            ])
            ->saveData();

        $this->table('reports_priorities')
            ->insert([
                [
                    'id' => 1,
                    'name' => 'Normal',
                    'weight' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                ], [
                    'id' => 2,
                    'name' => 'High',
                    'weight' => 50,
                    'created_at' => date('Y-m-d H:i:s'),
                ], [
                    'id' => 3,
                    'name' => 'Emergency',
                    'weight' => 100,
                    'created_at' => date('Y-m-d H:i:s'),
                ],

            ])
            ->saveData();
    }
}
