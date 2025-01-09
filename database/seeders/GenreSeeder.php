<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Absurdist Fiction',
            'Action and Adventure',
            'Adventure Fiction',
            'Alien Invasion',
            'Alternate History',
            'Alternate Universe',
            'Anthology',
            'Apocalyptic and Post-Apocalyptic Fiction',
            'Biography',
            'Bildungsroman',
            'Campus Novel',
            'Children\'s Literature',
            'Cli-Fi (Climate Fiction)',
            'Cozy Mystery',
            'Comedy',
            'Comedy of Manners',
            'Coming-of-Age',
            'Contemporary Fiction',
            'Contemporary Romance',
            'Crime and Mystery',
            'Cyberpunk',
            'Dark Fantasy',
            'Detective Fiction',
            'Drama',
            'Dystopian',
            'Ecofiction',
            'Epic',
            'Essay',
            'Experimental Literature',
            'Fable',
            'Fairy Tale',
            'Family Saga',
            'Fantasy',
            'Feminist Fiction',
            'Flash Fiction',
            'Folklore',
            'Gothic Fiction',
            'Gothic Romance',
            'Graphic Novel',
            'Hard Science Fiction',
            'Hard-Boiled Mystery',
            'Historical Fiction',
            'Historical Mystery',
            'Historical Romance',
            'High Fantasy',
            'Horror',
            'Legal Drama',
            'Legal Thriller',
            'Legend',
            'LGBT Literature',
            'Low Fantasy',
            'Magical Realism',
            'Medical Drama',
            'Medical Fiction',
            'Memoir',
            'Metafiction',
            'Microfiction',
            'Military Fiction',
            'Mythology',
            'Narrative Nonfiction',
            'Noir',
            'Paranormal Fiction',
            'Paranormal Romance',
            'Philosophical Fiction',
            'Picaresque',
            'Police Procedural',
            'Political Fiction',
            'Poetry',
            'Postcolonial Literature',
            'Psychological Fiction',
            'Quest',
            'Realist Literature',
            'Regency Romance',
            'Religious Fiction',
            'Romance',
            'Satire',
            'Science Fantasy',
            'Science Fiction',
            'Self-Help',
            'Short Story',
            'Soft Science Fiction',
            'Space Opera',
            'Speculative Fiction',
            'Sports Fiction',
            'Spy Fiction',
            'Steampunk',
            'Sword and Sorcery',
            'Tall Tale',
            'Thriller and Suspense',
            'Time Travel',
            'Transgressive Fiction',
            'Travel Literature',
            'Tragedy',
            'Urban Fantasy',
            'Urban Fiction',
            'Western',
            'Young Adult'
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
