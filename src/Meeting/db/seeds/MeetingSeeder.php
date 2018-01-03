<?php

use Phinx\Seed\AbstractSeed;

class MeetingSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 100; ++$i) {
            $date = $faker->unixTime('now');
            $data[] = [
                'name' => $faker->catchPhrase,
                'slug' => $faker->slug
            ];
        }
        $this->table('meeting')
            ->insert($data)
            ->save();
    }
}
