<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Diane's log</title>

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" />
{{--        <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}

    </head>
    <body class="" style="background: #edf2f7;">
        <div class="flex justify-center container mx-auto">
            <div class="w-full max-w-4xl pb-6">
                <section class="text-gray-700 body-font">
                    <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row">
                        <div class="mb-10 lg:max-w-lg md:mb-0">
                            <img class="object-cover object-center rounded-lg" alt="hero" src="/diane.jpg">
                        </div>
                        <div
                            class="flex flex-col items-center text-center lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 md:items-start md:text-left">
                            <h2 class="mb-1 text-xs font-medium tracking-widest text-blue-500 title-font">Qui ?</h2>
                            <h1 class="mb-8 text-2xl font-bold tracking-tighter text-center text-blue-800 lg:text-left lg:text-5xl title-font">
                                Diane Lisarelli
                            </h1>
                            <p class="mb-8 text-base leading-relaxed text-center text-gray-700 lg:text-left lg:text-1xl">
                                Originaire de Nice en PACA (cette région qui réclame aujourd’hui le monopole de l’appellation « Sud »), elle arpentait la Côte d’Azur en vue de cataloguer les plus beaux pins parasols de la Méditerranée, lorsqu’elle nous a adressé une lettre de Saint-Paul- de-Vence, village perché où vint s’établir l’écrivain américain James Baldwin. Elle a longtemps ocié au service actualité des Inrockuptibles, avant de se consacrer à des projets plus littéraires. Entre deux piges pour Libération ou Arte, elle signe notamment dans la NRF.
                            </p>
                            <div class="flex justify-center">
                                <a href="https://twitter.com/dnlsrll" target="_blank" class="inline-flex items-center font-semibold text-blue-700 md:mb-4 lg:mb-0 hover:text-blue-400">
                                    <svg class="w-12 h-12" role="img" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>Twitter icon</title><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="flex items-center mx-4 my-1 font-medium py-1 px-4 rounded-md text-yellow-700 bg-yellow-100 border border-yellow-300 ">
                    <div class="text-xl font-normal ml-4 max-w-full flex-initial">
                        <div class="py-2 font-bold">Important
                            <div class="text-sm font-base">Ces articles sont bla bla bla, merci de ne pas les partager bla bla bla.</div>
                        </div>
                    </div>
                </div>
                <div class="mt-16 px-4">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Liste des publications passées</h1>
                </div>
                @foreach($posts as $post)
                    <div class="mt-6 px-4">
                        <div class="px-10 py-6 bg-white rounded-lg shadow-md">
                            <div class="flex items-center">
                                <span class="text-gray-600">Publié en {{ $post->publish_date->formatLocalized('%B %Y') }} dans </span>
                                <span class="font-bold pl-2">{{ $post->client }}</span>
                            </div>
                            <div class="mt-2">
                                <div class="text-2xl text-gray-700 font-bold">
                                    {{ $post->title }}
                                </div>
                                <p class="mt-2 text-gray-600">
                                    {{ $post->description }}
                                </p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    @if($post->link)
                                        <div class="mb-2">
                                            Lien: <a href="{{ $post->link }}" target="_blank" class="pl-1 text-blue-500 hover:underline">
                                                Visiter
                                            </a>
                                        </div>
                                    @endif
                                    @if($post->pdf)
                                        <div>
                                            Pdf: <a href="{{ route("pdf-download", $post) }}" class="pl-1 text-blue-500 hover:underline">Télécharger</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-32">
                </div>
            </div>
        </div>
    </body>
</html>
