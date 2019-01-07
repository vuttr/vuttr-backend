![VUTTR](public/logo.png)

# VUTTR

[![Build Status](https://travis-ci.org/vuttr/vuttr-backend.svg?branch=master)](https://travis-ci.org/vuttr/vuttr-backend) [![Maintainability](https://api.codeclimate.com/v1/badges/e28eaaa9b584b057cd17/maintainability)](https://codeclimate.com/github/vuttr/vuttr-backend/maintainability)

Welcome to the "Very Useful Tools to Remember"!

It's a useful tool you can use to organize your bookmarks in a better way than your browser's bookmark manager. This repository contains only the API. To use the VUTTR, you need to run this and the client application.

## Requirements

- PHP >= 7.1.3
- Composer

All other requirements will be verified by the Composer tool.

## Getting Started

- Install project dependencies: `composer install`;
- Create a `.env` file with `cp .env.example .env`;
- Configure database setting in the `.env` file;
- Configure an `APP_KEY` in your `.env` (32 chars string).
- Run `php artisan migrate` and `php artisan db:seed`.

## Running

To get the application server running, just run:

- `php -S localhost:3000 -t public`

The API will be up and running at [localhost:3000](http://localhost:3000).

## Contributing

The tool is in early stage development. When I have something working, I will create a contributing guide.

---

Free logo by [Logo Dust](http://logodust.com/).
