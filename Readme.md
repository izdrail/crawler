# Crawler Boat

This package is designed to provide a simple and efficient solution for Laravel users who want to extract full text and sentiment analysis from a provided link.
The package is built using the Laravel PHP framework and utilizes [V1.NLPAPI.ORG](https://v1.nlpapi.org/docs) the latest advancements in natural language processing to deliver accurate results.

The main feature of the package is the "getSentiment" method which enables the user to easily extract the full text from a given link.
The extracted text is then analyzed using advanced sentiment analysis algorithms to determine the overall sentiment of the content.
The results of the analysis are presented in a clear and concise format, making it easy for the user to understand and utilize the information.

This package is a great tool for businesses, marketers, and researchers who need to gather information from various sources and analyze it for sentiment and tone.
The user-friendly interface, fast performance, and reliable results make it an essential tool for anyone who needs to process large amounts of information quickly and accurately.

With the Laravel Crawl and Sentiment Analysis Package, you'll be able to extract valuable insights from any link in no time.

## Installation

You can install the package via composer:

```bash
composer require cornatul/crawlerboat
```

## Usage SentimentInterface -  Laravel 9+

```php
@todo implement this
```

## Usage HtmlClientContract -  Laravel 9+

You can use the interface in your own classes by type-hinting against the interface: HtmlClientContract


```php

        $links = [
            'it' => 'https://www.cv-library.co.uk/it-jobs?perpage=100',
        ];

        $object = [
            'base_url' => 'https://www.cv-library.co.uk',
            "links" => $links, //array of links
            "iterator" => "h2.job__title > a", // css selector of a list of links to crawl
            "fields"=> [
                "title" => "h1.job__title > span",
                "body" => "div.job__description",
                "url" => "",
                "category" => "",
                "image" => "img.job__logo",
            ],
        ];


        $htmlStructure = HtmlDTO::from($object);

        $data = $htmlClientContract->extract($htmlStructure);
```
The interface is used in the package to extract data from a given link.

The iterator is used to extract a list of links from the given link.

The fields are used to extract the data from the list of links.

