<?php
// Datei: includes/faq-data.php

$faqData = [
    [
        'question' => 'How do I use this tool?',
        'answer' => [
            'type' => 'ordered-list',
            'content' => [
                'Copy your Steam Workshop collection URL',
                'Paste it into our tool',
                'Click "Generate Commands"',
                'Download the generated command file',
                'Use it with SteamCMD'
            ],
            'additional_text' => 'For detailed instructions, check our <a href="server-setup.php">server setup guide</a>.'
        ]
    ],
    [
        'question' => 'For which platforms does it work?',
        'answer' => [
            'type' => 'text-with-list',
            'intro_text' => 'Our tool works with multiple platforms:',
            'list_items' => [
                'EPIC Games Store',
                'GOG.com',
                'Dedicated game servers (rented or self-hosted)',
                'Any platform supporting SteamCMD integration'
            ],
            'closing_text' => 'It\'s particularly useful for platforms where you own the game but want to use Steam Workshop mods.'
        ]
    ],
    [
        'question' => 'Do I need Steam installed?',
        'answer' => [
            'type' => 'text',
            'content' => 'No, you don\'t need the full Steam client installed. You only need SteamCMD, which is a lightweight command-line version of Steam designed specifically for server operators and downloading workshop content.'
        ]
    ],
    [
        'question' => 'Where are the downloaded mods stored?',
        'answer' => [
            'type' => 'text-with-list',
            'intro_text' => 'Workshop content is downloaded to:',
            'list_items' => [
                'Windows: steamapps\\workshop\\content\\[gameid]',
                'Linux: steamapps/workshop/content/[gameid]'
            ],
            'closing_text' => 'Each mod gets its own folder named after its Workshop ID.'
        ]
    ],
    [
        'question' => 'Is this tool free to use?',
        'answer' => [
            'type' => 'text',
            'content' => 'Yes, this tool is completely free to use. It\'s provided as a service to the gaming community. There are no hidden costs or premium features.'
        ]
    ]
];
?>
