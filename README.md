
# Bowling Game

## Setup

- PHP >= 7.1 
- Make sure composer is installed
- Extract repository into your apache/nginx server root directory
- Go to project directory and run `composer install` to install all dependencies


## Example Inputs (Inside Terminal)

Go to your project directory and run following commands, to test its working

```
php artisan bowling:play "[[5,2],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]]"

php artisan bowling:play "[[10],[10],[10],[10],[10],[10],[10],[10],[10],[10,10,10]]"

php artisan bowling:play "[[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1]]"
```

For more help you may run:

```
php artisan help bowling:play

```

## Execute All Tests

```
./vendor/bin/phpunit tests/
```

## Major Files

```
app/Console/Commands/PlayBowling.php
app/Models/BowlingGame.php
```

```
tests/Features/SetInputFramesTest.php
tests/Features/ViewScoreHistoryTest.php
```

Cheers !