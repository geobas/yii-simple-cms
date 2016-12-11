# Yii 1.1 CMS
A simple CMS to startup your application

## Set up
1. `git clone git@github.com:geobas/yii-simple-cms.git`
2. Run `composer update`
3. Create a database named 'CMS' in your development environment.
4. Run `protected/yiic migrate` from application's root folder.

## Set up unit testing
1. Create a database named 'CMS_test' in your development environment.
2. Run `protected/yiic migrate --connectionID=CMStest` from application's root folder.

## Run unit tests
1. Install [entr](http://entrproject.org) to automatically run tests when something changes
2. Run `find ../ | entr -c phpunit unit` from application's test folder.

## Installed Extensions
1. Yiistrap
2. ExtCkeditor
3. efeed
4. nlsclientscript
