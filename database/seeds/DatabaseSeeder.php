<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        // Model::unguard(); 5.1v 이하
        // 모든 데이터를 삭제하고 auto-incrementing ID를 0으로 초기화

        App\Tag::truncate();
        DB::table('article_tag')->truncate();
        $tags = config('project.tags');

        foreach($tags as $slug => $name) {
            App\Tag::create([
                'name' => $name,
                'slug' => Str::slug($slug)
            ]);
        }
        $this->command->info('Seeded: tags table');

        // App\User::truncate();
        /* User */
        $this->call(UsersTableSeeder::class);

        // App\Article::truncate();
        /* Article */
        $this->call(ArticlesTableSeeder::class);

        // Model::reguard(); 5.1v 이하

        /* 변수 선언 */
        $faker = app(Faker\Generator::class);
        $users = App\User::all();
        $articles = App\Article::all();
        $tags = App\Tag::all();

        /* 아티클과 태그 연결 */
       foreach($articles as $article) {
           $article->tags()->sync(
                $faker->randomElements(
                    $tags->pluck('id')->toArray(), rand(1, 3)
                )
           );
       }
       $this->command->info('Seeded: article_tag table');

        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
