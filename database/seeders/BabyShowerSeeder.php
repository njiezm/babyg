<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use App\Models\Donation;
use App\Models\GiftItem;
use App\Models\GuestbookMessage;
use App\Models\NameOption;
use App\Models\TimelineEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BabyShowerSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('PARENT_ADMIN_EMAIL', 'parents@baby.local')],
            [
                'name' => env('PARENT_ADMIN_NAME', 'Gilles & Maeva'),
                'password' => Hash::make(env('PARENT_ADMIN_PASSWORD', 'ChangeMe123!')),
            ]
        );

        $content = [
            ['general', 'site_title', 'Titre du site', 'Baby Shower - Gilles & Maeva ?', 1],
            ['home', 'hero_badge', 'Badge accueil', 'Juin 2026', 2],
            ['home', 'hero_title', 'Titre accueil', 'Le Petit Prince arrive bientot', 3],
            ['home', 'hero_subtitle', 'Sous-titre accueil', 'Nous preparons notre plus beau voyage ensemble.', 4],
            ['home', 'countdown_target', 'Date compte a rebours', '2026-06-15 00:00:00', 5],
            ['urn', 'urn_goal', 'Objectif urne', '2000', 6],
            ['urn', 'urn_title', 'Titre urne', 'L\'Urne Digitale', 7],
            ['urn', 'urn_subtitle', 'Sous-titre urne', 'Vos contributions serviront a amenager sa chambre.', 8],
            ['urn', 'iban_text', 'IBAN', 'FR76 1234 5678 9000 0000 123 456', 9],
            ['urn', 'paypal_url', 'URL PayPal', 'https://www.paypal.com', 10],
            ['story', 'story_title', 'Titre histoire', 'Notre Histoire d\'Amour', 11],
            ['list', 'list_title', 'Titre liste', 'Liste de Naissance', 12],
            ['names', 'names_title', 'Titre prenoms', 'Votez pour le Prenom', 13],
            ['guestbook', 'guestbook_title', 'Titre livre d\'or', 'Livre d\'Or', 14],
            ['guestbook', 'guestbook_subtitle', 'Sous-titre livre d\'or', 'Partagez vos conseils et vos voeux.', 15],
        ];

        foreach ($content as [$group, $key, $label, $value, $order]) {
            ContentBlock::query()->updateOrCreate(
                ['key' => $key],
                ['group_name' => $group, 'label' => $label, 'value' => $value, 'sort_order' => $order]
            );
        }

        $timeline = [
            ['Le Mariage Civil', 'Decembre 2024', 'Tout a commence officiellement ici. Une journee simple et emouvante sous les neiges de decembre.', 'https://picsum.photos/seed/wedding1/400/300', '2024-12-14', 1],
            ['L\'Union Sacree', 'Decembre 2025', 'Devant nos proches et Dieu, nous avons scelle notre amour lors d\'une magnifique ceremonie.', 'https://picsum.photos/seed/church/400/300', '2025-12-14', 2],
            ['L\'Arrivee du Petit Prince', 'Juin 2026', 'Notre plus beau voyage commence a la Plage des Raisiniers. On est prets !', 'https://picsum.photos/seed/baby/400/300', '2026-06-15', 3],
        ];

        foreach ($timeline as [$title, $subtitle, $description, $image, $date, $order]) {
            TimelineEvent::query()->updateOrCreate(
                ['title' => $title],
                [
                    'subtitle' => $subtitle,
                    'description' => $description,
                    'image_url' => $image,
                    'event_date' => $date,
                    'sort_order' => $order,
                ]
            );
        }

        $gifts = [
            ['Berceau cododo', 'Sommeil', 180, 'https://picsum.photos/seed/Berceaucododo/300/200', true, 'Mamie', 1],
            ['Gigoteuse naissance', 'Sommeil', 35, 'https://picsum.photos/seed/Gigoteusenaissance/300/200', false, null, 2],
            ['Veilleuse nuage', 'Sommeil', 25, 'https://picsum.photos/seed/Veilleusenuage/300/200', false, null, 3],
            ['Baignoire bebe', 'Hygiene', 40, 'https://picsum.photos/seed/Baignoirebebe/300/200', false, null, 4],
            ['Table a langer', 'Hygiene', 120, 'https://picsum.photos/seed/Tablealanger/300/200', true, 'Collegues', 5],
            ['Kit de soins', 'Hygiene', 30, 'https://picsum.photos/seed/Kitdesoins/300/200', false, null, 6],
            ['Chauffe-biberon', 'Repas', 50, 'https://picsum.photos/seed/Chauffebiberon/300/200', false, null, 7],
            ['Poussette trio', 'Sortie', 550, 'https://picsum.photos/seed/Poussettetrio/300/200', true, 'Papa & Maman', 8],
            ['Tapis d\'eveil', 'Eveil', 55, 'https://picsum.photos/seed/Tapisdeveil/300/200', false, null, 9],
            ['Mobile musical', 'Deco', 45, 'https://picsum.photos/seed/Mobilemusical/300/200', false, null, 10],
        ];

        foreach ($gifts as [$name, $category, $price, $image, $reserved, $reservedBy, $order]) {
            GiftItem::query()->updateOrCreate(
                ['name' => $name],
                [
                    'category' => $category,
                    'price' => $price,
                    'image_url' => $image,
                    'is_reserved' => $reserved,
                    'reserved_by' => $reservedBy,
                    'sort_order' => $order,
                ]
            );
        }

        foreach (['Lucas', 'Mathis', 'Gabriel', 'Noah'] as $name) {
            $option = NameOption::query()->firstOrCreate(['name' => $name]);
            if ($option->votes()->count() === 0) {
                $option->votes()->createMany([
                    ['voter_name' => 'Vote initial 1'],
                    ['voter_name' => 'Vote initial 2'],
                ]);
            }
        }

        GuestbookMessage::query()->firstOrCreate(
            ['author' => 'Julie', 'message' => 'Felicitations a vous deux ! Je suis tellement heureuse pour vous.'],
            ['is_approved' => true]
        );

        GuestbookMessage::query()->firstOrCreate(
            ['author' => 'Marc', 'message' => 'Preparez les nuits blanches, mais ca en vaut la peine !'],
            ['is_approved' => true]
        );

        if (Donation::query()->count() === 0) {
            Donation::query()->create([
                'donor_name' => 'Don de lancement',
                'amount' => 820,
                'payment_method' => 'manuel',
                'note' => 'Montant initial affiche',
                'confirmed' => true,
            ]);
        }
    }
}

